<?php

function validate($username, $task, $duration, $task_start_time, $task_date, $status){
        if (filter_var($duration, FILTER_VALIDATE_INT) === false || (int)$duration <= 0) {
        return "duration_invalid";
    } 

    if($username === "" || $task === ""){
        return "empty_required_field";
    }
    if(strlen($task) > 255){
        return "long_task_text";

    }
    if ($task_start_time !== '' && (
        strlen($task_start_time) !== 5 ||          
        $task_start_time[2] !== ':' ||                                  
        (int)substr($task_start_time, 0, 2) < 0 ||              
        (int)substr($task_start_time, 0, 2) > 23 ||              
        (int)substr($task_start_time, 3, 2) < 0 ||               
        (int)substr($task_start_time, 3, 2) > 59                 
    )) {
        return "invalid_start_time";
    }
    if (empty($task_date) ||
        strlen($task_date) !== 10 ||          
        $task_date[4] !== '-' ||              
        $task_date[7] !== '-' ||               
        !ctype_digit(substr($task_date, 0, 4)) ||  
        !ctype_digit(substr($task_date, 5, 2)) ||  
        !ctype_digit(substr($task_date, 8, 2))     
    ) {
        return "invalid_date";
    }
    if (!in_array($status, ["open", "in_progress", "done"], true)) {
        return "invalid_status";
    }
    return true;
}




//     if (filter_var($duration, FILTER_VALIDATE_INT) === false || (int)$duration <= 0) {
//         error_log("Update failed: invalid duration value. duration=$duration\n", 3, $logFile);
//         header("Location: ../calendar.php?error=duration_invalid");
//         exit;
//     } else {
//         $duration = (int)$duration;
//     }
//     if($username == "" || $task == ""){
//         error_log("Update failed: Mandatory field is empty. username=$username, task=$task, duration=$duration\n", 3, $logFile);
//         header("Location: ../calendar.php?error=empty_required_field");
//         exit;
//     }
//     if(strlen($task) > 255){
//         error_log("Update failed: Too long task.\n", 3, $logFile);
//         header("Location: ../calendar.php?error=long_task");
//         exit;
//     }
//     if (empty($task_date) ||
//         strlen($task_date) !== 10 ||          
//         $task_date[4] !== '-' ||              
//         $task_date[7] !== '-' ||               
//         !ctype_digit(substr($task_date, 0, 4)) ||  
//         !ctype_digit(substr($task_date, 5, 2)) ||  
//         !ctype_digit(substr($task_date, 8, 2))     
//     ) {
//     error_log("Update failed: Empty or invalid date format. task_date=$task_date\n", 3, $logFile);
//     header("Location: ../calendar.php?error=invalid_date");
//     exit;
// }
//     if(empty($status)){
//         error_log("Update failed: Empty status.\n", 3, $logFile);
//         header("Location: ../calendar.php?error=empty_status");
//         exit;
//     } else if (!in_array($status, ["open", "in_progress", "done"], true)) {
//         error_log("Update failed: Invalid status. status=$status\n", 3, $logFile);
//         header("Location: ../calendar.php?error=invalid_status");
//         exit;
//     }
