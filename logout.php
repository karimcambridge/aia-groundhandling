<?php

require_once 'core.php';

//if(session_status() == PHP_SESSION_NONE) { // session_start() is in core.php!
//    session_start();
//}
logEvent($_SESSION['accountId'], EVENT_LOG_DEAUTH);
session_unset();
session_destroy();

header('location:index.php');
exit();

?>