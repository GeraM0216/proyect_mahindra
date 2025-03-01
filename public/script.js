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


// mensajes del usuario
document.getElementById("send-button").addEventListener("click", function() {
    const messageInput = document.getElementById("message-input");
    const chatBox = document.getElementById("chat-box");
    
    if (messageInput.value.trim() !== "") {
      const userMessage = document.createElement("div");
      userMessage.classList.add("user-message");
      userMessage.textContent = messageInput.value;
      chatBox.appendChild(userMessage);
      messageInput.value = ""; // Limpia el input
      chatBox.scrollTop = chatBox.scrollHeight; // Hace scroll automático al último mensaje
    }
  });