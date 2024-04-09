document.addEventListener("DOMContentLoaded", function () {
    const insertFormContainer = document.getElementById("insert-form-container");
    const clientForm = document.getElementById("client-form");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const clientIdInput = document.getElementById("client-id");
    const clientNameInput = document.getElementById("client-name");
    const complexityInput = document.getElementById("complexity");
    const engagementInput = document.getElementById("engagement");
    const clientStatusInput = document.getElementById("client-status");
    const addClientBtn = document.getElementById("add-client-btn");
    const overlay = document.getElementById("overlay");

    addClientBtn.addEventListener("click", function () {
        // Mostrar el formulario al hacer clic en el botón "Agregar Cliente"
        insertFormContainer.style.display = "block";
        clientForm.style.display = "block";
        document.body.classList.add("show-form");
        overlay.style.display = "block";
        document.getElementById("client-form").reset();
    });

    cancelBtn.addEventListener("click", function () {
        // Ocultar el formulario al hacer clic en el botón "Cancelar"
        insertFormContainer.style.display = "none";
        document.body.classList.remove("show-form");
        overlay.style.display = "none";
    });

    // Lógica para eliminar al hacer clic en el botón "Eliminar"
    document.querySelectorAll(".delete-btn").forEach(function (deleteBtn) {
        deleteBtn.addEventListener("click", function (event) {
            event.preventDefault(); // Evitar la navegación por el enlace
    
            const clientId = this.getAttribute("data-id");
            const confirmDelete = confirm("¿Estás seguro de que deseas eliminar este cliente?");
    
            if (confirmDelete) {
                // Si el usuario confirma la eliminación, enviar una solicitud al servidor para eliminar el cliente
                deleteClient(clientId);
            }
        });
    });

    // Lógica para editar al hacer clic en el botón "Editar"
    document.querySelectorAll(".edit-btn").forEach(function (editBtn) {
        editBtn.addEventListener("click", function (event) {
            event.preventDefault(); // Evitar la navegación por el enlace
    
            const clientId = this.getAttribute("data-id");
            document.getElementById("client-id").value = clientId; // Asignar el ID del cliente al campo oculto    
            
            // Aquí puedes usar AJAX para obtener los datos del cliente con el ID específico
            // y luego llenar el formulario de edición con esos datos
            // Luego, muestra el formulario de edición con los datos precargados
            // y permite al usuario realizar ediciones
            // Puedes hacer esto utilizando fetch o XMLHttpRequest
            // Por ejemplo:
            fetch('getClient.php?id=' + encodeURIComponent(clientId))
            .then(response => response.json())
            .then(data => {
                // Llenar el formulario con los datos del cliente obtenidos
                document.getElementById("client-name").value = data.Client_Name;
                document.getElementById("complexity").value = data.Complexity;
                document.getElementById("engagement").value = data.Engagement;
                document.getElementById("client-status").value = data.Client_Status;
    
                // Mostrar el formulario de edición
                document.getElementById("insert-form-container").style.display = "block";
                document.getElementById("client-form").style.display = "block";
                document.body.classList.add("show-form");
                document.getElementById("overlay").style.display = "block";
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    });

    function deleteClient(clientId) {
        fetch('clients.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'delete=' + encodeURIComponent(clientId),
        })
        .then(response => response.text())
        .then(data => {
            console.log('Éxito:', data);
            location.reload();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    
});

document.addEventListener("DOMContentLoaded", function () {
    const insertFormContainer = document.getElementById("insert-form-container");
    const processForm = document.getElementById("process-form");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const overlay = document.getElementById("overlay");

    // Mostrar el formulario al hacer clic en el botón "Add Process"
    document.getElementById("add-client-btn").addEventListener("click", function () {
        insertFormContainer.style.display = "block";
        processForm.reset();
        document.body.classList.add("show-form");
        overlay.style.display = "block";
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
                    document.getElementById("processName").value = data.Process;
                    document.querySelector('select[name="cliente"]').value = data.ID_Client;
                    document.querySelector('select[name="entity"]').value = data.ID_Entity;
                    document.querySelector('select[name="cluster"]').value = data.ID_Cluster;
                    document.querySelector('select[name="country"]').value = data.ID_Country;
                    document.querySelector('select[name="area"]').value = data.ID_Area;
                    document.querySelector('select[name="category"]').value = data.ID_Category;
                    document.querySelector('select[name="periodicity"]').value = data.ID_Periodicity;
                    document.querySelector('select[name="approver"]').value = data.ID_User_Approver;
                    document.querySelector('select[name="analyst"]').value = data.ID_User_Analyst;
                    document.querySelector('select[name="period"]').value = data.Period;
                    document.querySelector('select[name="year"]').value = data.Year;
                    document.querySelector('select[name="processStatus"]').value = data.Process_Status;
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

    // Esperar a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionar el formulario por su ID
        var form = document.getElementById('process-form');

        // Agregar un evento de escucha para el evento "submit" del formulario
        form.addEventListener('submit', function (event) {
            // Detener el envío del formulario predeterminado
            event.preventDefault();

            // Obtener los valores de los campos del formulario
            var formData = new FormData(form);

            // Enviar los datos del formulario al backend utilizando fetch
            fetch('processes.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del backend
                console.log(data);
                // Por ejemplo, mostrar un mensaje de éxito o redireccionar a otra página
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    });
});

