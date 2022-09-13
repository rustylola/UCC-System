<?php

include('database.php');

session_start();

    if(!isset($_SESSION['verificationcode'])){
        $_SESSION['warning-message'] = "Error acquired, Please Complete the forms below.";
        header('Location: home.php');
        exit();
    }

    // $data = $_SESSION;
    // echo "<pre>";
    // var_dump($data);

    $verificationcode = $_SESSION['verificationcode'];
    $uniqueID = $_SESSION['uniqueid'];
    $countdose = count($_SESSION['vaccinetype']);

    $querycheck = "SELECT * FROM `vax_created` WHERE account_unique_id='".$uniqueID."'";
    $result = mysqli_query($mysqli,$querycheck);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Vaxcert</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>
<body id="body">
<div class="container" style="width:900px;">
    <div class="row">
        <button type="button" style="margin-top: 10px;" class="btn btn-primary btn-lg btn-block" id="print-btn"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; &nbsp; PRINT</button>
    </div>
</div>
<div class="container" id="id-print" style="border:1px solid #FF4600; width:900px;margin-top:10px;margin-bottom:20px; padding-bottom:30px;">
    <div class="row d-flex justify-content-center" style="padding-top:20px;">
        <div class="col-3 text-right" style="margin:0px;padding:0px;"><img src="img/Caloocan_City.png"class="img-fluid" alt="Responsive image" style="width: 184.76px; height:183px;margin:0px;padding:0px;"></div>
        <div class="col-6 text-center" style="margin-top:40px;padding:0px;max-width:750px">
            <label style="font-size: 45px; font-weight:bold;margin-bottom:0px;color:#FF4600;">CALOOCAN <label style="color:#007514;margin-bottom:0px;">VAX</label><label style="margin-bottom:0px;color:#B80D0D;">CERT</label></label>
            <br>
            <label style="font-size: 25px; font-weight:bold;color:#FF4600;">Covid-19 Vaccination Certificate</label>
        </div>
        <div class="col-3 text-left" style="margin:0px;padding:0px;"><img src="img/vaxlogo.png"class="img-fluid" alt="Responsive image" style="width:183px; height:183px;margin:0px;padding:0px;"></div>
    </div>
    <div class="row" style="padding-top: 20px;padding-left:50px;padding-right:50px;padding-bottom:10px;">
        <div class="col-12" style="border-top:10px solid #FF4600;">
            
        </div>
    </div>
    <div class="row">
        <div class="col-6 text-right" style="margin:0px;padding:10px;"><img src="<?php echo $row['img_path']?>" style="width: 435px; height:435px;margin:0px;padding:0px;border:10px solid #FF4600;"></div>
        <div class="col-6 text-left" style="margin:0px;padding:10px;"><img src="<?php echo $row['qr_path']?>" style="width: 435px; height:435px;margin:0px;padding:0px;border:10px solid #FF4600;"></div>
    </div>
    <div class="row" style="padding-top: 10px;padding-left:50px;padding-right:50px;padding-bottom:10px;">
        <div class="col-12" style="border-top:10px solid #FF4600;">
        </div>
    </div>
    <div class="row" style="padding-left:50px;padding-right:50px;padding-bottom:10px;">
        <div class="col-6" style="padding:0px;">
            <label style="color:#FF4600;font-size: 18px; font-weight:600; margin:0px;">NAME:</label>
            <h4 style="color:#FF4600;font-size: 28px; font-weight:bold;"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></h4>
            <label style="color:#FF4600;font-size: 18px; font-weight:600; margin:0px;">BIRTH DATE:</label>
            <h4 style="color:#FF4600;font-size: 28px; font-weight:bold;"><?php echo $row['birth_date'];?></h4>
        </div>
        <div class="col-6">
            <label style="color:#FF4600;font-size: 18px; font-weight:600; margin:0px;">ISSUER:</label>
            <h4 style="color:#FF4600;font-size: 28px; font-weight:bold; width:500px;word-break: break-all;">Caloocan Vaxcert Department</h4>
            <label style="color:#FF4600;font-size: 18px; font-weight:600; margin:0px;">GENDER:</label>
            <h4 style="color:#FF4600;font-size: 28px; font-weight:bold;"><?php echo $row['gender'];?></h4>
        </div>
    </div>

    <div class="row" style="padding-left:50px;padding-right:50px;padding-bottom:20px;">
        <div class="col-12" style="border-top:10px solid #FF4600;">
        </div>
    </div>

    <div class="row" style="padding-left:50px;padding-right:50px;padding-bottom:20px;">
        <div class="col-12 text-center" style="border-radius:10px 10px 10px 10px;border:5px solid #FF4600;padding:15px;background-color:#FF4600;">
            <h1 style="font-size: 30px; font-weight:bold;color:white;">Certificate ID : <?php echo $row['account_unique_id'];?></h1>
        </div>
    </div>

    <div class="row" style="padding-left:50px;padding-right:50px;padding-bottom:10px;">
        <div class="col-12" style="border-radius:10px 10px 10px 10px;border:5px solid #FF4600; height:100%;">
        <table class="table">
            <thead>
                <tr class="text-center" style="color:#FF4600; font-size:20px;">
                    <th style="width: 50px;">Number Dose</th>
                    <th style="width: 150px;">Vaccine Shot Type</th>
                    <th style="width: 160px;">Date of Vaccinated</th>
                    <th style="width: 150px;">Vaccine Brand</th>
                    <th style="width: 180px;">Vaccination Location</th>
                    <th style="width: 150px;">Country Vaccinated</th>
                </tr>
            </thead>
            <tbody>
            <?php

                $query = "SELECT `id`, `old_data_id`, `first_name`, `middle_name`, `last_name`, `birth_date`, `num_dose`, `vaccine_shot_type`, `vaccine_brand`, `vaccination_area`, `vaccinated_country`, `date_vaccinated`, `date_inputed` 
                FROM `vaccination_old` 
                WHERE `vaccination_old`.`old_data_id`= '".$_SESSION['ID']."'";
                $result = mysqli_query($mysqli,$query);
                $count = mysqli_num_rows($result);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr class="text-center" style="color:#FF4600;font-size:20px;">
                    <td scope="row" style="font-weight: 600;"><?php echo $row['num_dose']; ?></td>
                    <td style="font-weight: 600;"><?php echo $row['vaccine_shot_type']; ?></td>
                    <td style="font-weight: 600;"><?php echo $row['date_vaccinated']; ?></td>
                    <td style="font-weight: 600;"><?php echo $row['vaccine_brand']; ?></td>
                    <td style="font-weight: 600;"><?php echo $row['vaccination_area'];?></td>
                    <td style="font-weight: 600;"><?php echo $row['vaccinated_country']; ?></td>
                </tr>
            <?php
                    }
                }else{
            ?>
                <tr class="text-center" style="color:#FF4600;font-size:20px;">
                    <th scope="row">No Data Found</th>
                </tr>
            <?php }?>
            </tbody>
            </table>
        </div>
     </div><!--white-space:pre-line , word-break: break-all -->
</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#print-btn').click(function(){
                $('#print-btn').hide();
                window.print();
                location.reload();
            });
        });
        // window.onload = function () {
        //     document.getElementById("print-btn")
        //         .addEventListener("click", () => {
        //             const invoice = this.document.getElementById("id-print");
        //             console.log(invoice);
        //             console.log(window);
        //             var opt = {
        //                 margin:       10,
        // filename:     'MyVaxcert.pdf',
        // image:        { type: 'jpeg', quality: 1 },
        // html2canvas:  { dpi: 300, letterRendering: true, width: 1080, height: 1920},
        // jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
        // pagebreak:    { mode: ['avoid-all', 'css'] }
        //             };
        //             html2pdf().from(invoice).set(opt).save();
        //         })
        // }
    </script>
</body>
</html>