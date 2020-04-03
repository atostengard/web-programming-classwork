<?php

   require 'connection.php';
    
    if (!isset($_SESSION)) {
        session_start();       
    }

    //get userID from name
    $userName = $_SESSION['userName'];
    $userID = mysqli_query($connection, "SELECT user_id FROM USER WHERE userName = '$userName'");
    if (!$userID) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
    $line = mysqli_fetch_array($userID, MYSQLI_ASSOC);
    $userID = $line['user_id'];
    $userID = mysqli_real_escape_string($connection, $userID);

    //change pet status in db
    $petStatus = mysqli_query($connection, "UPDATE USER SET petStatus = 'Sad' WHERE user_id='$userID'");
    if (!$petStatus) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }
    
    header('Location:petpage.php');
?>