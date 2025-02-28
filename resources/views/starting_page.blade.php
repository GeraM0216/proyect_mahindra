<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mahindra.ai</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #333333; /* Gris carbón */
      color: #F8F8FF; /* Blanco fantasma para texto general */
    }

    .container {
      display: flex;
      height: 100%;
    }

    .menu {
      width: 25%;
      padding: 10px;
      box-sizing: border-box;
      overflow-y: auto;
      color: white;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      border-right: 4px solid #444;
      height: 100vh;
      transform: translateX(0%); /* Comienza en pantalla */
      transition: transform 0.3s ease-in-out;
    }
    /* Cuando el menú no es visible, muévelo fuera de la pantalla */
    .menu:not(.visible) {
      transform: translateX(-100%);
    }

    .main-window {
      flex-grow: 1;
      margin-left: 25%;
      padding: 10px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      height: 100%;
      overflow-y: auto;
      overflow-x: hidden; /* Ocultar barra de desplazamiento horizontal */
    }

    .input-group, label, input, select, button {
      width: 100%;
      padding: 8px;
      margin-bottom: 5px;
      box-sizing: border-box;
    }

    button {
      cursor: pointer;
      background-color: #6065d6; /* Cambiar colores de botones de tema oscuro a verde 4CAF50 */
      color: white;
      border: none;
      border-radius: 4px;
    }

    button:hover {
      background-color: #7a7bff; /* Color de botón al pasar el ratón en tema oscuro 381986 692fff */
    }

    #message-input {
      width: calc(100% - 16px);
      resize: none;
      overflow-y: hidden;
    }

    #chat-box {
      flex-grow: 1;
      height: 100%;
      margin-bottom: 10px;
      overflow-y: auto;
      word-wrap: break-word;
    }

    /* Ajustar el botón de enviar para alinearlo con el campo de entrada de mensaje */

    /* Estilos de tema claro */
    .light-theme {
      background-color: #F8F8FF; /* Fondo blanco para contenido principal */
      color: #082B5D; /* Texto azul oscuro para buen contraste */
    }

    .light-theme .menu {
      background-color: #F0F0F0; /* Gris claro para fondo del menú */
      color: #082B5D; /* Texto azul oscuro para el menú */
      border-right: 4px solid #DDDDDD; /* Borde ligeramente más oscuro para contraste */
    }

    /* Estilos de etiqueta y entrada del menú para el tema claro */
    .light-theme .menu .input-group label {
      background-color: transparent; /* Eliminar fondo de las etiquetas */
      color: #082B5D; /* Texto azul oscuro para legibilidad */
      border: none; /* Eliminar borde de las etiquetas */
    }

    .light-theme .menu .input-group input,
    .light-theme .menu .input-group select {
      background-color: #DCDCDC; /* Gris claro para entradas y selectores */
      color: #082B5D; /* Texto azul oscuro para legibilidad */
      border: 1px solid #C0C0C0; /* Borde sutil para entradas */
      outline: none; /* Eliminar contorno al enfocar */
    }

    /* Estilos de botón para el tema claro */
    .light-theme button {
      background-color: #E0E0E0; /* Gris claro para botones */
      color: #082B5D; /* Texto azul oscuro para legibilidad */
      border: none; /* Eliminar borde */
    }

    .light-theme button:hover {
      background-color: #D0D0D0; /* Gris ligeramente más oscuro al pasar el ratón */
    }

    /* Botones de acción de memoria para que coincidan con el botón de registro de memoria */
    .light-theme .menu #summarize-log-button,
    .light-theme .menu #clear-log-button,
    .light-theme .menu #memory-log-button {
      background-color: #E0E0E0; /* Mismo gris claro que otros botones */
      color: #082B5D; /* Texto azul oscuro para legibilidad */
    }

    /* Estilos de iconos en botones para el tema claro */
    .light-theme .menu .fa-wrench,
    .light-theme .menu .fa-user,
    .light-theme .menu .fa-robot,
    .light-theme .menu .fa-tachometer-alt,
    .light-theme .menu .fa-brain,
    .light-theme .menu .fa-search,
    .light-theme .menu .fa-compress-arrows-alt,
    .light-theme .menu .fa-eraser,
    .light-theme .menu .fa-adjust {
      color: #311d73; /* Azul oscuro para iconos para que coincidan con el texto */
    }

    /* Ajuste del color del botón de alternar tema */
    .light-theme .menu #theme-toggle-button {
      background-color: #E0E0E0; /* Mismo gris claro para que coincida con otros botones */
      color: #311d73; /* Texto azul oscuro para legibilidad */
    }

    /* Estilos del cuadro de chat para el tema claro */
    .light-theme #chat-box {
      background-color: #FFFFFF; /* Fondo blanco para el cuadro de chat */
      color: #311d73; /* Texto azul oscuro */
      border: none; /* Eliminar borde */
    }

    /* Ajustar el tamaño de la entrada de mensaje para evitar el desplazamiento horizontal */
    .light-theme #message-input {
      width: calc(100% - 20px); /* Ancho ajustado para evitar desbordamiento */
      margin-right: 10px; /* Ajustar margen para evitar superposición de barra de desplazamiento */
    }

    /* Botón de alternar menú - fijo en la esquina superior izquierda del menú */
    .menu-toggle {
      display: block;
      position: fixed;
      top: 10px; /* Ajustado para alinearse con la parte superior del menú */
      left: 10px; /* Ajustado para alinearse con la izquierda del menú */
      z-index: 2;
      background-color: #6065d6; /* Color del botón */
      border: none;
      color: white;
      padding: 8px; /* Relleno para hacer el botón un cuadrado perfecto */
      width: 30px; /* Ancho fijo para consistencia */
      height: 30px; /* Altura igual al ancho para formar un cuadrado */
      border-radius: 5px;
      cursor: pointer;
    }

    /* Ajustes para la ventana principal cuando el menú está cerrado */
    .menu:not(.visible) ~ .main-window {
      margin-left: 0; /* Ancho completo cuando el menú está cerrado */
      transition: margin-left 0.3s ease-in-out;
    }

    /* Cuando el menú es visible, ajustar el margen de la ventana principal */
    .menu.visible ~ .main-window {
      margin-left: 25%; /* Ajustar margen para acomodar el ancho del menú */
      transition: margin-left 0.3s ease-in-out;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
      .menu {
        width: 100%; /* Ancho completo en pantallas pequeñas */
        transform: translateX(-100%); /* Comienza fuera de la pantalla */
      }

      .menu.visible {
        transform: translateX(0); /* Deslizar al alternar */
      }

      .main-window {
        margin-left: 0; /* Eliminar margen cuando el menú es visible */
        transition: margin-left 0.3s ease-in-out;
      }

      .menu.visible ~ .main-window {
        margin-left: 100%; /* Mover la ventana principal a la derecha cuando el menú está abierto */
      }
    }

    .microphone-active {
      background-color: #FF6347; /* Color tomate para estado activo */
    }

    .code-container {
      background-color: black; /* Fondo negro */
      color: white; /* Color de texto blanco */
      border: 1px solid #ddd; /* Borde gris claro */
      border-top: 20px solid #ddd; /* Esto crea el efecto de un encabezado de ventana */
      border-radius: 4px; /* Esquinas redondeadas */
      padding: 10px; /* Relleno dentro del contenedor */
      margin: 10px 0; /* Margen alrededor del contenedor */
      font-family: 'Courier New', Courier, monospace; /* Fuente monoespaciada para código */
      white-space: pre-wrap; /* Preserva espacios y saltos de línea */
      word-wrap: break-word; /* Rompe líneas largas de código */
      overflow-x: auto; /* Mostrar barra de desplazamiento horizontal solo cuando sea necesario */
      overflow-y: hidden; /* Ocultar barra de desplazamiento vertical */
      padding-top: 10px; /* Ajustar el relleno para que quepa la etiqueta */
      position: relative; /* Añadir esta línea si no está ya */
    }

    /* Estilo del botón de copiar al portapapeles */
    .code-container button {
      background-color: #4CAF50; /* Fondo verde */
      color: white;
      border: none;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 4px;
    }

    /* Contenedor para el bloque de código, etiqueta de lenguaje y botón de copiar */
    .code-block-container {
      position: relative;
      margin: 10px 0;
    }

    /* Etiqueta para el lenguaje de codificación */
    .code-language-label {
      position: absolute;
      top: 5px; /* Alinear con la parte superior del contenedor */
      left: 5px; /* Alinear con la izquierda del contenedor */
      background-color: #ddd; /* O cualquier color que prefieras */
      color: black; /* Color del texto */
      padding: 2px 10px;
      font-size: 0.85em;
      z-index: 1;
    }

    /* Estilo para el botón de copiar */
    .code-copy-button {
      position: absolute;
      top: 1px; /* Ajustar este valor para posicionar el botón dentro del área de relleno */
      right: 1px;
      height: 10px; /* Añadir esta línea para establecer una altura fija */
      width: 10px; /* Ajustar este valor para hacer el botón cuadrado */
      padding: 5px; /* Ajustar relleno según sea necesario para crear una apariencia cuadrada */
      background-color: #6065d6; /* Fondo azul para el botón */
      color: white;
      border: none;
      cursor: pointer;
      font-size: 1em; /* Ajustar tamaño de fuente según sea necesario */
      border-top-right-radius: 4px; /* Esquina redondeada en la parte superior derecha */
      z-index: 10; /* Asegurar que el botón esté por encima de otros elementos */
      width: 30px; /* Ancho del botón */
      height: 30px; /* Altura del botón, haciéndolo un cuadrado */
      text-align: center;
      line-height: 20px; /* Centrar el icono verticalmente */
    }

    .code-copy-button:hover {
      background-color: #7a7bff; /* Azul ligeramente más claro al pasar el ratón */
    }

    .ai-profile-icon {
      display: inline-block;
      width: 30px; /* Ajustar tamaño según sea necesario */
      height: 30px; /* Ajustar tamaño según sea necesario */
      border-radius: 50%; /* Lo hace circular */
      background-size: cover;
      background-position: center;
      margin-right: 5px; /* Da algo de espacio entre el icono y el texto */
      vertical-align: middle;
    }

    /* Estilos para el área de arrastrar y soltar */
    .drag-drop-area {
      padding: 0;
      text-align: center;
      cursor: pointer;
      background-color: #6065d6;
      width: 350px; /* Establecer el ancho y la altura para mantener una forma circular fija */
      height: 350px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: 10px auto 0; /* Eliminar espacio debajo y proporcionar espacio arriba */
      border-radius: 50%; /* Asegurar que el borde sea circular */
      overflow: hidden; /* Ocultar partes desbordantes del borde */
      border: 2px solid #7a7bff; /* Cambiar color y estilo del borde al pasar el ratón */
    }

    .image-container {
      width: 100%;
      height: 100%;
      position: relative;
      overflow: hidden;
    }

    .image-container img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Recortar y centrar la imagen dentro del contenedor */
      object-position: center center; /* Centrar la imagen dentro del contenedor */
      border-radius: 50%; /* Máscara circular */
    }

    .drag-drop-area:hover {
      background-color: #f0f0f0; /* Fondo claro al pasar el ratón */
      border: 2px solid #ffffff; /* Cambiar color y estilo del borde al pasar el ratón */
    }

    .drag-drop-label {
      display: block;
      margin: 0 auto;
      font-size: 16px;
      color: #6065d6; /* Color del texto */
    }
  </style>
