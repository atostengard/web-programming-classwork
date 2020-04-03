<?php

    require 'connection.php';
    
    if (!isset($_SESSION)) {
        session_start();       
    }
    
    $taskName = $_POST['taskName'];
    $listName = $_SESSION['listName'];
    
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
    
    $taskDeletionQuery = mysqli_query($connection, "DELETE FROM TASK WHERE user_id = '$userID' AND name = '$taskName'");
    if (!$taskDeletionQuery) {
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
    
    $newGoldAmt = $userGold + 50;
    
    $updateGold = mysqli_query($connection, "UPDATE USER SET amt_gold='$newGoldAmt' WHERE user_id='$userID'");
    if (!$updateGold) {
        printf("Update Error: %s\n", mysqli_error($connection));
        exit();
    }
    
    //get listID - need this to query updated list of tasks
    $listID = mysqli_query($connection, "SELECT list_id FROM LIST WHERE name = '$listName' AND user_id = '$userID'");
    if (!$listID) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
    $line = mysqli_fetch_array($listID, MYSQLI_ASSOC);
    $listID = $line['list_id'];
    $listID = mysqli_real_escape_string($connection, $listID);
    
    //update task array and reset session variables
    $tasks = mysqli_query($connection, "SELECT name FROM TASK WHERE list_id = '$listID' AND user_id = '$userID'");
    if (!$tasks) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
    }
    
    $taskArray = array();
    while ($line = mysqli_fetch_array($tasks, MYSQLI_ASSOC)) {
        array_push($taskArray, $line['name']);
    }
    
    $_SESSION['tasks'] = $taskArray;
    
    
    header('Location:taskpage.php');
?>
