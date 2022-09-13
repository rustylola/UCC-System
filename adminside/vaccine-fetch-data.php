<?php

include("database.php");


$query = "SELECT * FROM `vaccine_list` ORDER BY `vaccine_list`.`vaccine_name` ASC";
$result = mysqli_query($mysqli,$query);
$currentdose = $_POST['currentdose'];
$count = mysqli_num_rows($result);

$output = "";

if($count > 0){
    
    $output.='
    <select class="custom-select" name="vaccbrand[]" style="border: 1px solid #FF7900;" id="vaccine-brand'.$currentdose.'">
        <option selected>--Select Here--</option>';

    while($row = mysqli_fetch_assoc($result)){
        $output.='<option value="'.$row["vaccine_name"].'">'.$row["vaccine_name"].'</option>';
    }

    $output.='</select>';

}else{
    $output.='
    <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF7900;" id="vaccine-area1">
        <option selected>No Data Found</option>';

    $output.='</select>';
}

echo $output;

?>