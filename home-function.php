<?php

include('database.php');

if(isset($_POST['vaxtype']) && isset($_POST['vaxdate']) && isset($_POST['vaxbrand']) && isset($_POST['vaxcountry']) && isset($_POST['vaxarea'])){

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

        $totaldose = count($vaxtype);
        $datelast = $vaxdate[$totaldose-1];
        $vaccinelastbrand = $vaxbrand[$totaldose-1];
        $vaccinelastarea = $vaxarea[$totaldose-1];
        sleep(2);

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
        $output = '';

    if($count > 0){
        $output.= '
        <div id="found-details">
            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:10px; padding-top:0px;">
            <div class="col-12-lg">
                <img src="img/found.gif"class="rounded mx-auto d-block" style="width: 30%; height:30%; margin-top:20px">
            </div>
            <div class="col-12-lg text-center">
                <h5 style="color: #FF4600;margin-top:30px;">
                    Your data found! Click the "Next" button to proceed to the next step.
                </h5>
                <h5 style="color: #FF4600;margin-top:30px;margin-bottom:20px;">
                    Thank you!
                </h5>
            </div>
                <div class="next-btn-4 col-12-lg text-center" style="margin-top: 20px;">
                        <!--next-btn-4-->
                        <button type="button" id="next4" class="btn btn-primary btn-lg" style="background-color: #FF4600 !important; width:300px;">NEXT</button>
                 </div>
            </div>
        </div>';
        $output.='<script>$("#next4").click(function(){
            console.log("low");
            $("#fifth").show();
            $("#fourth").hide();
            $("#progressBar").css("width","90%");
            $("#progressText").html("STEP 5 : Upload Picture");
            
        });</script>';

        echo $output;
    }else{
        $output.= '
        <div id="warning-details">
            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:10px; margin-bottom:10px; padding-top:0px;">
            <div class="col-12-lg">
                <img src="img/warning.gif"class="rounded mx-auto d-block" style="width: 30%; height:30%; margin-top:20px">
            </div>
            <div class="col-12-lg text-center">
                <h5 style="color: #FF4600;margin-top:30px;">
                    Warning ! Your inputed data is not exist, kindly click the "Previous" then check it and replace with the correct data of yours.
                </h5>
                <h5 style="color: #FF4600;margin-top:30px;margin-bottom:20px;">
                    Thank you!
                </h5>
            </div>
                <div class="next-btn-4 col-12-lg text-center" style="margin-top: 20px;">
                <!--prev-btn-3-->
                <button type="button" id="prev3" class="btn btn-secondary btn-lg" style=" width:80%;">PREVIOUS</button>
                </div>
            </div>
        </div>';
        $output.='<script>$("#prev3").click(function(){
            console.log("low");
            $("#second").show();
            $("#fourth").hide();
            $("#progressBar").css("width","30%");
            $("#progressText").html("STEP 2 : Personal Information");
        });</script>';
        echo $output;
    }

    for($start = 0; $start < $totaldose; $start++){
        $item_vaxtype = mysqli_real_escape_string($mysqli,$vaxtype[$start]);
        $item_vaxdate = mysqli_real_escape_string($mysqli,$vaxdate[$start]);
        $item_vaxbrand  = mysqli_real_escape_string($mysqli,$vaxbrand[$start]);
        $item_vaxcountry = mysqli_real_escape_string($mysqli,$vaxcountry[$start]);
        $item_vaxarea = mysqli_real_escape_string($mysqli,$vaxarea[$start]);

        // echo $item_vaxtype."<br>";
        // echo $item_vaxdate."<br>";
        // echo $item_vaxbrand."<br>";
        // echo $item_vaxcountry."<br>";
        // echo $item_vaxarea."<br>";
    }
}

?>