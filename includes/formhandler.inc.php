<?php

$logFile = __DIR__ . "/../logs/app.log";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $task = isset($_POST["task"]) ? trim($_POST["task"]) : '';
    $duration = isset($_POST["duration"]) ? trim($_POST["duration"]) : '';
    $starting_time = isset($_POST["starting_time"]) && trim($_POST["starting_time"]) !== ''
        ? trim($_POST["starting_time"])
        : null;
    $task_date = isset($_POST["task_date"]) ? trim($_POST["task_date"]) : '';
    $isEveryday = isset($_POST['isEveryday']) ? 1 : 0;
    $status = isset($_POST["status"]) ? trim($_POST["status"]) : '';

    if(empty($task_date)){
        $task_date = date("Y-m-d");
    }
    if(empty($status)){
        $status = "open";
    }

    require_once "inputvalidate.inc.php";
    $validationResult = validate($username, $task, $duration, $starting_time, $task_date, $status);
    if($validationResult !== true){
        error_log("Add task failed: $validationResult\n", 3, $logFile);
        header("Location: ../calendar.php?error=$validationResult");
        exit;
    }


    try {
        require_once "dbh.inc.php";

        $sql_user = "SELECT id FROM users WHERE username = ?;";
        $stmt_user = $pdo->prepare($sql_user);
        $stmt_user->execute([$username]);
        $result = $stmt_user->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            die("User not found");
        } else {
            $user_id = $result["id"];
        }

        $sql_insert_task = "INSERT INTO tasks (user_id, task, duration, start, task_date, is_everyday, status) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt_insert_task = $pdo->prepare($sql_insert_task);
        $stmt_insert_task->execute([$user_id, $task, $duration, $starting_time, $task_date, $isEveryday, $status]);

        header("Location: ../calendar.php?task=success");
        exit;
        
    } catch (Exception $e) {
        error_log("Database error during adding task: " . $e->getMessage() . "\n", 3, $logFile);
        header("Location: ../calendar.php?error=server_error");
        exit;
    }

} else {
    error_log("Add task request failed: Request method was not POST\n", 3,  $logFile);
    header("Location: ../calendar.php?error=invalid_request");
    exit;
}
