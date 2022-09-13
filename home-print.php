<?php

include('database.php');
include('phpqrcode/qrlib.php');
session_start();

if(isset($_POST['print'])){

    if(isset($_POST['vaccinetype']) && isset($_POST['vaccinedate']) && isset($_POST['vaccbrand']) && isset($_POST['vacccountry']) && isset($_POST['vaccarea'])){

        $imgname = $_FILES['idpicture']['name'];
        $imgsize = $_FILES['idpicture']['size'];
        $imgtmpname = $_FILES['idpicture']['tmp_name'];
        $imgtype = $_FILES['idpicture']['type'];
        $imgerror = $_FILES['idpicture']['error'];

        $filesupload = $_FILES['idpicture'];
        
        $fileExtension = explode('.', $imgname);
        $fileGetExtension = strtolower(end($fileExtension));

        $filenameNew = "IMG".uniqid('',true).".".$fileGetExtension;

        $fileDestination = "uploadimg/".$filenameNew;
        
        move_uploaded_file($imgtmpname,$fileDestination);

        $uniqueID = $_POST['uniqueID'];
        $firstname = mysqli_real_escape_string($mysqli,$_POST['fname']);
        $middlename = mysqli_real_escape_string($mysqli,$_POST['mname']);
        $lastname = mysqli_real_escape_string($mysqli,$_POST['lname']);
        $birthdate = mysqli_real_escape_string($mysqli,$_POST['bdate']);
        $gender = mysqli_real_escape_string($mysqli,$_POST['gender']);
        $address = mysqli_real_escape_string($mysqli,$_POST['address']);
        $hours = mysqli_real_escape_string($mysqli,$_POST['vacchours']);
        $contactnum = mysqli_real_escape_string($mysqli,$_POST['contactnum']);

        $vaxtype = $_POST['vaccinetype'];
        $vaxdate = $_POST['vaccinedate'];
        $vaxbrand = $_POST['vaccbrand'];
        $vaxcountry = $_POST['vacccountry'];
        $vaxarea = $_POST['vaccarea'];

        $totaldose = count($vaxtype);
        $datelast = $vaxdate[$totaldose-1];
        $vaccinelastbrand = $vaxbrand[$totaldose-1];
        $vaccinelastarea = $vaxarea[$totaldose-1];

        $query = "SELECT `ID`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`, `address`, `date_inputed` 
        FROM `vaccinated_old_data` 
        WHERE first_name='".$firstname."'
        AND gender='".$gender."'
        AND last_name='".$lastname."' 
        AND birth_date='".date('F d, Y',strtotime($birthdate))."' 
        AND dose='".$totaldose."' 
        AND date_last_vacc='".date('F d, Y',strtotime($datelast))."' 
        AND manufacturer='".$vaccinelastbrand."'";
        $result = mysqli_query($mysqli,$query);
        $count = mysqli_num_rows($result);

        if($count > 0){
            while($rows = mysqli_fetch_assoc($result)){
                $getID = $rows['ID'];
                $getfirst_name = $rows['first_name'];
                $getmiddle_name = $rows['middle_name'];
                $getlast_name = $rows['last_name'];
                $getbirth_date = $rows['birth_date'];
                $getgender = $rows['gender'];
                $getcontact_num = $rows['contact_num'];
                $getdose = $rows['dose'];
                $getdate_last_vacc = $rows['date_last_vacc'];
                $getmanufacturer = $rows['manufacturer'];
                $getvaccination_area = $rows['vaccination_area'];
                $getaddress = $rows['address'];
            }
            $codeHash = $getID.$getfirst_name.$getlast_name.$getmiddle_name.$getbirth_date.$getgender.$getcontact_num.$getdose.$getdate_last_vacc.$getmanufacturer.$getvaccination_area.$getaddress;

            $_SESSION['fullname'] = $getfirst_name." ".$getmiddle_name." ".$getlast_name;
            $_SESSION['usergender'] = $getgender;
            $_SESSION['userbdate'] = $getbirth_date;
            $_SESSION['vaccinetype'] = $vaxtype;
            $_SESSION['vaccinedate'] = $vaxdate;
            $_SESSION['vaccbrand'] = $vaxbrand;
            $_SESSION['vacccountry'] = $vaxcountry;
            $_SESSION['vaccarea'] = $vaxarea;

            $_SESSION['filename'] = $filenameNew;
            $_SESSION['ID'] = $getID;
            $_SESSION['verificationcode'] = password_hash($codeHash, PASSWORD_DEFAULT);

            $verificationcode = $_SESSION['verificationcode'];

            //QR Codes upload
            $path = "uploadqrcode/";
            $file = $path."QR".uniqid().".png";
            QRcode::png($verificationcode, $file, "L", 10, 1);

            $_SESSION['filenameqr'] = $file;
            $countdose = count($_SESSION['vaccinetype']);

            //Check if it is exist
            $querycheck ="SELECT * FROM vax_created WHERE vax_created.account_unique_id='".$uniqueID."'";
            $result = mysqli_query($mysqli,$querycheck);
            $count = mysqli_num_rows($result);

            if($count > 0){
                $querydelete = "DELETE FROM vax_created WHERE vax_created.account_unique_id='".$uniqueID."'";
                $result = mysqli_query($mysqli,$querydelete);

                $queryinsert ="INSERT INTO `vax_created` (`account_unique_id`, `verification_code`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vac`, `vaccine`, `manufacturer`, `vaccination_area`, `address`, `img_path`, `qr_path`) 
                            VALUES ('".$uniqueID."','".$verificationcode."','".$getfirst_name."','".$getmiddle_name."','".$getlast_name."','".$getbirth_date."','".$getgender."','".$getcontact_num."','".$getdose."','".$getdate_last_vacc."','".$getmanufacturer."','".$getmanufacturer."','".$getvaccination_area."','".$getaddress."',
                            '".$fileDestination."','".$file."')";
                $result = mysqli_query($mysqli,$queryinsert);
            }else{
                $queryinsert ="INSERT INTO `vax_created` (`account_unique_id`, `verification_code`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vac`, `vaccine`, `manufacturer`, `vaccination_area`, `address`, `img_path`, `qr_path`) 
                            VALUES ('".$uniqueID."','".$verificationcode."','".$getfirst_name."','".$getmiddle_name."','".$getlast_name."','".$getbirth_date."','".$getgender."','".$getcontact_num."','".$getdose."','".$getdate_last_vacc."','".$getmanufacturer."','".$getmanufacturer."','".$getvaccination_area."','".$getaddress."',
                            '".$fileDestination."','".$file."')";
                $result = mysqli_query($mysqli,$queryinsert);
            }
            
            header("Location:printvaxcert.php");
            
        }else{
            $_SESSION['check'] = 'Error found, Please Re-login.';
            header('location:index.php');
            exit();
        }
        
    }
    // $data = $_POST;
    // echo "<pre>";
    // var_dump($data);
}

?>

