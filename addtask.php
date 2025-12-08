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
    
    <?php 
        $currentPage = 'addtask';
        include "navbar.php" 
    ?>

    <section class="custom_container">
        <form action="includes/formhandler.inc.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <select class="form-select form-select-sm form-control" id="username" name="username" required>
                    <option selected>Select your name</option>
                    <option value="vahid">Vahid</option>
                    <option value="mahdi">Mahdi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="task" class="form-label">Task</label>
                <input type="text" class="form-control form-control-sm" id="task" placeholder="Your Task" name="task" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="number" class="form-control form-control-sm" id="duration" placeholder="Duration in Minutes" name="duration" required>
            </div>
            <div class="mb-3">
                <label for="task_date">Date</label>
                <input type="date" id="task_date" name="task_date">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="check_everyday" name="isEveryday">
                <label class="form-check-label" for="check_everyday">Everyday</label>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select form-select-sm form-control" id="status" name="status">
                    <option value="" selected>Select status</option>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </section>
</body>
</html>