<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar</title> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
