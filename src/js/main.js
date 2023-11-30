import { changeStatus } from './changeStatus.js';
import { Calendar } from './calendar.js';

changeStatus();

const cal = new Calendar();
cal.createCalendar();
cal.setDateClickEvent();
cal.PrevMonth();
cal.NextMonth();
