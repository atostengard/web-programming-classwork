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
    
    //get how many they have already to subtract one
    $numPowerups = mysqli_query($connection, "SELECT playPowerup FROM USER WHERE user_id = '$userID'");
    if (!$numPowerups) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }
    $line = mysqli_fetch_array($numPowerups, MYSQLI_ASSOC);
    $numPowerups = $line['playPowerup'];
    $numPowerups = mysqli_real_escape_string($connection, $numPowerups);
    
    if ($numPowerups == 0) {
        echo "You don't have any of those left! <br><button onclick=location.href='petpage.php'>Back</button>";
    }
    else {
        //delete powerup from the database
        $deletionQuery = mysqli_query($connection, "UPDATE USER SET playPowerup = $numPowerups - 1 WHERE user_id='$userID'");
        
        //change pet status in db
        $petStatus = mysqli_query($connection, "UPDATE USER SET petStatus = 'Happy' WHERE user_id='$userID'");
        if (!$petStatus) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
        header('Location:petpage.php');
    }

?>