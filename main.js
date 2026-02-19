const popup_form = document.getElementById("popup_form");
const form_date = document.getElementById("task_date");
const start_date = document.getElementById("start_date");
const single_task = document.getElementById("single-task");
const multitime_task = document.getElementById("multitime-task");
const btn_multitime_task = document.getElementById("btn_multitime_task");
const btn_singletime_task = document.getElementById("btn_singletime_task");
let day, month, year;

function show_popup_form(d, m, y) {
  if (d <= 9) {
    d = "0" + d;
  }

  day = d;
  month = m;
  year = y;
  popup_form.style.display = "block";
  popup_form.classList.add("show");
  form_date.value = year + "-" + month + "-" + day;
}
function close_popup() {
  popup_form.classList.remove("show");
  popup_form.style.display = "none";
}

function show_singletime_task() {
  single_task.style.display = "block";
  multitime_task.style.display = "none";
  form_date.value = year + "-" + month + "-" + day;
  start_date.value = "";
  btn_singletime_task.classList.add("active");
  btn_multitime_task.classList.remove("active");
}

function show_multitime_task() {
  single_task.style.display = "none";
  multitime_task.style.display = "block";
  form_date.value = "";
  start_date.value = year + "-" + month + "-" + day;
  btn_multitime_task.classList.add("active");
  btn_singletime_task.classList.remove("active");
}
