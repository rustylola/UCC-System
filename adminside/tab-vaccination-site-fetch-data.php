<?php

include("database.php");

if(isset($_POST['siteid'])){
    
    $siteid = $_POST['siteid'];
    $query = "SELECT * FROM `vaccination_site` WHERE id='".$siteid."'";

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