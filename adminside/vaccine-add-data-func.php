<?php
session_start();
include('database.php');

    
$functionflags = $_POST['functionflags'];

    if($functionflags == 'add'){

        $processby = $_SESSION['username'];
        $firstname = mysqli_real_escape_string($mysqli,$_POST['firstname']);
        $middlename = mysqli_real_escape_string($mysqli,$_POST['middlename']);
        $lastname = mysqli_real_escape_string($mysqli,$_POST['lastname']);
        $birthdate = mysqli_real_escape_string($mysqli,$_POST['birthdate']);
        $gender = mysqli_real_escape_string($mysqli,$_POST['gender']);
        $address = mysqli_real_escape_string($mysqli,$_POST['address']);
        $hours = mysqli_real_escape_string($mysqli,$_POST['hours']);
        $contactnum = mysqli_real_escape_string($mysqli,$_POST['contactnum']);

        $vaxtype = $_POST['vaxtype'];
        $vaxdate = $_POST['vaxdate'];
        $vaxbrand = $_POST['vaxbrand'];
        $vaxcountry = $_POST['vaxcountry'];
        $vaxarea = $_POST['vaxarea'];
        $vaxprocess= $_POST['vaxprocess'];

        $getage = getAge($birthdate);

        $totaldose = count($vaxtype);
        $datelast = $vaxdate[$totaldose-1];
        $vaccinelastbrand = $vaxbrand[$totaldose-1];
        $vaccinelastarea = $vaxarea[$totaldose-1];
        $vaxlastprocess = $vaxprocess[$totaldose-1];

        $query = "INSERT INTO `vaccinated_old_data`(`first_name`, `middle_name`, `last_name`, `birth_date`,`age`,`gender`,`dose`,`contact_num`,`date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`,`process_by`,`address`) 
                  VALUES ('".$firstname."','".$middlename."','".$lastname."','".date('F d, Y',strtotime($birthdate))."','".$getage."','".$gender."','".$totaldose."','".$contactnum."','".date('F d, Y',strtotime($datelast))."','".$vaccinelastbrand."','".$vaccinelastbrand."','".$vaccinelastarea."','".$vaxlastprocess."','".$address."')";

        $result = mysqli_query($mysqli,$query);

        $last_id = mysqli_insert_id($mysqli); // get last insert id
        
        $num_dose = 1;
        for($start = 0; $start < $totaldose; $start++ ){

            $item_vaxtype = mysqli_real_escape_string($mysqli,$vaxtype[$start]);
            $item_vaxdate = mysqli_real_escape_string($mysqli,$vaxdate[$start]);
            $item_vaxbrand  = mysqli_real_escape_string($mysqli,$vaxbrand[$start]);
            $item_vaxcountry = mysqli_real_escape_string($mysqli,$vaxcountry[$start]);
            $item_vaxarea = mysqli_real_escape_string($mysqli,$vaxarea[$start]);
            $item_vaxprocessby = mysqli_real_escape_string($mysqli,$vaxprocess[$start]);

            $multiquery ="INSERT INTO `vaccination_old` (`old_data_id`,`first_name`, `middle_name`, `last_name`, `birth_date`, `num_dose`, `vaccine_shot_type`, `vaccine_brand`, `vaccination_area`, `vaccinated_country`,`process_by`,`date_vaccinated`) 
                          VALUES ('".$last_id."','".$firstname."','".$middlename."','".$lastname."','".date('F d, Y',strtotime($birthdate))."','".$num_dose."','".$item_vaxtype."','".$item_vaxbrand."','".$item_vaxarea."','".$item_vaxcountry."','".$item_vaxprocessby."','".date('F d, Y',strtotime($item_vaxdate))."')";
            $multiresult = mysqli_query($mysqli, $multiquery);
            $num_dose+=1;
        }
    }

    function getAge($date) {
        return intval(date('Y', time() - strtotime($date))) - 1970;
     }
?>