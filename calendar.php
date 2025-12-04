<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>ToDo/Tasks</title>
</head>
<body>
    <?php include "navbar.php" ?>

    <div class="cal_container p-3 bg-light rounded shadow">
        <p><?php echo date("F"); ?></p>
        <div class="calendar table-responsive">
            <table class="table table-bordered table-sm text-center align-middle w-100">
                <thead class="table-primary">
                    <tr>
                    <th scope="col" class="fw-bold">Monday</th>
                    <th scope="col" class="fw-bold">Tuesday</th>
                    <th scope="col" class="fw-bold">Wednesday</th>
                    <th scope="col" class="fw-bold">Thursday</th>
                    <th scope="col" class="fw-bold">Friday</th>
                    <th scope="col" class="fw-bold">Saturday</th>
                    <th scope="col" class="fw-bold">Sunday</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $year = date("Y");
                        $month = date("m");
                        $day = 1;
                        $bool = true;
                        $daysInMonth = date("t", strtotime($year . "-" . $month . "-" . 1));
                        $firstWeekDay = date("N", strtotime($year . "-" . $month . "-" . 1));
                        $counter = $firstWeekDay;

                        require_once "includes/monthtasks.inc.php";
                        // var_dump($dataArray[12][0]["task"]);
                        while($day <= $daysInMonth){
                            echo "<tr>";
                            if($bool){
                                for($i = 1 ; $i < $firstWeekDay ; $i++){
                                    echo "<td></td>";
                                }
                                $bool = false;
                            }
                            for ($i = $counter ; $i <= 7 ; $i++){
                                if($day <= $daysInMonth){
                                    if($day == date("j")){
                                        echo "<td class='bg-warning fw-bold'>" . $day . "<br>";
                                    } else {
                                        echo "<td>" . $day . "<br>"; 
                                    }
                                    if(!empty($dataArray[$day])){
                                        foreach($dataArray[$day] as $dataSubArray){
                                            echo "<div class='card'>";
                                                    echo "<h5 class='card-title'>";
                                                        echo  htmlspecialchars($dataSubArray["task"]);
                                                    echo "</h5>";
                                                    echo "<p>";
                                                        echo htmlspecialchars($dataSubArray["duration"]) . " min | " 
                                                        . htmlspecialchars($dataSubArray["username"]) . " | " 
                                                        . htmlspecialchars($dataSubArray["status"]);
                                                    echo "</p>";
                                            echo "</div>";
                                        }
                                    }
                                    echo"</td>";
                                    $day++; 
                                } else {
                                    echo "<td></td>";
                                }
                            }
                            $counter = 1;

                            echo "</tr>";
                        }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>



