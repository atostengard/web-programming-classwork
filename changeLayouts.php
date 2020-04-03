<?php
    require 'connection.php';
    
    if (!isset($_SESSION)) {
        session_start();       
    }
    
    //get value clicked on from post
    $layoutChoice = $_POST['layoutChoice'];
    
    if ($layoutChoice == "Christmas") {
        $_SESSION['layout'] = 'newStyles2.css';
    }
    else if ($layoutChoice == "Navy and Teal") {
        $_SESSION['layout'] = 'newStyles.css';
    }
    
    header('Location:taskpage.php');
?>
