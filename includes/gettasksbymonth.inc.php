<?php

try {
    require_once "dbh.inc.php";

    $year = date("Y");
    $month = date("m");
    $monthTasks = "tasks.task_date BETWEEN '" . $year . "-" . $month . "-1' AND '" . $year . "-" . $month . "-" . date("t", strtotime($year . "-" . $month . "-" . 1)) . "'";
    $sql_select_tasks = "SELECT 
                            tasks.id,
                            users.username, 
                            tasks.task, 
                            tasks.duration, 
                            tasks.task_date, 
                            tasks.is_everyday, 
                            tasks.status 
                        FROM tasks 
                        LEFT JOIN users ON users.id = tasks.user_id 
                        WHERE $monthTasks;";
    $stmt_select_tasks = $pdo->prepare($sql_select_tasks);
    $stmt_select_tasks->execute();
    $result_select_tasks = $stmt_select_tasks->fetchAll(PDO::FETCH_ASSOC);
   
} catch (Exception $e) {
    error_log("Database error during getting task by month: " . $e->getMessage() . "\n", 3, $logFile);
    header("Location: ../calendar.php?error=server_error");
    exit;
}