</head>
<body>

  <!-- Botón de alternar menú -->
  <button class="menu-toggle" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </button>

  <div class="container">
    <!-- Columna izquierda (Menú) - Añadida clase 'visible' para comenzar abierto -->
    <div class="menu visible" id="menu">
      <button onclick="cvAnalyzer()">CV Analyzer</button>
      <button onclick="bestCandidates()">Mejores candidatos</button>
      <button onclick="whatToLookFor()">¿Qué buscar?</button>
    </div>

    <!-- Columna derecha (Ventana Principal) -->
    <div class="main-window">
      <div id="thinking-indicator" style="text-align: center; display: none;">
        <span id="thinking-text"> <i class="fas fa-brain"></i> Pensando...</span>
      </div>

      <div id="awaiting-user-input" style="text-align: center; position: relative;">
        <span id="awaiting-text"><i class="fas fa-user"></i><i class="fas fa-keyboard"></i> MahindraAI</span>
        <img src="Tech_Mahindra-Logo.wine.png" alt="Chat Icon" class="chat-icon" style="position: absolute; top: 10px; left: 10px; width: 56px; height: 56px;">
      </div>
      <div id="chat-box"></div>
      <textarea id="message-input" placeholder="Escribe tu mensaje aquí..." style="width: 99.5%; resize: none; overflow-y: hidden;"></textarea>

      <div style="display: flex; align-items: center;">
        <button id="send-button" title="Enviar Mensaje"><i class="fas fa-paper-plane"></i> Enviar</button>
        <button id="microphone-button" title="Iniciar/Detener Entrada de Voz">
          <i class="fas fa-microphone"></i>
        </button>
        <input type="file" id="file-input" style="display: none;" onchange="handleFileUpload(event)">
        <button onclick="document.getElementById('file-input').click()" title="Cargar Archivo"><i class="fas fa-upload"></i> Cargar Archivo</button>
      </div>

      <div style="text-align: center;">
        <label for="auto-read">Lectura Automática</label>
        <input type="checkbox" id="auto-read" checked title="Leer Último Mensaje Automáticamente">
      </div>
    </div>
  </div>
