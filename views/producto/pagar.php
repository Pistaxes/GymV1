<?php

require_once '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51OKXdZG1jX1oNbL4YMzT6NBXFedxRir5t0QFZhxyMoGWyXvUjaL2Drx8E4jzEg5gepPwIXdBCQPbk1qJQdawIOic00XHxwstAo');

$token = $_POST['stripeToken'];
$total = $_POST['monto'];
$nombre =$_POST['nombre'];
try {
  
  $charge = \Stripe\Charge::create([
    'amount' => $total * 100,
    'currency' => 'MXN',
    'source' => $token,
  ]);
  echo '<h1>Tu pago a sido realizado con exito </h1>';
  echo $nombre;

} catch (\Stripe\Exception\CardError $e) {
  
  echo $e->getMessage();
}

$script="<script src='build/js/graficas.js'></script>";


?>