document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#editUserForm');
    let submitButton = form.querySelector('#button');

    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        // Capturamos los valores del formulario
        let formData = new FormData(form);

        // Capturar y validar campos
        let id_person = formData.get('id_person');
        let id_address_type = formData.get('id_address_type');
        let street = formData.get('street');
        let number = formData.get('number');
        let id_neighborhood = formData.get('id_neighborhood');
        let apartment = formData.get('apartment');
        let floor = formData.get('floor');
        let id_contact_type = formData.get('id_contact_type');
        let contact = formData.get('contact');

        // Verificar que los campos obligatorios estén llenos
        if (!id_address_type || !street || !number || !id_contact_type || !contact) {
            document.querySelector('#message').innerText = 'Por favor complete todos los campos obligatorios.';
            return;
        }

        // Crear los datos que se enviarán en el body
        let bodyData = new URLSearchParams();
        bodyData.append('id_person', id_person);
        bodyData.append('id_address_type', id_address_type);
        bodyData.append('street', street);
        bodyData.append('number', number);
        bodyData.append('id_neighborhood', id_neighborhood);
        bodyData.append('apartment', apartment);
        bodyData.append('floor', floor);
        bodyData.append('id_contact_type', id_contact_type);
        bodyData.append('contact', contact);

        // Petición AJAX usando fetch
        fetch('../../controllers/editProfileController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: bodyData.toString()
        })
        .then(response => response.text())
        .then(data => {
            // Mostrar respuesta
            document.querySelector('#message').innerText = data;
        })
        .catch(error => {
            document.querySelector('#message').innerText = 'Error: ' + error;
        });
    });
});
