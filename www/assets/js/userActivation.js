jQuery(document).on('click','#active',function(event){//la petición espera 3 parametros, el evento,
    // el id del formulario o sobre donde extraemos los datos y una funcion
    event.preventDefault();
    jQuery.ajax({
        url:'../../app/controllers/activeUser.php',//archivo el cual procesará los datos
        type:'POST',//el modo de envio, pero no tengo un formulario, que debo poner?
        dataType:'json',//el tipo de dato que se envia
        data:$(this).serialize()//los datos a enviar
    })
    .done(function(respuesta){
        console.info(respuesta);
    })
    .fail(function(resp){
        console.error(resp.responseText());
    })
    .always(function(){
        console.info("complete");
    })
});

//1ra duda, los datos como los obtengo? no es un formulario. deberia usar este script para obtenerlos y enviarlo?