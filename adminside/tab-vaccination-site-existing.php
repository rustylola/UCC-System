<?php

    include("database.php");

    $sitename = mysqli_real_escape_string($mysqli,$_POST['sitename']);

    $query = "SELECT * FROM `vaccination_site` WHERE vaccination_name='".$sitename."'";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output = '';

    if($count > 0){
        
        $output.='<script>
                    $("#vaccination-site-name-error").html("*Vaccination Site Name Already Exist.");
                    $(".modal-response-btn").attr("disabled",true);
                </script>';

    }else{
        $output.='<script>
                    $("#vaccination-site-name-error").html();
                    $(".modal-response-btn").removeAttr("disabled");
                </script>';
    }
    echo $output;

?>