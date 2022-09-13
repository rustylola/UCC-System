<?php

include('database.php');

if(isset($_POST['dateselect'])){
    $selecteddeletedate = mysqli_real_escape_string($mysqli, $_POST['dateselect']);
    $datetostring = strtotime($selecteddeletedate);
    $datesearch = date("Y-m-d", $datetostring);
    $querycheck = "SELECT * FROM `vax_tracing` WHERE date_created LIKE '%".$datesearch."%'";
    $result = mysqli_query($mysqli,$querycheck);
    $count = mysqli_num_rows($result);
    $output = '';
    if($count > 0){

        $querydelete = "DELETE FROM `vax_tracing` WHERE `vax_tracing`.`date_created` LIKE '%".$datesearch."%'";
        $result = mysqli_query($mysqli,$querydelete);

        $output.='<div class="alert alert-success" role="alert">
        <strong>Records deleted successfully.</strong>
        </div>';
    }else{
        $output.='<div class="alert alert-success" role="alert">
        <strong>No Records found</strong>
    </div>';
    }
    echo $output;
}

?>