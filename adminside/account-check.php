<?php
//session_start();

if($_SESSION['accountrole'] == 'user'){
    header('location:../home.php');
    exit();
}

if(!isset($_SESSION['username']) || !isset($_SESSION['uniqueid'])){
    header('location:../index.php');
    exit();
}else if($_SESSION['username'] == '' || $_SESSION['uniqueid'] ==''){
    $_SESSION['check'] = 'Please Login';
    header('location:../index.php');
    exit();
}

?>