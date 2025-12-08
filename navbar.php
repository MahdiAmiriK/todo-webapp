<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">ToDoWebApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $currentPage === 'addtask' ? 'active' : '' ?>" href="addtask.php">Add a Task</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage === 'calendar' ? 'active' : '' ?>" href="calendar.php">Calendar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>