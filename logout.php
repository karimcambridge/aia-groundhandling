<?php

require_once 'core.php';

session_start();
logAudit($_SESSION['accountId'], AUDIT_EVENT_DEAUTH);
session_unset();
session_destroy();

header('location:index.php');
exit();

?>