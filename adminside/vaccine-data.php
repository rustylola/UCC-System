<?php session_start(); ?>
<?php include('account-check.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/style.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/cd5c91c254.js" crossorigin="anonymous"></script>

<style>
    .p-2{
        padding:0px !important;
    }
</style>

</head>
<body>
<nav class="navbar sticky-top navbar-dark" style="background-color: #FF7900;position: fixed;width: 100%;">
    <a class="navbar-brand" href="#" >CALOOCAN VAXCERT</a>
    <a class="navbar-brand" href="../home.php"> GO BACK <i class="fa fa-sign-out"></i></a>
</nav>

<!-- The sidebar -->
<div class="sidebar">
    <?php 
        $_SESSION['activesidebar'] = "vaccine-data";
        include('sidebar.php');
    ?>
</div>
<input type="hidden" id="nameprocess" placeholder="Search Names" value="<?php echo $_SESSION['username']."-".$_SESSION['accountrole'];?>">
<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row content">
        <div class="col-lg-12">
            <div class="row" style="padding-right: 10px; padding-top:10px;">
                <div class="col-12" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Vaccination Data
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4" style="padding: 0px; padding-top:10px; padding-bottom:10px;padding-right:10px;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" name="searchName" id="searchName" placeholder="Search Names" oninput="tablefilter()">
                            </div>
                        </div>
                        <div class="col-4" style="padding: 0px; padding-top:10px; padding-bottom:10px;padding-right:10px;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                                </div>
                                    <select class="custom-select" id="vaccine-area-filter" onchange="tablefilter()">
                                        <option selected>--Vaccination Area--</option>
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
                        </div>
                        <div class="col-2" style="padding: 0px; padding-top:10px; padding-bottom:10px;padding-right:10px;">
                            <button type="button" class="btn btn-block" name="print-account-report" id="print-account-report" style="background-color: #FF7900; color:white;" onclick="print_report()">Print Report</button>
                        </div>
                        <div class="col-2" style="padding: 0px; padding-top:10px; padding-bottom:10px;">
                            <button type="button" class="btn btn-block" name="create-account-btn" id="add-old-data" style="background-color: #FF7900; color:white;" >ADD DATA</button>
                        </div>
                    </div>
                    <div class="row">
                    <table class="table table-hover" id="table-data-old">
                        <!--table here-->
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!--Add and Edit Modal-->

<!-- Modal -->
<div class="modal fade" id="add-edit-old-modal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-scrollable" style="max-width: 800px;">
    <div class="modal-content">
    <form action="" id="add-edit-old-data">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center"style="color: #FF7900;" id="add-edit-ModalLabel">Modal title</h5>
      </div>
      <div class="modal-body">
      <div class="row" style="padding-left: 15px; padding-right:15px; margin-bottom:10px;">
          <div class="col-lg-12 text-center" style="border:2px solid #FF7900;">
            <label for="firstname" style="color: #FF7900;font-weight:500; font-size:20px; margin-bottom: 0px;">Personal Information</label>
          </div>
      </div>  
      <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="firstname" style="color: #FF7900;font-weight:500;">First Name</label>
                    <input type="text" name="fname" class="form-control" id="firstname" maxlength="25" placeholder="Enter Firstname" style="border: 1px solid #FF7900;">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="fname-error"></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="middlename" style="color: #FF7900;font-weight:500;">Middle Name</label>
                    <input type="text" name="mname" class="form-control" id="middlename" maxlength="25" placeholder="Enter Middle Name" style="border: 1px solid #FF7900;">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="mname-error"></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lastname" style="color: #FF7900;font-weight:500;">Last Name</label>
                    <input type="text" name="lname" class="form-control" id="lastname" maxlength="25" placeholder="Enter Last Name" style="border: 1px solid #FF7900;">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="lname-error"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="birthdate" style="color: #FF7900;font-weight:500;">Birth Date</label>
                    <input type="Date" name="bdate" class="form-control" id="birthdate" style="border: 1px solid #FF7900;">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="bdate-error"></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gender" style="color: #FF7900;font-weight:500;">Gender</label>
                    <select name="gender" id="gender" class="custom-select"style="border: 1px solid #FF7900;">
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
                    <label for="address" style="color: #FF7900; font-weight:500;">Address</label>
                    <input type="text" class="form-control" id="address" maxlength="60" style="border: 1px solid #FF7900;"placeholder="Enter address">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="address-error"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vacchours" style="color: #FF7900; font-weight:500;">Are you vaccinated 48 hours ago?</label>
                    <select class="custom-select" id="vacchours" style="border: 1px solid #FF7900;">
                            <option selected>Yes | No</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                    </select>
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vacchours-error"></p>
                </div>    
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contactnum" style="color: #FF7900; font-weight:500;">Contact Number</label>
                    <input type="text" maxlength="14" class="form-control" id="contactnum" style="border: 1px solid #FF7900;"placeholder="Ex. 0912345679">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="contactnum-error"></p>
                </div>
            </div>
        </div>

        <div class="dose-form">
            <div class="col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF7900; padding:10px; margin-top:10px;">
                <div style="text-align: center;border-bottom:1px solid #FF7900;color: #FF7900;font-weight:500;">Vaccination Details Dose : <label id="vaccdosetext">1</label></div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vacctype" style="color: #FF7900;font-weight:500;">Vaccine Shot Type</label>
                            <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-shot1">
                                    <option selected>Vaccine Shot | Booster Shot</option>
                                    <option value="Vaccine Shot">Vaccine Shot</option>
                                    <option value="Booster Shot">Booster Shot</option>
                            </select>
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-shot-error1"></p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vaccdate" style="color: #FF7900;font-weight:500;">Date Vaccinated</label>
                            <input type="date" class="form-control" id="vaccine-date1" style="border: 1px solid #FF7900;">
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-date-error1"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vaccbrand" style="color: #FF7900;font-weight:500;">Vaccine Brand</label>
                            <div class="vaccine-brands1">
                                <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-brand1">
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
                            <label for="vacccountry" style="color: #FF7900;font-weight:500;">Lot No.</label>
                            <input type="text" class="form-control" id="vaccine-country1" style="border: 1px solid #FF7900;" placeholder="Enter Lot Number">
                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-country-error1"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-top:5px;">
                            <label for="vaccarea" style="color: #FF7900;font-weight:500;">Caloocan Vaccination Area</label>
                            <div class="vaccination-selection1">
                                <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-area1">
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
                            <input type="hidden" class="form-control" id="process-by1" style="border: 1px solid #FF7900;" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--new dose forms-->
        <div class="new-dose-form">

        </div>
        <!--End new dose forms-->

        <div class="add-vaccine-btn col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF7900; padding:10px; margin-top:10px;">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="javascript:void(0)" class="add-dose btn btn-primary" style="background-color: #FF7900 !important; width:100%;font-size: 20px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 20px;">&nbsp;&nbsp;</i>Add Vaccine Dose</a>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="close-edit-add-modal" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="edit-add-btn" name="edit-add-btn" value="add" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="success-failed-Modal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center"style="color: #FF7900;" id="success-failed-Modal-title">Show Result</h5>
      </div>
      <div class="modal-body" id="success-failed-Modal-result">
        <div class="alert alert-success" role="alert">
            <strong id="strong-result">Operation Success!</strong><br>
            <!-- <strong id="label-result">You successfully read this important alert message.</strong> -->
            <!--<label id="label-result-operation">You successfully read this important alert message.</label>-->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="close-success-failed" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="view-delete-Modal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-scrollable" style="max-width: 600px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center"style="color: #FF7900;" id="view-delete-Modal-title">Delete Data</h5>
      </div>
      <div class="modal-body" id="view-delete-Modal-body">
      <!--View Data-->
      </div>
      <div class="modal-footer">
        <button type="button" id="view-delete-modal-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="view-delete-func-btn" name="view-delete-func-btn" value="delete" class="btn btn-warning">Delete Data</button>
      </div>
    </div>
  </div>
</div>

<!--are you sure modal-->
<div class="modal fade" id="ask-modal" data-keyboard="false" data-backdrop="static" style="background-color: rgba(0, 0, 0, .5);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="col-12 modal-title text-center"style="color: red;" id="ask-delete-Modal-title">Assurance Deleting Data Selected</h5>
      </div>
      <div class="modal-body">
      <div class="alert alert-warning" role="alert">
        <strong>Warning!</strong> All data including the vaccine information will be deleted, are you sure you want to delete this?.
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="delete-it-now" value="" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- UNIVERSAL MODAL -->
    <div class="modal" id="print-modal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="print-modal-title">Print Report 
                        <!-- Modal title -->
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="print-modal-body">
                                    <div class="form-group">
                                        <label for="filter-vaccinationarea-selection">Filter Selection Vaccination Area</label>
                                        <select class="custom-select" id="filter-vaccinationarea-selection" name="filter-vaccinationarea-selection">
                                            <option selected>Select Here</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter-age-group">Filter Age Group</label>
                                        <select class="custom-select" id="filter-age-group" name="filter-age-group">
                                            <option selected>Select Here</option>
                                            <option value="No Age">No Age Group</option>
                                            <option value="0-14">Children (0-14 y/o)</option>
                                            <option value="15-24">Youth (15-24 y/o)</option>
                                            <option value="25-59">Adults (25-59 y/o)</option>
                                            <option value="60-200">Senior (60-above y/o)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="filtering">Filter Selection</label>
                                        <select class="custom-select" id="filter-selection" name="filter-selection">
                                            <option selected>Select Here</option>
                                            <option value="1">Specific Day</option>
                                            <option value="2">Day to Day Interval</option>
                                        </select>
                                    </div>
                                    <div class="input-group selected-filter-show">
                                        <!-- FILTER SHOW -->
                                    </div>
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="filter-error"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="button" class="btn modal-response-btn" id="print-report-btn" value>Print</button>
                </div>
            </div>
        </div>
    </div>

<script>

    $(document).ready(function(){

        filtervaccinationsite();
        filtervaccinationsiteprint();

        var params = new window.URLSearchParams(window.location.search);
        var areaget = params.get('area');
        if(params.get('area') == '--Vaccination Area--' || params.get('area') == null){
            tablefetch();
            console.log(params.get('area'));
        }else{
            console.log(params.get('area')+1);    
            $('#vaccine-area-filter').val(areaget);
            tablefilter();
        }


            var editingFlagsID;
            $(document).on('click','.edit-old-data',function(){
            var selectedDataID = $(this).attr('id');
            editingFlagsID = selectedDataID;
            $.ajax({
                url:'vaccine-data-function.php',
                method:'POST',
                data:{selectedDataID:selectedDataID},
                dataType:"json",
                success:function(data){
                    $('#firstname').val(data.first_name);
                    $('#middlename').val(data.middle_name);
                    $('#lastname').val(data.last_name);
                    var bdate = new Date(data.birth_date).toLocaleDateString('en-CA');
                    $('#birthdate').val(bdate);
                    $('#gender').val(data.gender);
                    $('#address').val(data.address);
                    $('#vacchours').val('Yes');
                    $('#contactnum').val(data.contact_num);

                    folow(data.ID,data.first_name,data.middle_name,data.last_name,bdate);

                }
            });
            
            $('#edit-add-btn').val('edit');
            $('#edit-add-btn').html('Save Changes');
            $('#add-edit-ModalLabel').html('Edit Data');
            $('#add-edit-old-modal').modal('show');

        });

        function folow(selectingID,firstname,middlename,lastname,birthdate){
            $.ajax({
                url:'vaccine-data-function.php',
                method:'POST',
                data:{
                    editID:selectingID,
                    editfirstname:firstname,
                    editmiddlename:middlename,
                    editlastname:lastname,
                    editbirthdate:birthdate,
                },
                success:function(data){
                    $('.dose-form').html(data);
                }
            });
        }

        $(document).on('click','#add-old-data',function(){
            addDose = 1;
            $('#process-by1').val(nameprocess);
            $('#add-edit-old-data').trigger('reset');
            $('#edit-add-btn').val('add');
            $('#edit-add-btn').html('Add Data');
            $('#add-edit-ModalLabel').html('Add Vaccination Data');
            $('#add-edit-old-modal').modal('show');
        });

        $(document).on('click','#edit-add-btn',function(){
               
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
                        $('#vaccine-country-error'+i).html('*Lot No. is required.');
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
                

                if($('#edit-add-btn').val() == 'add'){
                    insertingData();
                }else if($('#edit-add-btn').val() == 'edit'){
                    editingData(editingFlagsID);
                }

        });

        $(document).on('click','#close-edit-add-modal', function(){
            var remain = $('#vaccine-area-filter option:selected').text();
            window.location.href='vaccine-data.php?area='+remain;
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

            //view-delete-section click

            //view
            $(document).on('click','.view-old-data',function(){
                var selectviewID = $(this).attr('id');
                $.ajax({
                    url:'vaccine-data-view-delete.php',
                    method:'POST',
                    data:{selectviewID:selectviewID},
                    success:function(data){
                        $('#view-delete-Modal-body').html(data);
                    },
                });
                console.log(selectviewID);
                $('#view-delete-Modal-title').html('View Data');
                $('#view-delete-func-btn').val('view');
                $('#view-delete-func-btn').hide();
                $('#view-delete-Modal').modal('show');
            });

            //delete click
            $(document).on('click','.delete-old-data',function(){
                var selectdeleteID = $(this).attr('id');
                $.ajax({
                    url:'vaccine-data-view-delete.php',
                    method:'POST',
                    data:{selectdeleteID:selectdeleteID},
                    success:function(data){
                        $('#view-delete-Modal-body').html(data);
                    },
                });
                console.log(selectdeleteID);
                $('#view-delete-Modal-title').html('Delete Data');
                $('#view-delete-func-btn').val(selectdeleteID);
                $('#view-delete-func-btn').show();
                $('#view-delete-Modal').modal('show');
            });

            $(document).on('click','#view-delete-func-btn',function(){
                var selectedIDget = $(this).val();
                console.log(selectedIDget);
                $('#delete-it-now').val(selectedIDget);
                $('#ask-modal').modal('show');
            });

            $(document).on('click','#delete-it-now', function(){
                var selectedIDgetlast = $(this).val();
                console.log(selectedIDgetlast);
                $.ajax({
                    url:'vaccine-data-view-delete.php',
                    method:'POST',
                    data:{selectedIDgetlast:selectedIDgetlast},
                    success:function(data){
                        $('#view-delete-Modal').modal('hide');
                        $('#ask-modal').modal('hide');
                        success('Deleting Data');
                    }
                });
            });

            $(document).on('change','#filter-selection',function(){
                var selected = $(this).val();
                
                if($('#filter-selection option:selected').text() == 'Select Here'){
                    $('.selected-filter-show').html('');
                    $('#print-report-btn').prop('disabled',true);
                }else if(selected == '2'){
                    $('#print-report-btn').val('day-to-day');
                    $('#print-report-btn').removeAttr('disabled');
                    $('.selected-filter-show').html(`
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Start Date</span>
                        </div>
                        <input type="date" class="form-control" id="start-date-here" name="start-date-here" placeholder="Start Date">
                        <input type="date" class="form-control" id="end-date-here" name="end-date-here" placeholder="End Date">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">End Date</span>
                        </div>`);
                }else if(selected == '1'){
                    $('#print-report-btn').val('single-day');
                    $('#print-report-btn').removeAttr('disabled');
                    $('.selected-filter-show').html(`
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Select Specific Date</span>
                        </div>
                        <input type="date" class="form-control" id="specific-date-here" placeholder="Select Specific Date">`);
                }
                $('#filter-error').html('');
            });

            $(document).on('change','#start-date-here',function(){
                $('#end-date-here').val('');
                $('#filter-error').html('');
            });
            $(document).on('change','#end-date-here',function(){
                //$('#end-date-here').val('');
                $('#filter-error').html('');
            });
            $(document).on('change','#specific-date-here',function(){
                //$('#end-date-here').val('');
                $('#filter-error').html('');
            });
            $(document).on('click', '#print-report-btn',function (e){
                e.preventDefault();

                var flagsvalue = $(this).val();
                if(flagsvalue == 'single-day'){
                    if($('#specific-date-here').val() == ''){
                        $('#filter-error').html('*Please select specific date.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    if($('#filter-vaccinationarea-selection option:selected').text() == '--Vaccination Area--'){
                        $('#filter-error').html('*Please select which area.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    if($('#filter-vaccinationarea-selection option:selected').text() == '--Vaccination Area--'){
                        $('#filter-error').html('*Please select which area.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    if($('#filter-age-group option:selected').text() == 'Select Here'){
                        $('#filter-error').html('*Please age selection.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    printnewtabday($('#specific-date-here').val(),$('#filter-vaccinationarea-selection option:selected').text(),$('#filter-age-group option:selected').val());
                    
                    console.log($('#specific-date-here').val());

                }else if(flagsvalue == 'day-to-day'){

                    let startdate =  new Date($('#start-date-here').val());
                    let enddate = new Date($('#end-date-here').val());
                    if(isNaN(Date.parse(startdate)) || $('#start-date-here').val() == ''){
                        $('#filter-error').html('*Please select start date.');
                        return false;
                    }else if(isNaN(Date.parse(enddate)) || $('#end-date-here').val() == ''){
                        $('#filter-error').html('*Please select end date.');
                        return false;
                    }else if(Date.parse(startdate) > Date.parse(enddate)){
                        $('#filter-error').html('*Start date must be "'+ $('#end-date-here').val()+ '" below to this date.');
                        return false;
                    }else if(Date.parse(startdate) == Date.parse(enddate)){
                        $('#filter-error').html('*Start and End date are same.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    if($('#filter-vaccinationarea-selection option:selected').text() == '--Vaccination Area--'){
                        $('#filter-error').html('*Please select which area.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    if($('#filter-age-group option:selected').text() == 'Select Here'){
                        $('#filter-error').html('*Please age selection.');
                        return false;
                    }else{
                        $('#filter-error').html('');
                    }

                    printnewtabdaytoday($('#start-date-here').val(),$('#end-date-here').val(),$('#filter-vaccinationarea-selection option:selected').text(),$('#filter-age-group option:selected').val());
                    
                    console.log(Date.parse(startdate));
                    console.log(Date.parse(enddate));
                    console.log($('#filter-age-group option:selected').val());
                }
            });
    });

    function success(operation,name){
        $('#success-failed-Modal').modal('show');
        $('#strong-result').html('Your '+operation+' is Success.');
        //$('#label-result').html('Name: '+name);
        //$('#label-result-operation').html('Applied');
        $(document).on('click','#close-success-failed',function(){
            location.reload();
        });
    }

    function insertingData(){
        var functionflags = $('#edit-add-btn').val();
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
        var vaxprocess = []

        for(let i = 1; i <= addDose; i++ ){
            vaxtype.push($('#vaccine-shot'+i+' option:selected').text());
            vaxdate.push($('#vaccine-date'+i).val());
            vaxcountry.push($('#vaccine-country'+i).val());
            vaxbrand.push($('#vaccine-brand'+i+' option:selected').text());
            vaxarea.push($('#vaccine-area'+i+' option:selected').text());
            vaxprocess.push($('#process-by'+i).val());
        }
        console.log(vaxprocess);

        $.ajax({
            url:'vaccine-add-data-func.php',
            method:'POST',
            data:{
                functionflags:functionflags,
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
                
                vaxprocess:vaxprocess
            },
            success:function(){
                $('#add-edit-old-data').trigger('reset');
                $('#add-edit-old-modal').modal('hide');
                success('Inserting');
                console.log('add-success');
            },
            error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
            }
        });
    }

    function editingData(flagsID){
        var getFlagsID = flagsID;
        console.log(getFlagsID);
        var functionflags = $('#edit-add-btn').val();
        console.log(functionflags);
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
        var vaxprocess = [];
        console.log(vaxprocess);

        for(let i = 1; i <= addDose; i++ ){
            vaxtype.push($('#vaccine-shot'+i+' option:selected').text());
            vaxdate.push($('#vaccine-date'+i).val());
            vaxcountry.push($('#vaccine-country'+i).val());
            vaxbrand.push($('#vaccine-brand'+i+' option:selected').text());
            vaxarea.push($('#vaccine-area'+i+' option:selected').text());
            vaxprocess.push($('#process-by'+i).val());
        }

        $.ajax({
            url:'vaccine-data-function.php',
            method:'POST',
            data:{
                getFlagsID:getFlagsID,
                functionflags:functionflags,
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

                vaxprocess:vaxprocess
            },
            success:function(){
                $('#add-edit-old-data').trigger('reset');
                $('#add-edit-old-modal').modal('hide');
                success('Editing data');
            },
        });
    }

    function windowreset(){
        var remain = $('#vaccine-area-filter option:selected').text();
        window.location.href='vaccine-data.php?area='+remain;
    }

    function tablefilter(){
        if($('#searchName').val().length > 0 && $('#vaccine-area-filter option:selected').text() != "--Vaccination Area--"){
            var searchName = $('#searchName').val();
            var searchVacarea = $('#vaccine-area-filter option:selected').text();
            $.ajax({
                url:'vaccine-data-fetch-func-tb.php',
                method:'POST',
                data:{
                    searchName:searchName,
                    searchVacarea:searchVacarea,
                },
                success:function(data){
                    $('#table-data-old').html(data);
                }
            });
        }else if($('#searchName').val().length > 0){
            var searchName = $('#searchName').val();
            $.ajax({
                url:'vaccine-data-fetch-func-tb.php',
                method:'POST',
                data:'searchName='+searchName,
                success:function(data){
                    $('#table-data-old').html(data);
                }
            });
        }else if($('#vaccine-area-filter option:selected').text() != "--Vaccination Area--"){
            var searchVacarea = $('#vaccine-area-filter option:selected').text();
            $.ajax({
                url:'vaccine-data-fetch-func-tb.php',
                method:'POST',
                data:'searchVacarea='+searchVacarea,
                success:function(data){
                    $('#table-data-old').html(data);
                }
            });
        }else{
            tablefetch();
        }
    }

    function tablefetch(){
        $.ajax({
            url:'vaccine-data-fetch-tb.php',
            success:function(data){
                $('#table-data-old').html(data);
            }
        });
    }
            var addDose = 1; //flags
            var nameprocess = $('#nameprocess').val();;
            selectionvaccinationsite(addDose);
            selectionvaccine(addDose);
            $(document).on('click','.remove-dose', function () {
                addDose-=1;

                $('.removebtn'+ addDose).show();

                $(this).closest('.new-form').remove();
                if(addDose <= 5){
                    $('.add-vaccine-btn').show();
                }
            });
            //On click add dose
            $(document).on('click',".add-dose", function () {
                
                addDose += 1;

                $('.removebtn'+ (addDose-1)).hide();
                

                if(addDose >= 5){
                    $('.add-vaccine-btn').hide();
                }else{
                    $('.add-vaccine-btn').show();
                }
                $('.new-dose-form').append(`
                            
                            <div class="new-form col-12" style="border-radius:10px 10px 10px 10px;border:1px solid #FF7900; padding:10px; margin-top:10px;">
                                <div style="text-align: center;border-bottom:1px solid #FF7900;color: #FF7900;font-weight:500;">Vaccination Details Dose : <label id="vaccdosetext">${addDose}</label></div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vacctype" style="color: #FF7900;font-weight:500;">Vaccine Shot Type</label>
                                            <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-shot${addDose}">
                                                    <option selected>Vaccine Shot | Booster Shot</option>
                                                    <option value="Vaccine Shot">Vaccine Shot</option>
                                                    <option value="Booster Shot">Booster Shot</option>
                                            </select>
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-shot-error${addDose}"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccdate" style="color: #FF7900;font-weight:500;">Date Vaccinated</label>
                                            <input type="date" class="form-control" id="vaccine-date${addDose}" style="border: 1px solid #FF7900;">
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-date-error${addDose}"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccbrand" style="color: #FF7900;font-weight:500;">Vaccine Brand</label>
                                            <div class="vaccine-brands${addDose}">
                                                <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-brand${addDose}">
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
                                            <label for="vacccountry" style="color: #FF7900;font-weight:500;">Lot No.</label>
                                            <input type="text" class="form-control" id="vaccine-country${addDose}" style="border: 1px solid #FF7900;" placeholder="Enter Lot Number">
                                            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-country-error${addDose}"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label for="vaccarea" style="color: #FF7900;font-weight:500;">Caloocan Vaccination Area</label>
                                            <div class="vaccination-selection${addDose}"> 
                                                <select class="custom-select"style="border: 1px solid #FF7900;" id="vaccine-area${addDose}">
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
                                            <input type="hidden" class="form-control" id="process-by${addDose}" style="border: 1px solid #FF7900;" value="${nameprocess}">
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

        function filtervaccinationsite(){
            $.ajax({
                type: "POST",
                url: "vaccinationsite-filter.php",
                success: function (data) {
                    $(`#vaccine-area-filter`).html(data);
                }
            });
        }

        function filtervaccinationsiteprint(){
            $.ajax({
                type: "POST",
                url: "created-vaxcert-filter-vacarea.php",
                success: function (data) {
                    $(`#filter-vaccinationarea-selection`).html(data);
                }
            });
        }

        function print_report(){
            $('#print-report-btn').prop('disabled',true);
            $('#print-modal').modal('show');
            $('#print-report-btn').addClass('btn-success');
        }

        function printnewtabdaytoday(startdate,enddate,vaccinearea,age){
            var getstartdate = startdate;
            var getenddate = enddate;
            var getage = age;
            var vaccinationarea = vaccinearea;
            window.open('vaccine-data-print.php?vaccinationarea='+vaccinearea+'&startdate='+getstartdate+'&endate='+getenddate+'&agegroup='+getage, '_blank');
            location.reload();
        }

        function printnewtabday(selectday,vaccinearea,age){
            var getselectday = selectday;
            var getage = age;
            window.open('vaccine-data-print.php?vaccinationarea='+vaccinearea+'&selectday='+getselectday+'&agegroup='+getage,'_blank');
            location.reload();
        }

        function calculateAge(birthday) { // birthday is a date
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }
</script>

</body>
</html>