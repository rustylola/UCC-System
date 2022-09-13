<?php
session_start();
include('database.php');

if(isset($_POST['delete-selected-id'])){
    $query = "DELETE FROM `vax_user_acc` WHERE `vax_user_acc`.`Unique_ID` = '".$_POST['delete-selected-id']."'";
    $result = mysqli_query($mysqli,$query);
    if($result){
        $_SESSION['message'] = "Delete Success.";
        $_SESSION['type'] = "success";
    }else{
        $_SESSION['message'] = "Delete failed.";
        $_SESSION['type'] = "warning";
    }
}

if(isset($_POST['accountdeleteID'])){
    $query = "SELECT * FROM `vax_user_acc` WHERE Unique_ID='".$_POST['accountdeleteID']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

if(isset($_POST['username']) && isset($_POST['email'])){

    $accrole = mysqli_real_escape_string($mysqli, $_POST['accrole']);
    $accountID = mysqli_real_escape_string($mysqli, $_POST['uniqueID']);
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, password_hash($_POST['password'], PASSWORD_DEFAULT));
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $datenow = date('Y/m/d H:i:s');
    $add_by_role = $_SESSION['accountrole'];
    $add_by_username = $_SESSION['username'];
    $add_by = $add_by_role."-".$add_by_username;
    if(!empty($accountID)){
        $query = "UPDATE `vax_user_acc` SET `user_name`='".$username."',`email`='".$email."',`password`='".$password."',`date_created`='".$datenow."',`account_role`='".$accrole."',`add_by`='".$add_by."' WHERE Unique_ID='".$accountID."'";

        $result = mysqli_query($mysqli,$query);

        if($result){
            $_SESSION['message'] = "Update Success.";
            $_SESSION['type'] = "success";
        }else{
            $_SESSION['message'] = "Update failed.".$query;
            $_SESSION['type'] = "warning";
        }
    }else{
        $newAccountID = strtoupper(uniqid());

        $query = "INSERT INTO `vax_user_acc`(`Unique_ID`, `user_name`, `email`, `password`,`account_role`,`add_by`) VALUES ('".$newAccountID."','".$username."','".$email."','".$password."','".$accrole."','".$add_by."');";

        $result = mysqli_query($mysqli,$query);

        if($result){
            $_SESSION['message'] = "Add Success.";
            $_SESSION['type'] = "success";
        }else{
            $_SESSION['message'] = "Add failed.";
            $_SESSION['type'] = "warning";
        }
    }
}

if(isset($_POST['accountID'])){
    $query = "SELECT * FROM `vax_user_acc` WHERE Unique_ID='".$_POST['accountID']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

if(!empty($_POST['username'])){
    $username = $_POST['username'];

    $query = "SELECT `user_name` FROM `vax_user_acc` WHERE user_name='".$username."'";
    $result = mysqli_query($mysqli,$query);

    $count = mysqli_num_rows($result);

    if($count>0) {
        echo "<p class='form-text text-danger font-weight-bold' style='font-size: 12px;' id='username-error'>*Username Already Exist</p>";
        echo "<script>$('#create-edit').prop('disabled',true);</script>";
    }else{
        echo "<p class='form-text text-danger font-weight-bold' style='font-size: 12px;' id='username-error'></p>";
        echo "<script>$('#create-edit').prop('disabled',false);</script>";
    }
}

?>