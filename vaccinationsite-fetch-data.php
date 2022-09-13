<?php

include("database.php");


$query = "SELECT * FROM `vaccination_site` ORDER BY `vaccination_name` DESC";
$result = mysqli_query($mysqli,$query);

$currentdose = $_POST['currentdose'];
$count = mysqli_num_rows($result);

$output = "";

if($count > 0){
    
    $output.='
    <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF4600;" id="vaccine-area'.$currentdose.'">
        <option selected>--Select Here--</option>';

    while($row = mysqli_fetch_assoc($result)){
        $output.='<option value="'.$row["vaccination_name"].'">'.$row["vaccination_name"].'</option>';
    }

    $output.='</select>';

}else{
    $output.='
    <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF4600;" id="vaccine-area1">
        <option selected>No Data Found</option>';

    $output.='</select>';
}

echo $output;

?>