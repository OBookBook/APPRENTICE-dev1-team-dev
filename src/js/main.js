import { Calendar } from "./calendar.js";
// import { changeStatus } from "./changeStatus.js";
import { createNewTask } from "./createNewTask.js";
import { deleteTask } from "./deleteTask.js";

// let checkboxes = document.querySelectorAll(".checkbox");

const cal = new Calendar();
cal.createCalendar();
cal.setDateClickEvent();
cal.PrevMonth();
cal.NextMonth();
cal.showTodaysContents();
// createNewTask();
// deleteTask();
