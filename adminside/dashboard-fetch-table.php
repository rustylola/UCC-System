<?php

include('database.php');

$datestring;
$output='';
$query = "SELECT * FROM `vax_announcement` ORDER BY ID DESC";
$result = mysqli_query($mysqli,$query);
$count = mysqli_num_rows($result);

if($count>0){
    $output.='<table class="table table-hover" id="table-live">
<thead>
    <tr>
        <th>Created By</th>
        <th style="width: 560px;">Post Description</th>
        <th>Date Posted</th>
        <th class="text-center">Action</th>
    </tr>
</thead>
<tbody>';

while($row = mysqli_fetch_assoc($result)){
    $datestring = strtotime($row['date_created']);
    $output.='
    <tr>
        <td>'.$row['created_by'].'</td>
        <td style="width: 560px;">'.$row['post_desc'].'</td>
        <td>'.date('F d, Y',$datestring)."-".date('g:i a',$datestring).'</td>
        <td class="text-center"> 
        <button class="btn btn-primary m-1 edit-data" name="edit" value="Edit" id="'.$row['ID'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
        <button name="delete" value="Delete" class="btn btn-danger delete-data" id="'.$row['ID'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
    </tr>
    
    ';
}

$output.='</tbody>
        </table>';

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