<?php

include("database.php");

if(isset($_POST['flags'])){

    $flags = $_POST['flags'];

    $id = $_POST['getid'];
    $vaccine_name = mysqli_real_escape_string($mysqli,$_POST['vaccine_name']);
    $vaccine_address = mysqli_real_escape_string($mysqli,$_POST['vaccine_address']);

    if($flags == 'add-function'){

        $query = "INSERT INTO `vaccine_list` (`vaccine_name`, `vaccine_brand`)
                    VALUES ('".$vaccine_name."','".$vaccine_address."')";
        $result = mysqli_query($mysqli,$query);

        $output = '';

        if($result){
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Vaccine Successfully Added.</h3>
                            </div>
                        </div>';
        }else{
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-times-circle" aria-hidden="true" style="color:red; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Something went wrong. Error : '.$result.'</h3>
                                
                            </div>
                        </div>';
        }
        
        echo $output;

    }else if($flags == 'update-function'){

        $query = "UPDATE `vaccine_list` SET `vaccine_name`='".$vaccine_name."',`vaccine_brand`='".$vaccine_address."' WHERE `vaccine_list`.`id` ='".$id."'";
        $result = mysqli_query($mysqli,$query);

        $output = '';

        if($result){
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Vaccine '.$vaccine_name.' Successfully Updated.</h3>
                                <h4>&nbsp;&nbsp; ID number : '.$id.' </h4>
                            </div>
                        </div>';
        }else{
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-times-circle" aria-hidden="true" style="color:red; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Something went wrong. Error : '.$result.'</h3>
                                
                            </div>
                        </div>';
        }
        
        echo $output;
    }

    sleep(2);
}

?>