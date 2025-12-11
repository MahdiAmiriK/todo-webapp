<?php

$id = $_GET["id"];

require_once "includes/gettaskbyid.inc.php";

$dataToEdit = $result_select_task;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>ToDo/Add</title>
</head>
<body>
    <?php include "navbar.php" ?>

    <section class="custom_container">
        <form action="includes/updatetask.inc.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($dataToEdit['id']) ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <select class="form-select form-select-sm form-control" id="username" name="username" required>
                    <option value="vahid" <?php if(strtolower($dataToEdit['username']) == "vahid") echo "selected";?>>Vahid</option>
                    <option value="mahdi" <?php if(strtolower($dataToEdit['username']) == "mahdi") echo "selected";?>>Mahdi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="task" class="form-label">Task</label>
                <input type="text" class="form-control form-control-sm" id="task" placeholder="Your Task" name="task" 
                value="<?php echo htmlspecialchars($dataToEdit['task']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="starting_time" class="form-label">Starting Time</label>
                <input type="time" class="form-control form-control-sm" id="starting_time" placeholder="Starting Time" name="starting_time" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="number" class="form-control form-control-sm" id="duration" placeholder="Duration in Minutes" name="duration" 
                value="<?php echo htmlspecialchars($dataToEdit['duration']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="task_date">Date</label>
                <input type="date" id="task_date" name="task_date" value="<?php echo htmlspecialchars($dataToEdit['task_date']) ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="check_everyday" name="isEveryday" <?php if ($dataToEdit['is_everyday'] == 1) echo "checked"; ?>>
                <label class="form-check-label" for="check_everyday">Everyday</label>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select form-select-sm form-control" id="status" name="status">
                    <option value="open" <?php if ($dataToEdit['status'] == "open") echo "selected"; ?>>Open</option>
                    <option value="in_progress" <?php if ($dataToEdit['status'] == "in_progress") echo "selected"; ?>>In Progress</option>
                    <option value="done" <?php if ($dataToEdit['status'] == "done") echo "selected"; ?>>Done</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>            
        </form>

        <form class="deleteBtnForm" action="includes/deletetask.inc.php" method="post">
                <input type="hidden" name="deleteBtn" value="<?php echo htmlspecialchars($dataToEdit['id']) ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </section>
</body>
</html>



 