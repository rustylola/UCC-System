<?php

include('database.php');

if(isset($_POST['searchID'])){

    $searchID = mysqli_real_escape_string($mysqli, $_POST['searchID']);
    $query = "SELECT * FROM vax_created WHERE account_unique_id LIKE '%".$searchID."%'";
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
                <th class="text-center">Last Vaccinated</th>
                <th class="text-center">Dose</th>
                <th class="text-center">User Img</th>
                <th class="text-center">Generate QrCode</th>
                <th class="text-center">Vaxcert Created</th>
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
                        <td class="text-center">'.date('F d, Y',$datelastvac).'</td>
                        <td class="text-center">'.$row['dose'].'</td>
                        <td class="text-center"><a href="#" class="view-img" id="'.$row['img_path'].'">View Img</a></td>
                        <td class="text-center"><a href="#" class="view-qr" id="'.$row['qr_path'].'">View Qrcode</a></td>
                        <td class="text-center">'.date('F d, Y',$datecreated).'</td>
                        <td class="text-center">
                        <button class="btn btn-primary m-1 view-vaxcert" name="view-vaxcert" value="View" id="'.$row['account_unique_id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button name="delete-vaxcert" value="Delete" class="btn btn-danger delete-vaxcert" id="'.$row['account_unique_id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
    
$query = "SELECT * FROM `vax_created` ORDER BY `vax_created`.`id` DESC";
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
            <th class="text-center">Last Vaccinated</th>
            <th class="text-center">Dose</th>
            <th class="text-center">User Img</th>
            <th class="text-center">Generate QrCode</th>
            <th class="text-center">Vaxcert Created</th>
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
                    <td class="text-center">'.date('F d, Y',$datelastvac).'</td>
                    <td class="text-center">'.$row['dose'].'</td>
                    <td class="text-center"><a href="#" class="view-img" id="'.$row['img_path'].'">View Img</a></td>
                    <td class="text-center"><a href="#" class="view-qr" id="'.$row['qr_path'].'">View Qrcode</a></td>
                    <td class="text-center">'.date('F d, Y',$datecreated).'</td>
                    <td class="text-center">
                        <button class="btn btn-primary m-1 view-vaxcert" name="view-vaxcert" value="View" id="'.$row['account_unique_id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button name="delete-vaxcert" value="Delete" class="btn btn-danger delete-vaxcert" id="'.$row['account_unique_id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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