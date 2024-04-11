let date = new Date();

function updateCalendar() {
  let monthYearLabel = document.getElementById("monthYearLabel");
  monthYearLabel.textContent = date.toLocaleString('en-US', { month: 'long', year: 'numeric' });

  let calendar = document.getElementById("calendar");
 
  calendar.innerHTML = '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

  
  let firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
  let startingDay = firstDay.getDay();

  
  let monthLength = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

  
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
        if (day === date.getDate()) {
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