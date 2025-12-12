<?php

$logFile = __DIR__ . "/../logs/app.log";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $taskId = isset($_POST['id']) ? trim($_POST['id']) : '';
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $task = isset($_POST["task"]) ? trim($_POST["task"]) : '';
    $duration = isset($_POST["duration"]) ? trim($_POST["duration"]) : '';
    $starting_time = isset($_POST["starting_time"]) && trim($_POST["starting_time"]) !== ''
        ? trim($_POST["starting_time"])
        : null;
    $task_date = isset($_POST["task_date"]) ? trim($_POST["task_date"]) : '';
    $isEveryday = isset($_POST['isEveryday']) ? 1 : 0;
    $status = isset($_POST["status"]) ? trim($_POST["status"]) : '';

    if(empty($taskId) || !ctype_digit($taskId)){
        error_log("Update failed: Id is empty or not number. id=$taskId\n", 3, $logFile);
        header("Location: ../calendar.php?error=empty_task_id");
        exit;
    }
    $taskId = (int)$taskId;

    if(empty($task_date)){
        $task_date = date("Y-m-d");
    }
    if(empty($status)){
        $status = "open";
    }

    require_once "inputvalidate.inc.php";
    $validationResult = validate($username, $task, $duration, $starting_time, $task_date, $status);
    if($validationResult !== true){
        error_log("Update failed: $validationResult\n", 3, $logFile);
        header("Location: ../calendar.php?error=$validationResult");
        exit;
    }

    try {
        require_once "dbh.inc.php";

        $sql_user = "SELECT id FROM users WHERE username = ?;";
        $stmt_user = $pdo->prepare($sql_user);
        $stmt_user->execute([$username]);
        $result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
        if(!$result_user){
            error_log("Update failed: No user found with username=$username\n", 3, $logFile);
            header("Location: ../calendar.php?error=invalid_user");
            exit;
        } else {
            $user_id = $result_user["id"];
        }

        $sql_update_task = "UPDATE tasks SET user_id = ?, task = ?, duration = ?, start = ?, task_date = ?, is_everyday = ?, status = ? WHERE tasks.id = ?;";
        $stmt_update_task = $pdo->prepare($sql_update_task);
        $stmt_update_task->execute([$user_id, $task, $duration, $starting_time, $task_date, $isEveryday, $status, $taskId]);

        if ($stmt_update_task->rowCount() === 0) {
            error_log("Update failed: No rows updated for task id=$taskId\n", 3, $logFile);
            header("Location: ../calendar.php?warning=no_changes");
        } else {
            header("Location: ../calendar.php?task=update");
        }
        exit;
        

    } catch (PDOException $e) {
        error_log("Database error during update (id=$taskId): " . $e->getMessage() . "\n", 3, $logFile);
        header("Location: ../calendar.php?error=server_error");
        exit;
    }


} else {
    error_log("Update request failed: Request method was not POST\n", 3,  $logFile);
    header("Location: ../calendar.php?error=invalid_request");
    exit;
}