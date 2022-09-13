<?php

    include("database.php");

    $vaccinename = mysqli_real_escape_string($mysqli,$_POST['vaccinename']);

    $query = "SELECT * FROM `vaccine_list` WHERE vaccine_name='".$vaccinename."'";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output = '';

    if($count > 0){
        
        $output.='<script>
                    $("#vaccine-name-error").html("*Vaccine Name Already Exist.");
                    $(".modal-response-btn").attr("disabled",true);
                </script>';

    }else{
        $output.='<script>
                    $("#vaccine-name-error").html();
                    $(".modal-response-btn").removeAttr("disabled");
                </script>';
    }
    echo $output;

?>