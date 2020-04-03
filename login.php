<?php
require 'connection.php';

//Initialize session
session_start();

//Retrieve username and password
if (isset($_REQUEST['userName']) and isset($_REQUEST['password'])) {
    $login = mysqli_query($connection, "SELECT userName, password FROM USER WHERE userName = '" . mysqli_real_escape_string($connection, $_REQUEST['userName']) . "' and password = '" . mysqli_real_escape_string($connection, $_REQUEST['password']) . "'");
    if (!$login) {
            printf("Error in login: %s\n", mysqli_error($connection));
            exit();
    }
}
else {
    echo "post variables not set";
}

//Check if un/pw match
if (mysqli_num_rows($login) == 1) {
    //set username session variable
    $_SESSION['userName'] = $_REQUEST['userName'];
    header('Location:taskpage.php');
}

?>