<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mahindra.ai</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="stylessearch.css">
  <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
  <!-- Menú -->
  <button class="menu-toggle" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </button>

  <div class="container">
    <!-- Menú lateral -->
    <div class="menu visible" id="menu">
      <div class="menu-image">
        <img src="logo.png" alt="MahindraAI">
      </div>

      <div class="icon-home">
        <button onclick="cvAnalyzer()"><i class='bx bx-home-alt'></i>CV Analyzer</button>
        <button onclick="bestCandidates()"><i class='bx bx-search-alt'></i>Mejores candidatos</button>
        <button onclick="whatToLookFor()"><i class='bx bx-file-find'></i>¿Qué buscar?</button>
      </div>

      <!-- Botón de Cerrar sesión -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Cerrar sesión</button>
      </form>
    </div>

    <!-- Ventana principal -->
    <div class="main-window">
      <!-- Indicador de pensando -->
      <div id="thinking-indicator" style="text-align: center; display: none;">
        <span id="thinking-text"> <i class="fas fa-brain"></i> Pensando...</span>
      </div>

      <!-- Mensaje de espera -->
      <div id="awaiting-user-input" style="text-align: center; position: relative;">
        <span id="awaiting-text"><i class="fas fa-user"></i><i class="fas fa-keyboard"></i> MahindraAI</span>
      </div>

      <!-- Caja de chat -->
      <div id="chat-box"></div>

 
      <!-- Entrada de texto -->
      <textarea id="message-input" placeholder="Escribe tu mensaje aquí..."></textarea> 

      <!-- Controles -->
      <div class="controls">
        <button id="send-button"><i class="fas fa-paper-plane"></i> Enviar</button>
        <button id="microphone-button"><i class="fas fa-microphone"></i></button>
        <input type="file" id="file-input" style="display: none;" onchange="handleFileUpload(event)">
        <button onclick="document.getElementById('file-input').click()"><i class="fas fa-upload"></i> Cargar Archivo</button>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
