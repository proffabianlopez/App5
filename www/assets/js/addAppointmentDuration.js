document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#appointmentForm');
    let submitButton = form.querySelector('#submitButton');
    
    // Añadir un evento click al botón de enviar
    submitButton.addEventListener('click', function(event) {
        // Evitar el comportamiento predeterminado
        event.preventDefault();
        
        // Obtener el valor de la duración ingresada
        let duration = document.querySelector('#durationInput').value;

        // Verificar que se ha ingresado una duración válida
        if (duration === '' || isNaN(duration) || duration < 10 || duration > 60) {
            document.querySelector('#messaje').innerText = 'Por favor ingrese una duración válida entre 10 y 60 minutos.';
            return;
        }

        // Crear una solicitud AJAX usando fetch
        fetch('../../controllers/addAppoinmentDuration.php', {  
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'duracion=' + encodeURIComponent(duration)
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector('#messaje').innerText = data;
        })
        .catch(error => {
            document.querySelector('#messaje').innerText = 'Error: ' + error;
        });
    });
});
