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
    <?php $_SESSION['activesidebar'] = "accounts";
    include('sidebar.php');
    ?>
</div>

<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row content">
        <div class="col-lg-12">
            <div class="row" style="padding-right: 10px; padding-top:10px;">
                <div class="col-12" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Staff's Account
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-5" style="padding: 0px; padding-top:10px; padding-bottom:10px;padding-right:10px;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" name="searchID" id="searchID" placeholder="ACCOUNT ID" oninput="searchbars()">
                            </div>
                        </div>
                        <div class="col-5" style="padding: 0px; padding-top:10px; padding-bottom:10px;padding-right:10px;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" name="searchName" id="searchName" placeholder="ACCOUNT NAME" oninput="searchbars()">
                            </div>
                        </div>
                        <div class="col-2" style="padding: 0px; padding-top:10px; padding-bottom:10px;">
                            <button type="button" class="btn btn-block" name="create-account-btn" id="create-account-btn" style="background-color: #FF7900; color:white;" >ADD ACCOUNT</button>
                        </div>
                    </div>
                    <div class="row">
                    <?php
                    if(isset($_SESSION['message'])){
                    ?>
                        <div class="alert alert-<?php echo $_SESSION['type'];?> alert-dismissible fade show" role="alert" style="width: 100%;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?php echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                            unset($_SESSION['type']);
                        ?></strong>
                        </div>
                    <?php
                        }
                    ?>
                        <table class="table table-hover" id="table-users">
                            
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<!--add and create modal account-->
<div class="modal" id="create-edit-Modal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="" id="create-account-form">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center"style="color: #FF7900;" id="Modaltitle">Account</h5>
        
      </div>
      <div class="modal-body">
            <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="uniqueID" id="uniqueID" value="">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" maxlength="20" placeholder="Enter Username" onInput="checkusername()" autocomplete="off">
                                <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="username-error"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Enter Email">
                                <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="email-error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="accrole">Account Role</label>
                        <select class="custom-select" id="accrole" name="accrole">

                        </select>
                        <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="role-error"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" maxlength="30" placeholder="Enter Password">
                        <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="password-error"></p>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" maxlength="30" placeholder="Enter Confim Password">
                        <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="confirmpassword-error"></p>
                    </div>
                </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="create-edit" id="create-edit" value="Create Account" class="btn btn-success">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Delete modal-->
