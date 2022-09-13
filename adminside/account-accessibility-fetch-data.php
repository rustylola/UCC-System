<?php

include("database.php");

if(isset($_POST['roleid'])){
    
    $roleid = $_POST['roleid'];
    $query = "SELECT * FROM `vax_user_role` WHERE id='".$roleid."'";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $row = mysqli_fetch_array($result);
        $role_name = $row['account_user_role'];
        $role_main = $row['account_main_role'];
        $string = $row['role_accessibility'];
        $getarray = explode(",",$string); 

        $getalldata = array("role_name"=> $role_name,"role_main"=> $role_main,"role_access"=>$getarray);
        echo json_encode($getalldata);
        
    }else{
        echo $result;
    }

}

?>