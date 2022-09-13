
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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
            </ul>
        </nav>

    <!--Carousel Banner-->
        <div class="container" style="margin-top:90px; width:100%;">
            <div class="row">
                <div class="col-12 text-center">
                    <video id="camera-take" width="100%" style="border: 1px solid #FF4600;border-radius:10px 10px 10px 10px;"></video>
                </div>
            </div>
            <div class="row" style="margin-top: 5px;">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border: 1px solid #FF4600;background-color:#FF4600; color:white;">QR CODE OUTPUT</span>
                        </div>
                        <input type="text" class="form-control" id="qr-code-output" style="border: 1px solid #FF4600;" placeholder="Code Result" oninput="scancodeinput()">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-12">
                    <div class="col-12 text-center" style="border: 1px solid #FF4600;border-radius:10px 10px 10px 10px;margin-bottom: 20px; padding:10px;">
                        <div class="col-12">
                            <img src="img/scanme.gif" style="width: 30%;margin:20px; border: 5px solid #FF4600;">
                        </div>
                            <h4 style="color: #FF4600;">SCAN QR CODE NOW!</h4>
                        <div class="col-12-lg text-center" style="border-radius:10px 10px 10px 10px;border:1px solid #FF4600;margin:10px;">
                            <h5 style="color: #FF4600;margin-top:5px; padding:10px;">
                                Allow the camera use, then scan the QR CODE and wait for the result. 
                            </h5>
                             <!-- <img src="img/Pictureuse.png"class="img-fluid" style="height:30%;width:30%;margin:20px;border:1px solid #FF4600; padding:10px;"> -->
                        </div>
                    </div>
                </div>
            </div> 
        </div>

    <div class="container-justify ">
        <div class="d-flex justify-content-around align-items-center bg-white" style="box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.45);height:50px !important;background-image: linear-gradient(360deg, white, #f2f2f2);">
            <div class="p-2">
                <b class="footcredit" style="color: #FF4600;">CALOOCAN @ VAX GENERATOR </b>
            </div>
        </div>
    </div>

<div class="modal fade" id="modalresult" data-keyboard="false" data-backdrop="static" >
  <div class="modal-dialog modal-dialog-scrollable" style="max-width: 600px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal3Label" style="color: #FF4600;">SCAN RESULT</h5>
        <button type="button" id="pressexit1" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12" id="result-scan">
                    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="pressexit2" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
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
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('camera-take')
        });
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                alert('No Cameras Found');
            }
        }).catch(function(e){
            console.log(e);
        })
        
        scanner.addListener('scan',function(c){
            document.getElementById('qr-code-output').value = c;
            scancodeinput();
        });

        function scancodeinput(){
            var getcode = $('#qr-code-output').val();
            if($('#qr-code-output').val() == ''){
                $('#result-scan').hide();
            }else{
                $.ajax({
                method: "POST",
                url: "QRcode-test-func.php",
                data: {getcode:getcode},
                success: function (data) {
                    $('#result-scan').html(data);
                    $('#modalresult').modal('show');
                }
                });
            }
        }

        $(document).on('click','#pressexit1',function(){
            location.reload();
        });

        $(document).on('click','#pressexit2',function(){
            location.reload();
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

    </script>
    

</body>
</html>