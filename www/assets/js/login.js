document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#loginForm');
    let submitButton = form.querySelector('#submitButton');
    
    // Añadir un evento click al botón de enviar
    submitButton.addEventListener('click', function(event) {
        // Evitar el comportamiento predeterminado
        event.preventDefault();
        
        // Obtener los valores del formulario
        let email = form.querySelector('#email').value;
        let pass = form.querySelector('#pass').value; 

        // Verificar si los campos están vacíos (por si acaso)
        if (!email || !pass) {
            document.querySelector('#messaje').innerText = 'Por favor, complete ambos campos del login.';
            return;
        }

        // Crear una solicitud AJAX usando fetch
        let formData = new URLSearchParams(new FormData(form)).toString();

        fetch('../controllers/login.php', {  
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())  // Parsear la respuesta como JSON
        .then(data => {
            if (data.status === 'success') {
                // Redirigir a la URL proporcionada por el servidor
                window.location.href = data.redirect_url;
            } else {
                // Mostrar el mensaje de error
                document.querySelector('#messaje').innerText = data.message;
            }
        })
        .catch(error => {
            document.querySelector('#messaje').innerText = 'Error: ' + error;
        });
    });
});
