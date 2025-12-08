<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>ToDoWebApp</title>
</head>
<body>
    <?php include "navbar.php" ?>

    <div class="container-lg">
        <div class="landingPageHeading">
            <div class="landingPageInfo transbox">
                <h1 class='landingPageH1'>ToDo Web App</h1>
                 <p class='slog'>Your tasks won’t do themselves… unfortunately.</p>
            </div>

        </div>
        <div class="d-grid gap-3 col-md-4 col-sm-8 mx-auto mt-4">
            <a href="calendar.php" class="btn btn-outline-primary btn-lg shadow">Calendar</a>
            <a href="addtask.php" class="btn btn-outline-primary btn-lg shadow">Add a Task</a>
        </div>
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>