<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $task = $_POST["task"];
    $duration = $_POST["duration"];
    $task_date = $_POST["task_date"];
    $isEveryday = isset($_POST["isEveryday"]) ? 1 : 0;
    $status = $_POST["status"];

    if($username == "" || $task == "" || $duration <=0){
        die("Please fill in all mandatory fields correctly.");
    }
    if(empty($task_date)){
        $task_date = date("Y-m-d");
    }
    if(empty($status)){
        $status = "open";
    }

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

    header("Location: ../index.php?task=success");
    exit;

} else {
    echo "Request Method Problem";
}
