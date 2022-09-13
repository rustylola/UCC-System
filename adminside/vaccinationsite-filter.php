<?php
include("database.php");


$query = "SELECT * FROM `vaccination_site` ORDER BY `vaccination_name` DESC";
$result = mysqli_query($mysqli,$query);

$count = mysqli_num_rows($result);

$output = "";

if($count > 0){
    
    $output.='
        <option selected>--Vaccination Area--</option>';

    while($row = mysqli_fetch_assoc($result)){
        $output.='<option value="'.$row["vaccination_name"].'">'.$row["vaccination_name"].'</option>';
    }


}else{
    $output.='
        <option selected>No Data Found</option>';

}

echo $output;

?>