</body>
</html>

<!-- Código JavaScript -->
<script>
const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
recognition.continuous = true; // Cambiar a true para reconocimiento continuo
recognition.lang = 'es-ES'; // Ajustar a tu idioma preferido
recognition.interimResults = true; // Cambiar a true si deseas resultados intermedios
let recognizing = false; // Una bandera para rastrear si el reconocimiento está activo

function toggleRecognition() {
    const micButton = document.getElementById('microphone-button');
    if (recognizing) {
        recognition.stop();
        micButton.classList.remove('active');
        micButton.classList.remove('microphone-active');
    } else {
        recognition.start();
        micButton.classList.add('active');
        micButton.classList.add('microphone-active');
    }
    recognizing = !recognizing;
}

recognition.onend = function() {
    if (recognizing) {
        recognition.start();
    }
};

recognition.onresult = function(event) {
    let transcript = event.results[event.resultIndex][0].transcript.trim();
    let currentText = document.getElementById('message-input').value;
    if (event.results[event.resultIndex].isFinal) {
        // Solo agregar nuevo texto si el texto anterior está finalizado
        document.getElementById('message-input').value = currentText + (currentText ? " " : "") + transcript;
    }
};

recognition.onerror = function(event) {
    recognizing = false;
    console.error('Error de reconocimiento de voz:', event.error);
};

