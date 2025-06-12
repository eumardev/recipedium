// Delegación de eventos para validación de formularios (funciona con AJAX y carga dinámica)


$(document).on('submit', '#loginForm', function(event) {
    if (!validateLoginForm()) {
        event.preventDefault();
    }
});


// --- VALIDACIONES ---

function validateRegisterForm() {
    const nombre = document.getElementById('nombre').value;
    const dni = document.getElementById('DNI').value;
    const email = document.getElementById('email').value;
    const clave = document.getElementById('clave').value;

    const nombreRegex = /^[a-zA-Z0-9]{3,15}$/;
    const dniRegex = /^[0-9]{8}[A-Za-z]$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // const claveRegex = /^[a-zA-Z0-9]{4,20}$/;
    // clave que al menos exige una mayúscula, una minúsucla y un caracter especial:                           
    const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{4,20}$/;

    if (!nombreRegex.test(nombre)) {
        alert('El nombre de usuario debe tener entre 3 y 15 caracteres alfanuméricos.');
        return false;
    }
    if (!dniRegex.test(dni)) {
        alert('El DNI/NIF debe tener 8 números seguidos de una letra.');
        return false;
    }
    if (!emailRegex.test(email)) {
        alert('El correo electrónico no es válido.');
        return false;
    }
    if (!claveRegex.test(clave)) {
        alert('La clave debe tener entre 4 y 20 caracteres alfanuméricos, una mayúscula, una minúscula y un carácter especial.');
        return false;
    }nombre
    return true;
}

function validateLoginForm() {
    const nombre = document.querySelector('input[name="nombre"]').value;
    const clave = document.querySelector('input[name="clave"]').value;

    const nombreRegex = /^[a-zA-Z0-9]{3,15}$/;
    const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{4,20}$/;

    if (!nombreRegex.test(nombre)) {
        alert('El nombre de usuario debe tener entre 3 y 15 caracteres alfanuméricos y sin espacios.');
        return false;
    }
    if (!claveRegex.test(clave)) {
        alert('La clave debe tener entre 4 y 20 caracteres alfanuméricos.');
        return false;
    }
    return true;
}

function validateUsuarioForm() {
    const nombre = document.getElementById('nombre').value;
    const dni = document.getElementById('DNI').value;
    const email = document.getElementById('email').value;
    const clave = document.getElementById('clave').value;

    const nombreRegex = /^[a-zA-Z0-9]{3,15}$/;
    const dniRegex = /^[0-9]{8}[A-Za-z]$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{4,20}$/;

    if (!nombreRegex.test(nombre)) {
        alert('El nombre de usuario debe tener entre 3 y 15 caracteres alfanuméricos y sin espacios.');
        return false;
    }
    if (!dniRegex.test(dni)) {
        alert('El DNI/NIF debe tener 8 números seguidos de una letra.');
        return false;
    }
    if (!emailRegex.test(email)) {
        alert('El correo electrónico no es válido.');
        return false;
    }
    if (!claveRegex.test(clave)) {
        alert('La clave debe tener entre 4 y 20 caracteres alfanuméricos.');
        return false;
    }
    return true;
}

function validateRecetaForm() {
    const titulo = document.getElementById('titulo').value;
    const ingredientes = document.getElementById('ingredientes').value;
    const tiempoPreparacion = document.getElementById('tiempo_preparacion').value;
    const tiempoTotal = document.getElementById('tiempo_total').value;
    const instrucciones = document.getElementById('instrucciones').value;

    const tituloRegex = /^.{3,100}$/;
    const ingredientesRegex = /^.{10,1000}$/;
    const tiempoRegex = /^[0-9]+$/;
    const instruccionesRegex = /^.{10,2000}$/;

    if (!tituloRegex.test(titulo)) {
        alert('El título debe tener entre 3 y 100 caracteres.');
        return false;
    }
    if (!ingredientesRegex.test(ingredientes)) {
        alert('Los ingredientes deben tener entre 10 y 1000 caracteres.');
        return false;
    }
    if (!tiempoRegex.test(tiempoPreparacion)) {
        alert('El tiempo de preparación debe ser un número válido.');
        return false;
    }
    if (!tiempoRegex.test(tiempoTotal)) {
        alert('El tiempo total debe ser un número válido.');
        return false;
    }
    if (!instruccionesRegex.test(instrucciones)) {
        alert('Las instrucciones deben tener entre 10 y 2000 caracteres.');
        return false;
    }
    return true;
}
// validacion para notificaciones
function validateMensajeForm() {
    const destinatario = document.getElementById('destinatario').value;
    const mensaje = document.getElementById('mensaje').value;
    const destinatarioRegex = /^[a-zA-Z0-9]{3,15}$/;
    const mensajeRegex = /^.{10,1000}$/;

    if (!destinatarioRegex.test(destinatario)) {
        alert('El nombre de usuario debe tener entre 3 y 15 caracteres alfanuméricos y sin espacios.');
        return false;
    }
    if (!mensajeRegex.test(mensaje)) {
        alert('El mensaje debe tener entre 10 y 1000 caracteres.');
        return false;
    }
    return true;
}

// validación para modificar notificaciones
function validateModiNotificacionForm() {
    const mensaje = document.getElementById('mensaje').value;
    const mensajeRegex = /^.{10,1000}$/;

    if (!mensajeRegex.test(mensaje)) {
        alert('El mensaje debe tener entre 10 y 1000 caracteres.');
        return false;
    }
    return true;
}

// validación para el formulario de contacto
function validateContactoForm() {
    const mensaje = document.getElementById('mensaje').value;
    const mensajeRegex = /^.{10,1000}$/;
    if (!mensajeRegex.test(mensaje)) {
        alert('El mensaje debe tener entre 10 y 1000 caracteres.');
        return false;
    }
    return true;
}