<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $taskId = $_POST["id"];
    $username = $_POST["username"];
    $task = $_POST["task"];
    $duration = $_POST["duration"];
    $task_date = $_POST["task_date"];
    $isEveryday = isset($_POST["isEveryday"]) ? 1 : 0;
    $status = $_POST["status"];

    if($taskId == ""){
        die("There is a problem with the id of these task.");
    }
    if($username == "" || $task == "" || $duration <=0){
        die("Please fill in all mandatory fields correctly.");
    }
    if(empty($task_date)){
        $task_date = date("Y-m-d");
    }
    if(empty($status)){
        $status = "open";
    }

    try {
        require_once "dbh.inc.php";

        $sql_check_task_id = "SELECT id FROM tasks WHERE id = ?;";
        $stmt_check_task_id = $pdo->prepare($sql_check_task_id);
        $stmt_check_task_id->execute([$taskId]);
        $result_check_task_id = $stmt_check_task_id->fetch(PDO::FETCH_ASSOC);
        if(!$result_check_task_id){
            die("There is no such an id.");
        }

        $sql_user = "SELECT id FROM users WHERE username = ?;";
        $stmt_user = $pdo->prepare($sql_user);
        $stmt_user->execute([$username]);
        $result = $stmt_user->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            die("User not found");
        } else {
            $user_id = $result["id"];
        }

        $sql_update_task = "UPDATE tasks SET user_id = ?, task = ?, duration = ?, task_date = ?, is_everyday = ?, status = ? WHERE tasks.id = ?;";
        $stmt_update_task = $pdo->prepare($sql_update_task);
        $stmt_update_task->execute([$user_id, $task, $duration, $task_date, $isEveryday, $status, $taskId]);

        header("Location: ../calendar.php?task=success");
        exit;

    } catch (Exception $e) {
        echo "connection failed: " . $e->getMessage();
    }


} else {
    echo "Request Method Problem";
}