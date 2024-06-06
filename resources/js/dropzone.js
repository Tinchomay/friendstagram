import Dropzone from "dropzone";

const contenedorDrop = document.querySelector('#dropzone');

if(contenedorDrop) {
    //Para que no busque la clase automaticamente y asi podamos asignarla
    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone("#dropzone", {
        //mensaje
        dictDefaultMessage: 'Sube tu imagen aqui',
        //Que files va a aceptar
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        //El usuario puede eliminar sus imagenes
        addRemoveLinks: true,
        //Texto al eliminar
        dictRemoveFile: 'Borrar Archivo',
        //Archivos maximos
        maxFiles: 1,
        //Para solo subir una
        uploadMultiple: false,
        //Función personalizada para el evento `error`
        // error: function(file, error) {
        //     // Eliminar el texto "[object Object]" del mensaje de error
        //     const errorMessage = error.message.replace('[object Object]', '');

        //     // Mostrar el mensaje de error personalizado
        //     this.emit('errorMessage', errorMessage);
        // }
        //Creamos una funcion que se inicie con dropzone
        init: function () {
            if(document.querySelector('[name="imagen"]').value.trim()) {
                const imagenPublicada = {};
                //La funcion call requiere unas propiedades, en el caso del size da igual solo es requerido y debemos de agregar a imagenPublicada el nombre de la imagen
                imagenPublicada.size = 1000;
                imagenPublicada.name = document.querySelector('[name="imagen"]').value;
                //Aqui vamos a agregar el archivo a dropzone cuando detecte que hay un value con call
                this.options.addedfile.call(this, imagenPublicada);
                //Vamos a agregar la miniatura
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)
                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
            }
        }
    });

    //Y nos da la respuesta del servidor
    dropzone.on('success', function(file, response) {
        const inputName = document.querySelector('[name="imagen"]');
        //Con response.imagen accedemos al nombre de la imagen y llenamos el valor del input
        inputName.value = response.imagen
    })

    dropzone.on('error', function(file, message) {
        console.log(message)
    })

    //Lo vamos a utilizar para eliminar el value del input
    dropzone.on('removedfile', function() {
        document.querySelector('[name="imagen"]').value = '';
    })
}


