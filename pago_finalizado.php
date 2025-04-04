<?php
  include_once 'includes/templates/header.php';
  use PayPal\Rest\ApiContext;
  use PayPal\Api\PaymentExecution;
  use PayPal\Api\Payment;
  require 'includes/paypal.php'
?>
<section class="section contenedor">
  <h2>Resumen de registro</h2>
  <?php
      $paymentId = $_GET['paymentId'];
      $id_pago = $_GET['id_pago'];

      // Petición a REST API para saber si el usuario realmente pagó
      $pago = Payment::get($paymentId, $apiContext);
      $execution = new PaymentExecution();
      $execution->setPayerId($_GET['PayerID']);
      $resultado = $pago->execute($execution, $apiContext);
      $respuesta = $resultado->$transactions[0]->related_resources[0]->sale->state;
      if($respuesta == "completed") {
        echo "<div class='resultado correcto'>";
        echo "El pago se realizo correctamente! <br/>";
        echo "El id es {$paymentId}";
        echo "</div>"
        require_once('includes/functions/bd_conexion.php');
        $stmt = $conn->prepare('UPDATE registrados SET pagado = ? WHERE id = ?');
        $pagado = 1;
        $stmt->bind_param('ii', $pagado, $id_pago);
        $stmt->execute();
        $stmt->close();
        $conn->close();
      } else {
        echo "<div class='resultado error'>">
        echo "El pago no fue realizado correctamente.";
        echo "</div>";
      }
   ?>
</section>
<?php include_once 'includes/templates/footer.php'; ?>
