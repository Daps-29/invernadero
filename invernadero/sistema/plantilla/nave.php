<?php
include "../conexion.php";
 ?>
   <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS74E4f0zaGjfeFczYBgN5TeddOqymwoSkqxQ&usqp=CAU" alt=""><?php echo $_SESSION['nombre'];?> <?php echo $_SESSION['apellido'];?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                      <a class="dropdown-item"  href="salir.php"><i class="fa fa-sign-out pull-right"></i> Salir</a>
                    </div>
                  </li>
                  <!--Esto lo puse arriba xdxd-->
                  <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-bell"></i>
                      <!-- aqui va los numeros de las alertas -->
                      <span class="badge bg-green">|</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                      <li class="nav-item">
                         <a class="dropdown-item">
                    <!--hasta aqui -->
                    <?php
                      include "../conexion.php";

                        $query = mysqli_query($conexion,"SELECT  temperatura FROM sensor  ORDER BY id DESC LIMIT 0,1");
                         mysqli_close($conexion);
                         $frutillas = mysqli_fetch_assoc($query);
                      if($frutillas["temperatura"] > '20'){


                     ?>
                     <!--iba aqui----------->

                          <span>
                            <span>Inv.</span>
                            <span class="time">Temperatura</span>
                          </span>
                          <span class="message">
                           La temperatura es <?php echo $frutillas["temperatura"]; ?>°C tomar medidas.
                          </span>
                          <?php }
                            include "../conexion.php";
                              $query = mysqli_query($conexion,"SELECT COUNT(disponible) as total FROM espacios");
                               mysqli_close($conexion);
                               $espacio = mysqli_fetch_assoc($query);
                            if($espacio["total"] < '1'){

                           ?>
                          <span>
                            <span>Siembras</span>
                            <span class="time">Espacios</span>
                          </span>
                          <span class="message">
                           Ya no quedan espacios en el invernadero
                          </span>
                        <?php } ?>
                        </a>
                      </li>


                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->
