<?php 

include('database.php');

if(isset($_POST['selectedIDgetlast'])){
    $selectedIDgetlast = $_POST['selectedIDgetlast'];

    $query = "DELETE FROM `vaccinated_old_data` WHERE `vaccinated_old_data`.`ID` = '".$selectedIDgetlast."'";
    $result = mysqli_query($mysqli,$query);
    
    $querys = "DELETE FROM `vaccination_old` WHERE `vaccination_old`.`old_data_id` ='".$selectedIDgetlast."'";
    $results = mysqli_query($mysqli,$querys);
    
}

if(isset($_POST['selectviewID'])){

    $selectviewID = $_POST['selectviewID'];

    $query = "SELECT * FROM `vaccinated_old_data` WHERE ID='".$selectviewID."'";
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output= '';

    if($count > 0){
        while($rows = mysqli_fetch_assoc($result)){
            $fullname = $rows['last_name'].", ".$rows['first_name']." ".$rows['middle_name'];
            $output.='
            <div class="modal-body" id="view-delete-Modal-body">
                <div class="card">
                    <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                        Personal Account
                    </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Name : <label style="font-weight:bold;">'.$fullname.'</label></h6>
                            <h6 class="card-title"style="color: #000;">Birth Date : <label style="font-weight:bold;">'.$rows['birth_date'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Gender : <label style="font-weight:bold;">'.$rows['gender'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Address : <label style="font-weight:bold;">'.$rows['address'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Contact Number : <label style="font-weight:bold;">'.$rows['contact_num'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Last Process By : <label style="font-weight:bold;">'.$rows['process_by'].'</label></h6>
                        </div>
                    </div>
                    ';
        }

        $querys = "SELECT * FROM `vaccination_old` WHERE old_data_id='".$selectviewID."';";
        $results = mysqli_query($mysqli,$querys);
        $counts = mysqli_num_rows($result);

        if($counts > 0){
            $dose=1;
            while($rowss = mysqli_fetch_assoc($results)){
                $output.='       
                    <br>
                    <div class="card">
                        <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                            Vaccine # '.$dose.'
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Vaccine Shot Type : <label style="font-weight:bold;">'.$rowss['vaccine_shot_type'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Date Vaccinated : <label style="font-weight:bold;">'.$rowss['date_vaccinated'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Vaccine Brand : <label style="font-weight:bold;">'.$rowss['vaccine_brand'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Lot No. : <label style="font-weight:bold;">'.$rowss['vaccinated_country'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Caloocan Vaccination Area : <label style="font-weight:bold;">'.$rowss['vaccination_area'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Process By : <label style="font-weight:bold;">'.$rowss['process_by'].'</label></h6>
                        </div>
                    </div>';
                    $dose+=1;
            }
        }

        $output.='
            </div>
            ';
        echo $output;
    }
    
}

if(isset($_POST['selectdeleteID'])){

    $selectdeleteID = $_POST['selectdeleteID'];

    $query = "SELECT * FROM `vaccinated_old_data` WHERE ID='".$selectdeleteID."'";
    $result = mysqli_query($mysqli,$query);
    $count = mysqli_num_rows($result);
    $output= '';

    if($count > 0){
        while($rows = mysqli_fetch_assoc($result)){
            $fullname = $rows['last_name'].", ".$rows['first_name']." ".$rows['middle_name'];
            $output.='
                <div class="modal-body" id="view-delete-Modal-body">
                <div class="alert alert-warning text-center" role="alert">
                    <strong>Warning!</strong> <br> All data including doses will be deleted, Do you <br> want to delete this recored?
                </div>
                <div class="card">
                    <div class="card-header text-center bg-danger" style="color:white; font-size:25px;">
                        Personal Account
                    </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Name : <label style="font-weight:bold;">'.$fullname.'</label></h6>
                            <h6 class="card-title"style="color: #000;">Birth Date : <label style="font-weight:bold;">'.$rows['birth_date'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Gender : <label style="font-weight:bold;">'.$rows['gender'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Address : <label style="font-weight:bold;">'.$rows['address'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Contact Number : <label style="font-weight:bold;">'.$rows['contact_num'].'</label></h6>
                            <h6 class="card-title"style="color: #000;">Last Process By : <label style="font-weight:bold;">'.$rows['process_by'].'</label></h6>
                        </div>
                    </div>
                    ';
        }
        $output.='
            </div>
            ';
        echo $output;
    }
    
}



?>