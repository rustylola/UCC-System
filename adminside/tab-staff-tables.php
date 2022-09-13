<?php

include('database.php');

$query = "SELECT vax_user_acc.*,vax_user_role.account_user_role,vax_user_role.account_main_role FROM `vax_user_acc` LEFT OUTER JOIN vax_user_role ON vax_user_acc.account_role=vax_user_role.id";
$result = mysqli_query($mysqli,$query);
$count = mysqli_num_rows($result);

if($count > 0){
    $output='';
    $datestring;
    $output.='<table class="table table-hover" id="table-users">
<thead>
    <tr>
        <th>Account ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created by</th>
        <th>Date Created</th>
        <th class="text-center">Action</th>
    </tr>
</thead>
<tbody>';

while($row = mysqli_fetch_assoc($result)){
    $datestring = strtotime($row['date_created']);
    if($row['account_main_role'] == 'staff'){
        $output.='
        <tr>
            <td>'.$row['Unique_ID'].'</td>
            <td>'.$row['user_name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['account_user_role'].'</td>
            <td>'.$row['add_by'].'</td>
            <td>'.date('F d, Y',$datestring).'</td>
            <td class="text-center"> 
            <button class="btn btn-primary m-1 edit-account" name="edit-account" value="Edit" id="'.$row['Unique_ID'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button name="delete-data" value="Delete" class="btn btn-danger delete-data" id="'.$row['Unique_ID'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </td>
        </tr>';
    }
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