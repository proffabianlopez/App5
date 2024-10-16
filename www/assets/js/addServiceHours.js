document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#serviceForm');
    let submitButton = form.querySelector('#submitButton');
    
    // Añadir un evento click al botón de enviar
    submitButton.addEventListener('click', function(event) {
        // Evitar el comportamiento predeterminado
        event.preventDefault();
        
        // Obtener los valores de inicio y final de horario
        let desde = form.querySelector('#desde').value;
        let hasta = form.querySelector('#hasta').value; 

        // Verificar si los campos están vacíos (por si acaso)
        if (!desde || !hasta) {
            document.querySelector('#messaje').innerText = 'Por favor, complete ambos campos de horario.';
            return;
        }

        // Convertir las horas y minutos a formato [horas, minutos]
        let [desdeHoras, desdeMinutos] = desde.split(':').map(Number);
        let [hastaHoras, hastaMinutos] = hasta.split(':').map(Number);

        // Crear minutos totales para comparar horas
        let desdeTotalMinutos = (desdeHoras * 60) + desdeMinutos;
        let hastaTotalMinutos = (hastaHoras * 60) + hastaMinutos;

        // Validar si la hora de inicio y fin son iguales
        if (desdeTotalMinutos === hastaTotalMinutos) {
            document.querySelector('#messaje').innerText = 'La hora de inicio no puede ser igual a la hora de fin.';
            return;
        }

        // Validar que la hora de inicio sea menor que la hora de fin
        if (desdeTotalMinutos > hastaTotalMinutos) {
            document.querySelector('#messaje').innerText = 'La hora de inicio debe ser menor que la hora de fin.';
            return;
        }

        // Validar que la franja horaria no supere las 8 horas (480 minutos)
        let diffMinutos = hastaTotalMinutos - desdeTotalMinutos;
        if (diffMinutos > 480) {
            document.querySelector('#messaje').innerText = 'La franja horaria no puede ser mayor a 8 horas.';
            return;
        }

        // Si todo está bien, crear una solicitud AJAX usando fetch
        let formData = new URLSearchParams(new FormData(form)).toString();

        fetch('../../controllers/addServiceHours.php', {  
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
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