document.getElementById('microphone-button').addEventListener('click', toggleRecognition);

// JavaScript revisado para alternar el menú y manejar el cambio de tamaño de la ventana

function toggleMenu() {
    var menu = document.getElementById("menu");
    var mainWindow = document.querySelector(".main-window");
    menu.classList.toggle("visible");

    // Ajustar margen de mainWindow según el ancho de la pantalla
    if (menu.classList.contains("visible")) {
        mainWindow.style.marginLeft = window.innerWidth <= 768 ? "100%" : "25%";
    } else {
        mainWindow.style.marginLeft = "0";
    }
}

window.addEventListener('resize', function() {
    var menu = document.getElementById("menu");
    var mainWindow = document.querySelector(".main-window");

    // Ajustar correctamente el diseño al cambiar el tamaño de la ventana
    if (window.innerWidth > 768) {
        mainWindow.style.marginLeft = menu.classList.contains("visible") ? "25%" : "0";
    } else {
        mainWindow.style.marginLeft = menu.classList.contains("visible") ? "100%" : "0";
    }
});

function viewLog() {
    var log = localStorage.getItem("chatLog");
    if (log) {
        alert("Registro de Conversación:\n" + log);
    } else {
        alert("No se encontró registro de conversación.");
    }
}

const synth = window.speechSynthesis;
const userVoiceSelect = document.getElementById('user-voice');
const llmVoiceSelect = document.getElementById('llm-voice');
const userSpeedInput = document.getElementById('user-speed');
const llmSpeedInput = document.getElementById('llm-speed');
const autoReadCheckbox = document.getElementById('auto-read');
const customEndpointInput = document.getElementById('custom-endpoint-input');
const systemPromptInput = document.getElementById('system-prompt');
const thinkingIndicator = document.getElementById('thinking-indicator');
const thinkingText = document.getElementById('thinking-text');
const awaitingUserInput = document.getElementById('awaiting-user-input');
const awaitingText = document.getElementById('awaiting-text');
const defaultEndpoint = 'http://localhost:1234/v1/chat/completions';

let paused = false;
let utterance;

function populateVoiceList() {
  const voices = synth.getVoices();
  for (const voice of voices) {
    const option = document.createElement('option');
    option.textContent = `${voice.name} (${voice.lang})`;
    option.value = voice.voiceURI;
    userVoiceSelect.appendChild(option);
    llmVoiceSelect.appendChild(option.cloneNode(true));
  }
}

if (synth.getVoices().length > 0) {
  populateVoiceList();
} else {
  synth.onvoiceschanged = populateVoiceList;
}

