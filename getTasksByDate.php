<?php
    require 'connection.php';
    
    if (!isset($_SESSION)) {
        session_start();       
    }
    
    $sortDate = $_POST['sortDate'];
    //makes sure date is displayed in readable format where the list name goes
    $_SESSION['listName'] = $sortDate;
    $dateArray = date_parse($sortDate);
    $sortDate = $dateArray['year'] . '-' . $dateArray['month'] . '-' . $dateArray['day'];
    
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
    
    //get tasks
    $tasks = mysqli_query($connection, "SELECT name FROM TASK WHERE dueDate = '$sortDate' AND user_id = '$userID'");
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
