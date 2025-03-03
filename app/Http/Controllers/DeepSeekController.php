<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use function Pest\Laravel\post;
use Symfony\Component\Process\Process;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;
use Smalot\PdfParser\Parser;

class DeepSeekController extends Controller
{
    public function procesarCV(Request $request)
    {
        if (!$request->hasFile('archivo')) {
            return response()->json(['error' => 'No se subió ningún archivo'], 400);
        }

        $archivo = $request->file('archivo');
        $extension = $archivo->getClientOriginalExtension();
        $filePath = $archivo->getPathname();

        $contenido = '';

        // Procesar diferentes tipos de archivo
        if ($extension == 'csv') {
            // Procesar CSV
            $contenido = $this->procesarCSV($filePath);
        } elseif ($extension == 'docx') {
            // Procesar DOCX
            $contenido = $this->procesarDOCX($filePath);
        } elseif ($extension == 'pdf') {
            // Procesar PDF
            $contenido = $this->procesarPDF($filePath);
        } elseif ($extension == 'txt') {
            // Procesar TXT
            $contenido = file_get_contents($filePath);
        } else {
            return response()->json(['error' => 'Tipo de archivo no soportado'], 400);
        }

        // Llamar a la IA para analizar el contenido del CV
        $respuestaIA = $this->analizarCurriculumConIA($contenido);

        return response()->json(['respuesta' => $respuestaIA]);
    }

    // Procesar archivo CSV
    public function procesarCSV($filePath)
    {
        $csvData = file_get_contents($filePath);
        return $csvData; // Puede ser procesado según sea necesario
    }

    // Procesar archivo DOCX
    public function procesarDOCX($filePath)
    {
        $phpWord = IOFactory::load($filePath);
        $contenido = '';
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof Text) {
                    $contenido .= $element->getText();
                }
            }
        }
        return $contenido;
    }

    // Procesar archivo PDF
    public function procesarPDF($filePath)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);
        $contenido = $pdf->getText(); // Aquí extrae el texto
    
        return $contenido;
    }

    public function procesarMensajeUsuario(Request $request)
{
    // Obtener el mensaje del usuario de la solicitud
    $mensajeUsuario = $request->input('mensaje');  // Aquí se espera el mensaje del usuario como un texto

    // Validar que el mensaje no esté vacío
    if (empty($mensajeUsuario)) {
        return response()->json(['error' => 'No se recibió un mensaje'], 400);
    }

    // Llamar a la función para procesar el mensaje con la IA
    $respuestaIA = $this->analizarCurriculumConIA($mensajeUsuario);

    // Devolver la respuesta procesada
    return response()->json(['respuesta' => $respuestaIA]);
}
    // Función para enviar a la IA y analizar el contenido
    public function analizarCurriculumConIA($mensajeUsuario)
{
    // Definir la clave de API y la URL de la API de DeepSeek
    $apiKey = 'sk-cab0d97cc1264ebfba335fec2c1a3fc0';
    $url = 'https://api.deepseek.com'; // URL de la API de DeepSeek (o OpenAI)

    // Crear la solicitud para enviar a la API
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ])->post($url, [
        'model' => 'deepseek-chat',  // Usar el modelo adecuado
        'messages' => [
            ["role" => "system", "content" => "Eres un asistente que analiza currículums."],
            ["role" => "user", "content" => $mensajeUsuario],  // Aquí va el mensaje del usuario
        ]
    ]);

    // Verificar la respuesta de la API
    $responseJson = $response->json();

    // Asegurarse de que la respuesta contiene lo esperado
    if (isset($responseJson['choices'][0]['message']['content'])) {
        return response()->json([
            'response' => $responseJson['choices'][0]['message']['content']
        ]);
    } else {
        // En caso de que la respuesta no sea válida
        return 'Hola en que puedo ayudarte';
    }
}


}