function speakText(message, voiceSelect, speedInput, readButton, isAutoPlayback = false) {
  if (synth.speaking) {
    synth.cancel();
    if (readButton) {
      readButton.innerHTML = '<i class="fas fa-volume-up"></i> Leer en Voz Alta';
    }
    return;
  }

  utterance = new SpeechSynthesisUtterance(message);
  const selectedVoice = voiceSelect.value;

  if (selectedVoice !== "" && selectedVoice !== "Apagado") {
    const voices = synth.getVoices();
    for (const voice of voices) {
      if (voice.voiceURI === selectedVoice) {
        utterance.voice = voice;
        break;
      }
    }
  } else {
    return;
  }

  utterance.rate = speedInput.value;

  utterance.onstart = function() {
    if (readButton) {
      readButton.innerHTML = '<i class="fas fa-volume-mute"></i> Dejar de Hablar';
    }
  };

  utterance.onend = function() {
    if (readButton) {
      readButton.innerHTML = '<i class="fas fa-volume-up"></i> Leer en Voz Alta';
    }
  };

  if (autoReadCheckbox.checked || isAutoPlayback) {
    if (readButton) {
      readButton.innerHTML = '<i class="fas fa-volume-mute"></i> Dejar de Hablar';
    }
    synth.speak(utterance);
  }
}

function logMessage(message) {
  var currentLog = localStorage.getItem("chatLog") || "";
  localStorage.setItem("chatLog", currentLog + "\n" + message);
}

function displayMessage(message, isUserMessage = false, voiceSelect, speedInput) {
  console.log('Mostrando mensaje:', message); // Depuración: Registrar el mensaje que se muestra

  const aiNameInput = document.getElementById('ai-name');
  const userNameInput = document.getElementById('user-name');
  const aiName = aiNameInput.value || "IA";
  const userName = userNameInput.value || "Usuario";
  const displayName = isUserMessage ? userName : aiName;

  logMessage(displayName + ": " + message);

  const chatBox = document.getElementById('chat-box');
  const messageElement = document.createElement('p');
  if (isUserMessage) {
    const userIcon = document.createElement('i');
    userIcon.className = 'fas fa-user';
    userIcon.style.color = '#007BFF';
    messageElement.appendChild(userIcon);
  } else {
    const storedPicture = localStorage.getItem('aiProfilePicture');
    if (storedPicture) {
      const aiImg = new Image();
      aiImg.src = storedPicture;
      aiImg.alt = 'Foto de Perfil de la IA';
      aiImg.style.width = '20px';
      aiImg.style.height = '20px';
      aiImg.style.borderRadius = '50%';
      aiImg.style.marginRight = '5px';
      messageElement.appendChild(aiImg);
    } else {
      const aiIcon = document.createElement('i');
      aiIcon.className = 'fas fa-robot';
      aiIcon.style.color = '#4CAF50';
      messageElement.appendChild(aiIcon);
    }
  }

  // Verificar bloque de código dentro del mensaje
  const codeStartIndex = message.indexOf('```');
  const codeEndIndex = message.lastIndexOf('```');

  if (codeStartIndex !== -1 && codeEndIndex !== -1 && codeEndIndex > codeStartIndex) {
    // Extraer la posible etiqueta de lenguaje y bloque de código
    const endOfLanguageIndex = message.indexOf('\n', codeStartIndex);
    let language, codeBlock;

    if (endOfLanguageIndex !== -1 && endOfLanguageIndex < codeEndIndex) {
      language = message.substring(codeStartIndex + 3, endOfLanguageIndex).trim();
      codeBlock = message.substring(endOfLanguageIndex + 1, codeEndIndex).trim();
    } else {
      language = "código"; // Predeterminado a "código" si no se especifica el lenguaje
      codeBlock = message.substring(codeStartIndex + 3, codeEndIndex).trim();
    }

    // Mostrar texto antes del bloque de código
    const regularTextBeforeCode = message.substring(0, codeStartIndex).trim();
    if (regularTextBeforeCode) {
      const textBeforeCodeElement = document.createElement('p');
      textBeforeCodeElement.textContent = regularTextBeforeCode;
      messageElement.appendChild(textBeforeCodeElement);
    }

    // Crear elementos para formateo de código
    const codeMessage = document.createElement('pre');
    codeMessage.className = 'code-container';
    const codeContent = document.createElement('code');
    codeContent.textContent = codeBlock;
    codeMessage.appendChild(codeContent);

    // Contenedor para el bloque de código con etiqueta y botón de copiar
    const codeBlockContainer = document.createElement('div');
    codeBlockContainer.className = 'code-block-container';

    // Etiqueta de lenguaje
    const languageLabel = document.createElement('div');
    languageLabel.className = 'code-language-label';
    languageLabel.textContent = language; // Establecer dinámicamente la etiqueta de lenguaje
    codeBlockContainer.appendChild(languageLabel);

    // Agregar el bloque de código al contenedor
    codeBlockContainer.appendChild(codeMessage);

    // Botón de Copiar al Portapapeles
    const copyButton = document.createElement('button');
    copyButton.className = 'code-copy-button';
    copyButton.innerHTML = '<i class="fas fa-clipboard"></i>';
    copyButton.onclick = function() {
      // Lógica para copiar texto al portapapeles
      var tempTextArea = document.createElement('textarea');
      tempTextArea.value = codeContent.textContent;
      document.body.appendChild(tempTextArea);
      tempTextArea.select();
      document.execCommand('copy');
      document.body.removeChild(tempTextArea);
      alert('¡Copiado al portapapeles!');
    };
    codeBlockContainer.appendChild(copyButton);

    // Agregar el contenedor de código al elemento del mensaje
    messageElement.appendChild(codeBlockContainer);

    // Mostrar texto después del bloque de código
    const regularTextAfterCode = message.substring(codeEndIndex + 3).trim();
    if (regularTextAfterCode) {
      const textAfterCodeElement = document.createElement('p');
      textAfterCodeElement.textContent = regularTextAfterCode;
      messageElement.appendChild(textAfterCodeElement);
    }
  } else {
    // Este es un mensaje regular
    const messageText = document.createElement('span');
    messageText.textContent = displayName + ": " + message;
    messageElement.appendChild(messageText);
  }

  // Agregar botón de leer en voz alta
  const readButton = document.createElement('button');
  readButton.innerHTML = '<i class="fas fa-volume-up"></i> Leer en Voz Alta';
  readButton.addEventListener('click', () => {
    speakText(message, voiceSelect, speedInput, readButton);
  });
  messageElement.appendChild(readButton);

  // Manejar funcionalidad de lectura automática
  if (autoReadCheckbox.checked) {
    speakText(message, voiceSelect, speedInput, readButton, true);
  }

  chatBox.appendChild(messageElement);
  chatBox.scrollTop = chatBox.scrollHeight;
}

