
<?php session_start(); ?>
<?php include('account-check.php');?>
<?php include('dashboard-count.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/style.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
    <?php $_SESSION['activesidebar'] = "dashboard";
        include('sidebar.php');
    ?>
    
</div>

<div class="container-fluid" style="margin-top: 50px;">    
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
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em; color:white;"><?php echo $countannouncement; ?></h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#AA44AA, #840B0B); margin-right: 5px; border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">User's Account</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em; color:white;"><?php echo $countuserscount; ?></h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#4EEAAA, #6D9825);margin-right: 5px;border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">Vaccination Data</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em;color:white;"><?php echo $countdatacount;?></h1></div>
                            <div class="p-2 flex-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row"style="background-image: linear-gradient(#6E15F4, #322360);border-radius:10px 10px 10px 10px;">
                        <div class="d-flex flex-column container-fluid">
                            <div class="p-2 flex-fill"style="text-align:center;padding-top: 10px !important;"><h3 style="color:white;">Created Vaxcert</h3></div>
                            <div class="p-2 flex-fill"style="text-align:center;padding-bottom:10px !important;"><h1 style="font-size: 5em;color:white;"><?php echo $countvaxcertcount;?></h1></div>
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
                    <button type="button" class="btn btn-block add-data" style="margin-left: 15px;background-color: #FF7900; color:white;">Add Announcement</button>
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
                    
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal edit and add-->
<div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="" id="edit-announcement-form">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel" style="color: #FF7900;">ANNOUNCEMENT</h5>
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

<!-- modal delete-->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="" id="delete-announcement-form">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLabel" style="color: #FF7900;">DELETE ANNOUNCEMENT</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="deleteselectids" id="deleteselectids" hidden value="">
                    <label for="creatorname">Created by : <b id="delete-creatorname"></b></label>
                </div>
                <div class="form-group">
                    <label for="description">Post Description : <b id="delete-description"></b></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="delete-announcement" id="delete-announcement" value="Delete Announcement" class="btn btn-primary">
            </div>
            </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){
            
            function tablefetch(){
                $.ajax({
                url:'dashboard-fetch-table.php',
                success:function(data){
                    $('#table-live').html(data);
                },
                error(){
                    
                }
                });
            }
            tablefetch();

            $(document).on('click','.add-data', function(){
                $('#edit-announcement-form').trigger('reset');
                $('#edit-announcement').val('Add Announcement');
                $('#editModal').modal('show');
            });
            
            $(document).on('click', '.edit-data', function(){
                var selectedID = $(this).attr('id');
                $.ajax({
                    url:"dashboard-function.php",
                    method:"POST",
                    data:{selectedID:selectedID},
                    dataType:"json",
                    success:function(data){
                        $('#edit-announcement').val('Edit Announcement');
                        $('#selectid').val(data.ID);
                        $('#creatorname').val(data.created_by);
                        $('#description').val(data.post_desc);
                        $('#editModal').modal('show');
                    }
                });

            });

            $('#edit-announcement-form').on('submit', function(event){
                event.preventDefault(); 

                if($('#creatorname').val() == ''){
                    $('#creatorname-error').html('*Creator is required.');
                    return false;
                }else{
                    $('#creatorname-error').html('');
                } 
                
                if($('#description').val() ==''){
                    $('#description-error').html('*Description is required.');
                    return false;
                }else{
                    $('#description-error').html('');
                }

                $.ajax({
                        url:"dashboard-function.php",
                        method:"POST",
                        data:$('#edit-announcement-form').serialize(),
                        success:function(data){
                            $('#edit-announcement-form').trigger('reset');
                            tablefetch();
                            $('#editModal').modal('hide');
                            location.reload();
                        }
                    });

            });

            $(document).on('click', '.delete-data',function(){
                var deleteselectedid = $(this).attr('id');
                $.ajax({
                    url:"dashboard-function.php",
                    method:"POST",
                    data:{deleteselectedid:deleteselectedid},
                    dataType:"json",
                    success:function(data){
                        $('#deleteselectids').val(data.ID);
                        $('#delete-creatorname').html(data.created_by);
                        $('#delete-description').html(data.post_desc);
                        $('#deleteModal').modal('show');
                    }
                });
            });
            $('#delete-announcement-form').on('submit', function(event){
                event.preventDefault(); 
                $.ajax({
                    url:"dashboard-function.php",
                    method:"POST",
                    data:$('#delete-announcement-form').serialize(),
                    success:function(data){
                        $('#delete-announcement-form').trigger('reset');
                        $('#deleteModal').modal('hide');
                        location.reload();
                    }
                });
            });
        });

    </script>

</body>
</html>