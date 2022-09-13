<?php
session_start();
include('database.php');

if(isset($_POST['editfirstname'])){

    $selectedDataID = $_POST['editID'];
    $editfirstname = mysqli_real_escape_string($mysqli,$_POST['editfirstname']);
    $editmiddlename = $_POST['editmiddlename'];
    $editlastname = $_POST['editlastname'];
    $editbirthdate = $_POST['editbirthdate'];

    if($editmiddlename == ''){
        $query = "SELECT * FROM `vaccination_old` WHERE old_data_id='".$selectedDataID."'";
    }else{
        $query = "SELECT * FROM `vaccination_old` WHERE old_data_id='".$selectedDataID."'";
    }
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
        $flagscount = 1;
        $output;
        $dateformat;
        while($row = mysqli_fetch_assoc($result)){
            $output = '';
            $output.='
            <div class="dose-form">
            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF7900; padding:10px; margin-top:10px;">
                <div style="text-align: center;border-bottom:1px solid #FF7900;color: #FF7900;font-weight:500;">Vaccination Details Dose : <label id="vaccdosetext">'.$row['num_dose'].'</label></div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vacctype" style="color: #FF7900;font-weight:500;">Vaccine Shot Type</label>
                            <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-shot'.$flagscount.'">
                                    <option selected>Vaccine Shot | Booster Shot</option>
                                    <option value="Vaccine Shot">Vaccine Shot</option>
                                    <option value="Booster Shot">Booster Shot</option>
                            </select>
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-shot-error'.$flagscount.'"></p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vaccdate" style="color: #FF7900;font-weight:500;">Date Vaccinated</label>
                            <input type="date" class="form-control" id="vaccine-date'.$flagscount.'" style="border: 1px solid #FF7900;">
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-date-error1"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vaccbrand" style="color: #FF7900;font-weight:500;">Vaccine Brand</label>
                            <div class="vaccine-brands'.$flagscount.'">
                                '.vaccinelist($mysqli,$flagscount).'
                            </div>
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-brand-error1"></p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vacccountry" style="color: #FF7900;font-weight:500;">Lot No.</label>
                            <input type="text" class="form-control" id="vaccine-country'.$flagscount.'" style="border: 1px solid #FF7900;" placeholder="Enter Country">
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-country-error1"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vaccarea" style="color: #FF7900;font-weight:500;">Caloocan Vaccination Area</label>
                            <div class="vaccination-selection'.$flagscount.'">
                                '.vaccinationsite($mysqli,$flagscount).'
                            </div>    
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-area-error1"></p>
                            <input type="hidden" class="form-control" id="process-by'.$flagscount.'" style="border: 1px solid #FF7900;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ';
            echo $output;
            //sleep(1);
            $dateformat = date_create($row['date_vaccinated']);
            echo '<script>
                    $("#vaccine-shot'.$flagscount.'").val("'.$row['vaccine_shot_type'].'");
                    $("#vaccine-date'.$flagscount.'").val("'.date_format($dateformat,"Y-m-d").'");
                    $("#vaccine-brand'.$flagscount.'").val("'.$row['vaccine_brand'].'");
                    $("#vaccine-country'.$flagscount.'").val("'.$row['vaccinated_country'].'");
                    $("#vaccine-area'.$flagscount.'").val("'.$row['vaccination_area'].'");
                    $("#process-by'.$flagscount.'").val("'.$row['process_by'].'");
                </script>';
            $flagscount+=1;
        }
        echo '<script>addDose='.($flagscount-1).';
        if(addDose >= 5){
            $(".add-vaccine-btn").hide();
        }else{
            $(".add-vaccine-btn").show();
        }
        </script>';
    }else {
        echo "SELECT * FROM `vaccination_old` WHERE first_name='".$editfirstname."' AND middle_name='".$editmiddlename."' AND last_name='".$editlastname."' AND birth_date='".date('F d, Y',strtotime($editbirthdate))."'";
    }
}