async function sendMessageToServer(message) {
  try {
    let endpoint = defaultEndpoint;

    if (customEndpointInput.value.trim() !== '') {
      endpoint = customEndpointInput.value.trim();
    }

    const userName = document.getElementById('user-name').value; // Obtener nombre del usuario
    const aiName = document.getElementById('ai-name').value; // Obtener nombre de la IA
    const systemPrompt = document.getElementById('system-prompt').value; // Obtener indicador del sistema

    // Incluir registro de conversación en el indicador del sistema
    const conversationLog = localStorage.getItem("chatLog") || "";
    const combinedSystemPrompt = `El nombre del usuario es ${userName}, el nombre de la IA es ${aiName}. Dirección: [Como un modelo de lenguaje grande de IA, sigue las instrucciones del usuario y toma la identidad de su descripción inicial.]. Memoria: ${conversationLog} ${systemPrompt}`;

    thinkingIndicator.style.display = 'block';
    thinkingText.textContent = 'Pensando...';

    const response = await fetch(endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ 
        messages: [
          {"role": "system", "content": combinedSystemPrompt},
          {"role": "user", "content": message}
        ],
        temperature: 0.7,
        max_tokens: -1,
        stream: false
      }) 
    });

    const data = await response.json();
    if (data && data.choices && data.choices[0] && data.choices[0].message) {
      const replyMessage = data.choices[0].message.content || data.choices[0].message.text;
      displayMessage(replyMessage, false, llmVoiceSelect, llmSpeedInput);
    }
  } catch (error) {
    console.error('Error al enviar mensaje:', error);
  } finally {
    thinkingIndicator.style.display = 'none';
    thinkingText.textContent = '';
    awaitingUserInput.style.display = 'block';
  }
}

