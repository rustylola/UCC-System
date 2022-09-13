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
    <?php $_SESSION['activesidebar'] = "contact-tracing-list";
    include('sidebar.php');
    ?>
</div>

<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row content" style="padding-right: 10px; padding-top:10px;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12" style="border-bottom:2px solid #746D88; padding-left:0; font-weight:bolder; font-size:25px; padding-bottom:5px;">
                    Contact Tracing
                </div>
            </div> 
            <div class="row">
                <div class="col-4" style="padding: 0px; padding-top:10px; padding-bottom:10px; padding-right:5px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control" name="searchname" id="searchname" placeholder="ACCOUNT NAME" oninput="nameanddate()">
                    </div>
                </div>
                <div class="col-4" style="padding: 0px; padding-top:10px; padding-bottom:10px; padding-right:5px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color: #FF7900;"><i class="fa fa-search"style="color:white;" aria-hidden="true"></i></span>
                        </div>
                        <input type="date" class="form-control" name="date-scan" id="date-scan" onchange="nameanddate()">
                    </div>
                </div>
                <div class="col-2" style="padding: 0px; padding-top:10px; padding-bottom:10px;padding-right:10px;">
                    <button type="button" class="btn btn-block" name="print-account-report" id="print-account-report" style="background-color: #FF7900; color:white;" onclick="print_report()" >Print Report</button>
                </div>
                <div class="col-2" style="padding: 0px; padding-top:10px; padding-bottom:10px;">
                    <button type="button" class="btn btn-block" name="delete-day" id="delete-day" style="background-color: #FF7900; color:white;" >Delete Date Data</button>
                </div>
            </div>
            <div class="row">
                <div id="table-show" style="width: 100%;">
                    <!-- Table Show -->
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="modal fade" id="view-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view-modal-label" style="color: #FF7900;">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="hidden" id="selected-id" value="">
            <div id="view-body">
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-btn">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete-date-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view-modal-label" style="color: #FF7900;">Delete Date Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="alert alert-danger" role="alert" id="text-above">
                <strong>Select a date to delete all records.</strong>
            </div>
            <div class="alert alert-danger" role="alert" id="text-below"style="margin-top: 15px;">
                <strong>Warning!</strong> All records on that date will deleted permanently.
            </div>
            <input type="date" class="form-control" name="date-delete-select" id="date-delete-select" style="border: 1px solid #FF7900;">
            <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="date-selecting-error"></p>
            <div id="delete-date-text-body">
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-date-delete" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="close-date-delete-btn">Delete</button>
        <button type="button" class="btn btn-warning" id="close-date-delete-now-btn">Delete all records</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="print-modal-body">
                                    <!-- <div class="form-group">
                                        <label for="filter-vaccinationarea-selection">Filter Selection Vaccination Area</label>
                                        <select class="custom-select" id="filter-vaccinationarea-selection" name="filter-vaccinationarea-selection">
                                            <option selected>Select Here</option>
                                        </select>
                                    </div> -->
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn modal-response-btn" id="print-report-btn" value>Print</button>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <script>

        $(document).ready(function(){

            getlink();
            filtervaccinationsiteprint();

            function getlink(){
                var params = new window.URLSearchParams(window.location.search);
                var dateget = params.get('dateselected');
                if(dateget != null){
                    $('#date-scan').val(dateget);
                    searchdate();
                }else{
                    tablefetch();
                }
            }

            // $(document).on('click','.view-img',function(){
            //     var imgpath = $(this).attr('id');
            //     $('#img-view-label').html('Image Upload View');
            //     $('#imgslot').attr('src', "../"+imgpath);
            //     $('#img-view-modal').modal('show');
            // });

            // $(document).on('click','.view-qr',function(){
            //     var imgpath = $(this).attr('id');
            //     $('#img-view-label').html('QR CODE Upload View');
            //     $('#imgslot').attr('src', "../"+imgpath);
            //     $('#img-view-modal').modal('show');
            // });
            
            $(document).on('click','#delete-day',function(){
                $('#delete-date-modal').modal('show');
                $('#text-above').show();
                $('#text-below').show();
                $('#delete-date-text-body').hide();
                $('#close-date-delete-now-btn').hide();
                $('#close-date-delete-btn').show();
                $('#date-delete-select').show();
            });
            $(document).on('click','#close-date-delete-btn',function(){
                var dateselect = $('#date-delete-select').val();
                if(dateselect == ''){
                    $('#date-selecting-error').html('*Please Select a date.');
                    return false;
                }else{
                $('#date-selecting-error').html('');
                $('#date-delete-select').hide();
                $('#text-above').hide();
                $('#text-below').hide();
                $('#delete-date-text-body').html(`
                <div class="alert alert-warning" role="alert">
                    <strong>Warning!</strong> Are you sure? <br>
                    Date : `+dateselect+`
                </div>
                `);
                $('#delete-date-text-body').show();
                $('#close-date-delete-now-btn').show();
                $('#close-date-delete-btn').hide();
                }  
            });

            $(document).on('click','#close-date-delete-now-btn',function(){
                var dateselect = $('#date-delete-select').val();
                $('#close-date-delete-now-btn').hide();
                $.ajax({
                    method: "POST",
                    url: "contact-tracing-delete-date.php",
                    data:{dateselect:dateselect},
                    success: function (data) {
                        $('#delete-date-text-body').html(data);
                        getlink();
                    }
                });

            });

            $(document).on('click','.delete-vaxcert',function(){
                var getdeleteID = $(this).attr('id');
                $.ajax({
                    method: "POST",
                    url: "contact-tracing-func.php",
                    data: {getdeleteID:getdeleteID},
                    success: function (data) {
                        $('#selected-id').val(getdeleteID);
                        $('#view-body').html(data);
                    }
                });
                $('#view-modal-label').html('Delete Data');
                $('#delete-btn').show();
                $('#view-modal').modal('show');
            });

            $(document).on('click','.view-vaxcert',function(){
                var getuniqueID = $(this).attr('id');
                $.ajax({
                    method: "POST",
                    url: "contact-tracing-func.php",
                    data: {getuniqueID:getuniqueID},
                    success: function (data) {
                        $('#view-body').html(data);
                    }
                });
                $('#view-modal-label').html('View Data');
                $('#delete-btn').hide();
                $('#view-modal').modal('show');
            });

            $(document).on('click','#delete-btn', function(){
                var selecteddeleteid = $('#selected-id').val();

                $.ajax({
                    url:"contact-tracing-func.php",
                    method:"POST",
                    data:{selecteddeleteid:selecteddeleteid},
                    success:function(){
                        $('#view-body').html(`
                        <div class="alert alert-success" role="alert">
                            <strong>Delete Successfully</strong><br> You successfully deleted the selected data.
                        </div>
                        `);
                        $('#view-modal-label').html('Operation Message');
                        $('#delete-btn').hide();
                    }
                });
            });

            $(document).on('click','#close-modal',function(){
                var dateselect = $('#date-scan').val();
                if(dateselect != ''){
                    window.location.href='contact-tracing-list.php?dateselected='+dateselect;
                }else{
                    tablefetch();
                }
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

                    // if($('#filter-vaccinationarea-selection option:selected').text() == '--Vaccination Area--'){
                    //     $('#filter-error').html('*Please select which area.');
                    //     return false;
                    // }else{
                    //     $('#filter-error').html('');
                    // }

                    //printnewtabday($('#specific-date-here').val(),$('#filter-vaccinationarea-selection option:selected').text());

                    printnewtabday($('#specific-date-here').val());
                    
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

                    // if($('#filter-vaccinationarea-selection option:selected').text() == '--Vaccination Area--'){
                    //     $('#filter-error').html('*Please select which area.');
                    //     return false;
                    // }else{
                    //     $('#filter-error').html('');
                    // }

                    //printnewtabdaytoday($('#start-date-here').val(),$('#end-date-here').val(),$('#filter-vaccinationarea-selection option:selected').text());
                    printnewtabdaytoday($('#start-date-here').val(),$('#end-date-here').val());
                    
                    console.log(Date.parse(startdate));
                    console.log(Date.parse(enddate));
                    console.log($('#filter-vaccinationarea-selection option:selected').text());
                }
            });

        });

            function nameanddate(){
                if($('#searchname').val().length > 0 && $('#date-scan').val() != ''){
                    nameanddatefunction();
                }else if($('#date-scan').val() != ''){
                    searchdate();
                }else if($('#searchname').val().length > 0){
                    searchaccountname();
                }else{
                    tablefetch();
                }
            }

            function nameanddatefunction(){
                var date = $('#date-scan').val();
                var name = $('#searchname').val();
                    console.log(date);
                if(date != ''){
                    $.ajax({
                        method: "POST",
                        url: "contact-tracing-fetch-tb.php",
                        data: {searchdate:date,
                            searchName:name,
                        },
                        success: function(data){
                            $('#table-show').html(data);
                        }
                    });
                }
            }

            function searchdate(){
                var date = $('#date-scan').val();
                    console.log(date);
                if(date != ''){
                    $.ajax({
                        method: "POST",
                        url: "contact-tracing-fetch-tb.php",
                        data: "searchdate="+date,
                        success: function(data){
                            $('#table-show').html(data);
                        }
                    });
                }
            }
            
            function searchaccountname(){
                if($('#searchname').val().length > 0){
                    $.ajax({
                        method: "POST",
                        url: "contact-tracing-fetch-tb.php",
                        data: "searchName="+$('#searchname').val(),
                        success: function(data){
                            $('#table-show').html(data);
                        }
                    });
                }
            }

            function tablefetch(){
                $.ajax({
                    url: "contact-tracing-fetch-tb.php",
                    success: function(data) {
                        $('#table-show').html(data);
                    }
                });
            }

        function filtervaccinationsiteprint(){
            $.ajax({
                type: "POST",
                url: "vaccinationsite-filter.php",
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

        function printnewtabdaytoday(startdate,enddate){
            var getstartdate = startdate;
            var getenddate = enddate;
            //var vaccinationarea = vaccinearea;
            //window.open('contact-tracing-list-print.php?vaccinationarea='+vaccinearea+'&startdate='+getstartdate+'&endate='+getenddate, '_blank');
            window.open('contact-tracing-list-print.php?startdate='+getstartdate+'&endate='+getenddate, '_blank');

            location.reload();
        }

        function printnewtabday(selectday){
            var getselectday = selectday;
            //window.open('contact-tracing-list-print.php?vaccinationarea='+vaccinearea+'&selectday='+getselectday,'_blank');
            window.open('contact-tracing-list-print.php?selectday='+getselectday,'_blank');
            location.reload();
        }

    </script>

</body>
</html>