<?php

require_once '../vendor/autoload.php';


\Stripe\Stripe::setApiKey('sk_test_51OKXdZG1jX1oNbL4YMzT6NBXFedxRir5t0QFZhxyMoGWyXvUjaL2Drx8E4jzEg5gepPwIXdBCQPbk1qJQdawIOic00XHxwstAo');
ob_start();
use Model\Ticket;
use Model\Producto;
use Dompdf\Dompdf;
use TCPDF;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$id= $_SESSION['id'];
$token = $_POST['stripeToken'];
$total = $_POST['monto'];

try {
  
  $charge = \Stripe\Charge::create([
    'amount' => $total * 100,
    'currency' => 'MXN',
    'source' => $token,
  ]);
  $consulta ="SELECT c.*, p.nombre, p.precio as precioUnitario, sum(c.cantidad* p.precio) as subtotal from carrito c
  join usuarios u on c.usuarioId = u.id
  join producto p on c.productoId = p.id
  where u.id = '${id}'
  group by 1;";
  $resultado = Ticket::SQL($consulta);

  $producto= Producto::eliminarTabla($id);
  
  // Crear un nuevo objeto PDF
  $pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Ticket de Compra');

// Agregar una página
$pdf->AddPage();

// HTML para el ticket de compra
$html = '<h1>Ticket de Compra</h1>';
$html .= '<table border="1" style="width:100%;border-collapse:collapse;">
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Precio Unitario ID</th>
        <th>Subtotal</th>
    </tr>';
$datos=[];
// Generar filas con los detalles de compra
foreach ($resultado as $detalle) {
    $html .= '<tr>';
    $html .= '<td>' . $detalle->id . '</td>';
    $html .= '<td>' . $detalle->nombre . '</td>';
    $html .= '<td>' . $detalle->precioUnitario . '</td>';
    $html .= '<td>' . $detalle->subtotal . '</td>';
    $html .= '</tr>';
    $datos[]= $detalle->subtotal;
}
$total = (array_sum($datos));
$html .= '</table>';

$html .='<h2>Tu total a pagar es de $ '.$total.'</h2>';


// Escribir el HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Guardar el PDF en el servidor
$ruta_pdf ='/ticket_de_compra.pdf';
$pdf->Output(__DIR__ . '/ticket_de_compra.pdf', 'F');
echo 'PDF generado y guardado como ticket_de_compra.pdf';


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USER'];
    $mail->Password = $_ENV['EMAIL_PASS'];

    // Configuración del remitente y destinatario
    $mail->From="sceii.itcelaya@gmail.com";
    $mail->addAddress($_SESSION['email']);

    // Contenido del correo electrónico
    $mail->isHTML(true);
    $mail->Subject = 'Adjunto: Ticket de Compra';
    $mail->Body = 'Adjunto encontrarás el ticket de compra generado.';
    $url = __DIR__ . '/ticket_de_compra.pdf';
    $fichero = file_get_contents($url);
    $mail->addStringAttachment($fichero, 'ticket_de_compra.pdf');
    //$mail->addAttachment($ruta_pdf, 'ticket_de_compra.pdf'); // Adjuntar el archivo PDF generado

    // Enviar el correo electrónico
    $mail->send();
    echo 'Correo enviado correctamente con el archivo adjunto.';

  echo '<h1>Tu pago a sido realizado con exito </h1>';
  

} catch (\Stripe\Exception\CardError $e) {
  echo 'Error al enviar el correo: ', $mail->ErrorInfo;
  echo $e->getMessage();
}


        


$script="<script src='build/js/graficas.js'></script>";


?>