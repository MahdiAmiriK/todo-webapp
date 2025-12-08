<?php

$logFile = __DIR__ . "/../logs/app.log";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $taskId = isset($_POST['id']) ? trim($_POST['id']) : '';
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $task = isset($_POST["task"]) ? trim($_POST["task"]) : '';
    $duration = isset($_POST["duration"]) ? trim($_POST["duration"]) : '';
    $task_date = isset($_POST["task_date"]) ? trim($_POST["task_date"]) : '';
    $isEveryday = isset($_POST['isEveryday']) ? 1 : 0;
    $status = isset($_POST["status"]) ? trim($_POST["status"]) : '';

    if(empty($taskId) || !ctype_digit($taskId)){
        error_log("Update failed: Id is empty or not number. id=$taskId\n", 3, $logFile);
        header("Location: ../calendar.php?error=empty_task_id");
        exit;
    }
    $taskId = (int)$taskId;
    if (filter_var($duration, FILTER_VALIDATE_INT) === false || (int)$duration <= 0) {
        error_log("Update failed: invalid duration value. duration=$duration\n", 3, $logFile);
        header("Location: ../calendar.php?error=duration_invalid");
        exit;
    } else {
        $duration = (int)$duration;
    }
    if($username == "" || $task == ""){
        error_log("Update failed: Mandatory field is empty. username=$username, task=$task, duration=$duration\n", 3, $logFile);
        header("Location: ../calendar.php?error=empty_required_field");
        exit;
    }
    if(strlen($task) > 255){
        error_log("Update failed: Too long task.\n", 3, $logFile);
        header("Location: ../calendar.php?error=long_task");
        exit;
    }
    if (empty($task_date) ||
        strlen($task_date) !== 10 ||          
        $task_date[4] !== '-' ||              
        $task_date[7] !== '-' ||               
        !ctype_digit(substr($task_date, 0, 4)) ||  
        !ctype_digit(substr($task_date, 5, 2)) ||  
        !ctype_digit(substr($task_date, 8, 2))     
    ) {
    error_log("Update failed: Empty or invalid date format. task_date=$task_date\n", 3, $logFile);
    header("Location: ../calendar.php?error=invalid_date");
    exit;
}
    if(empty($status)){
        error_log("Update failed: Empty status.\n", 3, $logFile);
        header("Location: ../calendar.php?error=empty_status");
        exit;
    } else if (!in_array($status, ["open", "in_progress", "done"], true)) {
        error_log("Update failed: Invalid status. status=$status\n", 3, $logFile);
        header("Location: ../calendar.php?error=invalid_status");
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

        $sql_update_task = "UPDATE tasks SET user_id = ?, task = ?, duration = ?, task_date = ?, is_everyday = ?, status = ? WHERE tasks.id = ?;";
        $stmt_update_task = $pdo->prepare($sql_update_task);
        $stmt_update_task->execute([$user_id, $task, $duration, $task_date, $isEveryday, $status, $taskId]);

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