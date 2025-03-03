

function toggleMenu() {
    var menu = document.getElementById("menu");
    var mainWindow = document.querySelector(".main-window");
    menu.classList.toggle("visible");

    if (menu.classList.contains("visible")) {
        mainWindow.style.marginLeft = window.innerWidth <= 768 ? "100%" : "25%";
    } else {
        mainWindow.style.marginLeft = "0";
    }
}

window.addEventListener('resize', function() {
    var menu = document.getElementById("menu");
    var mainWindow = document.querySelector(".main-window");
    if (window.innerWidth > 768) {
        mainWindow.style.marginLeft = menu.classList.contains("visible") ? "25%" : "0";
    } else {
        mainWindow.style.marginLeft = menu.classList.contains("visible") ? "100%" : "0";
    }
});

function cvAnalyzer() {
    document.title = 'CV Analyzer';
    document.getElementById('awaiting-text').innerHTML = '<i class="fas fa-user"></i><i class="fas fa-keyboard"></i> CV Analyzer';
}

function bestCandidates() {
    document.title = 'Mejores candidatos';
    document.getElementById('awaiting-text').innerHTML = '<i class="fas fa-user"></i><i class="fas fa-keyboard"></i> Mejores candidatos';
}

function whatToLookFor() {
    document.title = '¿Qué buscar?';
    document.getElementById('awaiting-text').innerHTML = '<i class="fas fa-user"></i><i class="fas fa-keyboard"></i> ¿Qué buscar?';
}


document.getElementById("send-button").addEventListener("click", function() {
    const messageInput = document.getElementById("message-input");
    const chatBox = document.getElementById("chat-box");

    let userMessage = messageInput.value.trim();
    if (userMessage === "") return;

    // Agregar mensaje del usuario al chat
    const userMessageDiv = document.createElement("div");
    userMessageDiv.classList.add("user-message");
    userMessageDiv.textContent = userMessage;
    chatBox.appendChild(userMessageDiv);

    // Limpiar input y hacer scroll hacia abajo
    messageInput.value = "";
    chatBox.scrollTop = chatBox.scrollHeight;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Hacer petición a DeepSeek para obtener la respuesta de la IA
    fetch('/dashboard', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN":csrfToken
        },
        body: JSON.stringify({ mensaje: userMessage }) // Enviar el mensaje del usuario
    })
    .then(response => response.json()) // Analizar la respuesta como JSON
    .then(data => {
        console.log("Respuesta de la IA:", data);

        // Verifica si la respuesta tiene la propiedad 'respuesta'
        if (data.respuesta) {
            // Crear un nuevo div para el mensaje de la IA
            const aiMessageDiv = document.createElement("div");
            aiMessageDiv.classList.add("ai-message"); // Añadir la clase 'ai-message'
            
            // Usar la respuesta de la IA
            aiMessageDiv.innerHTML = `<b>AI:</b> ${data.respuesta}`; 

            // Agregar el mensaje al chat
            chatBox.appendChild(aiMessageDiv);

            // Hacer scroll hacia abajo para ver la respuesta
            chatBox.scrollTop = chatBox.scrollHeight;
        } else {
            console.log("No se recibió respuesta de la IA");
        }
    })
    .catch(error => console.error("Error:", error));
});


    // Mostrar el nombre del archivo seleccionado
    function mostrarNombreArchivo() {
      var input = document.getElementById('file-input');
      var fileName = input.files.length > 0 ? input.files[0].name : "Ningún archivo seleccionado";
      document.getElementById('file-name').innerText = fileName;
    };
