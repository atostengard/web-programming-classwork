
<?php
//Jess - storepage

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


    $powerupType = $_POST['powerupType']; 
    echo $powerupType;

    $currentValue = mysqli_query($connection, "SELECT $powerupType FROM USER WHERE user_id = '$userID';");
    $line = mysqli_fetch_array($currentValue, MYSQLI_ASSOC);
    $currentValue = $line[$powerupType];
    $currentValue = mysqli_real_escape_string($connection, $currentValue);
    echo $currentValue;

    $updateResult = mysqli_query($connection, "UPDATE USER SET $powerupType = $currentValue + 1 WHERE user_id = '$userID';");
    if (!$updateResult) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }

    //update user gold amount for finishing task
    //get current user gold amount so we can add to it
    $userGold = mysqli_query($connection, "SELECT amt_gold FROM USER WHERE user_id='$userID'");
    if (!$userGold) {
        printf("Selection Error: %s\n", mysqli_error($connection));
        exit();
    }
    $line = mysqli_fetch_array($userGold, MYSQLI_ASSOC);
    $userGold = $line['amt_gold'];
    $userGold = mysqli_real_escape_string($connection, $userGold);
    
    if($powerupType == "foodPowerup" || $powerupType == "playPowerup") {
    	$newGoldAmt = $userGold - 100;
    }
    else {
    	$newGoldAmt = $userGold - 50;
    }
    
    $updateGold = mysqli_query($connection, "UPDATE USER SET amt_gold='$newGoldAmt' WHERE user_id='$userID'");
    if (!$updateGold) {
        printf("Update Error: %s\n", mysqli_error($connection));
        exit();
    }

    //echo("hello");

    header('Location:storepage.php');


?>