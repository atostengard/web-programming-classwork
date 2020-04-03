<?php
    require 'connection.php';
    
    if (!isset($_SESSION)) {
        session_start();       
    }
    
    $taskName = $_POST['taskToAdd'];
    $frequency = $_POST['frequency'];
    $dueDate = $_POST['date'];
    $listName = $_SESSION['listName'];
    $dateArray = date_parse($dueDate);
    $dueDate = $dateArray['year'] . '-' . $dateArray['month'] . '-' . $dateArray['day'];
    
    
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
    $listID = mysqli_query($connection, "SELECT list_id FROM LIST WHERE name = '$listName' AND user_id = '$userID'");
    if (!$listID) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
    $line = mysqli_fetch_array($listID, MYSQLI_ASSOC);
    $listID = $line['list_id'];
    $listID = mysqli_real_escape_string($connection, $listID);
    
    //get max task_id to find next ID available in sequence
    $maxTaskID = mysqli_query($connection, "SELECT MAX(task_id) FROM TASK WHERE user_id = '$userID';");
    $line = mysqli_fetch_array($maxTaskID, MYSQLI_ASSOC);
    $maxTaskID = $line['MAX(task_id)'];
    $maxTaskID = mysqli_real_escape_string($connection, $maxTaskID);
    $newTaskID = $maxTaskID + 1;
    
    $insertResult = mysqli_query($connection, "INSERT INTO TASK (user_id, list_id, task_id, frequency, set_id, name, dueDate) VALUES ('$userID', '$listID', '$newTaskID', '$frequency', 0, '$taskName', '$dueDate');");
    if (!$insertResult) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }
    
    //get tasks and reset session variables so tasks show up on page after redirect
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
