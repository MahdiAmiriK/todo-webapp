<?php

$logFile = __DIR__ . "/../logs/app.log";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = trim($_POST["deleteBtn"]);
    
    if(empty($id) || !ctype_digit($id)){
        error_log("Delete failed: invalid id received. Value: $id\n", 3,  $logFile);
        header("Location: ../calendar.php?error=invalid_id");
        exit;
    }

    try {
        require_once "dbh.inc.php";

        $sql_delete_task = "DELETE FROM tasks WHERE id=?;";
        $stmt_delete_task = $pdo->prepare($sql_delete_task);
        $stmt_delete_task->execute([$id]);
        
        if($stmt_delete_task->rowCount() == 0){
            error_log("Delete failed: no task found with id=$id\n", 3,  $logFile);
            header("Location: ../calendar.php?error=task_not_found");
            exit;
        }
        header("Location: ../calendar.php?task=delete_success");
        exit;

    } catch (Exception $e) {
        error_log(
            "Database error during deletion (id=$id): " . $e->getMessage() . "\n",
            3,
             $logFile
        );

        header("Location: ../calendar.php?error=server_error");
        exit;
    }


} else {
    error_log("Delete request failed: Request method was not POST\n", 3,  $logFile);
    header("Location: ../calendar.php?error=invalid_request");
    exit;

}



