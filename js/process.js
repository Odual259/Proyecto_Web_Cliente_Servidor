$(document).ready(function () {
    loadProcess();

    function loadProcess() {
        $.ajax({
            url: "getData.php",
            method: "GET",
            success: function (data) {
                displayProcess(JSON.parse(data));
            }
        });
    }

    function displayProcess(processes) {
        $("#processList").empty();
        if(processes.length > 0){
            console.log(processes);
            processes.forEach(function (process) {
                const listItem = `
                <li><a class="dropdown-item" href="#"> Process: ${process.Process} Due_date: ${process.Due_date}</a></li>
                `;
                $("#processList").append(listItem);
            }); 
        }
    }

    $("#processList").on("click", ".dropdown-item", function () {
        $.ajax({
            url: "getData.php",
            method: "GET",
            success: function (data) {
                let dataArray = JSON.parse(data);
                if (Array.isArray(dataArray)) {
                    dates = [];
                    for (let i = 0; i < dataArray.length; i++) {
                        // Divide la cadena de fecha en partes
                        let dateParts = dataArray[i]['Due_date'].split("-");
                        // Crea un nuevo objeto Date a partir de las partes de la fecha
                        // los meses comienzan desde 0, se resta 1 al mes
                        dates.push(new Date(dateParts[0], dateParts[1] - 1, dateParts[2]));
                    }
                    updateCalendar();
                }
            }
        });
    });
    
});
