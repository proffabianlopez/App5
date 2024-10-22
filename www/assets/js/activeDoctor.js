document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones con la clase 'btn-activate'
    let activateButtons = document.querySelectorAll('.btn-activate');

    // Añadir un evento click a cada botón
    activateButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener el ID del usuario desde el atributo data-id
            let doctorId = this.getAttribute('data-id');

            // Crear una solicitud AJAX usando fetch
            fetch('/app/controllers/activeDoctor.php', {  
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Tipo de datos que estamos enviando
                },
                body: 'id=' + encodeURIComponent(doctorId) // Enviar el ID del usuario en el cuerpo de la solicitud
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('messaje').innerText = data;
            })
            .catch(error => {
                document.getElementById('messaje').innerText = error;
            });
        });
    });
});
