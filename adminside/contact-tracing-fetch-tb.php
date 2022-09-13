<?php

include('database.php');

if(isset($_POST['searchdate']) && isset($_POST['searchName'])){
    $searchdate = mysqli_real_escape_string($mysqli, $_POST['searchdate']);
    $datetostring = strtotime($searchdate);
    $datesearch = date("Y-m-d", $datetostring);
    $searchName = mysqli_real_escape_string($mysqli, $_POST['searchName']);

    $searchdate = mysqli_real_escape_string($mysqli, $_POST['searchdate']);
    $query = "SELECT `id`, `account_unique_id`, `verification_code`, CONCAT(`last_name`,', ',`first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vac`, `vaccine`, `manufacturer`, `vaccination_area`, `address`, `date_created` FROM `vax_tracing` WHERE CONCAT(`last_name`,', ',`first_name`,' ', `middle_name`) LIKE '%".$searchName."%' AND date_created LIKE '%".$datesearch."%'";
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
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            ';
    
        while($row = mysqli_fetch_assoc($result)){
            $datelastvac = strtotime($row['date_last_vac']);
            $datecreated = strtotime($row['date_created']);
            $output.='<tr>
                        <td>'.$row['account_unique_id'].'</td>
                        <td>'.$row['Data_Name'].'</td>
                        <td class="text-center">'.$row['gender'].'</td>
                        <td class="text-center">'.$row['contact_num'].'</td>
                        <td class="text-left">'.$row['address'].'</td>
                        <td class="text-center">'.date('F d, Y, g:i a',$datecreated).'</td>
                        <td class="text-center">
                        <button class="btn btn-primary m-1 view-vaxcert" name="view-vaxcert" value="View" id="'.$row['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button class="btn btn-danger delete-vaxcert" name="delete-vaxcert" value="Delete"  id="'.$row['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </td>
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
}else if(isset($_POST['searchdate'])){
    $searchdate = mysqli_real_escape_string($mysqli, $_POST['searchdate']);
    $datetostring = strtotime($searchdate);
    $datesearch = date("Y-m-d", $datetostring);
    $query = "SELECT `id`, `account_unique_id`, `verification_code`, CONCAT(`last_name`,', ',`first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vac`, `vaccine`, `manufacturer`, `vaccination_area`, `address`, `date_created` FROM `vax_tracing` WHERE date_created LIKE '%".$datesearch."%'";
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
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            ';
    
        while($row = mysqli_fetch_assoc($result)){
            $datelastvac = strtotime($row['date_last_vac']);
            $datecreated = strtotime($row['date_created']);
            $output.='<tr>
                        <td>'.$row['account_unique_id'].'</td>
                        <td>'.$row['Data_Name'].'</td>
                        <td class="text-center">'.$row['gender'].'</td>
                        <td class="text-center">'.$row['contact_num'].'</td>
                        <td class="text-left">'.$row['address'].'</td>
                        <td class="text-center">'.date('F d, Y, g:i a',$datecreated).'</td>
                        <td class="text-center">
                        <button class="btn btn-primary m-1 view-vaxcert" name="view-vaxcert" value="View" id="'.$row['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button class="btn btn-danger delete-vaxcert" name="delete-vaxcert" value="Delete"  id="'.$row['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </td>
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
                <td>No Data Found </td>
            </tr>
            ';
            echo $output;
        }
        
}else if(isset($_POST['searchName'])){

    $searchName = mysqli_real_escape_string($mysqli, $_POST['searchName']);
    $query = "SELECT `id`, `account_unique_id`, `verification_code`, CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `gender`, `contact_num`, `dose`, `date_last_vac`, `vaccine`, `manufacturer`, `vaccination_area`, `address`, `date_created` FROM `vax_tracing` WHERE CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) LIKE '%".$searchName."%'";
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
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            ';
    
        while($row = mysqli_fetch_assoc($result)){
            $datelastvac = strtotime($row['date_last_vac']);
            $datecreated = strtotime($row['date_created']);
            $output.='<tr>
                        <td>'.$row['account_unique_id'].'</td>
                        <td>'.$row['Data_Name'].'</td>
                        <td class="text-center">'.$row['gender'].'</td>
                        <td class="text-center">'.$row['contact_num'].'</td>
                        <td class="text-left">'.$row['address'].'</td>
                        <td class="text-center">'.date('F d, Y, g:i a',$datecreated).'</td>
                        <td class="text-center">
                        <button class="btn btn-primary m-1 view-vaxcert" name="view-vaxcert" value="View" id="'.$row['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button class="btn btn-danger delete-vaxcert" name="delete-vaxcert" value="Delete"  id="'.$row['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </td>
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

}else{
    
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
            <th class="text-center">Action</th>
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
                    <td class="text-center">
                        <button class="btn btn-primary m-1 view-vaxcert" name="view-vaxcert" value="View" id="'.$row['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button class="btn btn-danger delete-vaxcert" name="delete-vaxcert" value="Delete"  id="'.$row['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </td>
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
}


?>