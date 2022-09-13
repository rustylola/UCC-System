<?php
include('database.php');

if(isset($_POST['searchrole'])){
    $searchrole = mysqli_real_escape_string($mysqli,$_POST['searchrole']);
    $query = "SELECT * FROM `vax_user_role` WHERE `account_user_role` LIKE '%".$searchrole."%' ";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output='';

    if($count > 0){
    
    $output.='
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th class="text-center" style="width:200px;">Main Role</th>
                            <th class="text-center">Accessibility Sidebar</th>
                            <th>Date Created</th>
                            <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    while($row = mysqli_fetch_assoc($result)){
            
            if($row['account_user_role'] == 'admin' || $row['account_user_role'] == 'user'){
                $output.='
                        <tr>
                            <td>'.$row['account_user_role'].'</td>
                            <td class="text-center">'.$row['account_main_role'].'</td>
                            <td class="text-center">';
                if($row['role_accessibility'] != 'none'){
                    $string = $row['role_accessibility'];
                    $getarray = explode(",",$string); 
                    $getcount = count($getarray);
                    for($i = 0; $i < $getcount; $i++){
                        $output.= '&nbsp;<span class="badge badge-primary">'.$getarray[$i].'</span>';
                    }
                }else{
                    $output.='<span class="badge badge-secondary">none</span>';
                }  
                $output.='
                            </td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" disabled style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" disabled style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
            }else if($row['account_user_role'] == 'staff'){
                $output.='
                        <tr>
                            <td>'.$row['account_user_role'].'</td>
                            <td class="text-center">'.$row['account_main_role'].'</td>
                            <td class="text-center">';
                if($row['role_accessibility'] != 'none'){
                    $string = $row['role_accessibility'];
                    $getarray = explode(",",$string); 
                    $getcount = count($getarray);
                    for($i = 0; $i < $getcount; $i++){
                        $output.= '&nbsp;<span class="badge badge-primary">'.$getarray[$i].'</span>';
                    }
                }else{
                    $output.='<span class="badge badge-secondary">none</span>';
                }  
                $output.='
                            </td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" disabled style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
            }else{
                $output.='
                        <tr>
                            <td>'.$row['account_user_role'].'</td>
                            <td class="text-center">'.$row['account_main_role'].'</td>
                            <td class="text-center">';
                if($row['role_accessibility'] != 'none'){
                    $string = $row['role_accessibility'];
                    $getarray = explode(",",$string); 
                    $getcount = count($getarray);
                    for($i = 0; $i < $getcount; $i++){
                        $output.= '&nbsp;<span class="badge badge-primary">'.$getarray[$i].'</span>';
                    }
                }else{
                    $output.='<span class="badge badge-secondary">none</span>';
                }  
                $output.='
                            </td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
            }
    }
    $output.= '     </tbody>
                </table>';
    echo $output;
    }else{
        echo nodatafound();
    }
}else{
    $query = "SELECT * FROM `vax_user_role` ORDER BY `vax_user_role`.`id` ASC";

    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output='';

    if($count > 0){
    
    $output.='
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th style="width:200px;" class="text-center">Main Role</th>
                            <th class="text-center">Accessibility Sidebar</th>
                            <th>Date Created</th>
                            <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    while($row = mysqli_fetch_assoc($result)){
            
            if($row['account_user_role'] == 'admin' || $row['account_user_role'] == 'user'){
                $output.='
                        <tr>
                            <td>'.$row['account_user_role'].'</td>
                            <td class="text-center">'.$row['account_main_role'].'</td>
                            <td class="text-center">';
                if($row['role_accessibility'] != 'none'){
                    $string = $row['role_accessibility'];
                    $getarray = explode(",",$string); 
                    $getcount = count($getarray);
                    for($i = 0; $i < $getcount; $i++){
                        $output.= '&nbsp;<span class="badge badge-primary">'.$getarray[$i].'</span>';
                    }
                }else{
                    $output.='<span class="badge badge-secondary">none</span>';
                }  
                $output.='
                            </td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" disabled style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" disabled style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
            }else if($row['account_user_role'] == 'staff'){
                $output.='
                        <tr>
                            <td>'.$row['account_user_role'].'</td>
                            <td class="text-center">'.$row['account_main_role'].'</td>
                            <td class="text-center">';
                if($row['role_accessibility'] != 'none'){
                    $string = $row['role_accessibility'];
                    $getarray = explode(",",$string); 
                    $getcount = count($getarray);
                    for($i = 0; $i < $getcount; $i++){
                        $output.= '&nbsp;<span class="badge badge-primary">'.$getarray[$i].'</span>';
                    }
                }else{
                    $output.='<span class="badge badge-secondary">none</span>';
                }  
                $output.='
                            </td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" disabled style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
            }else{
                $output.='
                        <tr>
                            <td>'.$row['account_user_role'].'</td>
                            <td class="text-center">'.$row['account_main_role'].'</td>
                            <td class="text-center">';
                if($row['role_accessibility'] != 'none'){
                    $string = $row['role_accessibility'];
                    $getarray = explode(",",$string); 
                    $getcount = count($getarray);
                    for($i = 0; $i < $getcount; $i++){
                        $output.= '&nbsp;<span class="badge badge-primary">'.$getarray[$i].'</span>';
                    }
                }else{
                    $output.='<span class="badge badge-secondary">none</span>';
                }  
                $output.='
                            </td>
                            <td>'.date("F d, Y h:i A",strtotime($row['datecreated'])).'</td>
                            <td class="text-center" style="width: 200px;">
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-primary edit-btn" style="color:white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-danger delete-btn" style="color:white"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button type="button" value="" id="'.$row['id'].'" class="btn btn-success view-btn" style="color:white"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    ';
            }
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
                                <th>Role</th>
                                <th>Main Role</th>
                                <th class="text-center">Accessibility Sidebar</th>
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