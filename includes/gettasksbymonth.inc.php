<?php

try {
    require_once "dbh.inc.php";

    $year = 2025;
    $month = 12;
    $monthTasks = "tasks.task_date BETWEEN '" . $year . "-" . $month . "-1' AND '" . $year . "-" . $month . "-" . date("t", strtotime($year . "-" . $month . "-" . 1)) . "'";
    $sql_select_tasks = "SELECT 
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
    echo "connection failed: " . $e->getMessage();
}


        // require_once "includes/gettasksbymonth.inc.php";

        // $dbData = $result_select_tasks;

        // foreach ($dbData as $data){
        //     echo "<div>";
        //     foreach($data as $key=>$value){
        //         echo "<span>";
        //         echo $key . ": " . $value . " | ";
        //         echo "</span>";
        //     }
        //     echo "</div>";
        // }
