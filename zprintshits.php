<?php
session_start();
// $data = $_GET;
// echo "<pre>";
// var_dump($data);
// $datas = $_SESSION;
// echo "<pre>";
// var_dump($datas);

include('account-check.php');
include('database.php');

require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        global $vaccinationarea;
        $this->Image('../img/vaxlogo.png',169,6,30);
        $this->SetFont('Arial','B',50);
        $this->SetDrawColor(0);
        $this->SetTextColor(255,121,0);
        // Move to the right
        $this->Cell(160,25,'CALO',0,0,'R');
        // Title
        $this->Cell(92,25,' CAN',0,0,'C');
        // Line break
        $this->Ln(28);

        $this->SetTextColor(0);
        $this->SetFont('Arial','B',12);
        $this->Cell(340,6,'PATIENT VACCINATION LIST DATA REPORT',0,0,'C');
        $this->Ln(5);

        if(isset($_GET['selectday'])){
            $specificdate = strtotime($_GET['selectday']);
            $this->SetTextColor(0);
            $this->SetFont('Arial','B',10);
            $this->Cell(340,6,'Date Report : '.date("F d, Y",$specificdate),0,0,'C');
            $this->Ln(7);
        }else{
            //$datenow = new Date();
            $datestart = strtotime($_GET['startdate']);
            $dateend = strtotime($_GET['endate']);
            $this->SetTextColor(0);
            $this->SetFont('Arial','B',10);
            $this->Cell(340,6,'Date Report',0,0,'C');
            $this->Ln(5);
            $this->SetTextColor(0);
            $this->SetFont('Arial','B',10);
            $this->Cell(340,6, date("F d, Y",$datestart).' : '.date("F d, Y",$dateend),0,0,'C');
            $this->Ln(7);
        }
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',7);
    }
 
// Page footer
    function Footer()
    {   
        $this->Ln(1);
        $this->SetY(-22);
        $this->SetX(10);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(40,6,strtoupper($_SESSION['accountrole']),"",0,"C");
        
        $this->SetY(-22);
        $this->SetX(60);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(50,6,strtoupper($_SESSION['username']),"",0,'C');

        $this->SetY(-22);
        $this->SetX(120);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(50,6,"","",0,'C');

        $this->SetY(-22);
        $this->SetX(180);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(55,6,($_GET['agegroup'] == 'No Age' ? 'No Age': $_GET['agegroup'].' y/o'),"",0,'C');

        $this->SetY(-22);
        $this->SetX(245);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,strtoupper(date("F d, Y")),"",0,'C');

        $this->SetY(-22);
        $this->SetX(299);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,$_GET['vaccinationarea'],"",0,'C');
        // -----------------------------------------
        $this->SetY(-18);
        $this->SetX(10);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(40,6,'ACCOUNT ROLE',"T",0,"C");

        $this->SetY(-18);
        $this->SetX(60);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(50,6,'ACCOUNT NAME',"T",0,'C');

        $this->SetY(-18);
        $this->SetX(120);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(50,6,'SIGNATURE',"T",0,'C');

        $this->SetY(-18);
        $this->SetX(180);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(55,6,'AGE FILTER',"T",0,'C');

        $this->SetY(-18);
        $this->SetX(245);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,'DATE PRINTED',"T",0,'C');

        $this->SetY(-18);
        $this->SetX(299);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,'VACCINATION AREA',"T",0,'C');

        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',6);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        
    }
}
$vaccinationarea = $_GET['vaccinationarea'];
$result = mysqli_query($mysqli, "SELECT `ID`, CONCAT(`last_name`,', ', `first_name`,' ',`middle_name`) AS Data_Name,`gender`,`age`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`,`process_by`,`date_inputed`  FROM `vaccinated_old_data` ORDER BY `vaccinated_old_data`.`date_inputed` DESC") or die("database error:". mysqli_error($mysqli));

 
$pdf = new PDF();
//header
$pdf->AddPage("L",'Legal');
//foter page
$pdf->AliasNbPages();

$header = array('No','Full Name','Sex','Age','Dose','Date Vaccinated','Vaccine Brand','Area Vaccinated','Lot No.','Process By','Date Process');

foreach($header as $heading){
    if($heading == 'No'){
        $pdf->Cell(5,5,$heading,1,0,'C');
    }else if($heading == 'Dose'){
        $pdf->Cell(40,5,$heading,1,0,'C');
    }else if($heading == 'Process By'){
        $pdf->Cell(25,5,$heading,1,0,'C');
    }else if($heading == 'Area Vaccinated'){
        $pdf->Cell(82,5,$heading,1,0,'C');
    }else if($heading == 'Full Name'){
        $pdf->Cell(60,5,$heading,1,0,'C');
    }else if($heading == 'Date Process'){
        $pdf->Cell(25,5,$heading,1,0,'C');
    }else if($heading == 'Sex'){
        $pdf->Cell(7,5,$heading,1,0,'C');
    }else if($heading == 'Age'){
        $pdf->Cell(7,5,$heading,1,0,'C');
    }else if($heading == 'Date Vaccinated'){
        $pdf->Cell(25,5,$heading,1,0,'C');
    }else if($heading == 'Lot No.'){
        $pdf->Cell(30,5,$heading,1,0,'C');
    }else{
        $pdf->Cell(30,5,$heading,1,0,'C');
    }
}

