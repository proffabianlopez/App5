document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('#editDoctorForm');
    let submitButton = form.querySelector('#button');
    
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        // Capturamos los valores del formulario
        let formData = new FormData(form);

        // Realizamos las validaciones correspondientes
        let id_doctor = formData.get('id_doctor');
        let name = formData.get('name');
        let surname = formData.get('surname');
        let onlineConsultation = formData.get('onlineConsultation');
        let street = formData.get('street');
        let number = formData.get('number');
        let apartment = formData.get('apartment');
        let floor = formData.get('floor');

        let bodyData = new URLSearchParams();
        bodyData.append('id_doctor', id_doctor);
        bodyData.append('name', name);
        bodyData.append('surname', surname);
        bodyData.append('onlineConsultation', onlineConsultation);
        bodyData.append('street', street);
        bodyData.append('number', number);
        bodyData.append('apartment', apartment);
        bodyData.append('floor', floor);

        fetch('../../controllers/editDoctor.php', {
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
