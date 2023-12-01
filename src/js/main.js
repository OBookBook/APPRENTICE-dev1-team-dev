import { Calendar } from "./calendar.js";
import { changeStatus } from "./changeStatus.js";
import { createNewTask } from "./createNewTask.js";
import { deleteTask } from "./deleteTask.js";

const cal = new Calendar();
cal.createCalendar();
cal.setDateClickEvent();
cal.PrevMonth();
cal.NextMonth();
createNewTask();
deleteTask();
changeStatus();