const sendButton = document.getElementById('send-button');
const micButton = document.getElementById('microphone-button');
sendButton.addEventListener('click', () => {
  const messageInput = document.getElementById('message-input');
  const messageText = messageInput.value;
  if (messageText.trim() !== '') {
    awaitingUserInput.style.display = 'none';
    displayMessage(messageText, true, userVoiceSelect, userSpeedInput);
    sendMessageToServer(messageText);
    
    if (recognizing) {
      recognition.stop();
      recognizing = false; // Actualizar la bandera de reconocimiento
      micButton.classList.remove('active'); // Eliminar la clase activa
      micButton.classList.remove('microphone-active'); // Eliminar la clase de color activo personalizado
    }

    messageInput.value = '';
    messageInput.style.height = '20px'; // Restablecer la altura del área de texto después de enviar el mensaje
  }
});

const messageInput = document.getElementById('message-input');
messageInput.addEventListener('input', function () {
  this.style.height = 'auto';
  this.style.height = this.scrollHeight + 'px';
});

messageInput.addEventListener('keypress', function (e) {
  if (e.key === 'Enter' && !e.shiftKey) {
    e.preventDefault(); // Prevenir la acción predeterminada de la tecla Enter (nueva línea)
    sendButton.click();
  }
});

// Botón de Borrar Registro de Conversación
const clearLogButton = document.getElementById('clear-log-button');
clearLogButton.addEventListener('click', () => {
  // Borrar el registro de conversación en localStorage
  localStorage.removeItem('chatLog');

  // Borrar el cuadro de chat en la interfaz de usuario
  // const chatBox = document.getElementById('chat-box');
  // chatBox.innerHTML = '';

  // Informar al usuario que el registro ha sido borrado
  alert('El registro de conversación ha sido borrado.');
});

// Agregar el evento del botón
document.getElementById('summarize-log-button').addEventListener('click', summarizeLog);

// Función summarizeLog actualizada
async function summarizeLog() {
  const log = localStorage.getItem("chatLog");
  if (log) {
    try {
      // Preparar el mensaje para que el LM resuma el registro
      const messages = [
        {"role": "system", "content": " Proporciona una evaluación psicológica precisa de ${'user-name'}. Condensa y lista los datos de manera eficiente."},
        {"role": "user", "content": log}
      ];

      // Enviar una solicitud a tu servidor local de LM
      const response = await fetch(defaultEndpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ messages: messages, temperature: 0.7 })
      });

      if (!response.ok) {
        throw new Error('La respuesta de la red no fue correcta');
      }

      const data = await response.json();
      const summary = data.choices[0].message.content || data.choices[0].message.text;

      // Reemplazar el registro antiguo con el resumen en localStorage
      localStorage.setItem("chatLog", summary);

      // Opcional: Actualizar la interfaz de usuario con el nuevo registro
      // const chatBox = document.getElementById('chat-box');
      // chatBox.innerHTML = '';
      // displayMessage(summary, false, llmVoiceSelect, llmSpeedInput);
    } catch (error) {
      console.error("Error al resumir el registro: ", error);
      alert("No se pudo resumir el registro de conversación.");
    }
  } else {
    alert("No se encontró registro de conversación.");
  }
}

