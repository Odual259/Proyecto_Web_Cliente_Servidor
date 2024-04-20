let date = new Date();
let dates = []; // Array para almacenar las fechas

function updateCalendar() {
  let monthYearLabel = document.getElementById("monthYearLabel");
  monthYearLabel.textContent = date.toLocaleString('en-US', { month: 'long', year: 'numeric' });

  let calendar = document.getElementById("calendar");
  // Clear the previous content of the calendar
  calendar.innerHTML = '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

  // Get the first day of the month
  let firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
  let startingDay = firstDay.getDay();

  // Get the number of days in the month
  let monthLength = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

  // Create the cells of the calendar
  let day = 1;
  for (let i = 0; i < 9; i++) {
    let row = document.createElement('tr');
    for (let j = 0; j < 7; j++) {
      if (i === 0 && j < startingDay || day > monthLength) {
        let cell = document.createElement('td');
        row.appendChild(cell);
      } else {
        let cell = document.createElement('td');
        cell.textContent = day;

        // Si el día coincide con alguna de las fechas en el array dates, resáltalo
        for (let k = 0; k < dates.length; k++) {
          if (day === dates[k].getDate() && date.getMonth() === dates[k].getMonth() && date.getFullYear() === dates[k].getFullYear()) {
            cell.classList.add('highlight-database-date');
            break; 
          }
        }
        if (day === date.getDate() && !cell.classList.contains('highlight-database-date')) {
          cell.classList.add('highlight');
        }
        row.appendChild(cell);
        day++;
      }
    }
    calendar.appendChild(row);
    if (day > monthLength) {
      break;
    }
  }
}

function previousMonth() {
  date.setMonth(date.getMonth() - 1);
  updateCalendar();
}

function nextMonth() {
  date.setMonth(date.getMonth() + 1);
  updateCalendar();
}

updateCalendar();