        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-home"></i> INICIO </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
          <!-- menu profile quick info -->
          <div class="profile clearfix">
             <div class="profile_info">
             <?php include "../conexion.php";
           if ($_SESSION['genero'] == 1){
              $msj = 'Bienvenida al sistema';
            } if ($_SESSION['genero'] == 2) {
              $msj = 'Bienvenido al sistema';
            } if ($_SESSION['genero'] == 3) {
              $msj = 'Bienvenid@ al sistema';
            } ?>
          <span><?php echo $msj; ?> <?php echo $_SESSION['usuario'];?></span>
          <p>La Paz-Bolivia, <?php echo fechaC(); ?></p>

             </div>
           </div>
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">

               <ul class="nav side-menu">
                  <li><a><i class="fa fa-android"></i> Asistente Invernadero <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="asistente.php"><i class="fa fa-gitlab"></i>Phoeby</a></li>
                    </ul>
                  </li>
                </ul>
                <?php  if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 2 ) {?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Invernadero <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index2.php"><i class="fa fa-home"></i>Control Invernadero</a></li>
                      <!--   <li><a href="espacios.php"><i class="fa fa-folder-o"></i>Espacios Disponibles</a></li>-->
                      <li><a href="grafico.php"><i class="fa fa-bar-chart"></i>Grafica Humedad</a></li>
                      <li><a href="reportes.php"><i class="fa fa-bar-chart"></i>Grafica Temperatura</a></li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>
                  <?php  if ($_SESSION['cargo'] == 1) {?>
                 <ul class="nav side-menu">
                  <li><a><i class="fa fa-user"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="usuario.php"><i class="fa fa-users"></i>Lista Usuarios</a></li>
                    </ul>
                  </li>
                </ul>
              <?php } ?>
                <?php  if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 3) {?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-pagelines"></i> Siembras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="frutilla.php"><i class="fa fa-leaf"></i>Listado de Frutillas</a></li>
                     <li><a href="frutilla.php"><i class="fa fa-remove"></i>Cosechas Eliminadas</a></li>
                      <li><a href="calendario.php"><i class="fa fa-calendar"></i>Calendario de Cosechas</a></li>
                    </ul>
                  </li>
                </ul>
<?php } ?>
<?php  if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 3 ) {?>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-area-chart"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="reportefecha.php"><i class="fa fa-align-left"></i>Reportes Fechas Invernadero</a></li>
                      <li><a href="reportecosecha.php"><i class="fa fa-align-left"></i>Reportes Fechas Cosecha</a></li>
                    </ul>
                  </li>
                </ul>
                <?php } ?>

              </div>
            </div>

            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="salir.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
