<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir CSV</title>
</head>

<body>
    <h2>Sube un archivo CSV para analizar</h2>
    <form id="formulario" enctype="multipart/form-data">
        <input type="file" name="archivo" id="archivo">
        <button type="submit">Enviar</button>
    </form>
    <p id="respuesta"></p>
    <input type="file" name="archivo" id="file-input" accept="/" style="display: none;"
        onchange="mostrarNombreArchivo()">

    <script>
        document.getElementById("formulario").addEventListener("submit", function (e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("archivo", document.getElementById("archivo").files[0]);

            fetch("http://localhost/procesar-csv", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("respuesta").innerText = data.respuesta;
                })
                .catch(error => console.error("Error:", error));
        });
    </script>
</body>

</html>