$no = 0;
$counting = 0;

while($row = mysqli_fetch_assoc($result)){

    $dataid = $row['ID'];
    $fullname = $row['Data_Name'];
    $sex = $row['gender'];
    if($sex == 'Male'){
        $sex = "M";
    }else if($sex == 'Female'){
        $sex = "F";
    }else{
        $sex = "O";
    }
    $age = $row['age'];

    $sql = "SELECT * FROM `vaccination_old` WHERE vaccination_old.old_data_id='".$dataid."' ORDER BY num_dose ASC";
    $results = mysqli_query($mysqli,$sql) or die("database error:". mysqli_error($mysqli));

    $flags = true;
    $sizename = 0;
    while($rows = mysqli_fetch_assoc($results)){
        $count = mysqli_num_rows($results);
        if($count == 1){
            $sizename = 6;
        }else if($count == 2){
            $sizename = 12;
        }else if($count == 3){
            $sizename = 18;
        }else if($count == 4){
            $sizename = 24;
        }else if($count == 5){
            $sizename = 30;
        }else{
            $sizename = 6;
        }

        if(isset($_GET['selectday'])){

            $dateinput = strtotime($rows['date_inputed']);
            $specificdbdate = date("F d, Y",$dateinput);
            $vaccinationareafilter = $_GET['vaccinationarea'];
            $specificdate = strtotime($_GET['selectday']);
            $selecteddate = date("F d, Y",$specificdate);
    
            $getagefilter = strval($_GET['agegroup']);
            $arrayAge = [];
            $arrayAge = explode("-", $getagefilter);
            
            if($specificdbdate == $selecteddate && $vaccinationareafilter == 'No Filter'){
                
                if($getagefilter == 'No Age'){
                    
                    $pdf->Ln(6);
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);
                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }

                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');

                }else if($row['age'] > intval($arrayAge[0]) && $row['age'] < intval($arrayAge[1])){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);

                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');
                }
    
            }else if($specificdbdate == $selecteddate && $vaccinationareafilter == $row['vaccination_area']){
                if($getagefilter == 'No Age'){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);

                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');

                }else if($row['age'] > intval($arrayAge[0]) && $row['age'] < intval($arrayAge[1])){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);

                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');
                }
            }
        }else{
    
            $dateinput = strtotime($rows['date_inputed']);
            $specificdbdate = date("F d, Y",$dateinput);
            $vaccinationareafilter = $_GET['vaccinationarea'];
            $datestart = strtotime($_GET['startdate']);
            $dateend = strtotime($_GET['endate']);
            $selectedstartdate = date("F d, Y",$datestart);
            $selectedenddate = date("F d, Y",$dateend);
            $getagefilter = strval($_GET['agegroup']);
            $arrayAge = [];
            $arrayAge = explode("-", $getagefilter);
            // echo ($dateinput > $datestart? "true":"false");
            // echo ($dateinput < $dateend ? "true":"false");
            if($dateinput > $datestart && $dateinput < $dateend && $vaccinationareafilter == 'No Filter'){
                if($getagefilter == 'No Age'){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);
                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');
                }else if($row['age'] > intval($arrayAge[0]) && $row['age'] < intval($arrayAge[1])){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);
                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');
                }
                
            }else if($dateinput > $datestart && $dateinput < $dateend && $vaccinationareafilter == $row['vaccination_area']){
                if($getagefilter == 'No Age'){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);
                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');
                }else if($row['age'] > intval($arrayAge[0]) && $row['age'] < intval($arrayAge[1])){
                    
                    $pdf->Ln(6);
    
                    $datelastvac = strtotime($rows['date_vaccinated']);
                    $dateinput = strtotime($rows['date_inputed']);
                    

                    if($flags){
                        $no++;
                        $pdf->Cell(5,$sizename,$no,1);
                        $pdf->Cell(60,$sizename,$fullname,1);
                        $pdf->Cell(7,$sizename,$sex,1,0,'C');
                        $pdf->Cell(7,$sizename,$age,1,0,'C');
                        $flags = false;
                    }else{
                        $pdf->Cell(5);
                        $pdf->Cell(60);
                        $pdf->Cell(7);
                        $pdf->Cell(7);
                    }
                    
                    $pdf->Cell(40,6,$rows['num_dose'].doseidentifier($rows['num_dose'])." ".$rows['vaccine_shot_type'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$datelastvac),1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccine_brand'],1,0,'C');
                    $pdf->Cell(82,6,$rows['vaccination_area'],1,0,'C');
                    $pdf->Cell(30,6,$rows['vaccinated_country'],1,0,'C');
                    $pdf->Cell(25,6,$rows['process_by'],1,0,'C');
                    $pdf->Cell(25,6,date("F d, Y",$dateinput),1,0,'C');
                }
            }
        }
    }

}

    $pdf->Ln(6);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(324,6,'TOTAL : ',1,0,'R');
    $pdf->Cell(10,6,$no,1,0,'R');
    $pdf->Output();
function doseidentifier($dose){
    if($dose == 1){
        return "st";
    }else if($dose == 2){
        return "nd";
    }else if($dose == 3){
        return "rd";
    }else if($dose == 4){
        return "th";
    }else if($dose == 5){
        return "th";
    }
}
    
?>
