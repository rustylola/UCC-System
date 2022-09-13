<?php

include("database.php");

if(isset($_POST['flags'])){

    $flags = $_POST['flags'];

    $id = $_POST['getid'];
    $getrole_name = mysqli_real_escape_string($mysqli,$_POST['getrole_name']);
    $getrole_selected = $_POST['getrole_selected'];
    $getmain_role = $_POST['getmain_role'];
    $getcountselected = count($getrole_selected);
    $stringselected = '';
    for($i = 0; $i < $getcountselected; $i++){
        if($i == 0){
            $stringselected.=$getrole_selected[$i]['accessbar'];
        }else{
            $stringselected.=','.$getrole_selected[$i]['accessbar'];
        }
    }
    if($flags == 'add-function'){

        $query = "INSERT INTO `vax_user_role` (`account_user_role`,`account_main_role`,`role_accessibility`) 
                    VALUES ('".$getrole_name."','".$getmain_role."','".$stringselected."')";
        $result = mysqli_query($mysqli,$query);

        $output = '';

        if($result){
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Role Successfully Added.</h3>
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

        $query = "UPDATE `vax_user_role` SET `account_user_role`='".$getrole_name."',`account_main_role`='".$getmain_role."',`role_accessibility`='".$stringselected."', `datecreated`='".date("Y-m-d H:i:s")."' WHERE `vax_user_role`.`id` ='".$id."'";
        $result = mysqli_query($mysqli,$query);

        $output = '';

        if($result){
            $output.= '<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Role '.$getrole_name.' Successfully Updated.</h3>
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