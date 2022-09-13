<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/style2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .p-2{
        padding:0px !important;
    }
</style>

</head>
<body>
<nav class="navbar sticky-top navbar-dark" style="background-color: #1F0075;">
    <a class="navbar-brand" href="#" >CALOOCAN VAXCERT</a>
    <a class="navbar-brand" href="../home.php"> GO BACK <i class="fa fa-sign-out"></i></a>
</nav>

<!-- The sidebar -->
<div class="sidebar">
  <a href="dashboard.php" style="text-decoration: none !important;"class="active"><i class="fa fa-desktop"></i> &nbsp Dashboard</a>
  <a href="users-account.php" style="text-decoration: none !important;"><i class="fa fa-user-o"></i> &nbsp Users' Account</a>
  <a href="vaccine-data.php" style="text-decoration: none !important;"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp Vaccination Data</a>
  <a href="created-vaxcert.php" style="text-decoration: none !important;"><i class="fa fa-address-card-o" aria-hidden="true"></i> &nbsp Created Vaxcert</a>
  <a href="contact-tracing-list.php" style="text-decoration: none !important;"><i class="fa fa-eye" aria-hidden="true"></i></i> &nbsp Contact Tracer</a>
</div>

<div class="container-fluid">    
    <div class="row content">
        <div class="col-lg-12">
            <div class="row" style="padding-right: 10px; padding-top:10px;">
                <div class="col-12" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Dashboard
                </div>
            </div>
            <div class="row" style="padding-right: 10px; padding-top:10px;">
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#AAAAAA, #840BBB); margin-right: 5px; border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">Announcement</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em; color:white;">22</h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#AA44AA, #840B0B); margin-right: 5px; border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">User's Account</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em; color:white;">54</h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#4EEAAA, #6D9825);margin-right: 5px;border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">Vaccination Data</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em;color:white;">23</h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#6E15F4, #322360);border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">Created Vaxcert</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em;color:white;">23</h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-right: 10px; padding-top:10px; padding-bottom: 10px;">
                <div class="col-9" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Accouncement
                </div>
                <div class="col-3" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    <div class="row">
                    <button type="button" class="btn btn-block add-data" style="margin-left: 15px;background-color: #1F0075; color:white;">Add Announcement</button>
                    </div>
                </div>
            </div>
            <div class="row" id="result-message">
                <?php
                    if(isset($_SESSION['message'])){
                ?>
                    <div class="alert alert-<?php echo $_SESSION['type'];?> alert-dismissible fade show" role="alert" style="width: 100%; margin-right:10px;">
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
            </div>
            <div class="row" style="padding-right: 10px;">
                <table class="table table-hover" id="table-live">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="" id="edit-announcement-form">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel" style="color: #1F0075;">ANNOUNCEMENT</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="selectid" id="selectid" hidden value="">
                    <label for="creatorname">Created by</label>
                    <input type="text" class="form-control" name="creatorname" id="creatorname" maxlength="25" placeholder="Enter Author Name" value="">
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="creatorname-error"></p>
                </div>
                <div class="form-group">
                    <label for="description">Post Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description" maxlength="500" placeholder="Enter Description"></textarea>
                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="description-error"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="edit-announcement" id="edit-announcement" value="Edit Announcement" class="btn btn-primary">
            </div>
            </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.add-data', function(){
                $('#edit-announcement-form').trigger('reset');
                $('#edit-announcement').val('Add Announcement');
                $('#editModal').modal('show');
            });

    });


</script>

</html>