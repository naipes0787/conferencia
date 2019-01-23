<?php
  try{
    require_once('includes/functions/bd_conexion.php');
    $sql = "SELECT * ";
    $sql .= " FROM invitados";
    $resultado = $conn->query($sql);
  } catch(\Exception $e){
    echo $e->getMessage();
  }
 ?>
 <section class="invitados contenedor seccion">
   <h2>Nuestro invitados</h2>
   <ul class="lista-invitados clearfix">
   <?php
    while($invitados = $resultado->fetch_assoc()){?>
        <li>
          <div class="invitado">
            <a class="invitado-info" href="#invitado<?php echo $invitados['id']; ?>">
              <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="imagen invitado <?php echo $invitados['id']; ?>">
              <p><?php echo $invitados['nombre'] . " " . $invitados['apellido']; ?></p>
            </a>
          </div>
        </li>
        <div style="display:none;">
          <div class="invitado-info" id="invitado<? echo $invitados['id']; ?>">
            <h2><?php echo $invitados['nombre'] . " " . $invitados['apellido']; ?></h2>
            <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="imagen invitado <?php echo $invitados['id']; ?>">
            <p>
              <? echo $invitados['descripcion']; ?>
            </p>
          </div>
        </div>
  <?php } // while de fetch_assoc() ?>
  </ul>
  </section> <!-- invitados -->
 <?php
   $conn->close();
 ?>
