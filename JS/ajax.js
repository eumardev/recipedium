$(document).ready(function () {
  // Formulario de nueva notificaciones/mensajes
  $(document).on("submit", "#mensajeForm", function (e) {
    e.preventDefault();
    if (typeof validateMensajeForm === "function" && !validateMensajeForm()) {
      return;
    }
    $.ajax({
      type: "POST",
      url: "./nNotificacion.php",
      data: $(this).serialize(),
      success: function (response) {
        $("#divRespuesta").html("<p>" + response + "</p>");
        if (response.includes("Notificación enviada correctamente.")) {
          $("#mensajeForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuesta").html(
          "<p>Error al enviar la notificación. Por favor, intente nuevamente.</p>"
        );
      },
    });
  });

  // Formulario de nuevo mensaje desde contacto
  $(document).on("submit", "#contactoForm", function (event) {
    if (!validateContactoForm()) {
      event.preventDefault();
      return false;
    }
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: "./nNotificacion.php",
      data: $(this).serialize(),
      success: function (response) {
        $("#divRespuesta").html(response);
        if (response.includes("Notificación enviada correctamente")) {
          $("#contactoForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuesta").html(
          '<div class="error-message">Error al enviar el mensaje. Por favor, intente nuevamente.</div>'
        );
      },
    });
  });
  // Formulario de nueva receta
  $(document).on("submit", "#recetaForm", function (e) {
    e.preventDefault();
    if (typeof validateRecetaForm === "function" && !validateRecetaForm()) {
      return false;
    }
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: "./nReceta.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        $("#divRespuesta").html("<p>" + response + "</p>");
        if (response.includes("Receta creada correctamente.")) {
          $("#recetaForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuesta").html(
          "<p>Error al crear la receta. Por favor, intente nuevamente.</p>"
        );
      },
    });
  });

  // Formulario de nuevo usuario (desde perfil admin)
  $(document).on("submit", "#usuarioForm", function (e) {
    e.preventDefault();
    if (typeof validateUsuarioForm === "function" && !validateUsuarioForm()) {
      return false;
    }
    $.ajax({
      type: "POST",
      url: "./nUsuario.php",
      data: $(this).serialize(),
      success: function (response) {
        $("#divRespuesta").html(response);
        if (response.includes("Usuario creado correctamente.")) {
          $("#usuarioForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuesta").html(
          '<div class="error-message">Error al crear el usuario. Por favor, intente nuevamente.</div>'
        );
      },
    });
  });

  //Formulario registro usuario (desde perfil público)
  $(document).on("submit", "#registerForm", function (e) {
    e.preventDefault();
    if (typeof validateRegisterForm === "function" && !validateRegisterForm()) {
      return false;
    }
    $.ajax({
      type: "POST",
      url: "./nUsuario.php",
      data: $(this).serialize(),
      success: function (response) {
        $("#divRespuestaRegistro").html(response);
        if (response.includes("Usuario creado correctamente.")) {
          $("#registerForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuestaRegistro").html(
          '<div class="error-message">Error al registrar el usuario. Por favor, intente nuevamente.</div>'
        );
      },
    });
  });

// Validacion de login con AJAX
$(document).on("submit", "#loginForm", function (e) {
  e.preventDefault();
  if (typeof validateLoginForm === "function" && !validateLoginForm()) {
    return false;
  }
  $.ajax({
    type: "POST",
    url: "./login.php",
    data: $(this).serialize(),
    success: function (response) {
      if (response.trim() === "ok") {
        // si el login es correcto, redirige a app.php con window.location.href que lo que hace es cambiar la url
        window.location.href = "./app.php";
      } else {
        // Solo muestra el mensaje si hay error
        $("#divRespuestaLogin").html(response);
      }
    },
    error: function () {
      $("#divRespuestaLogin").html(
        '<div class="error-message">Error al iniciar sesión. Inténtalo de nuevo.</div>'
      );
    },
  });
});
  // Modificacion de usuario con AJAX
  $(document).on("submit", "#modificaUsuarioForm", function (e) {
    e.preventDefault();
    if (typeof validateUsuarioForm === "function" && !validateUsuarioForm()) {
      return false;
    }
    $.ajax({
      type: "POST",
      url: "./modiUsuario.php",
      data: $(this).serialize(),
      success: function (response) {
        $("#divRespuestaModificacion").html(response);
        if (response.includes("Usuario modificado correctamente")) {
          $("#modificaUsuarioForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuestaModificacion").html(
          '<div class="error-message">Error al modificar el usuario. Por favor, intente nuevamente.</div>'
        );
      },
    });
  });

  // Modificaicon de notificación con AJAX
  $(document).on("submit", "#modificaNotificacionForm", function (e) {
    e.preventDefault();
    if (
      typeof validateModiNotificacionForm === "function" &&
      !validateModiNotificacionForm()
    ) {
      return false;
    }
    $.ajax({
      type: "POST",
      url: "./modiNotificacion.php",
      data: $(this).serialize(),
      success: function (response) {
        $("#divRespuestaModificacionNotificacion").html(
          "<p>" + response + "</p>"
        );
        if (response.includes("Notificacion modificada correctamente")) {
          $("#modificaNotificacionForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuestaModificacionNotificacion").html(
          "<p>Error al modificar la notificación. Por favor, intente nuevamente.</p>"
        );
      },
    });
  });

  // Modificación de receta con AJAX

  $(document).on("submit", "#modificaRecetaForm", function (e) {
    e.preventDefault();
    console.log("AJAX submit capturado");
    if (typeof validateRecetaForm === "function" && !validateRecetaForm()) {
      return false;
    }
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: "./modiReceta.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        $("#divRespuestaModificacionReceta").html(response);
        if (response.includes("Recetilla modificada correctamente")) {
          $("#modificaRecetaForm")[0].reset();
        }
      },
      error: function () {
        $("#divRespuestaModificacionReceta").html(
          '<div class="error-message">Error al modificar la receta. Por favor, intente nuevamente.</div>'
        );
      },
    });
  });

  // Guardar recetas públicas con AJAX
  $(document).on("click", ".guardar-receta", function (e) {
    e.preventDefault();
    var idReceta = $(this).data("id");
    var boton = $(this);

    $.ajax({
      type: "POST",
      url: "./aReceta.php",
      data: { id_receta: idReceta },
      success: function (response) {
        if (response.includes("Receta guardada correctamente")) {
          boton
            .prop("disabled", true)
            .text("La receta se ha guardado correctamente");
        } else if (response.includes("ya está guardada")) {
          boton.prop("disabled", true).text("Receta ya guardada");
        } else if (response.includes("No puedes guardar tu propia receta")) {
          boton
            .prop("disabled", true)
            .text("No puedes guardar tu propia receta");
        }
      },
      error: function () {
        boton.text("Error").prop("disabled", true);
      },
    });
  });

  // Marcar notificaciones como leídas
  $(document).on("click", ".marcar-leida", function (e) {
    e.preventDefault();
    var boton = $(this);
    var idUsuario = boton.data("id-usuario");
    var idNotificacion = boton.data("id-notificacion");
    var detalles = boton.closest(".notificacion-detalles");

    $.ajax({
      type: "POST",
      url: "./marcarNotificacion.php",
      data: { id_usuario: idUsuario, id_notificacion: idNotificacion },
      success: function (response) {
        console.log("Respuesta AJAX:", response);
        boton
          .prop("disabled", true)
          .removeClass("btn-success")
          .addClass("btn-secondary")
          .text("Leída");
        detalles
          .find('p:contains("Leída:")')
          .html("<strong>Leída:</strong> Sí");

        // Recargar el nav para actualizar el icono del sobre
        $("#nav").load("./nav.php", function () {
          if (typeof iniciaHamburguesa === "function") iniciaHamburguesa();
          if (typeof iniciaNav === "function") iniciaNav();
        });
      },
      error: function () {
        alert("Error al marcar la notificación como leída.");
      },
    });
  });

  // Eliminar notificaciones
  $(document).on("click", ".eliminar-notificacion", function (e) {
    e.preventDefault();
    if (!confirm("¿Seguro que quieres eliminar esta notificación?")) return;
    var boton = $(this);
    var idNotificacion = boton.data("id");
    var item = boton.closest(".filter-item");

    $.ajax({
      type: "POST",
      url: "./eNotificacion.php",
      data: { id_notificacion: idNotificacion },
      success: function (response) {
        if (response.includes("eliminada")) {
          //podriamos usar item.remove para que se eliminara automaticamente sin desvanecimiento pero queda mejor fadeOut
          item.fadeOut(300, function () {
            $(this).remove();
          });
        } else {
          alert("No se pudo eliminar la notificación.");
        }
      },
      error: function () {
        alert("Error al eliminar la notificación.");
      },
    });
  });

  //elimiar usuario
  $(document).on("click", ".eliminar-usuario", function (e) {
    e.preventDefault();
    if (!confirm("¿Seguro que quieres eliminar este usuario?")) return;
    var boton = $(this);
    var idUsuario = boton.data("id");
    $.ajax({
      type: "POST",
      url: "./eUsuario.php",
      data: { id_usuario: idUsuario },
      success: function (response) {
        if (response.includes("eliminado")) {
          //podriamos usar boton.closest('.usuario-item').remove(); para que se eliminara automaticamente sin desvanecimiento pero queda mejor fadeOut
          boton.closest(".usuario-item").fadeOut(300, function () {
            $(this).remove();
          });
          $("#divRespuesta").html(
            '<div class="success-message">Usuario eliminado correctamente.</div>'
          );
        } else {
          $("#divRespuesta").html(
            '<div class="error-message">No se pudo eliminar el usuario.</div>'
          );
        }
      },
      error: function () {
        $("#divRespuesta").html(
          '<div class="error-message">Error al eliminar el usuario.</div>'
        );
      },
    });
  });

  //eliminar receta
  $(document).on("click", ".eliminar-receta", function (e) {
    e.preventDefault();
    if (!confirm("¿Seguro que quieres eliminar esta receta?")) return;
    var boton = $(this);
    var idReceta = boton.data("id");
    $.ajax({
      type: "POST",
      url: "./eReceta.php",
      data: { id_receta: idReceta },
      success: function (response) {
        response = response.trim();
        if (response === "eliminada") {
          boton.closest(".receta-item").fadeOut(300, function () {
            $(this).remove();
          });
          $("#divRespuesta").html(
            '<div class="success-message">Receta eliminada correctamente.</div>'
          );
        } else {
          $("#divRespuesta").html(
            '<div class="error-message">No se pudo eliminar la receta.</div>'
          );
        }
      },
      error: function () {
        $("#divRespuesta").html(
          '<div class="error-message">Error al eliminar la receta.</div>'
        );
      },
    });
  });
  // eliminar receta guardada
  $(document).on("click", ".eliminar-receta-guardada", function (e) {
    e.preventDefault();
    if (!confirm("¿Seguro que quieres eliminar esta receta guardada?")) return;
    var boton = $(this);
    var idReceta = boton.data("id");
    var item = boton.closest(".filter-item");

    $.ajax({
      type: "POST",
      url: "./eRecetaGuardada.php",
      data: { id: idReceta },
      success: function (response) {
        if (response.includes("eliminada")) {
          item.fadeOut(300, function () {
            $(this).remove();
          });
        } else {
          alert("No se pudo eliminar la receta guardada.");
        }
      },
      error: function () {
        alert("Error al eliminar la receta guardada.");
      },
    });
  });
});