if(isset($_POST['selectedDataID'])){

    $query = "SELECT * FROM `vaccinated_old_data` WHERE ID='".$_POST['selectedDataID']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

if(isset($_POST['functionflags'])){
    $functionflags = $_POST['functionflags'];

    // if($functionflags == 'add'){
        // $firstname = mysqli_real_escape_string($mysqli,$_POST['firstname']);
        // $middlename = mysqli_real_escape_string($mysqli,$_POST['middlename']);
        // $lastname = mysqli_real_escape_string($mysqli,$_POST['lastname']);
        // $birthdate = mysqli_real_escape_string($mysqli,$_POST['birthdate']);
        // $gender = mysqli_real_escape_string($mysqli,$_POST['gender']);
        // $address = mysqli_real_escape_string($mysqli,$_POST['address']);
        // $hours = mysqli_real_escape_string($mysqli,$_POST['hours']);
        // $contactnum = mysqli_real_escape_string($mysqli,$_POST['contactnum']);

        // $vaxtype = $_POST['vaxtype'];
        // $vaxdate = $_POST['vaxdate'];
        // $vaxbrand = $_POST['vaxbrand'];
        // $vaxcountry = $_POST['vaxcountry'];
        // $vaxarea = $_POST['vaxarea'];

        // $totaldose = count($vaxtype);
        // $datelast = $vaxdate[$totaldose-1];
        // $vaccinelastbrand = $vaxbrand[$totaldose-1];
        // $vaccinelastarea = $vaxarea[$totaldose-1];

        // $query = "INSERT INTO `vaccinated_old_data`(`first_name`, `middle_name`, `last_name`, `birth_date`,`gender`,`dose`,`contact_num`,`date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`,`address`) 
        //           VALUES ('".$firstname."','".$middlename."','".$lastname."','".date('F d, Y',strtotime($birthdate))."','".$gender."','".$totaldose."','".$contactnum."','".date('F d, Y',strtotime($datelast))."','".$vaccinelastbrand."','".$vaccinelastbrand."','".$vaccinelastarea."','".$address."')";

        // $result = mysqli_query($mysqli,$query);

        // $query = "SELECT ID FROM `vaccinated_old_data` ORDER BY `vaccinated_old_data`.`ID` DESC LIMIT 1";
        // $result = mysqli_query($mysqli,$query);
        // $rowd = $result->fetch_assoc();
        
        // $num_dose = 1;
        // for($start = 0; $start < $totaldose; $start++ ){

        //     $item_vaxtype = mysqli_real_escape_string($mysqli,$vaxtype[$start]);
        //     $item_vaxdate = mysqli_real_escape_string($mysqli,$vaxdate[$start]);
        //     $item_vaxbrand  = mysqli_real_escape_string($mysqli,$vaxbrand[$start]);
        //     $item_vaxcountry = mysqli_real_escape_string($mysqli,$vaxcountry[$start]);
        //     $item_vaxarea = mysqli_real_escape_string($mysqli,$vaxarea[$start]);

        //     $multiquery ="INSERT INTO `vaccination_old`(`old_data_id`,`first_name`, `middle_name`, `last_name`, `birth_date`, `num_dose`, `vaccine_shot_type`, `vaccine_brand`, `vaccination_area`, `vaccinated_country`, `date_vaccinated`) 
        //                   VALUES ('".$rowd['ID']."','".$firstname."','".$middlename."','".$lastname."','".date('F d, Y',strtotime($birthdate))."','".$num_dose."','".$item_vaxtype."','".$item_vaxbrand."','".$item_vaxarea."','".$item_vaxcountry."','".date('F d, Y',strtotime($item_vaxdate))."')";
        //     $multiresult = mysqli_query($mysqli, $multiquery);
        //     $num_dose+=1;
        // }
    // }else 
    if($functionflags == 'edit'){
        $processby = $_SESSION['username'];
        $getFlagsID = mysqli_real_escape_string($mysqli,$_POST['getFlagsID']);
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

        $query = "UPDATE `vaccinated_old_data` 
                  SET `first_name`='".$firstname."',`middle_name`='".$middlename."',`last_name`='".$lastname."',`birth_date`='".date('F d, Y',strtotime($birthdate))."',`age`='".$getage."',`gender`='".$gender."',`contact_num`='".$contactnum."',`dose`='".$totaldose."',`date_last_vacc`='".date('F d, Y',strtotime($datelast))."',`vaccine`='".$vaccinelastbrand."',`manufacturer`='".$vaccinelastbrand."',`vaccination_area`='".$vaccinelastarea."',`process_by`='".$vaxlastprocess."',`address`='".$address."', `date_inputed`='".date("Y-m-d H:i:s")."'
                  WHERE vaccinated_old_data.ID ='".$getFlagsID."'";

        $result = mysqli_query($mysqli,$query);

        $query = "SELECT id FROM `vaccination_old` WHERE old_data_id='".$getFlagsID."' ORDER BY `vaccination_old`.`id` ASC";
        $result = mysqli_query($mysqli,$query);
        $count = mysqli_num_rows($result);
        
        $start = 0;
        $num_dose = 1;
        while($rowk = mysqli_fetch_assoc($result)){
            $item_vaxtype = mysqli_real_escape_string($mysqli,$vaxtype[$start]);
            $item_vaxdate = mysqli_real_escape_string($mysqli,$vaxdate[$start]);
            $item_vaxbrand  = mysqli_real_escape_string($mysqli,$vaxbrand[$start]);
            $item_vaxcountry = mysqli_real_escape_string($mysqli,$vaxcountry[$start]);
            $item_vaxarea = mysqli_real_escape_string($mysqli,$vaxarea[$start]);
            $item_vaxprocess = mysqli_real_escape_string($mysqli,$vaxprocess[$start]);
    
            $multiquery ="UPDATE `vaccination_old` 
                          SET `first_name`='".$firstname."',`middle_name`='".$middlename."',`last_name`='".$lastname."',`birth_date`='".date('F d, Y',strtotime($birthdate))."',`num_dose`='".$num_dose."',`vaccine_shot_type`='".$item_vaxtype."',`vaccine_brand`='".$item_vaxbrand."',`vaccination_area`='".$item_vaxarea."',`process_by`='".$item_vaxprocess."',`vaccinated_country`='".$item_vaxcountry."',`date_vaccinated`='".date('F d, Y',strtotime($item_vaxdate))."'
                          WHERE vaccination_old.id='".$rowk['id']."'";
            $multiresult = mysqli_query($mysqli, $multiquery);
            $start+=1;
            $num_dose+=1;
        }

        for($count; $count<$totaldose; $count++){
            $item_vaxtypeadd = mysqli_real_escape_string($mysqli,$vaxtype[$count]);
            $item_vaxdateadd = mysqli_real_escape_string($mysqli,$vaxdate[$count]);
            $item_vaxbrandadd  = mysqli_real_escape_string($mysqli,$vaxbrand[$count]);
            $item_vaxcountryadd = mysqli_real_escape_string($mysqli,$vaxcountry[$count]);
            $item_vaxareaadd = mysqli_real_escape_string($mysqli,$vaxarea[$count]);
            $item_vaxprocessadd = mysqli_real_escape_string($mysqli,$vaxprocess[$count]);

            $multiquery ="INSERT INTO `vaccination_old`(`old_data_id`,`first_name`, `middle_name`, `last_name`, `birth_date`, `num_dose`, `vaccine_shot_type`, `vaccine_brand`, `vaccination_area`, `vaccinated_country`,`process_by`,`date_vaccinated`) 
                          VALUES ('".$getFlagsID."','".$firstname."','".$middlename."','".$lastname."','".date('F d, Y',strtotime($birthdate))."','".$num_dose."','".$item_vaxtypeadd."','".$item_vaxbrandadd."','".$item_vaxareaadd."','".$item_vaxcountryadd."','".$item_vaxprocessadd."','".date('F d, Y',strtotime($item_vaxdateadd))."')";
            $multiresult = mysqli_query($mysqli, $multiquery);
            $num_dose+=1;
        }
        // if($totaldose > $count){
        //     $item_vaxtypeadd = mysqli_real_escape_string($mysqli,$vaxtype[$count]);
        //     $item_vaxdateadd = mysqli_real_escape_string($mysqli,$vaxdate[$count]);
        //     $item_vaxbrandadd  = mysqli_real_escape_string($mysqli,$vaxbrand[$count]);
        //     $item_vaxcountryadd = mysqli_real_escape_string($mysqli,$vaxcountry[$count]);
        //     $item_vaxareaadd = mysqli_real_escape_string($mysqli,$vaxarea[$count]);

        //     $multiquery ="INSERT INTO `vaccination_old`(`old_data_id`,`first_name`, `middle_name`, `last_name`, `birth_date`, `num_dose`, `vaccine_shot_type`, `vaccine_brand`, `vaccination_area`, `vaccinated_country`, `date_vaccinated`) 
        //                   VALUES ('".$getFlagsID."','".$firstname."','".$middlename."','".$lastname."','".date('F d, Y',strtotime($birthdate))."','".$num_dose."','".$item_vaxtypeadd."','".$item_vaxbrandadd."','".$item_vaxareaadd."','".$item_vaxcountryadd."','".date('F d, Y',strtotime($item_vaxdateadd))."')";
        //     $multiresult = mysqli_query($mysqli, $multiquery);
        // }
    }
}

function vaccinationsite($mysqli,$currentdose){
    $query = "SELECT * FROM `vaccination_site` ORDER BY `vaccination_name` DESC";
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);

    $output = "";

if($count > 0){
    
    $output.='
    <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF7900;" id="vaccine-area'.$currentdose.'">
        <option selected>--Select Here--</option>';

    while($row = mysqli_fetch_assoc($result)){
        $output.='<option value="'.$row["vaccination_name"].'">'.$row["vaccination_name"].'</option>';
    }

    $output.='</select>';

    }else{
        $output.='
        <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF7900;" id="vaccine-area1">
            <option selected>No Data Found</option>';

        $output.='</select>';
    }

    return $output;
}

function vaccinelist($mysqli,$currentdose){
    
$query = "SELECT * FROM `vaccine_list` ORDER BY `vaccine_list`.`vaccine_name` ASC";
$result = mysqli_query($mysqli,$query);
$count = mysqli_num_rows($result);

$output = "";

if($count > 0){
    
    $output.='
    <select class="custom-select" name="vaccbrand[]" style="border: 1px solid #FF7900;" id="vaccine-brand'.$currentdose.'">
        <option selected>--Select Here--</option>';

    while($row = mysqli_fetch_assoc($result)){
        $output.='<option value="'.$row["vaccine_name"].'">'.$row["vaccine_name"].'</option>';
    }

    $output.='</select>';

    }else{
        $output.='
        <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF7900;" id="vaccine-area1">
            <option selected>No Data Found</option>';

        $output.='</select>';
    }

    return $output;
}

function getAge($date) {
    return intval(date('Y', time() - strtotime($date))) - 1970;
 }


?>