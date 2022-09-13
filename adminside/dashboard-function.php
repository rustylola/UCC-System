<?php

session_start();
include('database.php');

if(isset($_POST['deleteselectedid'])){
    $query = "SELECT * FROM `vax_announcement` WHERE ID='".$_POST['deleteselectedid']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

if(isset($_POST['deleteselectids'])){
    $query = "DELETE FROM `vax_announcement` WHERE `vax_announcement`.`ID` = '".$_POST['deleteselectids']."'";
    $result = mysqli_query($mysqli,$query);
    if($result){
        $_SESSION['message'] = "Delete Success.";
        $_SESSION['type'] = "success";
    }else{
        $_SESSION['message'] = "Delete failed.";
        $_SESSION['type'] = "warning";
    }
}

if(isset($_POST['selectedID'])){

    $query = "SELECT * FROM `vax_announcement` WHERE ID='".$_POST['selectedID']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);

}

if(isset($_POST['creatorname']) && isset($_POST['description'])){

    $selectedID = mysqli_real_escape_string($mysqli, $_POST['selectid']);
    $createdby = mysqli_real_escape_string($mysqli, $_POST['creatorname']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);
    $datenow = date('Y/m/d H:i:s');

    if(!empty($_POST['selectid'])){
        $query = "UPDATE `vax_announcement` SET `post_desc` = '".$description."', `created_by` = '".$createdby."',`date_created` = '".$datenow."' WHERE `vax_announcement`.`ID` = '".$selectedID."'";

        $result = mysqli_query($mysqli,$query);

        if($result){
            $_SESSION['message'] = "Update Success.";
            $_SESSION['type'] = "success";
        }else{
            $_SESSION['message'] = "Update failed.";
            $_SESSION['type'] = "warning";
        }
    }else{
        $query = "INSERT INTO `vax_announcement` (`post_desc`, `created_by`) VALUES ('".$description."', '".$createdby."')";

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

?>