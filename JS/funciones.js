function cargar(div, desde, callback) {
  $(div).load(desde, function () {
    if (typeof callback === "function") {
      callback();
    }
    // logica de #principal, definimos que si se está cargando alguno de los archivos del if entonces llame a la funcion filtrar, esto lo hacemos porque al ser carga dinamca da problemas con el buscador
    if (
      desde.includes("verRecetasAdmin.php") ||
      desde.includes("modificaReceta.php") ||
      desde.includes("eliminaReceta.php") ||
      desde.includes("verRecetasGuardadas.php") ||
      desde.includes("verRecetasCliente.php") ||
      desde.includes("verUsuarios.php") ||
      desde.includes("modificaUsuario.php") ||
      desde.includes("eliminaUsuario.php") ||
      desde.includes("verNotificacionesUsuario.php") ||
      desde.includes("verTodasNotificaciones.php") ||
      desde.includes("leerNotificaciones.php") ||
      desde.includes("modificaNotificacion.php") ||
      desde.includes("eliminaNotificacion.php") ||
      desde.includes("portada.php")
    ) {
      filtrar();
    }
    // Lógica para FAQ
    if (desde.includes("FAQ.php")) {
      if (typeof iniciaFAQ === "function") iniciaFAQ();
    }
  });
}

// Menú hamburguesa y responsive nav
function iniciaHamburguesa() {
  var $menuToggle = $(".menu-toggle");
  var $navbarNav = $(".navbar-nav");

  // Mostrar/ocultar menú hamburguesa
  $menuToggle.off("click").on("click", function () {
    $navbarNav.toggleClass("active");
    $menuToggle.toggleClass("open");
    // Cierra todos los dropdowns al cerrar el menú hamburguesa
    if (!$navbarNav.hasClass("active")) {
      $(".nav-item.open").removeClass("open");
    }
  });

  // Oculta o no, el menú hamburguesa al hacer clic en un enlace
  $navbarNav.find("a").on("click", function () {
    // Si es móvil entra en este bloque
    if (window.innerWidth <= 768) {
      // Si el enlace tiene la clase dropdown-toggle (es decir, abre un submenú), no cierra el menú hamburguesa (solo despliega el submenú, dropdown).
      if ($(this).hasClass("dropdown-toggle")) {
        return;
      }
      // Si el enlace está dentro de un submenú desplegable (.dropdown-menu), por defecto no cierra el menú hamburguesa
      if ($(this).closest(".dropdown-menu").length > 0) {
        // return; // si añado el retun no se cierre automáticamente al hacer clic en un dropdown-item, pero como nos interesa que se cierre, no lo añadimos
      }
      // Para el resto de enlaces, cierra el menú hamburguesa
      $navbarNav.removeClass("active");
      $menuToggle.removeClass("open");
      // Cierra todos los dropdowns al hacer clic en un enlace normal
      $(".nav-item.open").removeClass("open");
    }
  });

  // Cierra los dropdowns al hacer clic en un dropdown-item, para ello asigna un evento click a todos los elementos con clase .dropdown-item (opciones dentro de los submenús).Cuando se hace clic en uno, cierra todos los submenús eliminando la clase open de los elementos .nav-item.open.
  $navbarNav.find(".dropdown-item").on("click", function () {
    $(".nav-item.open").removeClass("open");
  });

  // Al cambiar tamaño de ventana, si es escritorio, se muestra el menú y el icono correctamente ya que quita la clase active del menú (lo oculta si estaba abierto en móvil).Quita la clase open del icono hamburguesa y cierra cualquier submenú abierto.
  $(window).on("resize", function () {
    if (window.innerWidth > 768) {
      $navbarNav.removeClass("active");
      $menuToggle.removeClass("open");
      $(".nav-item.open").removeClass("open");
    }
  });
}

// Función para controlar los Dropdowns del nav., sobre todo para dispositivos móviles.
function iniciaNav() {
  var isMobile = window.innerWidth <= 768;
  var dropdownToggles = document.querySelectorAll(".nav-link.dropdown-toggle");
  var dropdownNavItems = document.querySelectorAll(".nav-item.dropdown");

  // Limpia listeners previos
  dropdownToggles.forEach(function (toggle, i) {
    var newToggle = toggle.cloneNode(true);
    toggle.parentNode.replaceChild(newToggle, toggle);
    dropdownToggles[i] = newToggle;
  });

  // Vuelve a seleccionar los toggles después de clonar
  dropdownToggles = document.querySelectorAll(".nav-link.dropdown-toggle");

  if (isMobile) {
    dropdownToggles.forEach(function (toggle) {
      toggle.addEventListener("click", function (event) {
        event.preventDefault();
        var parent = this.closest(".nav-item.dropdown");
        // Cierra otros dropdowns
        dropdownNavItems.forEach(function (item) {
          if (item !== parent) item.classList.remove("open");
        });
        parent.classList.toggle("open");
      });
    });
  } else {
    dropdownNavItems.forEach(function (item) {
      item.classList.remove("open");
    });
  }
}

// Función para alternar entre el login y el registro
function toggleForms() {
  var loginForm = document.getElementById("login");
  var registerForm = document.getElementById("registro");
  if (loginForm && registerForm) {
    if (loginForm.style.display === "none") {
      loginForm.style.display = "block";
      registerForm.style.display = "none";
    } else {
      loginForm.style.display = "none";
      registerForm.style.display = "block";
    }
  }
}

// Asignar la función toggleForms al evento click de los enlaces
var showRegisterFormLink = document.getElementById("showRegisterForm");
var showLoginFormLink = document.getElementById("showLoginForm");

if (showRegisterFormLink) {
  showRegisterFormLink.addEventListener("click", function (event) {
    event.preventDefault();
    toggleForms();
  });
}

if (showLoginFormLink) {
  showLoginFormLink.addEventListener("click", function (event) {
    event.preventDefault();
    toggleForms();
  });
}

// función genérica para filtrar listas
function filtrar() {
  const searchInput = document.getElementById("search");
  const filterList = document.querySelector(".filter-list");

  if (searchInput && filterList) {
    searchInput.addEventListener("input", function () {
      const filter = searchInput.value.toLowerCase();
      const items = filterList.getElementsByClassName("filter-item");

      Array.from(items).forEach(function (item) {
        const text = item
          .querySelector(".filter-text")
          .textContent.toLowerCase();
        item.style.display = text.includes(filter) ? "" : "none";
      });
    });
  } else {
    console.log("No se encontraron los elementos necesarios para el buscador.");
  }
}

// Ejecutamos iniciaNav e iniciaHamburguesa al cargar la página
document.addEventListener("DOMContentLoaded", function () {
  iniciaHamburguesa();
  iniciaNav();
});
// Ejecutamos iniciaNav cada vez que cambie el tamaño de la ventana
window.addEventListener("resize", iniciaNav);
