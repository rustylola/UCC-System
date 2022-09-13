<?php

session_start();
include('database.php');

if(!empty($_POST['username'])){
    $username = $_POST['username'];

    $query = "SELECT `user_name` FROM `vax_user_acc` WHERE user_name='".$username."'";
    $result = mysqli_query($mysqli,$query);

    $count = mysqli_num_rows($result);

    if($count>0) {
        echo "<p class='form-text text-danger font-weight-bold' style='font-size: 12px;' id='username-error'>*Username Already Exist</p>";
        echo "<script>$('#create-account').prop('disabled',true);</script>";
    }else{
        echo "<p class='form-text text-danger font-weight-bold' style='font-size: 12px;' id='username-error'></p>";
        echo "<script>$('#create-account').prop('disabled',false);</script>";
    }
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['uniqueID'])){
    $uniqueid = $_POST['uniqueID'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $query = "INSERT INTO `vax_user_acc`(`Unique_ID`, `user_name`, `email`, `password`,`account_role`,`add_by`) VALUES ('".$uniqueid."','".$username."','".$email."','".$password."','3','owner')";

    if(mysqli_query($mysqli,$query)){
        //do something
    }

}

if(isset($_POST['username-login']) && isset($_POST['password-login'])){
    $usernamelogin = strtolower($_POST['username-login']);
    $passwordlogin = $_POST['password-login'];

    $query = "SELECT vax_user_acc.*,vax_user_role.account_user_role FROM `vax_user_acc` LEFT JOIN vax_user_role ON vax_user_acc.account_role=vax_user_role.id WHERE vax_user_acc.user_name='".$usernamelogin."'";
    $result = mysqli_query($mysqli,$query);

    $count = mysqli_num_rows($result);


    if($count > 0){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($passwordlogin, $row['password']) && strtolower($row['user_name']) == $usernamelogin){
                $_SESSION['username'] = $row['user_name'];
                $_SESSION['uniqueid'] = $row['Unique_ID'];
                $_SESSION['accountrole'] = $row['account_user_role'];
                $_SESSION['accountroleid'] = $row['account_role'];
                echo "<script>window.location.href = 'home.php';</script>";
            }else{
                echo "<h5 id='login-error-body text-center'>Login Failed, Check your password and try Again.</h5>";
            }
        }
    }else{
        echo "<h5 id='login-error-body text-center'>Login Failed, Check your username and password and try Again.</h5>";
    }
}

?>