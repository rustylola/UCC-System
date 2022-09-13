<?php
session_start();
// $data = $_GET;
// echo "<pre>";
// var_dump($data);
// $datas = $_SESSION;
// echo "<pre>";
// var_dump($datas);

include('account-check.php');


require('fpdf/fpdf.php');

class PDF extends FPDF
{
	/* Load data */
	function LoadData()
	{
        include('database.php');
		/* Read file lines */
		$query = "SELECT `ID`, CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`, `date_inputed`,`process_by`  FROM `vaccinated_old_data` ORDER BY `vaccinated_old_data`.`ID` DESC";
        $result = mysqli_query($mysqli,$query);
        $i = 0;
        $getdata = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($getdata, array("Name"=>$row['Data_Name'],"birth date"=>$row['birth_date']));
            $i++;
        }
		return json_encode($getdata);
	}
	/* Colored table */
	function FancyTable($header, $data)
	{
		/* Colors, line width and bold font */
		$this->SetFillColor(31, 0, 117);
		$this->SetTextColor(255);
		$this->SetDrawColor(209, 212, 207);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		/* Header */
		$w = array(40, 40);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		/* Color and font restoration */
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		/* Data */
		$fill = false;
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0]['Name'],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[0]['birth date'],'LR',0,'L',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		/* Closing line */
		$this->Cell(array_sum($w),0,'','T');
	}
}

$pdf = new PDF();
/* Column headings */
$header = array('Name','Birth Day');
/* Data loading */
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();

?>
