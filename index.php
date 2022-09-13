
<?php include('database.php'); ?>
<?php session_start(); ?>

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
                <li><a class="btn" id="sign-in-react" data-toggle="modal" data-target="#exampleModalsignup" style="color: #FF4600;">Sign up</a></li>
                <li><a class="btn" data-toggle="modal" data-target="#exampleModallogin" style="color: #FF4600;">Log in</a></li>
                <?php include('Apk-DownloadLink.php'); ?>
            </ul>
        </nav>

    <!--Carousel Banner-->
        <div class="container" style="margin-top:80px;">
            <?php
                if(isset($_SESSION['check'])){
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><?php echo $_SESSION['check'];?></strong>
                    </div>
                </div>
            </div>
            <?php
                    unset($_SESSION['check']);
                }
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
        <div class="container" style="padding-left:30px; padding-right:30px;margin-bottom:10px;">
            <div class="row justify-content-center" style="padding: 5px; color:#FF4600;border-bottom:1px solid #FF4600;border-top:1px solid #FF4600;">
                <h2 style="font-size: 1.65rem;text-align:center;">Caloocan VaxID Announcement</h2>
            </div>

    <!--Announcement List-->
            
            <?php
                $queryannounce = "SELECT * FROM `vax_announcement` ORDER BY ID DESC";
                $results = mysqli_query($mysqli,$queryannounce);
                $counts = mysqli_num_rows($results);

                if($counts > 0){
                    while($rows = mysqli_fetch_assoc($results)){
                ?>
            <div class="row" style="margin-top: 10px;border-radius:10px 10px 10px 10px;border:1px solid #FF4600;">
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
            <div class="row" style="margin-top: 10px;border-radius:10px 10px 10px 10px;border:1px solid #FF4600;">
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
            ?>

        </div>

    <!--Footer-->
    <div class="container-justify ">
        <div class="d-flex justify-content-around align-items-center bg-white" style="box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.45);height:50px !important;background-image: linear-gradient(360deg, white, #f2f2f2);">
            <div class="p-2"><b class="footcredit" style="color: #FF4600;">CALOOCAN @ VAX GENERATOR</b>
            </div>
        </div>
    </div>

    <!--Modal signup-->
    <div class="modal" id="exampleModalsignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form action="" id="create-account-form">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel" style="color: #FF4600;">SIGN UP ACCOUNT</h5>
                
            </div>
            <div class="show-form modal-body">
                <div class="container">
                    <div class="success-form row">
                        <div class="col-12 text-center">
                            <h1><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green; font-size:75px;"></i></h1>
                            <h3>&nbsp;&nbsp; Account Successfully Created. Login now!.</h3>
                        </div>
                    </div>
                    <div class="failed-form row">
                        <div class="col-12 text-center">
                            <h1><i class="fa fa-times-circle" aria-hidden="true" style="color:red; font-size:75px;"></i></h1>
                            <h3>&nbsp;&nbsp; Creating Account Failed. Try Again.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="uniqueID" id="uniqueID" value="<?php echo strtoupper(uniqid());?>">
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
                    <button type="button" class="btn btn-secondary" id="cancel-create-account" data-dismiss="modal">CANCEL</button>
                    <button type="submit" id="create-account" class="btn btn-success">CREATE ACCOUNT</button>
                </div>
            </form>
            </div>
        </div>
    </div>

     <!--Modal login-->
     <div class="modal" id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="" id="login-account-form">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel" style="color: #FF4600;">LOGIN ACCOUNT</h5>
            </div>
            <div class="modal-body">
                <div class="login-form-body container">
                    <div class="login-error-cols col-12 text-center">
                        <h5 id="login-error-body"></h5>
                    </div>
                    <div class="form-group">
                        <label for="username">USERNAME</label>
                        <input type="text" class="form-control" name="username-login" id="username-login" maxlength="25" placeholder="Enter Username">
                        <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="username-login-error"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input type="password" class="form-control" name="password-login" maxlength="30" id="password-login" placeholder="Enter Password">
                        <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="password-login-error"></p>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" id="login-cancel-account" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                    <button type="button" id="login-account" class="btn btn-success">LOGIN</button>
                </div>
            </form>    
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script type="text/javascript">
    
    // ------ Create account functions -----

    $(document).ready(function(){

        $('#create-account').click(function(e){
            
            e.preventDefault();

            if($('#username').val() == ''){
                $('#username-error').html('*Username is Required.');
                return false;
            }else if($('#username').val().length < 3 || $('#username').val().length > 20){
                $('#username-error').html('*Only 3-20 characters is required.');
                return false;
            }else{
                $('#username-error').html('');
            }

            if($('#email').val() == '' || IsEmail($('#email').val()) == false){
                $('#email-error').html('*Email is Required.');
                return false;
            }else if($('#email').val().length < 3 || $('#email').val().length > 40){
                $('#email-error').html('*Only 3-20 characters is required.');
                return false;
            }else{
                console.log(IsEmail($('#email').val()));
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
                type:'POST',
                url:'sign-login.php',
                data: $('#create-account-form').serialize(),
                success:function(data){
                    $('#create-account-form').trigger('reset');
                    $('.success-form').show();
                    $('.failed-form').hide();
                },
                error(){
                    $('.failed-form').show();
                    $('.success-form').hide();
                }
            });
        });

        $("#cancel-create-account").click(function(e){
            $('.success-form').hide();
            $('.failed-form').hide();
        });

        $("#sign-in-react").click(function(e){
            $('.failed-form').hide();
            $('.success-form').hide();
        });

        // Press keys -------
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

// ------ End Create account functions -----

        $('#login-account').click(function(){

            if($('#username-login').val() == ''){
                $('#username-login-error').html('*Username is Required.');
                return false;
            }else if($('#username-login').val().length < 3 || $('#username-login').val().length > 20){
                $('#username-login-error').html('*Only 3-20 characters is required.');
                return false;
            }else{
                $('#username-login-error').html('');
            }

            if($('#password-login').val() == ''){
                $('#password-login-error').html('*Password is Required.');
                return false;
            }else if($('#password-login').val().length < 5){
                $('#password-login-error').html('*Password must be 5-30 characters.');
                return false;
            }else{
                $('#password-login-error').html('');
            }

            $.ajax({
                type:'POST',
                url:'sign-login.php',
                data: $('#login-account-form').serialize(),
                success:function(data){
                    $('#login-account-form').trigger('reset');
                    $('.login-error-cols').show();
                    $('#login-error-body').html(data);
                }
            });

            $('#login-cancel-account').click(function(){
                $('.login-error-cols').hide();
            });

        });

        // Press keys -------
        $("#username-login").keypress(function(event){
        var inputValue = event.charCode;
            if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32)||(inputValue > 47 && inputValue < 58) ||(inputValue==32) || (inputValue==0))){
                event.preventDefault();
            }
        });

    });

    function checkusername(){
        $.ajax({
            type:'POST',
            url:'sign-login.php',
            data: 'username='+$('#username').val(),
            success:function(data){
                $('#username-error').html(data);
            },
            error(){}
        });
    }


    </script>

</body>
</html>