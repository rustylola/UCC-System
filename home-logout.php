<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['uniqueid']);
unset($_SESSION['accountrole']);

unset($_SESSION["filename"]);
unset($_SESSION['ID']);
unset($_SESSION['verificationcode']);
unset($_SESSION['vaccinetype']);
unset($_SESSION['vaccinedate']);
unset($_SESSION['vaccbrand']);
unset($_SESSION['vacccountry']);
unset($_SESSION['vaccarea']);
unset($_SESSION['fullname']);
unset($_SESSION['usergender']);
unset($_SESSION['userbdate']);
unset($_SESSION['filenameqr']);

exit();

?>