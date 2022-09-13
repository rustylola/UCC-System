<?php

include('database.php');
date_default_timezone_set('Asia/Manila');

if(isset($_POST['getinsert'])){
    $code = mysqli_real_escape_string($mysqli,$_POST['getinsert']);
    $querycheck ="SELECT * FROM `vax_created` WHERE verification_code ='".$code."';";
    $result = mysqli_query($mysqli,$querycheck);
    $count = mysqli_num_rows($result);

    if($count>0){
        while($rows = mysqli_fetch_assoc($result)){
            $uniqueid = $rows['account_unique_id'];
            $verification = $rows['verification_code'];
            $fname = $rows['first_name'];
            $mname = $rows['middle_name'];
            $lname = $rows['last_name'];
            $datelastvax = date('F d, Y', strtotime($rows['date_last_vac']));
            $bdate = date('F d, Y', strtotime($rows['birth_date']));
            $gender = $rows['gender'];
            $address = $rows['address'];
            $area = $rows['vaccination_area'];
            $contactnum = $rows['contact_num'];
            $dose = $rows['dose'];
            $vaccine = $rows['vaccine'];
            $manufacturer = $rows['manufacturer'];
        }

        $queryinsert ="INSERT INTO `vax_tracing` (`account_unique_id`, `verification_code`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vac`, `vaccine`, `manufacturer`, `vaccination_area`, `address`,`date_created`) 
                                    VALUES ('".$uniqueid."','".$verification."','".$fname."','".$mname."','".$lname."','".$bdate."','".$gender."','".$contactnum."','".$dose."','".$datelastvax."','".$vaccine."','".$manufacturer."','".$area."','".$address."','".date('Y-m-d H:i:s')."');";
        
        $result = mysqli_query($mysqli,$queryinsert);
        
        echo $result;
        // $uniqueid.$verification.$fname.$mname.$lname.$bdate.$contactnum.$dose.$datelastvax.$vaccine.$manufacturer.$area.$address;
    }
}

?>