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
        global $counting;
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
        $this->Cell(340,6,'CREATED VAXID DATA REPORT',0,0,'C');
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
        
            // $this->SetTextColor(0);
            // $this->SetFont('Arial','B',8);
            // $this->Cell(100,6,'ACCOUNT ROLE : '.strtoupper($_SESSION['accountrole']),1,0,'L');

            // $this->SetTextColor(0);
            // $this->SetFont('Arial','B',8);
            // $this->Cell(100,6,'ACCOUNT NAME : '.strtoupper($_SESSION['username']),1,0,'L');

            // $this->SetTextColor(0);
            // $this->SetFont('Arial','B',8);
            // $this->Cell(80,6,'DATE PRINTED : '.strtoupper(date("F d, Y")),1,0,'L');

            // $this->Ln(7);

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
        $this->SetX(65);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(100,6,strtoupper("Verified by: ".$_SESSION['username']),"",0,'C');

        // $this->SetY(-22);
        // $this->SetX(120);
        // $this->SetTextColor(0);
        // $this->SetFont('Arial','B',8);
        // $this->Cell(50,6,"","",0,'C');

        $this->SetY(-22);
        $this->SetX(180);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(55,6,"","",0,'C');

        $this->SetY(-22);
        $this->SetX(245);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,'',"",0,'C');

        $this->SetY(-22);
        $this->SetX(299);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,strtoupper(date("F d, Y")),"",0,'C');
        // -----------------------------------------
        $this->SetY(-18);
        $this->SetX(10);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(40,6,'ACCOUNT ROLE',"T",0,"C");

        // $this->SetY(-18);
        // $this->SetX(60);
        // $this->SetTextColor(0);
        // $this->SetFont('Arial','B',8);
        // $this->Cell(50,6,'ACCOUNT NAME',"T",0,'C');

        $this->SetY(-18);
        $this->SetX(65);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(100,6,'ACCOUNT NAME AND OVERPRINTED SIGNATURE',"T",0,'C');

        $this->SetY(-18);
        $this->SetX(180);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(55,6,'',"",0,'C');

        $this->SetY(-18);
        $this->SetX(245);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,'',"",0,'C');

        $this->SetY(-18);
        $this->SetX(299);
        $this->SetTextColor(0);
        $this->SetFont('Arial','B',8);
        $this->Cell(45,6,'DATE PRINTED',"T",0,'C');

        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',6);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
$vaccinationarea = $_GET['vaccinationarea'];
$result = mysqli_query($mysqli, "SELECT * FROM `vax_created` ORDER BY `vax_created`.`date_created` DESC") or die("database error:". mysqli_error($mysqli));
$header = array('No','Full Name','Gender','Birth Date','Age','Total Dose','Last Vaccinated','Last Vaccine','Area Vaccinated','Created Vaxcard');
 
$pdf = new PDF();
//header
$pdf->AddPage("L",'LEGAL');
//foter page
$pdf->AliasNbPages();
$no = 0;
foreach($header as $heading){
    if($heading == 'No'){
        $pdf->Cell(5,5,$heading,1,0,'C');
    }else if($heading == 'Total Dose'){
        $pdf->Cell(16,5,$heading,1,0,'C');
    }else if($heading == 'Area Vaccinated'){
        $pdf->Cell(102,5,$heading,1,0,'C');
    }else if($heading == 'Full Name'){
        $pdf->Cell(60,5,$heading,1,0,'C');
    }else if($heading == 'Gender'){
        $pdf->Cell(15,5,$heading,1,0,'C');
    }else if($heading == 'Birth Date'){
        $pdf->Cell(30,5,$heading,1,0,'C');
    }else if($heading == 'Age'){
        $pdf->Cell(15,5,$heading,1,0,'C');
    }else{
        $pdf->Cell(30,5,$heading,1,0,'C');
    }
}

$counting = 0;

