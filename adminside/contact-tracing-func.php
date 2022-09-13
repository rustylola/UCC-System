<?php

include('database.php');

if(isset($_POST['selecteddeleteid'])){
    $selecteddeleteid = mysqli_real_escape_string($mysqli, $_POST['selecteddeleteid']);
    $querydelete = "DELETE FROM vax_tracing WHERE vax_tracing.id='".$selecteddeleteid."'";
    $result = mysqli_query($mysqli,$querydelete);

}else if(isset($_POST['getuniqueID'])){

    $getuniqueID = mysqli_real_escape_string($mysqli, $_POST['getuniqueID']);

    $query = "SELECT * FROM vax_tracing WHERE id='".$getuniqueID."'";
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output= '';
    if($count>0){
        while($rows = mysqli_fetch_assoc($result)){
            $datecreated = strtotime($rows['date_created']);
            $fullname = $rows['last_name'].", ".$rows['first_name']." ".$rows['middle_name'];
            $output.='
                    <div class="modal-body" id="view-delete-Modal-body">
                    <div class="card">
                    <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                        Vaccination Card Information
                    </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Account ID : <label style="font-weight:bold;">'.$rows['account_unique_id'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Date Created : <label style="font-weight:bold;">'.date('F d, Y',$datecreated).'</label></h6>
                            <h6 class="card-title"style="color: #000;">Name : <label style="font-weight:bold;">'.$fullname.'</label></h6>
                            <h6 class="card-title"style="color: #000;">Birth Date : <label style="font-weight:bold;">'.$rows['birth_date'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Gender : <label style="font-weight:bold;">'.$rows['gender'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Address : <label style="font-weight:bold;">'.$rows['address'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Contact Number : <label style="font-weight:bold;">'.$rows['contact_num'].'</label></h6>
                        </div>
                    </div>
                    ';
        }
        echo $output;
    }
}else if(isset($_POST['getdeleteID'])){

    $getdeleteID = mysqli_real_escape_string($mysqli, $_POST['getdeleteID']);

    $query = "SELECT * FROM vax_tracing WHERE id='".$getdeleteID."'";
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output= '';
    if($count>0){
        while($rows = mysqli_fetch_assoc($result)){
            $datecreated = strtotime($rows['date_created']);
            $fullname = $rows['last_name'].", ".$rows['first_name']." ".$rows['middle_name'];
            $output.='
                <div class="alert alert-danger" role="alert">
                    <strong>You want to delete this?</strong><br>
                    Account Number : '.$rows['account_unique_id'].'<br>
                    Name : '.$fullname.'
                </div>
                    ';
        }
        echo $output;
    }
}

?>