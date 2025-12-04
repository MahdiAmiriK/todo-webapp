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
            <h1 class='landingPageH1'>Welcome to ToDoWebApp</h1>
            <p class='slog'>Slogan</p>

        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <a href="calendar.php" class="btn btn-secondary btn-lg">Calendar</a>
            <a href="addtask.php" class="btn btn-secondary btn-lg">Add a Task</a>
        </div>  
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>