<?php

include("database.php");


$query = "SELECT * FROM `vax_user_role` ORDER BY `id` ASC";
$result = mysqli_query($mysqli,$query);
$count = mysqli_num_rows($result);

$output = "";

if($count > 0){
    
    $output.='
        <option value="" selected>--Select Here--</option>';

    while($row = mysqli_fetch_assoc($result)){
        $output.='<option value="'.$row["id"].'">'.$row["account_user_role"].'</option>';
    }

}else{
    $output.='
        <option selected>No Data Found</option>';

}

echo $output;

?>