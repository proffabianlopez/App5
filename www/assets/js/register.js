document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#registerForm');
    let submitButton = form.querySelector('#submitButton');
    
    // Añadir un evento click al botón de enviar
    submitButton.addEventListener('click', function(event) {
        // Evitar el comportamiento predeterminado
        event.preventDefault();
        
        // Obtener los valores del formulario
        let name = form.querySelector('#name').value;
        let surname = form.querySelector('#surname').value; 
        let dni = form.querySelector('#dni').value;
        let birth_date = form.querySelector('#birth_date').value;
        let email = form.querySelector('#email').value;
        let password = form.querySelector('#password').value;

        // Verificar si los campos están vacíos
        if (!name || !surname || !dni || !birth_date || !email || !password) {
            document.querySelector('#messaje').innerText = 'Por favor, complete los campos del registro.';
            return;
        }

        // Crear una solicitud AJAX usando fetch
        let formData = new URLSearchParams(new FormData(form)).toString();

        fetch('../controllers/register.php', {  
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())  // Esperar una respuesta JSON
        .then(data => {
            // Si la respuesta indica éxito, redirigir
            if (data.status === 'success') {
                window.location.href = data.redirect_url;
            } else {
                // Si hay un error, mostrar el mensaje de error
                document.getElementById('messaje').innerText = data.message;
            }
        })
        .catch(error => {
            document.getElementById('messaje').innerText = 'Ocurrió un error: ' + error;
        });
    });
});
