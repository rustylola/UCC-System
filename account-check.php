<?php

session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['uniqueid'])){
    header('location:index.php');
    exit();
}else if($_SESSION['username'] == '' || $_SESSION['uniqueid'] ==''){
    $_SESSION['check'] = 'Please Login';
    header('location:index.php');
    exit();
}

?>