while($row = mysqli_fetch_assoc($result)){
    if(isset($_GET['selectday'])){
        $dateinput = strtotime($row['date_created']);
        $specificdbdate = date("F d, Y",$dateinput);
        $vaccinationareafilter = $_GET['vaccinationarea'];
        $specificdate = strtotime($_GET['selectday']);
        $selecteddate = date("F d, Y",$specificdate);
        if($specificdbdate == $selecteddate && $vaccinationareafilter == 'No Filter'){
            $no++;
            $pdf->Ln(6);
            $datelastvac = strtotime($row['date_last_vac']);
            $dateinput = strtotime($row['date_created']);
            $pdf->Cell(5,6,$no,1);
            $pdf->Cell(60,6,$row['last_name'].", ".$row['first_name']." ".$row['middle_name'],1,0,'C');
            $pdf->Cell(15,6,$row['gender'],1,0,'C');
            $pdf->Cell(30,6,$row['birth_date'],1,0,'C');
            $pdf->Cell(15,6,getage($row['birth_date']),1,0,'C');
            $pdf->Cell(16,6,$row['dose'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$datelastvac),1,0,'C');
            $pdf->Cell(30,6,$row['vaccine'],1,0,'C');
            $pdf->Cell(102,6,$row['vaccination_area'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$dateinput),1,0,'C');
        }else if($specificdbdate == $selecteddate && $vaccinationareafilter == $row['vaccination_area']){
            $no++;
            $pdf->Ln(6);
            $datelastvac = strtotime($row['date_last_vac']);
            $dateinput = strtotime($row['date_created']);
            $pdf->Cell(5,6,$no,1);
            $pdf->Cell(60,6,$row['last_name'].", ".$row['first_name']." ".$row['middle_name'],1,0,'C');
            $pdf->Cell(15,6,$row['gender'],1,0,'C');
            $pdf->Cell(30,6,$row['birth_date'],1,0,'C');
            $pdf->Cell(15,6,getage($row['birth_date']),1,0,'C');
            $pdf->Cell(16,6,$row['dose'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$datelastvac),1,0,'C');
            $pdf->Cell(30,6,$row['vaccine'],1,0,'C');
            $pdf->Cell(102,6,$row['vaccination_area'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$dateinput),1,0,'C');
        }
    }else{
        $dateinput = strtotime($row['date_created']);
        $specificdbdate = date("F d, Y",$dateinput);
        $vaccinationareafilter = $_GET['vaccinationarea'];
        $datestart = strtotime($_GET['startdate']);
        $dateend = strtotime($_GET['endate']);
        $selectedstartdate = date("F d, Y",$datestart);
        $selectedenddate = date("F d, Y",$dateend);
        
        // echo ($dateinput > $datestart? "true":"false");
        // echo ($dateinput < $dateend ? "true":"false");
        if($dateinput > $datestart && $dateinput < $dateend && $vaccinationareafilter == 'No Filter'){
            $no++;
            $pdf->Ln(6);
            $datelastvac = strtotime($row['date_last_vac']);
            $dateinput = strtotime($row['date_created']);
            $pdf->Cell(5,6,$no,1);
            $pdf->Cell(60,6,$row['last_name'].", ".$row['first_name']." ".$row['middle_name'],1,0,'C');
            $pdf->Cell(15,6,$row['gender'],1,0,'C');
            $pdf->Cell(30,6,$row['birth_date'],1,0,'C');
            $pdf->Cell(15,6,getage($row['birth_date']),1,0,'C');
            $pdf->Cell(16,6,$row['dose'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$datelastvac),1,0,'C');
            $pdf->Cell(30,6,$row['vaccine'],1,0,'C');
            $pdf->Cell(102,6,$row['vaccination_area'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$dateinput),1,0,'C');
        }else if($dateinput > $datestart && $dateinput < $dateend && $vaccinationareafilter == $row['vaccination_area']){
            $no++;
            $pdf->Ln(6);
            $datelastvac = strtotime($row['date_last_vac']);
            $dateinput = strtotime($row['date_created']);
            $pdf->Cell(5,6,$no,1);
            $pdf->Cell(60,6,$row['last_name'].", ".$row['first_name']." ".$row['middle_name'],1,0,'C');
            $pdf->Cell(15,6,$row['gender'],1,0,'C');
            $pdf->Cell(30,6,$row['birth_date'],1,0,'C');
            $pdf->Cell(15,6,getage($row['birth_date']),1,0,'C');
            $pdf->Cell(16,6,$row['dose'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$datelastvac),1,0,'C');
            $pdf->Cell(30,6,$row['vaccine'],1,0,'C');
            $pdf->Cell(102,6,$row['vaccination_area'],1,0,'C');
            $pdf->Cell(30,6,date("F d, Y",$dateinput),1,0,'C');
        }
    }

}
    $pdf->Ln(6);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(320,6,'TOTAL VAXID CREATED : ',1,0,'R');
    $pdf->Cell(13,6,$no,1,0,'R');

 $pdf->Output();

 function getAge($date) {
    return intval(date('Y', time() - strtotime($date))) - 1970;
}
?>
