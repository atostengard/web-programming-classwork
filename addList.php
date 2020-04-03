<?php
    require 'connection.php';
    
    if (!isset($_SESSION)) {
        session_start();       
    }

    $listName = $_POST['listName'];
    echo $listName;

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

    //get max task_id to find next ID available in sequence
    $maxListID = mysqli_query($connection, "SELECT MAX(list_id) FROM LIST WHERE user_id = '$userID';");
    $line = mysqli_fetch_array($maxListID, MYSQLI_ASSOC);
    $maxListID = $line['MAX(list_id)'];
    $maxListID = mysqli_real_escape_string($connection, $maxListID);
    $newListID = $maxListID + 1;

    echo $maxListID;

    $insertResult = mysqli_query($connection, "INSERT INTO LIST (user_id, list_id, name) VALUES ('$userID', '$newListID', '$listName');");
    if (!$insertResult) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }

    //get tasks and reset session variables so tasks show up on page after redirect
    $listNameQuery = mysqli_query($connection, "SELECT name FROM LIST WHERE list_id = '$listID' AND user_id = '$userID'");
    if (!$listNameQuery) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
    }
    
    $listNames = array();
    while ($line = mysqli_fetch_array($listNameQuery, MYSQLI_ASSOC)) {
        array_push($listNames, $line['name']);
    }
    
    $_SESSION['listNames'] = $listNames;
    header('Location:taskpage.php');

    
  
?>