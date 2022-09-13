<?php include("database.php");?>
<html>
    <?php
        $uniqueid = $_SESSION['uniqueid'];
        $query = "SELECT vax_user_acc.*,vax_user_role.account_user_role,vax_user_role.role_accessibility FROM `vax_user_acc` LEFT OUTER JOIN vax_user_role ON vax_user_acc.account_role=vax_user_role.id WHERE `vax_user_acc`.`Unique_ID`='".$uniqueid."'";
        $result = mysqli_query($mysqli,$query);
        $count = mysqli_num_rows($result);

        if($count > 0){
            $row = mysqli_fetch_array($result);
            $role_name = $row['account_user_role'];
            $string = $row['role_accessibility'];
            $getarray = explode(",",$string); 

            $getalldata = array("role_name"=> $role_name, "role_access"=>$getarray);
            $access = json_encode($getalldata);
            $decodeaccess = json_decode($access, true);
            $getrolename = $decodeaccess['role_name'];
            $getroleaccess = $decodeaccess['role_access'];
            $countroleaccess = count($getroleaccess);

            for($i = 0; $i < $countroleaccess; $i++){
                if($decodeaccess['role_access'][$i] == "dashboard"){
                    if($_SESSION['activesidebar'] == "dashboard"){
                    ?>
                        <a href="dashboard.php" style="text-decoration: none !important;" class="active"><i class="fa fa-desktop"></i> &nbsp Dashboard</a>
                    <?php
                    }else{
                    ?>
                        <a href="dashboard.php" style="text-decoration: none !important;"><i class="fa fa-desktop"></i> &nbsp Dashboard</a>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "accounts"){
                    if($_SESSION['activesidebar'] == "accounts"){
                    ?>
                        <!-- <a href="users-account.php" style="text-decoration: none !important;" class="active"><i class="fa-solid fa-user-group"></i> &nbsp Users' Account</a> -->
                        <div id="accordion" role="tablist">
                            <div class="card" style="border: 0px !important;">
                                <div class="card-header" role="tab" id="headingOne" style="padding:0px;border:0px;"">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="active" style="text-decoration: none !important;">
                                        <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Accounts &nbsp; <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body" style="padding: 0px;">
                                        <a href="tab-admin-account.php" style="text-decoration: none !important;background-color: #be5900;"><i class="fa-solid fa-user-tie"></i> &nbsp; Admin Account</a>
                                        <a href="tab-staff-account.php" style="text-decoration: none !important;background-color: #be5900;"><i class="fa-solid fa-user-tie"></i> &nbsp; Staff Account</a>
                                        <a href="users-account.php" style="text-decoration: none !important;background-color: #be5900;"><i class="fa-solid fa-user-group"></i> &nbsp; Users' Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }else{
                    ?>
                        <!-- <a href="users-account.php" style="text-decoration: none !important;"><i class="fa-solid fa-user-group"></i> &nbsp Users' Account</a> -->
                        <div id="accordion" role="tablist">
                            <div class="card" style="border: 0px !important;">
                                <div class="card-header" role="tab" id="headingOne" style="padding:0px;border:0px;"">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none !important;">
                                        <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Accounts &nbsp; <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body" style="padding: 0px;">
                                        <a href="tab-admin-account.php" style="text-decoration: none !important;background-color: #be5900;"><i class="fa-solid fa-user-tie"></i> &nbsp; Admin Account</a>
                                        <a href="tab-staff-account.php" style="text-decoration: none !important;background-color: #be5900;"><i class="fa-solid fa-user-tie"></i> &nbsp; Staff Account</a>
                                        <a href="users-account.php" style="text-decoration: none !important;background-color: #be5900;"><i class="fa-solid fa-user-group"></i> &nbsp; Users' Account</a>
                                        <!-- <a href="#"> &nbsp;&nbsp; <i class="fa fa-users" aria-hidden="true"></i> Admin</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "vaccine-data"){
                    if($_SESSION['activesidebar'] == "vaccine-data"){
                    ?>
                        <a href="vaccine-data.php" style="text-decoration: none !important;" class="active"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp Patient Data</a>
                    <?php
                    }else{
                    ?>
                        <a href="vaccine-data.php" style="text-decoration: none !important;"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp Patient Data</a>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "created-vaxcert"){
                    if($_SESSION['activesidebar'] == "created-vaxcert"){
                    ?>
                        <a href="created-vaxcert.php" style="text-decoration: none !important;" class="active"><i class="fa fa-address-card-o" aria-hidden="true"></i> &nbsp Created VaxID</a>
                    <?php
                    }else{
                    ?>
                        <a href="created-vaxcert.php" style="text-decoration: none !important;"><i class="fa fa-address-card-o" aria-hidden="true"></i> &nbsp Created VaxcerID</a>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "contact-tracing-list"){
                    if($_SESSION['activesidebar'] == "contact-tracing-list"){
                    ?>
                        <a href="contact-tracing-list.php" style="text-decoration: none !important;" class="active"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp Contact Tracer</a>
                    <?php
                    }else{
                    ?>
                        <a href="contact-tracing-list.php" style="text-decoration: none !important;"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp Contact Tracer</a>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "tab-vaccination-site"){
                    if($_SESSION['activesidebar'] == "tab-vaccination-site"){
                    ?>
                        <a href="tab-vaccination-site.php" style="text-decoration: none !important;" class="active"><i class="fa-solid fa-hospital"></i> &nbsp Vaccination Area</a>
                    <?php
                    }else{
                    ?>
                        <a href="tab-vaccination-site.php" style="text-decoration: none !important;"><i class="fa-solid fa-hospital"></i> &nbsp Vaccination Area</a>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "tab-vaccine"){
                    if($_SESSION['activesidebar'] == "tab-vaccine"){
                    ?>
                        <a href="tab-vaccine.php" style="text-decoration: none !important;" class="active"><i class="fa-solid fa-syringe"></i> &nbsp Vaccine List</a>
                    <?php
                    }else{
                    ?>
                        <a href="tab-vaccine.php" style="text-decoration: none !important;"><i class="fa-solid fa-syringe"></i> &nbsp Vaccine List</a>
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "tab-admin-account"){
                    if($_SESSION['activesidebar'] == "tab-admin-account"){
                    ?>
                        <!-- <a href="tab-admin-account.php" style="text-decoration: none !important;" class="active"><i class="fa-solid fa-user-tie"></i> &nbsp Admin Account</a> -->
                    <?php
                    }else{
                    ?>
                        <!-- <a href="tab-admin-account.php" style="text-decoration: none !important;"><i class="fa-solid fa-user-tie"></i> &nbsp Admin Account</a> -->
                    <?php
                    }
                }

                if($decodeaccess['role_access'][$i] == "account-accessibility"){
                    if($_SESSION['activesidebar'] == "account-accessibility"){
                    ?>
                        <a href="account-accessibility.php" style="text-decoration: none !important;" class="active"><i class="fa-solid fa-user-gear"></i> &nbsp Role Accessibility</a>
                    <?php
                    }else{
                    ?>
                        <a href="account-accessibility.php" style="text-decoration: none !important;"><i class="fa-solid fa-user-gear"></i> &nbsp Role Accessibility</a>
                    <?php
                    }
                }
            }
        }else{
            echo $result;
        }
    ?>
    

    
</html>