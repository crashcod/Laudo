<?php
// Inclua o autoload do Composer para carregar bibliotecas
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// Inicialize o objeto Dompdf
$dompdf = new Dompdf();

// Conteúdo HTML do laudo médico
$html = '
<html>
<head>
    <title>Laudo Médico</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; }
        .content { margin-top: 20px; }
        .footer { text-align: center; margin-top: 50px; }
        img { width: 100%; height: auto; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laudo Médico</h1>
    </div>
    <div class="content">
        <!-- Conteúdo do laudo -->
        <p>Nome do Paciente: [Nome]</p>
        <p>Data: [Data]</p>
        <p>Descrição: [Descrição]</p>
        <!-- Inserir imagem -->
        <img src="caminho/para/sua/imagem.jpg" alt="Imagem Médica">
    </div>
    <div class="footer">
        <p>Assinatura do Médico</p>
    </div>
</body>
</html>
';

// Carregar o conteúdo HTML
$dompdf->loadHtml($html);

// (Opcional) Configure o tamanho do papel e a orientação
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Saída do PDF gerado para o navegador
$dompdf->stream("laudo_medico.pdf", array("Attachment" => false));
?>
