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
    <?php $_SESSION['activesidebar'] = "account-accessibility";
    include('sidebar.php');
    ?>
</div>

<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row content" style="padding-right: 10px; padding-top:10px;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Role Accessibility
                </div>
            </div> 
            <div class="row">
                <div class="col-9" style="padding: 0px; padding-top:10px; padding-bottom:10px; padding-right:5px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control" name="searchrole" id="searchrole" placeholder="Role Search" oninput="searchrolefunc()">
                    </div>
                </div>
                <div class="col-3" style="padding: 0px; padding-top:10px; padding-bottom:10px;">
                    <button type="button" class="btn btn-block add-role" name="add-function" id="add-function" style="background-color: #FF7900; color:white;" >Add Role Access</button>
                </div>
            </div>
            <div class="row table-role-data-show">
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
    <div class="modal fade" id="view-role-details" data-keyboard="false" data-backdrop="static">
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
    tb_role();

    $(document).ready(function(){
        $(document).on('click','.add-role', function(){
            $(".modal-response-btn").removeAttr("disabled");
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','750px');
            $('#modal-title-show').html('Add Role Message');
            $('.modal-response-btn').show();
            $('.modal-response-btn').removeClass('btn-primary');
            $('.modal-response-btn').removeClass('btn-danger');
            $('.modal-response-btn').addClass('btn-success');
            $('.modal-response-btn').val('add-function');
            $('.modal-response-btn').attr('id',id);
            $('.modal-response-btn').html('Add Role');
            $('.modal-body-show').html(inputdata());
            $('#view-role-details').modal('show');
        });

        $(document).on('click','.edit-btn', function(){
            $(".modal-response-btn").removeAttr("disabled");
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','750px');
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
            $('#view-role-details').modal('show');
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

            $('#view-role-details').modal('show');
        });

        $(document).on('click','.view-btn', function(){
            var id = $(this).attr('id');
            $('.modal-dialog').css('max-width','600px');
            $('#modal-title-show').html('View Role Site');
            $('.modal-response-btn').hide();
            $('.modal-body-show').html(viewbtn());

            getdeletedata(id);

            //console.log($(this).attr('id'));
            $('#view-role-details').modal('show');
        });

        $(document).on('click','.modal-response-btn',function(){
            if($(this).val() == 'add-function'){
                
                if($('#role-name').val() == ''){
                    $('#role-name-error').html('*Role Name is Required.');
                    return false;
                }else if($('#role-name').val().length < 3){
                    $('#role-name-error').html('*Role Name is too short.');
                    return false;
                }else{
                    $('#role-name-error').html('');
                }

                if($('#role-select option:selected').text() == 'Select Main Role'){
                    $("#role-select-error").html('*Main Role is required');
                    return false;
                }else{
                    $("#role-select-error").html('');
                }

                if(selectedaccess().length == 0){
                    $('#role-access-error').html('*Please Select atleast 1 checkbox.');
                    return false;
                }else{
                    $('#role-access-error').html('');
                }

                var selectedid = $(this).attr('id');
                var flags = $(this).val();
                var rolename = $('#role-name').val();
                var mainrole = $('#role-select option:selected').text();
                insertupdatedata(selectedid,flags,rolename,selectedaccess(),mainrole);

                console.log($(this).val());

            }else if($(this).val() == 'update-function'){

                if($('#role-name').val() == ''){
                    $('#role-name-error').html('*Role Name is Required.');
                    return false;
                }else if($('#role-name').val().length < 3){
                    $('#role-name-error').html('*Role Name is too short.');
                    return false;
                }else{
                    $('#role-name-error').html('');
                }

                if($('#role-select option:selected').text() == 'Select Main Role'){
                    $("#role-select-error").html('*Main Role is required');
                    return false;
                }else{
                    $("#role-select-error").html('');
                }

                if(selectedaccess().length == 0){
                    $('#role-access-error').html('*Please Select atleast 1 checkbox.');
                    return false;
                }else{
                    $('#role-access-error').html('');
                }

                var selectedid = $(this).attr('id');
                var flags = $(this).val();
                var rolename = $('#role-name').val();
                var mainrole = $('#role-select option:selected').text();
                insertupdatedata(selectedid,flags,rolename,selectedaccess(),mainrole)

                console.log($(this).val());
            }else if($(this).val() == 'delete-function'){

                var flags = $(this).val();
                var selectedid = $('.modal-response-btn').attr('id');
                deletingdata(selectedid,flags);
                console.log($(this).val());
            }
        });
    });
    
    // INSERT AND UPDATE
    function insertupdatedata(id,flags,rolename,roleselected,mainrole){

    var selectedid = id;
    var btnflags = flags;
    var role_name = rolename;
    var role_selected = roleselected;
    var main_role = mainrole;

    $('.modal-response-btn').hide();

        $.ajax({
            type: "POST",
            url: "account-accessibility-add-update.php",
            data: {
                flags:btnflags,
                getid:selectedid,
                getrole_name:role_name,
                getrole_selected:role_selected,
                getmain_role:main_role,
            },success: function (data) {
                $('.modal-body-show').html(data);
                tb_role();
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
            url: "account-accessibility-delete.php",
            data: {
                flags:flags_btn,
                getid:selectedid,
            },success: function (data) {
                $('.modal-body-show').html(data);
                tb_role();
            },beforeSend: function() {
                $('.modal-body-show').html(loadingOnly());
            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                console.log(request.responseText);
            }
        });
    }

    // GET DATA FOR UPDATE
    function getdata(id){
        var selectedid = id;

        $.ajax({
            type: "POST",
            url: "account-accessibility-fetch-data.php",
            data: {roleid:selectedid},
            dataType: 'json',
            success: function (data) {
                console.log(data.role_name);
                console.log(data.role_access);
                var rolename = data.role_name;
                var roleaccess = data.role_access;
                var mainrole = data.role_main;
                // $('#role-name').val(data.account_user_role);
                // var selectedaccess = data.role_accessibility;
                checkboxfetchdata(rolename,roleaccess,mainrole);
            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                $('.modal-response-btn').hide();
                console.log(request.responseText);
            }
        });
    }

    // PUT DATA TO CHECK BOX
    function checkboxfetchdata(role_name,role_access,role_main){
        var getrole_name = role_name;
        var getrole_access = role_access;
        var getmainrole = role_main;
        var role_access_count = getrole_access.length;
        $('#role-name').val(getrole_name);
        $('#role-select').val(getmainrole);
        for(var i = 0; i < role_access_count; i++){
            if(getrole_access[i] == 'dashboard'){
                $('#dashboard').attr('checked',true);
            }else if(getrole_access[i] == 'accounts'){
                $('#accounts').attr('checked',true);
            }else if(getrole_access[i] == 'vaccine-data'){
                $('#vaccine-data').attr('checked',true);
            }else if(getrole_access[i] == 'created-vaxcert'){
                $('#created-vaxcert').attr('checked',true);
            }else if(getrole_access[i] == 'contact-tracing-list'){
                $('#contact-tracing-list').attr('checked',true);
            }else if(getrole_access[i] == 'tab-vaccination-site'){
                $('#tab-vaccination-site').attr('checked',true);
            }else if(getrole_access[i] == 'tab-vaccine'){
                $('#tab-vaccine').attr('checked',true);
            }else if(getrole_access[i] == 'tab-admin-account'){
                $('#tab-admin-account').attr('checked',true);
            }else if(getrole_access[i] == 'account-accessibility'){
                $('#account-accessibility').attr('checked',true);
            }
        }
    }

    // GET SELECTED ACCESSIBILITY TO ARRAY
    function selectedaccess(){
        var accessibilityvariable = [];
        $.each($("input[name='sidebar-accessibility']:checked"), function (K, V) { 
            accessibilityvariable.push({
                accessbar : V.value,
            });        
        });
        return accessibilityvariable;
    }

    // SEARCH ROLE FUNCTION
    function searchrolefunc(){
        var searchname = $('#searchrole').val();
        console.log(searchname);
        if(searchname != ""){

            $.ajax({
                type: "POST",
                url: "account-accessibility-tb.php",
                data: {searchrole:searchname},
                success: function (data) {
                    $('.table-role-data-show').html(data);
                },beforeSend: function() {
                    $('.table-role-data-show').html(loading());
                },error: function (request, status, error) {
                    $('.table-role-data-show').html(errorhandler(request.responseText));
                    console.log(request.responseText);
                }
            });
            
        }else{
            tb_role();
        }
    }
    // DEFAULT TABLE
    function tb_role(){
        $.ajax({
            type: "POST",
            url: "account-accessibility-tb.php",
            success: function (data) {
                $('.table-role-data-show').html(data);
                
            },beforeSend: function() {
                $('.table-role-data-show').html(loading());
            },error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    }

    // GET DATA FOR DELETE DISPLAY
    function getdeletedata(id){
        var selectedid = id;

        $.ajax({
            type: "POST",
            url: "account-accessibility-fetch-data.php",
            data: {roleid:selectedid},
            dataType: 'json',
            success: function (data) {
                console.log(data.role_name);
                console.log(data.role_access);
                var rolename = data.role_name;
                var roleaccess = data.role_access;
                var mainrole = data.role_main;
                // $('#role-name').val(data.account_user_role);
                // var selectedaccess = data.role_accessibility;
                attachdata(selectedid,rolename,roleaccess,mainrole);
            },error: function (request, status, error) {
                $('.modal-body-show').html(errorhandler(request.responseText));
                $('.modal-response-btn').hide();
                console.log(request.responseText);
            }
        });
    }

    // ATTACH DATA TO DISPLAY
    function attachdata(id,role_name,role_access,role_main){
        var getrole_name = role_name;
        var getrole_access = role_access;
        var getmainrole = role_main;
        var role_access_count = getrole_access.length;
        $('#role-id-delete-view').html(id);
        $('#role-name-delete-view').html(getrole_name);
        $('#role-main-delete-view').html(getmainrole);
        for(var i = 0; i < role_access_count; i++){
            if(getrole_access[i] == 'none'){
                $('.display-data-access').append('&nbsp;<span class="badge badge-danger">'+getrole_access[i]+'</span>');
            }else{
                $('.display-data-access').append('&nbsp;<span class="badge badge-primary">'+getrole_access[i]+'</span>');
            }
        }
    }

    // VIEW DISPLAY DATA
    function viewbtn(){
        var input= `<div class="card">
                        <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                            Role Information
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Role Id : <label style="font-weight:bold;" id="role-id-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Role Name : <label style="font-weight:bold;" id="role-name-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Role Main : <label style="font-weight:bold;" id="role-main-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Accessibility : <label style="font-weight:bold;" id="accessibility-delete-view"></label></h6>
                            <div class="display-data-access text-center" style="80%">

                            </div>
                        </div>
                    </div>`;
        return input;
    }

    // DISPLAY DATA INFO
    function viewdeletedisplay(){
        var input = `
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading text-center"><b>Warning!</b></h4>
                            <h5 class="text-center">Do you want to delete this role ?</h5>
                        </div>
                    <div class="card">
                        <div class="card-header text-center" style="background-color: #FF7900; color:white; font-size:25px;">
                            Role Information
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"style="color: #000;">Role Id : <label style="font-weight:bold;" id="role-id-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Role Name : <label style="font-weight:bold;" id="role-name-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Role Main : <label style="font-weight:bold;" id="role-main-delete-view"></label></h6>
                            <h6 class="card-title"style="color: #000;">Accessibility : <label style="font-weight:bold;" id="accessibility-delete-view"></label></h6>
                            <div class="display-data-access text-center" style="80%">

                            </div>
                        </div>
                    </div>`;
        return input;
    }

    // DISPLAY ADD UPDATE INPUT
    function inputdata(){
        var input = `
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="role-name">Role Name</label>
                                <input type="text" class="form-control" id="role-name" placeholder="Enter Role Name" maxlength="20" oninput="searchexisting()">
                                <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="role-name-error"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="role-select">Role Selection</label>
                                    <select class="custom-select" id="role-select">
                                        <option selected>Select Main Role</option>
                                        <option value="admin">admin</option>
                                        <option value="staff">staff</option>
                                        <option value="user">user</option>
                                    </select>
                                <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="role-select-error"></p>
                            </div>
                        </div>
                   </div>
                   <label for="">Select Sidebar Accessibility</label>
                    <div class="row selected-sidebar-accessibility" style="border-radius:5px 5px 5px 5px;border:1px solid #ced4da;margin-left: 1px;margin-right: 1px;padding-top: 10px;">
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="dashboard" name="sidebar-accessibility" value="dashboard">
                                <label class="custom-control-label" for="dashboard">Dashboard</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="accounts" name="sidebar-accessibility" value="accounts">
                                <label class="custom-control-label" for="accounts">accounts</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="vaccine-data" name="sidebar-accessibility" value="vaccine-data">
                                <label class="custom-control-label" for="vaccine-data">Vaccine-Data</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="created-vaxcert" name="sidebar-accessibility" value="created-vaxcert">
                                <label class="custom-control-label" for="created-vaxcert">Created-Vaxcert</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="contact-tracing-list" name="sidebar-accessibility" value="contact-tracing-list">
                                <label class="custom-control-label" for="contact-tracing-list">Contact-Tracing-List</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="tab-vaccination-site" name="sidebar-accessibility" value="tab-vaccination-site">
                                <label class="custom-control-label" for="tab-vaccination-site">Tab-Vaccination-Site</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="tab-vaccine" name="sidebar-accessibility" value="tab-vaccine">
                                <label class="custom-control-label" for="tab-vaccine">Tab-Vaccine</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="tab-admin-account" name="sidebar-accessibility" value="tab-admin-account">
                                <label class="custom-control-label" for="tab-admin-account">Tab-Admin-Account</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="account-accessibility" name="sidebar-accessibility" value="account-accessibility">
                                <label class="custom-control-label" for="account-accessibility">Account-Accessibility</label>
                            </div>
                        </div>
                    </div>
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="role-access-error"></p>`;
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