<?php

    if (!isset($_SESSION)) {
        session_start();       
    }
    
    
    if (isset($_SESSION['userName'])) {
        $user_id = mysqli_query($connection, "SELECT user_id FROM USER WHERE userName = '{$_SESSION['userName']}'");
        $line = mysqli_fetch_array($user_id, MYSQLI_ASSOC);
        $user_id = $line['user_id'];
        $user_id = mysqli_real_escape_string($connection, $user_id);

        //queries how much gold in user inventory
        $gold_amt = mysqli_query($connection, "SELECT amt_gold FROM USER WHERE user_id = '$user_id';");
        if (!$gold_amt) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }

        $listNames = mysqli_query($connection, "SELECT name, list_id FROM LIST WHERE user_id = '$user_id';");
        if (!$listNames) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }   

        //get powerups
        $powerupQuery = mysqli_query($connection, "SELECT foodPowerup, napPowerup, playPowerup FROM USER WHERE user_id = '$user_id';");
        $line = mysqli_fetch_array($powerupQuery, MYSQLI_ASSOC);

        $powerupArray = array();
        array_push($powerupArray, "Treat Powerups: ".$line['foodPowerup']);
        array_push($powerupArray, "Nap Powerups: ".$line['napPowerup']);
        array_push($powerupArray, "Play Powerups: ".$line['playPowerup']);

        
        $_SESSION['powerups'] = $powerupArray;
        
        $petStatus = mysqli_query($connection, "SELECT petStatus FROM USER WHERE user_id = '$user_id'");
        $line = mysqli_fetch_array($petStatus, MYSQLI_ASSOC);
        $petStatus = $line['petStatus'];
        $petStatus = mysqli_real_escape_string($connection, $petStatus);
        $_SESSION['petStatus'] = $petStatus;
        
        if ($petStatus == 'Sad') {
            $_SESSION['petImage'] = 'sadpet.gif';
        }
        else {
            $_SESSION['petImage'] = 'happypet.png';   
        }
        

    }
    
    //get layout
    if (!isset($_SESSION['layout'])) {
        $_SESSION['layout'] = 'newStyles.css';
    }




?>