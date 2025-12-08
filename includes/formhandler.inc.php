<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $task = trim($_POST["task"]);
    $duration = $_POST["duration"];
    $task_date = $_POST["task_date"];
    $isEveryday = isset($_POST["isEveryday"]) ? 1 : 0;
    $status = $_POST["status"];

    if($username == "" || $task == "" || $duration <=0){
        error_log("Validating error: username='$username', task='$task', duration='$duration'", 3, "../logs/app.log");
        header("Location: ../addtask.php?error=invalid_input");
        exit;
    }
    if(empty($task_date)){
        $task_date = date("Y-m-d");
    }
    if(empty($status)){
        $status = "open";
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

        $sql_insert_task = "INSERT INTO tasks (user_id, task, duration, task_date, is_everyday, status) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt_insert_task = $pdo->prepare($sql_insert_task);
        $stmt_insert_task->execute([$user_id, $task, $duration, $task_date, $isEveryday, $status]);

        header("Location: ../calendar.php?task=success");
        exit;
        
    } catch (Exception $e) {
        error_log("Database error during adding task: " . $e->getMessage() . "\n", 3, $logFile);
    header("Location: ../calendar.php?error=server_error");
    exit;
    }

} else {
    echo "Request Method Problem";
}
