<?php include_once 'includes/templates/header.php'; ?>
  <section class="seccion contenedor">
    <h2>Calendario de Eventos</h2>
    <?php
      try{
        require_once('includes/functions/bd_conexion.php');
        $sql = "SELECT e.id as evento_id, e.nombre as evento_nombre, ";
        $sql .= " e.fecha as evento_fecha, e.hora as evento_hora, ";
        $sql .= " ce.descripcion as categoria_evento, ce.icono as icono, ";
        $sql .= " i.nombre as invitado_nombre, i.apellido as invitado_apellido ";
        $sql .= " FROM eventos as e ";
        $sql .= " INNER JOIN categoria_evento as ce ";
        $sql .= " ON e.id_categoria_evento = ce.id ";
        $sql .= " INNER JOIN invitados as i ";
        $sql .= " ON e.id_invitado = i.id ";
        $sql .= " ORDER BY e.id ";
        $resultado = $conn->query($sql);
      } catch(\Exception $e){
        echo $e->getMessage();
      }
     ?>
     <div class="calendario">
      <?php
        $calendario = array();
        while($eventos = $resultado->fetch_assoc()){
          //obtener fecha del evento
          $fecha = $eventos['evento_fecha'];
          $evento = array(
            'titulo' => $eventos['evento_nombre'],
            'fecha' => $eventos['evento_fecha'],
            'hora' => $eventos['evento_hora'],
            'categoria' => $eventos['categoria_evento'],
            'icono' => $eventos['icono'],
            'invitado' => $eventos['invitado_nombre'] . " " . $eventos['invitado_apellido']
          );

          $calendario[$fecha][] = $evento;
          ?>
        <?php } // while de fetch_assoc() ?>
        <?php
          //Imprimir Eventos
          foreach($calendario as $dia => $lista_eventos){ ?>
              <h3>
                <i class="fa fa-calendar-alt"></i>
                <?php
                  // LINUX
                  setlocale(LC_TIME, 'es_ES.UTF');
                  // WINDOWS
                  setlocale(LC_TIME, 'spanish');

                  echo strftime("%A, %d de %B del %Y", strtotime($dia));
                ?>
              </h3>
              <?php foreach($lista_eventos as $evento) { ?>
                <div class="dia">
                  <p class="titulo"><?php echo $evento['titulo']; ?></p>
                  <p class="hora">
                    <i class="fa fa-clock" aria-hidden="true"></i>
                    <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                  </p>
                  <p>
                    <i class="fa <?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                    <?php echo $evento['categoria']; ?>
                  </p>
                  <p class="hora">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo $evento['invitado']; ?>
                  </p>
                </div>
              <?php } //fin foreach eventos ?>
          <?php } // fin foreach días ?>
     </div> <!-- Fin div calendario -->

     <?php
       $conn->close();
     ?>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>
