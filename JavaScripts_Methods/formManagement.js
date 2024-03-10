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

    function deleteClient(clientId) {
        // Aquí debes enviar una solicitud al servidor para eliminar el cliente con el ID proporcionado
        // Puedes usar AJAX para enviar la solicitud al servidor
        // En este ejemplo, se muestra un mensaje en la consola
        console.log("Solicitud para eliminar el cliente con ID: " + clientId);

        // Puedes realizar la solicitud AJAX aquí para eliminar el cliente en el servidor
        // Ejemplo con Fetch API:
        fetch('clientes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'delete=' + encodeURIComponent(clientId),
        })
        .then(response => response.text())
        .then(data => {
            console.log('Éxito:', data);
            // Realizar cualquier otra acción necesaria después de la eliminación
            // Puedes recargar la página o actualizar la tabla de clientes, por ejemplo
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
});