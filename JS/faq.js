// Función que controla el FAQ, al hacer clic en una pregunta, se despliega la respuesta correspondiente y se ocultan las demás respuestas
function iniciaFAQ() {
  var preguntas = $(".question");
  preguntas.off("click").on("click", function () {
    // Cierra todas las respuestas excepto la siguiente a la pregunta clicada
    $(".answer").not($(this).next(".answer")).slideUp("slow");
    // Alterna la respuesta de la pregunta clicada
    $(this).next(".answer").slideToggle("slow");
  });
}

$(document).ready(function () {
  iniciaFAQ();
});