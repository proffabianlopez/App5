document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#form');
    let submitButton = form.querySelector('#submitButton');

    // Añadir un evento click al botón de enviar
    submitButton.addEventListener('click', function(event) {
        // Evitar el comportamiento predeterminado del formulario
        event.preventDefault();

        // Crear un objeto FormData para recoger los datos del formulario
        let formData = new FormData(form);

        // Convertir FormData a formato URL-encoded para el envío (opcional pero útil en algunos casos)
        let urlEncodedData = new URLSearchParams(formData).toString();

        // Crear una solicitud AJAX usando fetch
        fetch('../../controllers/manage-doctors.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: urlEncodedData // Enviar los datos del formulario
        })
        .then(response => response.text()) // Recibir la respuesta como texto
        .then(data => {
            // Mostrar el mensaje de respuesta en un elemento del DOM
            document.querySelector('#messaje').innerText = data;
        })
        .catch(error => {
            // Manejar errores en caso de fallo
            document.querySelector('#messaje').innerText = 'Error: ' + error;
        });
    });
});
