<?php

include('database.php');

if(isset($_POST['searchName']) && isset($_POST['searchVacarea'])){

    $searchVacarea = mysqli_real_escape_string($mysqli, $_POST['searchVacarea']);
    $searchName = mysqli_real_escape_string($mysqli, $_POST['searchName']);
    
    $query = "SELECT `ID`, CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`, `date_inputed`,`process_by` FROM `vaccinated_old_data` WHERE CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) LIKE '%".$searchName."%' AND vaccination_area='".$searchVacarea."'";
    
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $output='';
        $datestring;
        $output.='<table class="table table-hover" id="table-data-old">
    <thead>
        <tr>
            <th style="width:150px;">Name</th>
            <th style="text-align:center;">Date Last Vaccine</th>
            <th style="text-align:center;">Total Dose</th>
            <th style="text-align:center;">Vaccine Brand</th>
            <th style="width:200px;">Vaccination Area</th>
            <th style="text-align:center;">Process By</th>
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>';

   while($row = mysqli_fetch_assoc($result)){ 
        $datestring = strtotime($row['date_last_vacc']);
        $dateupdate = strtotime($row['date_inputed']);
        $output.='
        <tr>
            <td>'.$row['Data_Name'].'</td>
            <td style="text-align:center;">'.$row['date_last_vacc'].'</td>
            <td style="text-align:center;">'.$row['dose'].'</td>
            <td style="text-align:center;">'.$row['manufacturer'].'</td>
            <td style="width:200px;">'.$row['vaccination_area'].'</td>
            <td style="text-align:center;">'.$row['process_by'].'<br>('.date("F d, Y-h:i A",$dateupdate).')</td>
            <td style="text-align:center;"> 
            <button class="btn btn-primary m-1 edit-old-data" name="edit-old-data" value="Edit" id="'.$row['ID'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button class="btn btn-success view-old-data" name="view-old-data" value="View" id="'.$row['ID'].'"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <button class="btn btn-danger m-1 delete-old-data" name="delete-old-data" value="Delete" id="'.$row['ID'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </td>
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
}else if(isset($_POST['searchName'])){

    $searchName = mysqli_real_escape_string($mysqli, $_POST['searchName']);
    $query = "SELECT `ID`,CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`, `date_inputed`,`process_by` FROM `vaccinated_old_data` WHERE CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) LIKE '%".$searchName."%'";
    
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $output='';
        $datestring;
        $output.='<table class="table table-hover" id="table-data-old">
    <thead>
        <tr>
            <th style="width:150px;">Name</th>
            <th style="text-align:center;">Date Last Vaccine</th>
            <th style="text-align:center;">Total Dose</th>
            <th style="text-align:center;">Vaccine Brand</th>
            <th style="width:200px;">Vaccination Area</th>
            <th style="text-align:center;">Process By</th>
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>';

   while($row = mysqli_fetch_assoc($result)){ 
        $datestring = strtotime($row['date_last_vacc']);
        $dateupdate = strtotime($row['date_inputed']);
        $output.='
        <tr>
            <td>'.$row['Data_Name'].'</td>
            <td style="text-align:center;">'.$row['date_last_vacc'].'</td>
            <td style="text-align:center;">'.$row['dose'].'</td>
            <td style="text-align:center;">'.$row['manufacturer'].'</td>
            <td style="width:200px;">'.$row['vaccination_area'].'</td>
            <td style="text-align:center;">'.$row['process_by'].'<br>('.date("F d, Y-h:i A",$dateupdate).')</td>
            <td style="text-align:center;"> 
            <button class="btn btn-primary m-1 edit-old-data" name="edit-old-data" value="Edit" id="'.$row['ID'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button class="btn btn-success view-old-data" name="view-old-data" value="View" id="'.$row['ID'].'"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <button class="btn btn-danger m-1 delete-old-data" name="delete-old-data" value="Delete" id="'.$row['ID'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </td>
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
}else if(isset($_POST['searchVacarea'])){

    $searchVacarea = mysqli_real_escape_string($mysqli, $_POST['searchVacarea']);
    $query = "SELECT `ID`, CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`, `date_inputed`,`process_by` FROM `vaccinated_old_data` WHERE vaccination_area='".$searchVacarea."'";
    
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $output='';
        $datestring;
        $output.='<table class="table table-hover" id="table-data-old">
    <thead>
        <tr>
            <th style="width:150px;">Name</th>
            <th style="text-align:center;">Date Last Vaccine</th>
            <th style="text-align:center;">Total Dose</th>
            <th style="text-align:center;">Vaccine Brand</th>
            <th style="width:200px;">Vaccination Area</th>
            <th style="text-align:center;">Process By</th>
            <th style="text-align:center;">Action</th>
        </tr>
    </thead>
    <tbody>';

   while($row = mysqli_fetch_assoc($result)){ 
        $datestring = strtotime($row['date_last_vacc']);
        $dateupdate = strtotime($row['date_inputed']);
        $output.='
        <tr>
            <td>'.$row['Data_Name'].'</td>
            <td style="text-align:center;">'.$row['date_last_vacc'].'</td>
            <td style="text-align:center;">'.$row['dose'].'</td>
            <td style="text-align:center;">'.$row['manufacturer'].'</td>
            <td style="width:200px;">'.$row['vaccination_area'].'</td>
            <td style="text-align:center;">'.$row['process_by'].'<br>('.date("F d, Y-h:i A",$dateupdate).')</td>
            <td style="text-align:center;"> 
            <button class="btn btn-primary m-1 edit-old-data" name="edit-old-data" value="Edit" id="'.$row['ID'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button class="btn btn-success view-old-data" name="view-old-data" value="View" id="'.$row['ID'].'"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <button class="btn btn-danger m-1 delete-old-data" name="delete-old-data" value="Delete" id="'.$row['ID'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </td>
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
}

?>