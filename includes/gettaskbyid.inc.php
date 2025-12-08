<?php

try {
    require_once "dbh.inc.php";

    $sql_select_task = "SELECT 
                            tasks.id,
                            users.username, 
                            tasks.task, 
                            tasks.duration, 
                            tasks.task_date, 
                            tasks.is_everyday, 
                            tasks.status 
                        FROM tasks 
                        LEFT JOIN users ON users.id = tasks.user_id 
                        WHERE tasks.id = $id;";
    $stmt_select_task = $pdo->prepare($sql_select_task);
    $stmt_select_task->execute();
    $result_select_task = $stmt_select_task->fetch(PDO::FETCH_ASSOC);
   
} catch (Exception $e) {
    error_log("Database error during getting task by id: " . $e->getMessage() . "\n", 3, $logFile);
    header("Location: ../calendar.php?error=server_error");
    exit;
}


