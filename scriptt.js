// Elementos del DOM
const $btnEnviar = document.querySelector("#WEnv"),
    $estado = document.querySelector("#estado");

    
$btnEnviar.addEventListener("click", async () => {

   
    // Los enviamos
    $estado.textContent = "Enviando archivos...";
    const respuestaRaw = await fetch("./Guardawebservices.php", {
        method: "POST"
    });
    const respuesta = respuestaRaw.json();
    // Puedes manejar la respuesta como tú quieras
    console.log({ respuesta });
    
    // Finalmente limpiamos el campo
    
    $estado.textContent = "Archivos enviados";
});