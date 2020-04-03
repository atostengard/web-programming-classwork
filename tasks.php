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
    
    //get listID
    $listName = $_POST['listName'];
    $listID = mysqli_query($connection, "SELECT list_id FROM LIST WHERE name = '$listName' AND user_id = '$userID'");
    if (!$listID) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
    $line = mysqli_fetch_array($listID, MYSQLI_ASSOC);
    $listID = $line['list_id'];
    $listID = mysqli_real_escape_string($connection, $listID);
    
    //get tasks
    $tasks = mysqli_query($connection, "SELECT name FROM TASK WHERE list_id = '$listID' AND user_id = '$userID'");
    if (!$tasks) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
    }
    
    $taskArray = array();
    while ($line = mysqli_fetch_array($tasks, MYSQLI_ASSOC)) {
        array_push($taskArray, $line['name']);
    }
   
    
    $_SESSION['listName'] = $listName;
    $_SESSION['tasks'] = $taskArray;
    header('Location:taskpage.php');
?>