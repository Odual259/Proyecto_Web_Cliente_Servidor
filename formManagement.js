document.addEventListener("DOMContentLoaded", function () {
    const insertFormContainer = document.getElementById("insert-form-container");
    const clientForm = document.getElementById("client-form");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
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
            event.preventDefault();
    
            const clientId = this.getAttribute("data-id");
            const confirmDelete = confirm("¿Estás seguro de que deseas eliminar este cliente?");
    
            if (confirmDelete) {
                deleteClient(clientId);
            }
        });
    });

    // Lógica para editar al hacer clic en el botón "Editar"
    document.querySelectorAll(".edit-btn").forEach(function (editBtn) {
        editBtn.addEventListener("click", function (event) {
            event.preventDefault();
    
            const clientId = this.getAttribute("data-id");
            document.getElementById("client-id").value = clientId; // Asignar el ID del cliente al campo oculto    
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