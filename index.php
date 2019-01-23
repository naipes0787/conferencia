<?php include_once 'includes/templates/header.php'; ?>
  <section class="seccion contenedor">
    <h2>La mejor conferencia de diseño web en español</h2>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </p>
  </section>

  <section class="programa">
    <div class="contenedor-video">
      <video autoplay loop poster="img/bg-talleres.jpg">
        <source src="video/video.mp4" type="video/mp4">
        <source src="video/video.webm" type="video/webm">
        <source src="video/video.ogv" type="video/ogv">
      </video>
    </div> <!-- contenido-video -->
    <div class="contenido-programa">
      <div class="contenedor">
        <div class="programa-evento">
          <h2>Programa del evento</h2>
          <?php
            try{
              require_once('includes/functions/bd_conexion.php');
              $sql = "SELECT * FROM categoria_evento as e ";
              $resultado = $conn->query($sql);
            } catch(\Exception $e){
              echo $e->getMessage();
            }
           ?>
          <nav class="menu-programa">
            <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)){ ?>
              <?php $nombre_evento = $cat['descripcion']; ?>
              <a href="#<?php echo strtolower($nombre_evento); ?>">
                <i class="fa <?php echo $cat['icono']; ?>" aria-hidden="true"></i> <?php echo $nombre_evento; ?>
              </a>
            <?php } ?>
          </nav>

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
              $sql .= " ON (e.id_invitado = i.id ";
              $sql .= " AND e.id_categoria_evento = 1) ";
              $sql .= " ORDER BY e.id LIMIT 2;";
              $sql .= "SELECT e.id as evento_id, e.nombre as evento_nombre, ";
              $sql .= " e.fecha as evento_fecha, e.hora as evento_hora, ";
              $sql .= " ce.descripcion as categoria_evento, ce.icono as icono, ";
              $sql .= " i.nombre as invitado_nombre, i.apellido as invitado_apellido ";
              $sql .= " FROM eventos as e ";
              $sql .= " INNER JOIN categoria_evento as ce ";
              $sql .= " ON e.id_categoria_evento = ce.id ";
              $sql .= " INNER JOIN invitados as i ";
              $sql .= " ON (e.id_invitado = i.id ";
              $sql .= " AND e.id_categoria_evento = 2) ";
              $sql .= " ORDER BY e.id LIMIT 2;";
              $sql .= "SELECT e.id as evento_id, e.nombre as evento_nombre, ";
              $sql .= " e.fecha as evento_fecha, e.hora as evento_hora, ";
              $sql .= " ce.descripcion as categoria_evento, ce.icono as icono, ";
              $sql .= " i.nombre as invitado_nombre, i.apellido as invitado_apellido ";
              $sql .= " FROM eventos as e ";
              $sql .= " INNER JOIN categoria_evento as ce ";
              $sql .= " ON e.id_categoria_evento = ce.id ";
              $sql .= " INNER JOIN invitados as i ";
              $sql .= " ON (e.id_invitado = i.id ";
              $sql .= " AND e.id_categoria_evento = 3) ";
              $sql .= " ORDER BY e.id LIMIT 2;";
            } catch(\Exception $e){
              echo $e->getMessage();
            }

           $conn->multi_query($sql);

           do {
             $resultado = $conn->store_result();
             $row = $resultado->fetch_all(MYSQLI_ASSOC);
             $i = 0; ?>

             <?php foreach($row as $evento): ?>
               <?php if($i % 2 == 0){ ?>
                 <div id="<?php echo strtolower($evento['categoria_evento']); ?>" class="info-curso ocultar clearfix">
              <?php } ?>
                  <div class="detalle-evento">
                    <h3><?php echo utf8_encode($evento['evento_nombre']); ?></h3>
                    <p><i class="fa fa-clock" aria-hidden="true"></i> <?php echo $evento['evento_hora']; ?></p>
                    <p><i class="fa fa-calendar-alt" aria-hidden="true"></i> <?php echo $evento['evento_fecha']; ?></p>
                    <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $evento['invitado_nombre'] . " " . $evento['invitado_apellido']; ?></p>
                  </div>
              <?php if($i % 2 == 1){ ?>
                  <a href="calendario.php" class="button float-right">Ver todos</a>
                </div>
              <?php } ?>
              <?php $i++; ?>
           <?php endforeach; ?>
           <?php $resultado->free(); ?>
           <?php
           } while ($conn->more_results() && $conn->next_result());
           ?>
        </div> <!-- programa evento -->
      </div>
    </div> <!-- contenido programa -->
  </section> <!-- programa -->

  <?php include_once 'includes/templates/invitados.php'; ?>

  <div class="contador parallax">
    <div class="contenedor">
      <ul class="resumen-evento clearfix">
        <li><p class=numero>0</p> Invitados</li>
        <li><p class=numero>0</p> Talleres</li>
        <li><p class=numero>0</p> Días</li>
        <li><p class=numero>0</p> Conferencias</li>
      </ul>
    </div>
  </div> <!-- contador -->

  <section class="precios seccion">
    <h2>Precios</h2>
    <div class="contenedor">
      <ul class="lista-precios clearfix">
        <li>
          <div class="tabla-precio">
            <h3>Pase por día</h3>
            <p class="numero">$30</p>
            <ul>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Bocadillos gratis</li>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Todas las conferencias</li>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Todos los talleres</li>
            </ul>
            <a href="#" class="button hollow">Comprar</a>
          </div>
        </li>
        <li>
          <div class="tabla-precio">
            <h3>Todos los días</h3>
            <p class="numero">$50</p>
            <ul>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Bocadillos gratis</li>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Todas las conferencias</li>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Todos los talleres</li>
            </ul>
            <a href="#" class="button">Comprar</a>
          </div>
        </li>
        <li>
          <div class="tabla-precio">
            <h3>Pase por 2 días</h3>
            <p class="numero">$45</p>
            <ul>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Bocadillos gratis</li>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Todas las conferencias</li>
              <li><i class="fa fa-check icono-precio" aria-hidden="true"></i>  Todos los talleres</li>
            </ul>
            <a href="#" class="button hollow">Comprar</a>
          </div>
        </li>
      </ul>
    </div>
  </section> <!-- tabla de precios -->

  <div id="mapa" class="mapa">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.0237807075387!2d-58.41814018421687!3d-34.60356016499785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca8a6b4f8475%3A0xd3a744a213a08d44!2sAv.+Corrientes+3625%2C+C1194AAC+CABA!5e0!3m2!1ses!2sar!4v1531268942060"
      width="100%" height="420" frameborder="0" style="border:0" allowfullscreen>
    </iframe>
  </div>

  <section class="seccion">
    <h2>Testimoniales</h2>
    <div class="testimoniales contenedor clearfix">
      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div>
      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div>
      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </section> <!-- Fin testimoniales -->

  <div class="newsletter parallax">
    <div class="contenido contenedor">
      <p>Regístrate al newsletter</p>
      <h3>GDLWebCamp</h3>
      <a href="#mc_embed_signup" class="button_newsletter button transparente">Registro</a>
    </div>
  </div> <!-- Fin newsletter -->

  <section class="seccion">
    <h2>Faltan</h2>
    <div class="cuenta-regresiva">
      <ul class="clearfix">
        <li><p id="dias" class="numero"></p> días</li>
        <li><p id="horas" class="numero"></p> horas</li>
        <li><p id="minutos" class="numero"></p> minutos</li>
        <li><p id="segundos" class="numero"></p> segundos</li>
      </ul>
    </div>
  </section>
<?php include_once 'includes/templates/footer.php'; ?>
