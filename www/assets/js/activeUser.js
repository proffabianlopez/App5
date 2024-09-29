document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones con la clase 'btn-activate'
    var activateButtons = document.querySelectorAll('.btn-activate');

    // Añadir un evento click a cada botón
    activateButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener el ID del usuario desde el atributo data-id
            var userId = this.getAttribute('data-id');

            // Crear una solicitud AJAX usando fetch
            fetch('/app/controllers/activeUser.php', {  // Cambiar la ruta aquí a 'activeUser.php'
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Tipo de datos que estamos enviando
                },
                body: 'id=' + encodeURIComponent(userId) // Enviar el ID del usuario en el cuerpo de la solicitud
            })
            .then(response => response.text())
            .then(data => {
                // Mostrar el mensaje del servidor
                document.getElementById('messaje').innerHTML = '<div class="alert alert-success">' + data + '</div>';
            })
            .catch(error => {
                // Manejar cualquier error en la solicitud
                document.getElementById('messaje').innerHTML = '<div class="alert alert-danger">Error al activar el usuario.</div>';
            });
        });
    });
});
