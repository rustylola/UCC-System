<?php

include('database.php');

if(isset($_POST['getcode'])){
    $code = mysqli_real_escape_string($mysqli,$_POST['getcode']);
    $querycheck ="SELECT * FROM `vax_created` WHERE verification_code ='".$code."';";
    $result = mysqli_query($mysqli,$querycheck);
    $count = mysqli_num_rows($result);
    $output='';
    if($count > 0){
        while($rows = mysqli_fetch_assoc($result)){
            $fullname = $rows['last_name'].", ".$rows['first_name']." ".$rows['middle_name'];
            $datelast = strtotime($rows['date_last_vac']);
            $output.='
                <div class="col-12 text-center" style="border: 1px solid #FF4600;border-radius:10px 10px 10px 10px;">
                    <div class="col-12">
                        <img src="img/Approve.gif"class="img-fluid" alt="Responsive image" style="width: 250px; height:250px;">
                    </div>
                    <div class="col-12">
                        <div id="tracing-message">
                        </div>
                    </div>
                    <div class="col-12-lg text-center" style="margin:10px;margin-bottom: 20px;">
                        <div class="d-flex flex-column">
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Name : '.$fullname.'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Birth Date : '.$rows['birth_date'].'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Gender : '.$rows['gender'].'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Contact Number : '.$rows['contact_num'].'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Address : '.$rows['address'].'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Dose : '.$rows['dose'].'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Date Last Vaccinated : '.date('F d, Y',$datelast).'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Vaccine/Manufacturer : '.$rows['manufacturer'].'</strong></div>
                            <div class="p-2 text-left" style="color: #FF4600;"><strong>Area Vaccination : '.$rows['vaccination_area'].'</strong></div>
                        </div>
                        <!-- <img src="img/Pictureuse.png"class="img-fluid" style="height:30%;width:30%;margin:20px;border:1px solid #FF4600; padding:10px;"> -->
                    </div>
                </div>
                    ';
        }
        echo $output;
    }else{
        $output.='
                <div class="col-12 text-center" style="border: 1px solid #FF4600;border-radius:10px 10px 10px 10px;margin-bottom: 20px;">
                    <div class="col-12">
                        <img src="img/nodata.gif"class="img-fluid" alt="Responsive image" style="width: 250px; height:250px; padding:20px;">
                    </div>
                        <h4 style="color: #FF4600;">OPPS! SCAN CODE DOES NOT EXIST.</h4>
                        <h4 style="color: #FF4600;">TRY AGAIN.</h4>
                        <!-- <img src="img/Pictureuse.png"class="img-fluid" style="height:30%;width:30%;margin:20px;border:1px solid #FF4600; padding:10px;"> -->
                    </div>
                </div>';
        echo $output;

        exit();
    }

$output = '';

}


?>