<div class="modal" id="delete-Modal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="" id="delete-account-form">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center"style="color: #FF7900;"id="exampleModalLabel">Delete Account</h5>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" role="alert">
            <input type="hidden" id="delete-selected-id" name="delete-selected-id" value="">
            <strong>Are You sure? Ask the owner for permission.</strong><br><br>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #FF7900; color:white;">Username</span>
                </div>
                <input type="text" id="username-delete" name="username-delete" class="form-control" disabled>
            </div>
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #FF7900; color:white;">Email</span>
                </div>
                <input type="text" id="email-delete" name="email-delete" class="form-control" disabled>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="delete-account" name="delete-account" class="btn btn-danger">Delete this Account</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script>
    $(document).ready(function(){

        tablefetch();
        userroleselection();
        $(document).on('click','#create-account-btn', function(){
            $('#create-account-form').trigger('reset');
            $('#create-edit').val('Create Account')
            $('#Modaltitle').html('Create Account');
            $('#create-edit-Modal').modal('show');
        });

        $(document).on('click', '.edit-account', function(){
            var accountID = $(this).attr('id');
            $.ajax({
                url:'tab-staff-function.php',
                method:'POST',
                data:{accountID:accountID},
                dataType:"json",
                success:function(data){
                    $('#uniqueID').val(data.Unique_ID);
                    $('#username').val(data.user_name);
                    if(data.account_role == null){
                        $('#accrole').val(0);
                    }else{
                        $('#accrole').val(data.account_role);
                    }
                    console.log(data.account_role);
                    $('#email').val(data.email);
                    $('#password').val("");
                    $('#confirmpassword').val("");
                    $('#create-edit').val('Edit Account');
                    $('#Modaltitle').html('Edit Account');
                    $('#create-edit-Modal').modal('show');
                }
            });
        });

        $(document).on('click', '.delete-data', function(){
            var accountdeleteID = $(this).attr('id');
            $.ajax({
                url:'tab-staff-function.php',
                method:'POST',
                data:{accountdeleteID:accountdeleteID},
                dataType:'json',
                success:function(data){
                    $('#delete-selected-id').val(data.Unique_ID);
                    $('#username-delete').val(data.user_name);
                    $('#email-delete').val(data.email);
                    $('#delete-Modal').modal('show');
                }
            });
        });

        $('#delete-account-form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'tab-staff-function.php',
                method:'POST',
                data:$('#delete-account-form').serialize(),
                success:function(data){
                    $('#delete-account-form').trigger('reset');
                    tablefetch();
                    $('#delete-account-form').modal('hide');
                    location.reload();
                }
            });
        });

        $('#create-account-form').on('submit', function(event){
            event.preventDefault();
            
            if($('#username').val() == ''){
                $('#username-error').html('*Username is Required.');
                return false;
            }else if($('#username').val().length < 3 || $('#username').val().length > 20){
                $('#username-error').html('*Only 3-20 characters is required.');
                return false;
            }else{
                $('#username-error').html('');
            }
            console.log($('#accrole option:selected').text());
            if($('#accrole option:selected').text() == '--Select Here--'){
                $('#role-error').html('*Account Role is Required.');
                return false;
            }else{
                $('#role-error').html('');
            }

            if($('#email').val() == '' || IsEmail($('#email').val()) == false){
                $('#email-error').html('*Email is Required.');
                return false;
            }else if($('#email').val().length < 3 || $('#email').val().length > 40){
                $('#email-error').html('*Only 3-20 characters is required.');
                return false;
            }else{
                $('#email-error').html('');
            }

            if($('#password').val() == ''){
                $('#password-error').html('*Password is Required.');
                return false;
            }else if($('#password').val().length < 5){
                $('#password-error').html('*Password must be 5-30 characters.');
                return false;
            }else{
                $('#password-error').html('');
            }

            if($('#confirmpassword').val() == ''){
                $('#confirmpassword-error').html('*Confirm Password is Required.');
                return false;
            }else if($('#password').val() != $('#confirmpassword').val()){
                $('#confirmpassword-error').html('*Password and Confirm Password is not the same.');
                return false;
            }else{
                $('#confirmpassword-error').html('');
            }

            $.ajax({
                url:'tab-staff-function.php',
                method:'POST',
                data:$('#create-account-form').serialize(),
                success:function(data){
                    $('#create-account-form').trigger('reset');
                    tablefetch();
                    $('#create-edit-Modal').modal('hide');
                    location.reload();
                }
            });

        });

    });

    function checkusername(){
        $.ajax({
            type:'POST',
            url:'tab-staff-function.php',
            data: 'username='+$('#username').val(),
            success:function(data){
                $('#username-error').html(data);
            },
            error(){}
        });
    }

    function searchbars(){
        if($('#searchID').val().length > 0 ){
            $.ajax({
            method:'POST',
            url:'tab-staff-function-table.php',
            data:'searchID='+$('#searchID').val(),
            success:function(data){
                $('#table-users').html(data);
            }
            });
        }else if($('#searchName').val().length > 0){
            $.ajax({
            method:'POST',
            url:'tab-staff-function-table.php',
            data:'searchName='+$('#searchName').val(),
            success:function(data){
                $('#table-users').html(data);
            }
            });
        }else{
            tablefetch();
        }
    }

    function tablefetch(){
        $.ajax({
            url:'tab-staff-tables.php',
            success:function(data){
                $('#table-users').html(data);
            }
        });
    }

        $("#username").keypress(function(event){
        var inputValue = event.charCode;
            if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32)||(inputValue > 47 && inputValue < 58) ||(inputValue==32) || (inputValue==0))){
                event.preventDefault();
            }
        });

        // Email Validation ----
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
                return false;
            }else{
                return true;
            }
        }

        function userroleselection(){
            $.ajax({
                type: "POST",
                url: "tab-staff-account-role-selection.php",
                success: function (data) {
                    $('#accrole').html(data);
                }
            });
        }

</script>

</body>
</html>