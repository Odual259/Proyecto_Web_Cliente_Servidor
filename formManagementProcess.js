document.addEventListener("DOMContentLoaded", function () {
    const insertFormContainer = document.getElementById("insert-form-container");
    const processForm = document.getElementById("process-form");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const overlay = document.getElementById("overlay");
    const addProcessBtn = document.getElementById("add-process-btn");

    addProcessBtn.addEventListener("click", function () {
        insertFormContainer.style.display = "block";
        processForm.style.display = "block";
        document.body.classList.add("show-form");
        overlay.style.display = "block";
        document.getElementById("process-form").reset();
    });

    // Ocultar el formulario al hacer clic en el botón "Cancelar"
    cancelBtn.addEventListener("click", function () {
        insertFormContainer.style.display = "none";
        document.body.classList.remove("show-form");
        overlay.style.display = "none";
    });

    // Lógica para eliminar al hacer clic en el botón "Eliminar"
    document.querySelectorAll(".delete-btn").forEach(function (deleteBtn) {
        deleteBtn.addEventListener("click", function (event) {
            event.preventDefault(); // Evitar la navegación por el enlace
            const processId = this.getAttribute("data-id");
            const confirmDelete = confirm("¿Estás seguro de que deseas eliminar este proceso?");
            if (confirmDelete) {
                deleteProcess(processId);
            }
        });
    });

// Lógica para editar al hacer clic en el botón "Editar"
document.querySelectorAll(".edit-btn").forEach(function (editBtn) {
    editBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Evitar la navegación por el enlace
        const processId = this.getAttribute("data-id");
        // Aquí puedes usar AJAX para obtener los datos del proceso con el ID específico
        // y luego llenar el formulario de edición con esos datos
        // Luego, muestra el formulario de edición con los datos precargados
        // y permite al usuario realizar ediciones
        // Puedes hacer esto utilizando fetch o XMLHttpRequest
        // Por ejemplo:
        fetch('getProcess.php?id=' + encodeURIComponent(processId))
            .then(response => response.json())
            .then(data => {
                // Llenar el formulario con los datos del proceso obtenidos
                document.getElementById("process-id").value = processId;
                document.getElementById("process").value = data.Process;
                document.getElementById("clientName").value = data.ID_Client;
                document.getElementById("entityName").value = data.ID_Entity;
                document.getElementById("cluster").value = data.ID_Cluster;
                document.getElementById("country").value = data.ID_Country;
                document.getElementById("area").value = data.ID_Area;
                document.getElementById("category").value = data.ID_Category;
                document.getElementById("periodicity").value = data.ID_Periodicity;
                document.getElementById("approver").value = data.ID_User_Approver;
                document.getElementById("analyst").value = data.ID_User_Analyst;
                document.getElementById("period").value = data.Period;
                document.getElementById("year").value = data.Year;
                document.getElementById("dueDate").value = data.Due_date;
                document.getElementById("finalStatus").value = data.Final_Status;
                // Mostrar el formulario de edición
                insertFormContainer.style.display = "block";
                document.body.classList.add("show-form");
                overlay.style.display = "block";
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
});

    // Función para eliminar un proceso
    function deleteProcess(processId) {
        fetch('processes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'delete=' + encodeURIComponent(processId),
        })
        .then(response => response.text())
        .then(data => {
            console.log('Éxito:', data);
            location.reload(); // Recargar la página después de eliminar el proceso
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
});