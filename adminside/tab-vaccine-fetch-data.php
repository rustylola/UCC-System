<?php

include("database.php");

if(isset($_POST['vaccineid'])){
    
    $vaccineid = $_POST['vaccineid'];
    $query = "SELECT * FROM `vaccine_list` WHERE id='".$vaccineid."'";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }else{
        echo $result;
    }

}

?>