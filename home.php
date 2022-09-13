<?php include('database.php'); ?>
<?php include('account-check.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC - Caloocan Vaxcert System - Create your vaxcertificate now!</title>
    <link rel="icon" href="img/vaxlogo.png">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        #second,#third,#second-failed,#last-div,#fifth,.end-form{
            display: none;
        }
        form .error{
            font-size: 12px;
            font-weight: bold;
        }
        #scrolls::-webkit-scrollbar {
            width: 0;  /* Remove scrollbar space */
            background: transparent;  /* Optional: just make scrollbar invisible */
        }
    </style>
    
</head>
<body>
    <!--Navigation bar-->
        <nav class="fixed-top">
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fa fa-bars" style="color: #FF4600;"></i>
            </label>
        <label class="logo"><img class="img-fluid" alt="Responsive image" src="img/caloo.png" data-src="holder.js/1920x980?theme=social"  data-holder-rendered="true"></label>
            <ul>
                <li><a href="home.php" class="btn" style="color: #FF4600;">Home</a></li>
                <?php
                if($_SESSION['accountrole'] == 'admin'){
                ?>
                    <li><a href="contact-tracing.php" class="btn" style="color: #FF4600;">Contact Tracing</a></li>
                <?php
                }
                ?>
                <li><a href="QRcode-test.php" class="btn" style="color: #FF4600;">Scan Code</a></li>
                <li><a class="btn" id="logout-click" style="color: #FF4600;">Logout</a></li>
                <?php include('Apk-DownloadLink.php'); ?>
            </ul>
        </nav>

    <!--Carousel Banner-->
        <div class="container" style="margin-top:80px;">
            <?php
                if(isset($_SESSION['username'])){
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><?php echo "Welcome ! ".$_SESSION['username'];?></strong>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <?php
                if(!empty($_SESSION['warning-message'])){
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><?php echo $_SESSION['warning-message'];?></strong>
                    </div>
                </div>
            </div>
            <?php
                unset($_SESSION['warning-message']);}
            ?>
                <div id="carouselFadeExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="img-fluid" alt="Responsive image" src="img/finalbanner.png" data-src="holder.js/1920x980?theme=social"  data-holder-rendered="true" style="width: 100%; height: 100%;">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" alt="Responsive image" src="img/banner1orig.jpg" data-src="holder.js/1920x980?theme=social"  data-holder-rendered="true" style="width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>
        </div>


    <!--Main Content-->
        <div class="container" style="margin-bottom:10px;">
        <form action="home-print.php" id="personal-vaccine-information" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="row" >

                <div class="col-lg-8" >
                    <div class="col-12-sm justify-content-center" style="padding: 5px; color:#FF4600;border-top:1px solid #FF4600;">
                        <h2 style="font-size: 1.65rem;text-align:center;" id="progressText">STEP 1: Review Data Privacy</h2>
                        <div class="progress" style="border: 1px solid #FF4600;">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" id="progressBar"role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 5%">
                                
                            </div>
                        </div>
                    </div>

                    <!--First-->
                    <div id="first" style="margin-bottom: 10px;">
                        <div class="col-12-lg">
                            <img src="img/Caloocan_City.png"class="rounded mx-auto d-block" style="width: 30%; height:30%; margin-top:20px;">
                        </div>
                        <div class="col-12-lg" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:20px;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" style="color: black;">
                                <label class="custom-control-label" for="customCheck1" style="color: #FF4600;font-weight:500;">
                                    Please review and accept the data <a href="#" style="text-decoration:none;">Privacy statement</a> by ticking the box. Make sure you 
                                    have your vaccination card before clicking "NEXT".
                                </label>
                            </div>
                        </div>
                        <div class="next-btn-1 col-12-lg text-center" style="margin-top: 20px;">
                            <!--next-btn-1-->
                            <button type="button" id="next1" class="btn btn-primary btn-lg" style="background-color: #FF4600 !important; width:300px;" disabled>NEXT</button>
                        </div>
                    </div>

                    <!--Second-->
                    <div id="second" style="margin-bottom: 10px;">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname" style="color: #FF4600;font-weight:500;">First Name</label>
                                    <input type="hidden" name="uniqueID" class="form-control" id="uniqueID" style="border: 1px solid #FF4600;" value="<?php echo $_SESSION['uniqueid']; ?>">
                                    <input type="text" name="fname" class="form-control" id="firstname" maxlength="25" placeholder="Enter Firstname" style="border: 1px solid #FF4600;";">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="fname-error"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middlename" style="color: #FF4600;font-weight:500;">Middle Name</label>
                                    <input type="text" name="mname" class="form-control" id="middlename" maxlength="25" placeholder="Enter Middle Name" style="border: 1px solid #FF4600;";">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="mname-error"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname" style="color: #FF4600;font-weight:500;">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lastname" maxlength="25" placeholder="Enter Last Name" style="border: 1px solid #FF4600;";">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="lname-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="birthdate" style="color: #FF4600;font-weight:500;">Birth Date</label>
                                    <input type="Date" name="bdate" class="form-control" id="birthdate" style="border: 1px solid #FF4600;">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="bdate-error"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender" style="color: #FF4600;font-weight:500;">Gender</label>
                                    <select name="gender" id="gender" class="custom-select"style="border: 1px solid #FF4600;">
                                        <option selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="gender-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" style="color: #FF4600; font-weight:500;">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" maxlength="60" style="border: 1px solid #FF4600;"placeholder="Enter address">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="address-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vacchours" style="color: #FF4600; font-weight:500;">Are you vaccinated 48 hours ago?</label>
                                    <select class="custom-select" name="vacchours" id="vacchours" style="border: 1px solid #FF4600;">
                                            <option selected>Yes | No</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                    </select>
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vacchours-error"></p>
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contactnum" style="color: #FF4600; font-weight:500;">Contact Number</label>
                                    <input type="text" name="contactnum" maxlength="14" class="form-control" id="contactnum" style="border: 1px solid #FF4600;"placeholder="Ex. 0912345679">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="contactnum-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6 text-center">
                                <button type="button" id="prev1" class="btn btn-secondary btn-lg" style="width:100%;">PREVIOUS</button>
                            </div>
                            <div class="col-6 text-center">
                                <button type="button" id="next2" class="btn btn-primary btn-lg" style="background-color: #FF4600 !important; width:100%;">NEXT</button>
                            </div>
                        </div>
                    </div>

                    <!--if the user is not 48 hours ago vaccinated-->
                    <div id="second-failed" style="margin-bottom: 10px;">
                        <div class="col-lg-12 text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:20px;">
                            <img src="img/vavava.gif" class="img-fluid" alt="Responsive image">
                            <label style="color: #FF4600;font-weight:500; margin-bottom:0;margin-top:10px;">
                            Sorry for the inconvenience, but we are unable to proceed with your request as you have only received your dose less than 48 hours ago..
                            </label>
                            <label style="color: #FF4600;font-weight:500; margin-bottom:0;margin-top:10px;">
                            If your vaccination dose was given in the last 48 hours, please re-apply after 48 hours to get your vaccination certificate.
                            </label>
                            <h5 style="color: #FF4600;margin:10px;">Thank You!</h5>
                            <button type="button" id="prev1-failed" class="btn btn-secondary btn-lg">PREVIOUS</button>
                        </div>
                    </div>

                    <!--Third-->
                    <div id="third" style="margin-bottom: 10px;">
                        <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:10px; margin-top:10px;">
                            <label style="color: #FF4600; font-weight:500;margin:0;">
                                Enter your vaccination details. Click only the "add dose" if you had more than 1 vaccination
                                dose base on your vaccination card.
                            </label>
                        </div>

                    <!--dose forms-->
                        <div class="dose-form">
                            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:10px; margin-top:10px;">
                                <div style="text-align: center;border-bottom:1px solid #FF4600;color: #FF4600;font-weight:500;">Vaccination Details Dose : <label id="vaccdosetext">1</label></div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vacctype" style="color: #FF4600;font-weight:500;">Vaccine Shot Type</label>
                                            <select class="custom-select" name="vaccinetype[]" style="border: 1px solid #FF4600;" id="vaccine-shot1">
                                                    <option selected>Vaccine Shot | Booster Shot</option>
                                                    <option value="Vaccine Shot">Vaccine Shot</option>
                                                    <option value="Booster Shot">Booster Shot</option>
                                            </select>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-shot-error1"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccdate" style="color: #FF4600;font-weight:500;">Date Vaccinated</label>
                                            <input type="date" name="vaccinedate[]" class="form-control" id="vaccine-date1" style="border: 1px solid #FF4600;">
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-date-error1"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccbrand" style="color: #FF4600;font-weight:500;">Vaccine Brand</label>
                                                <div class="vaccine-brands1">
                                                    <select class="custom-select" name="vaccbrand[]" style="border: 1px solid #FF4600;" id="vaccine-brand1">
                                                            <option selected>--Select Here--</option>
                                                            <option value="AstraZeneca">AstraZeneca</option>
                                                            <option value="Novavax">Novavax</option>
                                                            <option value="BioNTech/Pfizer">BioNTech/Pfizer</option>
                                                            <option value="Moderna">Moderna</option>
                                                            <option value="Gameleya">Gameleya</option>
                                                            <option value="Sanofi/GSK">Sanofi/GSK</option>
                                                            <option value="Johnson & Johnson">Johnson & Johnson</option>
                                                            <option value="Sinovac">Sinovac</option>
                                                            <option value="CureVac">CureVac</option>
                                                            <option value="Sputnik">Sputnik</option>
                                                            <option value="Sinopharm">Sinopharm</option>
                                                    </select>
                                                </div>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-brand-error1"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vacccountry" style="color: #FF4600;font-weight:500;">Lot No.</label>
                                            <input type="text" name="vacccountry[]" class="form-control" id="vaccine-country1" style="border: 1px solid #FF4600;" placeholder="Enter Lot Number">
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-country-error1"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccarea" style="color: #FF4600;font-weight:500;">Caloocan Vaccination Area</label>
                                                <div class="vaccination-selection1">
                                                    <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF4600;" id="vaccine-area1">
                                                        <option selected>--Select Here--</option>
                                                        <option value="Andres Bonifacio Elementary School">Andres Bonifacio Elementary School</option>
                                                        <option value="Buena Park">Buena Park</option>
                                                        <option value="Caloocan High School">Caloocan High School</option>
                                                        <option value="Caloocan City Hall North">Caloocan City Hall North</option>
                                                        <option value="Central Elementary School">Central Elementary School</option>
                                                        <option value="Glorieta, Tala">Glorieta, Tala</option>
                                                        <option value="Gregoria De Jesus">Gregoria De Jesus</option>
                                                        <option value="Maria Clara High School">Maria Clara High School</option>
                                                        <option value="Notredame of Greater Manila, Grace Park Caloocan City">Notredame of Greater Manila, Grace Park Caloocan City</option>
                                                        <option value="SM Sangandaan">SM Sangandaan</option>
                                                        <option value="University of Caloocan City">University of Caloocan City</option>

                                                        <option value="Talipapa High School">Talipapa High School</option>
                                                        <option value="SM Grand Central">SM Grand Central</option>
                                                        <option value="Maypajo High School">Maypajo High School</option>
                                                        <option value="Bagong Silang Elementary School">Bagong Silang Elementary School</option>
                                                        <option value="Caloocan City Medical Center">Caloocan City Medical Center</option>
                                                        <option value="Barangay 152 Covered Court">Barangay 152 Covered Court</option>
                                                    </select>
                                                </div>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-area-error1"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--new dose forms-->
                        <div class="new-dose-form">

                        </div>
                        <!--End new dose forms-->

                        <div class="add-vaccine-btn col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:10px; margin-top:10px;">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a href="javascript:void(0)" class="add-dose btn btn-primary" style="background-color: #FF4600 !important; width:100%;font-size: 20px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 20px;">&nbsp;&nbsp;</i>Add Vaccine Dose</a>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6 text-center">
                                <button type="button" id="prev2" class="btn btn-secondary btn-lg" style="width:100%;">PREVIOUS</button>
                            </div>
                            <div class="col-6 text-center">
                                <button type="button" id="next3" class="btn btn-primary btn-lg" style="background-color: #FF4600 !important; width:100%;">NEXT</button>
                            </div>
                        </div>
                    </div>
                    <div id="fourth">
            
                    </div>

                    <div id="fifth">
                        <div id="finish-details">
                            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:10px;margin-bottom:10px; padding-top:0px;">
                                <div class="row text-center" style="margin-top: 30px;">
                                    <div class="col-5">
                                        <img src="img/uploadhere.gif"class="img-fluid" alt="Responsive image">
                                    </div>
                                    <div class="col-2 align-self-center">
                                        <i class="fa fa-arrow-right" aria-hidden="true" id="arrow-size" style="font-size: 6vw;color:#FF4600;"></i>
                                    </div>
                                    <div class="col-5">
                                        <img src="img/PhotoUpload.gif"class="img-fluid" alt="Responsive image">
                                    </div>
                                </div>
                            <div class="col-12-lg text-center" style="padding:10px;">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="idpicture" lang="en" style="color:#FF4600;">
                                    <label class="custom-file-label" for="customFile" style="border: 1px solid #FF4600;color:#FF4600;">Click this to Upload photo &nbsp;<i class="fa fa-upload" aria-hidden="true"></i></label>
                                </div>
                                <p class="text-danger font-weight-bold" style="font-size: 12px;margin-bottom:0px;" id="picture-error"></p>
                            </div>
                            <div class="col-12-lg text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600;margin:10px;">
                                <h5 style="color: #FF4600;margin-top:5px;padding:10px;">
                                    Note: Take a picture of your face with white background and upload for the certification.
                                </h5>
                                 <!-- <img src="img/Pictureuse.png"class="img-fluid" style="height:30%;width:30%;margin:20px;border:1px solid #FF4600; padding:10px;"> -->
                            </div>
                                <div class="next-btn-4 col-12-lg text-center" style="margin-top: 20px;">
                                    <button type="button" id="nextlast" class="btn btn-primary btn-lg" style="background-color: #FF4600 !important; width:300px;">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="last-div">
                        <div id="Print-details">
                            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:10px;margin-bottom:10px; padding-top:0px;">
                                <div class="row text-center" style="margin-top: 30px;">
                                    <div class="col-5">
                                        <img src="img/pictureslot.png"class="img-fluid" id="showupload" alt="Responsive image" style="width: 250px; height:250px;border:5px solid #FF4600;">
                                    </div>
                                    <div class="col-2 align-self-center">
                                        <i class="fa fa-arrow-right" aria-hidden="true" id="arrow-size" style="font-size: 6vw;color:#FF4600;"></i>
                                    </div>
                                    <div class="col-5">
                                        <img src="img/Pictureuse.png"class="img-fluid" alt="Responsive image" style="width: 250px; height:250px;border:5px solid #FF4600;">
                                    </div>
                                </div>
                            <div class="col-12-lg text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600;margin:10px;">
                                <h5 style="color: #FF4600;margin-top:5px; padding:10px;">
                                    Note: Make sure the photo you upload. Click the "Previous" to change it or click "Print Vaxcert" if you are ready to print the certificate.
                                </h5>
                                 <!-- <img src="img/Pictureuse.png"class="img-fluid" style="height:30%;width:30%;margin:20px;border:1px solid #FF4600; padding:10px;"> -->
                            </div>
                                <div class="row" style="margin-top: 10px; padding:10px;">
                                    <div class="col-6 text-center">
                                        <button type="button" id="prevtofifth" class="btn btn-secondary btn-lg" style="width:100%;">PREVIOUS</button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <button type="submit" name="print" id="print" class="btn btn-primary btn-lg" style="background-color: #FF4600 !important; width:100%;">PRINT VAXCERT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="end-form">
                        <div id="Print-details">
                            <div class="col-12 text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:10px;margin-bottom:10px; padding-top:0px;">
                                    <div class="col-12">
                                        <img src="img/done.gif"class="img-fluid" alt="Responsive image" style="width: 250px; height:250px;">
                                    </div>
                                <h1 style="color: #FF4600;">CONGRASTULATIONS !</h1>
                            <div class="col-12-lg text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600;margin:10px;">
                                <h5 style="color: #FF4600;margin-top:5px; padding:10px;">
                                    You complete and download the printed vaxcert! Remember, always observe physical distancing and wash your hands.
                                </h5>
                                 <!-- <img src="img/Pictureuse.png"class="img-fluid" style="height:30%;width:30%;margin:20px;border:1px solid #FF4600; padding:10px;"> -->
                            </div>
                                <div class="row" style="margin-top: 10px; padding:10px;">
                                    <div class="col-12 text-center">
                                        <button type="button" id="GoBack" class="btn btn-secondary btn-lg" style="width:45%;"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;GO BACK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="col-12-sm justify-content-center" style="padding: 5px; color:#FF4600;border-bottom:1px solid #FF4600;border-top:1px solid #FF4600;">
                        <h2 style="font-size: 1.65rem;text-align:center;">Announcement</h2>
                    </div>
            <div id="scrolls" style="height: 600px; overflow:auto;">
            <!--Announcement List-->
            <?php
                $queryannounce = "SELECT * FROM `vax_announcement` ORDER BY ID DESC";
                $results = mysqli_query($mysqli,$queryannounce);
                $counts = mysqli_num_rows($results);

                if($counts > 0){
                    while($rows = mysqli_fetch_assoc($results)){
                ?>
            
                <div class="col-12" style="margin-top: 10px;border-radius:10px 10px 10px 10px;border:1px solid #FF4600;">
                    <div class="d-flex justify-content-center" id="schedannounce"">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2" style="text-align:start;color: #FF4600;">Posted : <?php $datestring = strtotime($rows['date_created']); echo date('F d, Y',$datestring)." - ".date('g:i a',$datestring);?></div>
                            <div class="p-2" style="text-align:start;color: #FF4600;"><h5> <?php echo $rows['post_desc'];?></h5></div>
                            <div class="p-2" style="text-align:start;">
                            <footer class="blockquote-footer"> Posted By 
                                <cite title="Source Title"><?php echo $rows['created_by']; ?></cite>
                            </div>
                        </div>
                    </div>
                </div>
            
                <?php
                    }
                }else{
                ?>
            <div class="col-12" style="margin-top: 10px;border-radius:10px 10px 10px 10px;border:1px solid #FF4600;">
                <div class="d-flex justify-content-center" id="schedannounce"">
                    <div class="d-flex flex-column container-fluid">
                        <div class="p-2" style="text-align:start;color: #FF4600;">Posted : No Records</div>
                        <div class="p-2" style="text-align:start;color: #FF4600;"><h5>-- NO RECORDS --</h5></div>
                        <div class="p-2" style="text-align:start;">
                        <footer class="blockquote-footer"> Posted By 
                            <cite title="Source Title">NO RECORDS</cite>
                        </div>
                    </div>
                </div>
            </div>
                <?php    
                }
            ?>      </div>
                </div>

            </div>
            </form>
        </div>

    <!--Footer-->
    <div class="container-justify ">
        <div class="d-flex justify-content-around align-items-center bg-white" style="box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.45);height:50px !important;background-image: linear-gradient(360deg, white, #f2f2f2);">
            <div class="p-2"><b class="footcredit" style="color: #FF4600;">CALOOCAN @ VAX GENERATOR </b>
            <?php
                if($_SESSION['accountrole'] != 'user'){
                    ?>
                    <a class="btn btn-primary" href="adminside/dashboard.php" id="admin-btn"><?php echo strtoupper($_SESSION['accountrole']); ?></a>
                    <?php
                }
            ?>    
            </div>
        </div>
    </div>
    
    <div class="modal" id="logout-Modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log out account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    <strong>Are you sure?</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="logout-confirm" class="btn btn-danger">Logout</button>
            </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script type="text/javascript">
        var addDose = 1;
        selectionvaccinationsite(addDose);
        selectionvaccine(addDose);

        $(document).ready(function () {
            
            //file upload
            $(document).on('change', '.custom-file-input', function (event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
            });

            //On click first step -next1-
            $('#next1').click(function(){
                $('#second').show();
                $('#first').hide();
                $('#progressBar').css('width','30%');
                $('#progressText').html('STEP 2 : Personal Information');
            });

            //On Click -Prev1-
            $('#prev1').click(function(){
                $('#second').hide();
                $('#first').show();
                $('#progressBar').css('width','10%');
                $('#progressText').html('STEP 1 : Review Data Privacy');
            });
            $('#prev1-failed').click(function(){
                $('#second-failed').hide();
                $('#second').show();
                $('#progressBar').css('width','30%');
                $('#progressText').html('STEP 2 : Personal Information');
            });

            //On click -next2-
            //Input Validation Step 2
            $('#next2').click(function(e){

                e.preventDefault();

                // if($('#personal-vaccine-information').validate({
                //     rules:{
                //         fname:{
                //             required: true,
                //             minlength: 4,
                //         }
                //     }
                // }).element('#firstname')){
                //     $('#second').hide();
                //     $('#third').show();
                //     $('#progressBar').css('width','50%');
                //     $('#progressText').html('STEP 3 : Vaccine Information');
                // }else{
                //     alert("haha");
                // }
                        
                if($('#firstname').val() == ''){
                    $('#fname-error').html('*First name is Required.');
                    return false;
                }else if($('#firstname').val().length < 2 || $('#firstname').val().length > 25){
                    $('#fname-error').html('*Only 2-25 Characters.');
                    return false;
                }else if(!isNaN($('#firstname').val())){
                    $('#fname-error').html('*Only Letters is acceptable.');
                    return false;
                }else{
                    $('#fname-error').html('');
                } 
                
                // Middle name filter
                // if($('#middlename').val() == ''){
                //     $('#mname-error').html('*Middle name is Required.');
                //     return false;
                // }else if($('#middlename').val().length < 2 || $('#middlename').val().length > 25){
                //     $('#mname-error').html('*Only 2-25 Characters.');
                //     return false;
                // }else if(!isNaN($('#middlename').val())){
                //     $('#mname-error').html('*Only Letters is acceptable.');
                //     return false;
                // }else{
                //     $('#mname-error').html('');
                // }

                if($('#lastname').val() == ''){
                    $('#lname-error').html('*Last name is Required.');
                    return false;
                }else if($('#lastname').val().length < 2 || $('#lastname').val().length > 25){
                    $('#lname-error').html('*Only 2-25 Characters.');
                    return false;
                }else if(!isNaN($('#lastname').val())){
                    $('#lname-error').html('*Only Letters is acceptable.');
                    return false;
                }else{
                    $('#lname-error').html('');
                }

                var dob = $('#birthdate').val();
                dob = new Date(dob);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                if(age < 12){
                    $('#bdate-error').html('*Make sure that you are 12 y/o and above.');
                    return false;
                }else if(age > 120){
                    $('#bdate-error').html('*Make sure that you are 120 y/o and below.');
                    return false;
                }else if(isNaN(age)){
                    $('#bdate-error').html('*Birthdate is required.');
                    return false;
                }else{
                    $('#bdate-error').html('');
                }
                
                if($('#gender option:selected').text() == 'Select Gender'){
                    $('#gender-error').html('*Please Select your gender.');
                    return false;
                }else{
                    $('#gender-error').html('');
                }

                if($('#address').val() == ''){
                    $('#address-error').html('*Address is required.');
                    return false;
                }else if($('#address').val().length < 5){
                    $('#address-error').html('*Please check your address.');
                    return false;
                }else{
                    $('#address-error').html('');
                }

                if($('#vacchours option:selected').text() == 'Yes | No'){
                    $('#vacchours-error').html('*Please Select your answer.');
                    return false;
                }else{
                    $('#vacchours-error').html('');
                }

                if($('#contactnum').val() == ''){
                    $('#contactnum-error').html('*Contact number is required.');
                    return false;
                }else if($('#contactnum').val().length < 6 || $('#contactnum').val().length > 12){
                    $('#contactnum-error').html('*Please check your entered contact number.');
                    return false;
                }else{
                    $('#contactnum-error').html('');
                }

                if($('#vacchours option:selected').text() == 'No'){
                    $('#second').hide();
                    $('#second-failed').show();
                    $('#progressBar').css('width','100%');
                    $('#progressText').html('48 Hours Rule');
                }else{
                    $('#second').hide();
                    $('#third').show();
                    $('#progressBar').css('width','50%');
                    $('#progressText').html('STEP 3 : Vaccine Information');
                }
            
            });
            
            //On click -next3-
            $('#next3').click(function(e){
                e.preventDefault();

                for(let i = 1; i <= addDose; i++ ){
                    if($('#vaccine-shot'+i+' option:selected').text() == 'Vaccine Shot | Booster Shot'){
                        $('#vaccine-shot-error'+i).html('*Please choose vaccine shot.');
                        return false;
                    }else{
                        $('#vaccine-shot-error'+i).html('');
                    }
                    var vdate = $('#vaccine-date'+i).val();
                    vdate = new Date(vdate);
                    if(isNaN(vdate)){
                        $('#vaccine-date-error'+i).html('*Date of vaccinated is required.');
                        return false;
                    }else{
                        $('#vaccine-date-error'+i).html('');
                    }

                    if($('#vaccine-brand'+i+' option:selected').text() == '--Select Here--'){
                        $('#vaccine-brand-error'+i).html('*Please select which vaccine brand.');
                        return false;
                    }else{
                        $('#vaccine-brand-error'+i).html('');
                    }

                    if($('#vaccine-country'+i).val() == ''){
                        $('#vaccine-country-error'+i).html('*Countery where you vaccinated is required.');
                        return false;
                    }else{
                        $('#vaccine-country-error'+i).html('');
                    }

                    if($('#vaccine-area'+i+' option:selected').text() == '--Select Here--'){
                        $('#vaccine-area-error'+i).html('*Please choose vaccination area you vaccinated.');
                        return false;
                    }else{
                        $('#vaccine-area-error'+i).html('');
                    }
                }

                $('#third').hide();
                $('#fourth').show();
                $('#progressBar').css('width','70%');
                $('#progressText').html('STEP 4 : Checking information');
                CheckData();
            });

            //On click -Prev2-
            $('#prev2').click(function(){
                $('#second').show();
                $('#third').hide();
                $('#progressBar').css('width','30%');
                $('#progressText').html('STEP 2 : Personal Information');
            });

            $('#prevtofifth').click(function(){
                $('#last-div').hide();
                $('#fifth').show();
                $('#progressBar').css('width','90%');
                $('#progressText').html('STEP 5 : Upload Picture');
            });

            $('#nextlast').click(function(){
                
                var fileName = $('#customFile').val();
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
                        $('#picture-error').html('');
                        $('#last-div').show();
                        $('#fifth').hide();
                        $('#progressBar').css('width','100%');
                        $('#progressText').html('LAST STEP : Print Vaxcert');
                }else if($('#customFile').val() == ''){
                    $('#picture-error').html('*Please upload your photo to proceed.');
                    return false;
                }else{
                    $('#picture-error').html('*Only jpg/jpeg and png files are allowed!.');
                    return false;
                }  

            });

            //On click remove dose
            $(document).on('click','.remove-dose', function () {
                addDose-=1;

                $('.removebtn'+ addDose).show();

                $(this).closest('.new-form').remove();
                if(addDose <= 5){
                    $('.add-vaccine-btn').show();
                }
            });

            //upload img preview
            $('#customFile').change(function(event){
                var x = URL.createObjectURL(event.target.files[0]);
                var file = this.files[0], img;
                if (Math.round(file.size / (1024 * 1024)) > 3) { // make it in MB so divide by 1024*1024
                    $('#picture-error').html('*Image is too large, Less than 6mb is acceptable.');
                    $('#nextlast').attr('disabled', true);
                    return false;
                }else{
                    $('#picture-error').html('');
                    $('#nextlast').removeAttr('disabled');;
                }

                $('#showupload').attr('src',x);

            });

            $('#print').click(function(){
                $('#progressBar').css('width','100%');
                $('#progressText').html('FINISH : CONGRATS!');
                $('#last-div').hide();
                $('.end-form').show();
            });
            $('#GoBack').click(function(){
                $('#progressBar').css('width','100%');
                $('#progressText').html('LAST STEP : Print Vaxcert');
                $('#last-div').show();
                $('.end-form').hide();
            });
        //insert data inserted
            
        $('#personal-vaccine-information').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                    e.preventDefault();
                    return false;
                }
        });


        function insertingData(){
        
        var formData = new FormData();
        let img = $('#customFile')[0].files;
        formData.append('user_img',img[0]);

        var firstname = $('#firstname').val();
        var middlename = $('#middlename').val();
        var lastname = $('#lastname').val();
        var birthdate = $('#birthdate').val();
        var gender = $('#gender option:selected').text();
        var address = $('#address').val();
        var hours = $('#vacchours option:selected').text();
        var contactnum = $('#contactnum').val();
        
        var vaxtype = [];
        var vaxdate = [];
        var vaxbrand = [];
        var vaxcountry = [];
        var vaxarea = [];

        for(let i = 1; i <= addDose; i++ ){
            vaxtype.push($('#vaccine-shot'+i+' option:selected').text());
            vaxdate.push($('#vaccine-date'+i).val());
            vaxcountry.push($('#vaccine-country'+i).val());
            vaxbrand.push($('#vaccine-brand'+i+' option:selected').text());
            vaxarea.push($('#vaccine-area'+i+' option:selected').text());
        }

        $.ajax({
            url:'home-print.php',
            method:'POST',
            data:{
                formData,
                firstname:firstname,
                middlename:middlename,
                lastname:lastname,
                birthdate:birthdate,
                gender:gender,
                address:address,
                hours:hours,
                contactnum:contactnum,

                vaxtype:vaxtype,
                vaxdate:vaxdate,
                vaxbrand:vaxbrand,
                vaxcountry:vaxcountry,
                vaxarea:vaxarea,
            },
            success:function(data){
                $('#fourth').html(data);
                console.log(data);
            },
        });
        }

        

        //Checking Data
        function CheckData(){
            
            var firstname = $('#firstname').val();
            var middlename = $('#middlename').val();
            var lastname = $('#lastname').val();
            var birthdate = $('#birthdate').val();
            var gender = $('#gender option:selected').text();
            var address = $('#address').val();
            var hours = $('#vacchours option:selected').text();
            var contactnum = $('#contactnum').val();
            
            var vaxtype = [];
            var vaxdate = [];
            var vaxbrand = [];
            var vaxcountry =[];
            var vaxarea =[];
    
            for(let i = 1; i <= addDose; i++ ){
                vaxtype.push($('#vaccine-shot'+i+' option:selected').text());
                vaxdate.push($('#vaccine-date'+i).val());
                vaxcountry.push($('#vaccine-country'+i).val());
                vaxbrand.push($('#vaccine-brand'+i+' option:selected').text());
                vaxarea.push($('#vaccine-area'+i+' option:selected').text());
            }
    
            $.ajax({
                url:'home-function.php',
                method:'POST',
                data:{
                    firstname:firstname,
                    middlename:middlename,
                    lastname:lastname,
                    birthdate:birthdate,
                    gender:gender,
                    address:address,
                    hours:hours,
                    contactnum:contactnum,
    
                    vaxtype:vaxtype,
                    vaxdate:vaxdate,
                    vaxbrand:vaxbrand,
                    vaxcountry:vaxcountry,
                    vaxarea:vaxarea,
                },beforeSend: function() {
                    $('#fourth').html(`<div id="loading">
                        <div class="col-lg-12 text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:20px; margin-top:30px;margin-bottom:10px">
                                <div class="spinner-border" style="width: 100px; height:100px; color:#FF4600;margin-top:20px;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            <h5 style="color: #FF4600;margin-top:30px;margin-bottom:20px;">Checking data from the database...</h5>
                        </div>
                    </div>`);
                },
                success:function(data){
                    $('#fourth').html(data);
                },
            });
            }

            //On click add dose
            $(document).on('click',".add-dose", function () {
                
                addDose += 1;

                $('.removebtn'+ (addDose-1)).hide();
                

                if(addDose == 5){
                    $('.add-vaccine-btn').hide();
                }else{
                    $('.add-vaccine-btn').show();
                }
                $('.new-dose-form').append(`
                            
                            <div class="new-form col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600; padding:10px; margin-top:10px;">
                                <div style="text-align: center;border-bottom:1px solid #FF4600;color: #FF4600;font-weight:500;">Vaccination Details Dose : <label id="vaccdosetext">${addDose}</label></div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vacctype" style="color: #FF4600;font-weight:500;">Vaccine Shot Type</label>
                                            <select class="custom-select" name="vaccinetype[]" style="border: 1px solid #FF4600;" id="vaccine-shot${addDose}">
                                                    <option selected>Vaccine Shot | Booster Shot</option>
                                                    <option value="Vaccine Shot">Vaccine Shot</option>
                                                    <option value="Booster Shot">Booster Shot</option>
                                            </select>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-shot-error${addDose}"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccdate" style="color: #FF4600;font-weight:500;">Date Vaccinated</label>
                                            <input type="date" name="vaccinedate[]" class="form-control" id="vaccine-date${addDose}" style="border: 1px solid #FF4600;">
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-date-error${addDose}"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccbrand" style="color: #FF4600;font-weight:500;">Vaccine Brand</label>
                                                <div class="vaccine-brands${addDose}">
                                                    <select class="custom-select" name="vaccbrand[]" style="border: 1px solid #FF4600;" id="vaccine-brand${addDose}">
                                                            <option selected>--Select Here--</option>
                                                            <option value="AstraZeneca">AstraZeneca</option>
                                                            <option value="Novavax">Novavax</option>
                                                            <option value="BioNTech/Pfizer">BioNTech/Pfizer</option>
                                                            <option value="Moderna">Moderna</option>
                                                            <option value="Gameleya">Gameleya</option>
                                                            <option value="Sanofi/GSK">Sanofi/GSK</option>
                                                            <option value="Johnson & Johnson">Johnson & Johnson</option>
                                                            <option value="Sinovac">Sinovac</option>
                                                            <option value="CureVac">CureVac</option>
                                                            <option value="Sputnik">Sputnik</option>
                                                            <option value="Sinopharm">Sinopharm</option>
                                                    </select>
                                                </div>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-brand-error${addDose}"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vacccountry" style="color: #FF4600;font-weight:500;">Lot No.</label>
                                            <input type="text" name="vacccountry[]" class="form-control" id="vaccine-country${addDose}" style="border: 1px solid #FF4600;" placeholder="Enter Lot Number">
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-country-error${addDose}"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccarea" style="color: #FF4600;font-weight:500;">Caloocan Vaccination Area</label>
                                                <div class="vaccination-selection${addDose}">
                                                    <select class="custom-select" name="vaccarea[]" style="border: 1px solid #FF4600;" id="vaccine-area${addDose}">
                                                        <option selected>--Select Here--</option>
                                                        <option value="Andres Bonifacio Elementary School">Andres Bonifacio Elementary School</option>
                                                        <option value="Buena Park">Buena Park</option>
                                                        <option value="Caloocan High School">Caloocan High School</option>
                                                        <option value="Caloocan City Hall North">Caloocan City Hall North</option>
                                                        <option value="Central Elementary School">Central Elementary School</option>
                                                        <option value="Glorieta, Tala">Glorieta, Tala</option>
                                                        <option value="Gregoria De Jesus">Gregoria De Jesus</option>
                                                        <option value="Maria Clara High School">Maria Clara High School</option>
                                                        <option value="Notredame of Greater Manila, Grace Park Caloocan City">Notredame of Greater Manila, Grace Park Caloocan City</option>
                                                        <option value="SM Sangandaan">SM Sangandaan</option>
                                                        <option value="University of Caloocan City">University of Caloocan City</option>

                                                        <option value="Talipapa High School">Talipapa High School</option>
                                                        <option value="SM Grand Central">SM Grand Central</option>
                                                        <option value="Maypajo High School">Maypajo High School</option>
                                                        <option value="Bagong Silang Elementary School">Bagong Silang Elementary School</option>
                                                        <option value="Caloocan City Medical Center">Caloocan City Medical Center</option>
                                                        <option value="Barangay 152 Covered Court">Barangay 152 Covered Court</option>
                                                    </select>
                                                </div>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-area-error${addDose}"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="removebtn${addDose} row">
                                    <div class="col-12">
                                        <a class="remove-dose btn btn-danger btn-block">Remove</a>
                                    </div>
                                </div>
                            </div>
                            `);
                selectionvaccinationsite(addDose);
                selectionvaccine(addDose);
            });

            //Press keys -----------------------------

            $("#firstname").keypress(function(event){
                var inputValue = event.charCode;
                //alert(inputValue);
                if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
                    event.preventDefault();
                }
            });

            $("#middlename").keypress(function(event){
                var inputValue = event.charCode;
                //alert(inputValue);
                if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
                    event.preventDefault();
                }
            });

            $("#lastname").keypress(function(event){
                var inputValue = event.charCode;
                //alert(inputValue);
                if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
                    event.preventDefault();
                }
            });

            $("#contactnum").keypress(function(event){
                var inputValue = event.charCode;
                //alert(inputValue);
                if(!((inputValue > 47 && inputValue < 58) ||(inputValue==32) || (inputValue==0))){
                    event.preventDefault();
                }
            });

            $('#logout-click').click(function(){
                $('#logout-Modal').modal('show');
            });

            $('#logout-confirm').click(function(){
                $.ajax({
                    url:'home-logout.php',
                    success:function(){
                        window.location.href = 'index.php';
                    }
                });
            });
        });

        //On click check box privacy
        $('#customCheck1').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {

            $('#next1').removeAttr('disabled'); //enable input

        } else {
            $('#next1').attr('disabled', true); //disable input
        }
        });

        function selectionvaccinationsite(dose){
            var cdose=dose;
            $.ajax({
                type: "POST",
                url: "vaccinationsite-fetch-data.php",
                data: {currentdose:cdose},
                success: function (data) {
                    $(`.vaccination-selection${cdose}`).html(data);
                }
            });
        }

        function selectionvaccine(dose){
            var cdose=dose;
            $.ajax({
                type: "POST",
                url: "vaccine-fetch-data.php",
                data: {currentdose:cdose},
                success: function (data) {
                    $(`.vaccine-brands${cdose}`).html(data);
                }
            });
        }

    </script>
</body>
</html>