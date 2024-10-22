document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones con la clase 'btn-confirm'
    let activateButtons = document.querySelectorAll('.btn-confirm');

    // Añadir un evento click a cada botón
    activateButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener el ID del usuario desde el atributo data-id
            let id = this.getAttribute('data-id');

            // Crear una solicitud AJAX usando fetch
            fetch('/app/controllers/confirmAppointment.php', {  
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Tipo de datos que estamos enviando
                },
                body: 'id=' + encodeURIComponent(id) // Enviar el ID del usuario en el cuerpo de la solicitud
            })
            .then(response => response.text())
            .then(data => {
                document.querySelector('#messaje').innerText = data;

            })
            .catch(error => {
                document.querySelector('#messaje').innerText = error;

            });
        });
    });
});
