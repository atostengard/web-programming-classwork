<?php
session_start();

//unset session variables
session_unset();
//unset($_SESSION['userName']);

//destroy session
session_destroy();

//jump back to task page
header('Location: taskpage.php');
?>