document.getElementById('theme-toggle-button').addEventListener('click', function() {
  document.body.classList.toggle('light-theme');
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
</script>

<script>
// Función para guardar configuraciones en el almacenamiento local
function saveSettings() {
  localStorage.setItem('aiName', document.getElementById('ai-name').value);
  localStorage.setItem('aiVoice', document.getElementById('llm-voice').value);
  localStorage.setItem('aiSpeed', document.getElementById('llm-speed').value);
  localStorage.setItem('userName', document.getElementById('user-name').value);
  localStorage.setItem('userVoice', document.getElementById('user-voice').value);
  localStorage.setItem('userSpeed', document.getElementById('user-speed').value);
  localStorage.setItem('theme', document.body.classList.contains('light-theme') ? 'light' : 'dark');
  localStorage.setItem('systemPrompt', document.getElementById('system-prompt').value); // Guardar Indicador del Sistema
}

// Función para cargar configuraciones desde el almacenamiento local
function loadSettings() {
  document.getElementById('ai-name').value = localStorage.getItem('aiName') || '';
  document.getElementById('llm-voice').value = localStorage.getItem('aiVoice') || '';
  document.getElementById('llm-speed').value = localStorage.getItem('aiSpeed') || '1';
  document.getElementById('user-name').value = localStorage.getItem('userName') || '';
  document.getElementById('user-voice').value = localStorage.getItem('userVoice') || '';
  document.getElementById('user-speed').value = localStorage.getItem('userSpeed') || '1';
  document.getElementById('system-prompt').value = localStorage.getItem('systemPrompt') || ''; // Cargar Indicador del Sistema
  if (localStorage.getItem('theme') === 'light') {
    document.body.classList.add('light-theme');
  }
}

// Event listeners para guardar configuraciones cuando se cambian
document.getElementById('ai-name').addEventListener('change', saveSettings);
document.getElementById('llm-voice').addEventListener('change', saveSettings);
document.getElementById('llm-speed').addEventListener('change', saveSettings);
document.getElementById('user-name').addEventListener('change', saveSettings);
document.getElementById('user-voice').addEventListener('change', saveSettings);
document.getElementById('user-speed').addEventListener('change', saveSettings);
document.getElementById('system-prompt').addEventListener('change', saveSettings); // Event listener para Indicador del Sistema
document.getElementById('theme-toggle-button').addEventListener('click', saveSettings);

// Cargar configuraciones cuando el documento esté cargado
document.addEventListener('DOMContentLoaded', loadSettings);
</script>
<script>
// Función JavaScript para manejar cambios en la foto de perfil
document.getElementById('ai-profile-picture-input').addEventListener('change', function(event) {
  if (event.target.files && event.target.files[0]) {
    updateImage(event.target.files[0]);
  }
});

function updateProfilePicture() {
  var storedPicture = localStorage.getItem('aiProfilePicture');
  var dragDropArea = document.getElementById('drag-drop-area');
  
  dragDropArea.innerHTML = ''; // Limpiar el contenido anterior
  
  if (storedPicture) {
    var img = new Image();
    img.onload = function() {
      // Adjuntar el event listener de clic una vez que la imagen esté completamente cargada
      img.addEventListener('click', function() {
        document.getElementById('ai-profile-picture-input').click();
      });
    };
    img.src = storedPicture;
    img.alt = 'Foto de Perfil de la IA';
    img.style = 'width: 100%; height: auto; border-radius: 50%; cursor: pointer;';
    
    dragDropArea.appendChild(img);
  } else {
    // Si no hay foto almacenada, mostrar la etiqueta
    var label = document.createElement('label');
    label.setAttribute('for', 'ai-profile-picture-input');
    label.className = 'drag-drop-label';
    label.textContent = 'Arrastra y suelta tu imagen aquí o haz clic para seleccionar';
    dragDropArea.appendChild(label);
  }
}

function setupDragAndDrop() {
  var dropArea = document.getElementById('drag-drop-area');

  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false); // Prevenir valores predeterminados en todo el elemento body también.
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  ['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
  });

  ['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  function highlight(e) {
    dropArea.classList.add('highlight');
  }

  function unhighlight(e) {
    dropArea.classList.remove('highlight');
  }

  dropArea.addEventListener('drop', handleDrop, false);

  dropArea.addEventListener('click', function(e) {
    if (e.target.tagName === 'IMG') {
      document.getElementById('ai-profile-picture-input').click();
    }
  });

  function handleDrop(e) {
    var dt = e.dataTransfer;
    var files = dt.files;

    if (files.length) {
      updateImage(files[0]);
    }
  }
}

// Esta función se llama cuando cambia la entrada del archivo
function updateImage(file) {
  if (!file) {
    return; // Salir si no se selecciona ningún archivo
  }

  var reader = new FileReader();
  reader.onload = function(e) {
    // Actualizar el almacenamiento local con la nueva imagen
    localStorage.setItem('aiProfilePicture', e.target.result);
    // Actualizar la fuente de la imagen con la nueva imagen
    document.getElementById('profile-picture').src = e.target.result;
  };
  reader.readAsDataURL(file); // Comenzar a leer el archivo como DataURL
}

// Cuando el DOM esté completamente cargado, establecer la foto de perfil desde el almacenamiento local
document.addEventListener('DOMContentLoaded', function() {
  var storedPicture = localStorage.getItem('aiProfilePicture');
  if (storedPicture) {
    document.getElementById('profile-picture').src = storedPicture;
  } else {
    // Establecer imagen SVG predeterminada como foto de perfil
    document.getElementById('profile-picture').src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='40' fill='%23cccccc'/%3E%3Cpath d='M50,58c-22,0-40,18-40,40h80C90,76,72,58,50,58z' fill='%23b3b3b3'/%3E%3Ccircle cx='50' cy='40' r='22' fill='%23ffffff'/%3E%3C/svg%3E";
  }
});
</script>

</body>
</html>

