<?php if(isset($_POST['submit'])):
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $fecha = date('Y-m-d H:i:s');
  $regalo = $_POST['regalo'];
  $total = $_POST['total_pedido'];
  // Pedidos
  $boletos = $_POST['boletos'];
  $camisas = $_POST['pedido_camisas'];
  $etiquetas = $_POST['pedido_etiquetas'];
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
      $stmt->close();
      $conn->close();
      header('Location: validar_registro.php?exito=true');
    } catch(\Exception $e){
      echo $e->getMessage();
    }
  endif; ?>
<?php include_once 'includes/templates/header.php'; ?>
<section class="section contenedor">
  <h2>Resumen de registro</h2>
  <?php
    if(isset($_GET['ok'])):
      if($_GET['ok'] == "1"):
        echo "La reserva se realizó exitosamente!";
      endif;
    endif;
  ?>
</section>
<?php include_once 'includes/templates/footer.php'; ?>
