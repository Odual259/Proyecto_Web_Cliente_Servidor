<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar</title> 
<link rel="stylesheet" type="text/css" href="Styles/calendar.css">
</head>

<body>
    
<header id="headerCalendar">
        <a href="index.php">
            <img id="logoCalendar" src="https://1000logos.net/wp-content/uploads/2023/03/KPMG-logo.png"
                alt="KDN Project Management Tool">
        </a>
        
        <div id="buttonsContainer">
        <button id="refreshCalendar">Refresh Calendar</button>
        <button id="addProcess">Add Procces</button>
    </div>
</header>

<div id="mainContainer">
 <div id="bodyCalendar">
    
 <h2 id="monthAndYear"><span onclick="previousMonth()">◀</span><span id="monthYearLabel"></span><span onclick="nextMonth()">▶</span></h2>

<table id="calendar">
  <tr>
    <th>Sun</th>
    <th>Mon</th>
    <th>Tue</th>
    <th>Wed</th>
    <th>Thu</th>
    <th>Fri</th>
    <th>Sat</th>
  </tr>
  
</table>
 </div>

 <div class="filter-section">
    <h2>Filters</h2>
    <form>
      <label for="client">Client:</label>
      <select id="client">
       
      </select>

      <label for="company">Company:</label>
      <select id="company">
       
      </select>

      <label for="process-name">Process Name:</label>
      <select id="process-name">
        
      </select>

      <label for="country">Country:</label>
      <select id="country">
        
      </select>
    </form>
  </div>
</div>

</body>
<script src="./js/calendar.js"></script>
</html>
