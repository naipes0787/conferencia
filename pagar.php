<?php

 if(!isset($_POST['submit'])) {
   exit("Hubo un error al intentar reservar");
 }

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'includes/paypal.php';

if(isset($_POST['submit'])):
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $fecha = date('Y-m-d H:i:s');
  $regalo = $_POST['regalo'];
  $total = $_POST['total_pedido'];
  // Pedidos
  $boletos = $_POST['boletos'];
  $cantidad_boletos = $boletos;
  $pedidoExtra = $_POST['pedido_extra'];
  $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
  $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];
  $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
  $precioEtiqueta = $_POST['pedido_extra']['etiquetas']['precio'];
  include_once 'includes/functions/funciones.php';
  $pedido = productos_json($boletos, $camisas, $etiquetas);
  // Eventos
  $eventos = $_POST['registro'];
  $registro = eventos_json($eventos);

  try{
    require_once('includes/functions/bd_conexion.php');
    $stmt = $conn->prepare("INSERT INTO registrados(nombre, apellido,
      email, fecha_registro, pases_articulos, talleres_registrados, regalo_id,
      total_pagado) VALUES (?,?,?,?,?,?,?,?);");
      $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido,
      $registro, $regalo, $total);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      $stmt->close();
      $conn->close();
      // header('Location: validar_registro.php?exito=true');
    } catch(\Exception $e){
      echo $e->getMessage();
    }
endif;

$compra = new Payer();
$compra->setPaymentMethod('paypal');

$i = 0;
$array_pedido = array();
foreach($cantidad_boletos as $key => $value){
  if((int)$value['cantidad'] > 0){
    ${"articulo$i"} = new Item();
    $array_pedido[] = ${"articulo$i"};
    ${"articulo$i"}->setName('Pase: ' . $key)
                   ->setCurrency('USD')
                   ->setQuantity((int) $value['cantidad'])
                   ->setPrice((int) $value['precio']);
    $i++;
  }
}
// $i = 0;
foreach($pedidoExtra as $key => $value){
  if((int)$value['cantidad'] > 0){
    if($key == 'camisas') {
      $precio = (float) $value['precio']* .93;
    } else {
      $precio = (float) $value['precio'];
    }
    ${"articulo$i"} = new Item();
    $array_pedido[] = ${"articulo$i"};
    ${"articulo$i"}->setName('Extras: ' . $key)
                   ->setCurrency('USD')
                   ->setQuantity((int) $value['cantidad'])
                   ->setPrice($precio);
    $i++;
  }
}

$listaArticulos = new ItemList();
$listaArticulos->setItems($array_pedido);

// Comento ya que no hay envíos
// $envio = 0;
// $detalles = new Details();
// $detalles->setShipping($envio)
//          ->setSubtotal($precio);

$cantidad = new Amount();
$cantidad->setCurrency('USD')
         ->setTotal($total);

$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
               ->setItemList($listaArticulos)
               ->setDescription('Pago Conferencia')
               ->setInvoiceNumber($id_registro);

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?id_pago={$id_registro}")
              ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?id_pago={$id_registro}");

$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));

try {
  $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
  // Don't spit out errors or use "exit" like this in production code
  echo '<pre>';
  print_r(json_decode($pce->getData()));
  echo '</pre>';
  exit;
}

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");
