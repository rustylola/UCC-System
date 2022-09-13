<?php

include('database.php');

$queryvaxcertcount = "SELECT * FROM `vax_created` ORDER BY `vax_created`.`id` DESC";
$resultvaxcertcount = mysqli_query($mysqli,$queryvaxcertcount);
$countvaxcertcount = mysqli_num_rows($resultvaxcertcount);

$queryuserscount = "SELECT * FROM `vax_user_acc` ORDER BY `vax_user_acc`.`ID` DESC";
$resultuserscount = mysqli_query($mysqli,$queryuserscount);
$countuserscount = mysqli_num_rows($resultuserscount);

$querydatacount = "SELECT `ID`, CONCAT(`last_name`,', ', `first_name`,' ', `middle_name`) AS Data_Name, `birth_date`, `dose`, `date_last_vacc`, `vaccine`, `manufacturer`, `vaccination_area`, `date_inputed` FROM `vaccinated_old_data` ORDER BY `vaccinated_old_data`.`ID` DESC";
$resultdatacount = mysqli_query($mysqli,$querydatacount);
$countdatacount = mysqli_num_rows($resultdatacount);

$queryannouncement = "SELECT * FROM `vax_announcement` ORDER BY ID DESC";
$resultannouncement = mysqli_query($mysqli,$queryannouncement);
$countannouncement = mysqli_num_rows($resultannouncement);

?>