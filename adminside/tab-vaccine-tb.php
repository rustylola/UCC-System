<?php

    include('database.php');
if(isset($_POST['vaccinename'])){
    $vaccinename = mysqli_real_escape_string($mysqli,$_POST['vaccinename']);

    $query = "SELECT * FROM `vaccine_list` WHERE vaccine_name LIKE '%".$vaccinename."%'";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output='';

    if($count > 0){
    
    $output.='
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Vaccine Name</th>
                            <th>Vaccine Brand</th>
                            <th>Date Created</th>
                            <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    while($row = mysqli_fetch_assoc($result)){
            
            $output.='
                        <tr>
                            <td>'.$row['vaccine_name'].'</td>
                            <td>'.$row['vaccine_brand'].'</td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
    }
    $output.= '     </tbody>
                </table>';
    echo $output;
    }else{
        echo nodatafound();
    }
}else{
    $query = "SELECT * FROM `vaccine_list` ORDER BY `vaccine_list`.`vaccine_name` ASC";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output='';

    if($count > 0){
    
    $output.='
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Vaccine Name</th>
                            <th>Vaccine Brand</th>
                            <th>Date Created</th>
                            <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    while($row = mysqli_fetch_assoc($result)){
            
            $output.='
                        <tr>
                            <td>'.$row['vaccine_name'].'</td>
                            <td>'.$row['vaccine_brand'].'</td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
    }
    $output.= '     </tbody>
                </table>';
    sleep(3);
    echo $output;
    }else{
        echo nodatafound();
    }
}

    function nodatafound(){
        $output = '';
        $output.='<div class="col-12">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vaccine Name</th>
                                    <th>Vaccine Brand</th>
                                    <th>Date Created</th>
                                    <th class="text-center" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>';
            $output.= '         <tr>
                                    <td>No Data Found</td>
                                </tr>';
            $output.= '     </tbody>
                        </table>
                    </div>';
        return $output;
    }
?>