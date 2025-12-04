<?php

try {
    require_once "gettasksbymonth.inc.php";
    
    $dbData = $result_select_tasks;
    $dataArray = [];

    foreach ($dbData as $data){
        $key = date("j", strtotime($data["task_date"]));
        if(!isset($dataArray[$key])){
            $dataArray[$key] = [];
        }
        $dataArray[$key][] = $data;
    }

   
} catch (Exception $e) {
    echo "connection failed: " . $e->getMessage();
}

