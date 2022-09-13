<?php

include("database.php");

if(isset($_POST['flags'])){

    $flags = $_POST['flags'];
    $id = $_POST['getid'];

    $query = "DELETE FROM `vaccination_site` WHERE `vaccination_site`.`id` ='".$id."'";
    $result = mysqli_query($mysqli,$query);

        $output = '';

        if($result){
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Vaccination Site Deleted Successfully.</h3>
                                <h4>&nbsp;&nbsp; Vaccination Site ID : '.$id.' </h4>
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
        
        sleep(3);
        echo $output;

}
?>