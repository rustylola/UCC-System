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
    <?php $_SESSION['activesidebar'] = "tab-vaccine";
    include('sidebar.php');
    ?>
</div>

<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row content" style="padding-right: 10px; padding-top:10px;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Vaccine List
                </div>
            </div> 
            <div class="row">
                <div class="col-9" style="padding: 0px; padding-top:10px; padding-bottom:10px; padding-right:5px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control" name="searchvaccinename" id="searchvaccinename" placeholder="Search Vaccine name" oninput="searchvaccinename()">
                    </div>
                </div>
                <div class="col-3" style="padding: 0px; padding-top:10px; padding-bottom:10px;">
                    <button type="button" class="btn btn-block add-btn" name="add-function" id="add-function" style="background-color: #FF7900; color:white;" >Add Vaccine</button>
                </div>
            </div>
            <div class="row table-vaccine-data-show">
                <div class="col-12">
                    <table class="table table-hover">
                        <!-- Table data fetch -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UNIVERSAL MODAL -->
<div class="modal fade" id="view-vaccine-details" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-show">Modal title 
                        <!-- Modal title -->
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-body-show">
                            <!-- Body Message -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn modal-response-btn" id="" value>Save changes</button>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
<script>
    tb_vaccine();

    $(document).ready(function(){
        $(document).on('click','.add-btn', function(){
            $(".modal-response-btn").removeAttr("disabled");
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','550px');
            $('#modal-title-show').html('Add Vaccine Message');
            $('.modal-response-btn').show();
            $('.modal-response-btn').removeClass('btn-primary');
            $('.modal-response-btn').removeClass('btn-danger');
            $('.modal-response-btn').addClass('btn-success');
            $('.modal-response-btn').val('add-function');
            $('.modal-response-btn').attr('id',id);
            $('.modal-response-btn').html('Add Vaccine');
            $('.modal-body-show').html(inputdata());

            $('#view-vaccine-details').modal('show');
        });

        $(document).on('click','.edit-btn', function(){
            $(".modal-response-btn").removeAttr("disabled");
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','550px');
            $('#modal-title-show').html('Update Message');
            $('.modal-response-btn').show();
            $('.modal-response-btn').removeClass('btn-primary');
            $('.modal-response-btn').removeClass('btn-danger');
            $('.modal-response-btn').addClass('btn-success');
            $('.modal-response-btn').val('update-function');
            $('.modal-response-btn').attr('id',id);
            $('.modal-response-btn').html('Update');
            $('.modal-body-show').html(inputdata());

            getdata(id);

            $('#view-vaccine-details').modal('show');
        });

        $(document).on('click','.delete-btn', function(){
            $(".modal-response-btn").removeAttr("disabled");
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','600px');
            $('#modal-title-show').html('Delete Message');
            $('.modal-response-btn').show();
            $('.modal-response-btn').removeClass('btn-success');
            $('.modal-response-btn').addClass('btn-danger');
            $('.modal-response-btn').val('delete-function');
            $('.modal-response-btn').attr('id',id);
            $('.modal-response-btn').html('Delete');
            $('.modal-body-show').html(viewdeletedisplay());

            getdeletedata(id);

            $('#view-vaccine-details').modal('show');
        });

        $(document).on('click','.view-btn', function(){
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','500px');
            $('#modal-title-show').html('View Vaccine Site');
            $('.modal-response-btn').hide();
            $('.modal-body-show').html(viewbtn);
            
            getviewbtndata(id);
            //console.log($(this).attr('id'));
            $('#view-vaccine-details').modal('show');
        });

        $(document).on('click','.modal-response-btn',function(){

            if($(this).val() == 'add-function'){

                if($('#vaccine-name').val() == ''){
                    $('#vaccine-name-error').html('*Vaccine Name is Required.');
                    return false;
                }else if($('#vaccine-name').val().length < 3){
                    $('#vaccine-name-error').html('*Vaccine Name is too short.');
                    return false;
                }else{
                    $('#vaccine-name-error').html('');
                }

                if($('#vaccine-brand').val() == ''){
                    $('#vaccine-brand-error').html('*Vaccine Brand is Required.');
                    return false;
                }else if($('#vaccine-brand').val().length < 5){
                    $('#vaccine-brand-error').html('*Vaccine Brand is too short.');
                    return false;
                }else{
                    $('#vaccine-brand-error').html('');
                }

                var selectedid = $(this).attr('id');
                var flags = $(this).val();
                var vaccinename = $('#vaccine-name').val();
                var vaccineaddress = $('#vaccine-brand').val();
                insertupdatedata(selectedid,flags,vaccinename,vaccineaddress);
                console.log($(this).val());
                
            }else if($(this).val() == 'update-function'){

                if($('#vaccine-name').val() == ''){
                    $('#vaccine-name-error').html('*Vaccine Name is Required.');
                    return false;
                }else if($('#vaccine-name').val().length < 3){
                    $('#vaccine-name-error').html('*Vaccine Name is too short.');
                    return false;
                }else{
                    $('#vaccine-name-error').html('');
                }

                if($('#vaccine-brand').val() == ''){
                    $('#vaccine-brand-error').html('*Vaccine Brand is Required.');
                    return false;
                }else if($('#vaccine-brand').val().length < 5){
                    $('#vaccine-brand-error').html('*Vaccine Brand is too short.');
                    return false;
                }else{
                    $('#vaccine-brand-error').html('');
                }

                var selectedid = $(this).attr('id');
                var flags = $(this).val();
                var vaccinename = $('#vaccine-name').val();
                var vaccineaddress = $('#vaccine-brand').val();
                insertupdatedata(selectedid,flags,vaccinename,vaccineaddress);
                console.log($(this).val());

            }else if($(this).val() == 'delete-function'){

                var flags = $(this).val();
                var selectedid = $('.modal-response-btn').attr('id');
                deletingdata(selectedid,flags);
                console.log($(this).val());
            }
        });
    });

    // INSERT UPDATE FUNCTION
    function insertupdatedata(id,flags,vaccinename,vaccinebrand){

    var selectedid = id;
    var btnflags = flags;
    var vaccine_name = vaccinename;
    var vaccine_brand = vaccinebrand;

    $('.modal-response-btn').hide();

        $.ajax({
            type: "POST",
            url: "tab-vaccine-add-update.php",
            data: {
                flags:btnflags,
                getid:selectedid,
                vaccine_name:vaccine_name,
                vaccine_address:vaccine_brand,
            },success: function (data) {
                $('.modal-body-show').html(data);
                tb_vaccine();
            },beforeSend: function() {
                $('.modal-body-show').html(loadingOnly());
            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                console.log(request.responseText);
            }
        });
    }

    // DELETE SELECTED DATA
    function deletingdata(id,flags){
        var flags_btn = flags;
        var selectedid = id;

        $('.modal-response-btn').hide();

        $.ajax({
            type: "POST",
            url: "tab-vaccine-delete.php",
            data: {
                flags:flags_btn,
                getid:selectedid,
            },success: function (data) {
                $('.modal-body-show').html(data);
                tb_vaccine();
            },beforeSend: function() {
                $('.modal-body-show').html(loadingOnly());
            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                console.log(request.responseText);
            }
        });
    }

    // GET DATA FOR DELETE
    function getdeletedata(id){
        var selectedid = id;

        $.ajax({
            type: "POST",
            url: "tab-vaccine-fetch-data.php",
            data: {vaccineid:selectedid},
            dataType: 'json',
            success: function (data) {
                
                $('#vaccine-id-delete-view').html(id);
                $('#vaccine-name-delete-view').html(data.vaccine_name);
                $('#vaccine-brand-delete-view').html(data.vaccine_brand);

            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                $('.modal-response-btn').hide();
                console.log(request.responseText);
            }
        });
    }

    // GET DATA FOR VIEW
    function getviewbtndata(id){
        var selectedid = id;

        $.ajax({
            type: "POST",
            url: "tab-vaccine-fetch-data.php",
            data: {vaccineid:selectedid},
            dataType: 'json',
            success: function (data) {
                
                $('#vaccine-id-view').html(id);
                $('#vaccine-name-view').html(data.vaccine_name);
                $('#vaccine-brand-view').html(data.vaccine_brand);

            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                $('.modal-response-btn').hide();
                console.log(request.responseText);
            }
        });
    }

    // GET DATA FOR UPDATE
    function getdata(id){
        var selectedid = id;

        $.ajax({
            type: "POST",
            url: "tab-vaccine-fetch-data.php",
            data: {vaccineid:selectedid},
            dataType: 'json',
            success: function (data) {
                
                $('#vaccine-name').val(data.vaccine_name);
                $('#vaccine-brand').val(data.vaccine_brand);

            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                $('.modal-response-btn').hide();
                console.log(request.responseText);
            }
        });
    }

    // SEARCH VACCINE NAME FUNC
    function searchvaccinename(){

        var searchname = $('#searchvaccinename').val();
        console.log(searchname);

        if(searchname != ""){

            $.ajax({
                type: "POST",
                url: "tab-vaccine-tb.php",
                data: {vaccinename:searchname},
                success: function (data) {
                    $('.table-vaccine-data-show').html(data);
                },beforeSend: function() {
                    $('.table-vaccine-data-show').html(loading());
                },error: function (request, status, error) {
                    $('.table-vaccine-data-show').html(errorhandler(request.responseText));
                    console.log(request.responseText);
                }
            });
            
        }else{
            tb_vaccine();
        }
    }

    // SEARCH EXISTING NAME
    function searchexisting(){
        var searchname = $('#vaccine-name').val();
        console.log(searchname);
        if(searchname != ""){
            $.ajax({
                type: "POST",
                url: "tab-vaccine-existname.php",
                data: {vaccinename:searchname},
                success: function (data) {
                    $("#vaccine-name-error").html(data);
                }
            });
        }
    }

    // DEFAULT TABLE
    function tb_vaccine(){
        $.ajax({
            type: "POST",
            url: "tab-vaccine-tb.php",
            success: function (data) {
                $('.table-vaccine-data-show').html(data);
                
            },beforeSend: function() {
                $('.table-vaccine-data-show').html(loading());
            },error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    }

    // INPUT DATA DISPLAY ------------------------------

    function inputdata(){
        var input = `<div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="vaccine-name">Vaccine Name</label>
                                <input type="text" class="form-control" id="vaccine-name" placeholder="Enter Vaccine Name" maxlength="30" oninput="searchexisting()">
                                <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="vaccine-name-error"></p>
                            </div>
                        </div>
                   </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="vaccine-brand">Vaccine Brand</label>
                                <input type="text" class="form-control" id="vaccine-brand" placeholder="Enter Vaccine Brand" maxlength="30">
                                <p class="form-text text-danger font-weight-bold" maxlength="100" style="font-size: 12px;" id="vaccine-brand-error"></p>
                            </div>
                        </div>
                    </div>`;
        return input;
    }

    // DISPLAY DATA INFO
    function viewbtn(){
        var input = `
                    <div class="card">
                        <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                            Vaccine Information
                        </div>
                        <div class="card-body">
                        <h6 class="card-title"style="color: #000;">Vaccine Id : <label style="font-weight:bold;" id="vaccine-id-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Vaccine Name : <label style="font-weight:bold;" id="vaccine-name-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Vaccine Brand : <label style="font-weight:bold;" id="vaccine-brand-view"></label></h6>
                        </div>
                    </div>`;
        return input;
    }

    // DISPLAY DATA INFO
    function viewdeletedisplay(){
        var input = `
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading text-center"><b>Warning!</b></h4>
                            <h5 class="text-center">Do you want to delete this vaccine ?</h5>
                        </div>
                    <div class="card">
                        <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                            Vaccine Information
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Vaccine Id : <label style="font-weight:bold;" id="vaccine-id-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Vaccine Name : <label style="font-weight:bold;" id="vaccine-name-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Vaccine Brand : <label style="font-weight:bold;" id="vaccine-brand-delete-view"></label></h6>
                        </div>
                    </div>`;
        return input;
    }

    // LOADING DISPLAY
    function loadingOnly(){
        var loadingdata = `
                        <div class="container"style=" width: 100%;">
                            <div class="row" style="margin-top: 20px;padding-left: 34px; padding-right: 34px; margin-bottom: 10px;">
                                <div class="col-12"> 
                                    <div class="row" style="height:100%;">
                                        <div class="col-lg-12 d-flex">
                                            <div class="row justify-content-center align-self-center" style="width: 100%;">
                                                <div class="col-12 text-center">
                                                    <div class="spinner-border" style="width: 200px; height:200px; color: #FF7900;" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <h5 style="color: #FF7900;margin-top:30px;margin-bottom:20px;">Loading ...</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        return loadingdata;
    }

    function loading(){
        var loadingdata = `
                        <div class="container"style=" width: 100%;">
                            <div class="row" style="margin-top: 20px;padding-left: 34px; padding-right: 34px; margin-bottom: 10px;">
                                <div class="col-12"> 
                                    <div class="row" style="height:100%;">
                                        <div class="col-lg-12 d-flex">
                                            <div class="row justify-content-center align-self-center" style="width: 100%;">
                                                <div class="col-12 text-center">
                                                    <div class="spinner-border" style="width: 200px; height:200px; color: #FF7900;" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <h5 style="color: #FF7900;margin-top:30px;margin-bottom:20px;">Fetching data from database...</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        return loadingdata;
    }

    // ERROR HANDLER
    function errorhandler(errorshow){
        var error = `<div class="alert alert-primary" role="alert">
                            <div class="col-12 text-center">
                                <h1><i class="fa fa-times-circle" aria-hidden="true" style="color:red; font-size:75px;"></i></h1>
                                <h3>&nbsp;&nbsp; Something went wrong. Error :</h3>
                                <h3>&nbsp;&nbsp; ${errorshow}</h3>
                            </div>
                        </div>`
        return error;
    }

</script>

</body>
</html>