<?php

include('database.php');

$query = "SELECT * FROM `vax_tracing` ORDER BY `vax_tracing`.`date_created` DESC";
$result = mysqli_query($mysqli,$query);
$count = mysqli_num_rows($result);
$output='';
    if($count>0){

    $output.='<div id="table-show">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Account ID</th>
            <th>Name</th>
            <th class="text-center">Gender</th>
            <th class="text-center">Contact Number</th>
            <th class="text-center" style="width: 180px;">Address</th>
            <th class="text-center">Date Scan</th>
        </tr>
        </thead>
        <tbody>
        ';

    while($row = mysqli_fetch_assoc($result)){
        $datelastvac = strtotime($row['date_last_vac']);
        $datecreated = strtotime($row['date_created']);
        $output.='<tr>
                    <td>'.$row['account_unique_id'].'</td>
                    <td>'.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'].'</td>
                    <td class="text-center">'.$row['gender'].'</td>
                    <td class="text-center">'.$row['contact_num'].'</td>
                    <td class="text-left">'.$row['address'].'</td>
                    <td class="text-center">'.date('F d, Y, g:i a',$datecreated).'</td>
                    
                </tr>';
    }
    $output.='</tbody>
        </table>
    </div>';

    echo $output;
    }else{
        $output='';
        $output.='
        <tr>
            <td>No Data Found</td>
        </tr>
        ';
        echo $output;
    }

?>