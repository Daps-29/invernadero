 <?php
session_start();
if($_SESSION['cargo'] !=1 ){
  header("location: ../");
}
include "../conexion.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<?php
require "plantilla/header.php";
 ?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php
require "plantilla/nav.php";
 ?>
<?php
require "plantilla/nave.php";
 ?>
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lista de usuarios</h3>
                <?php
                if ($_SESSION['cargo'] == 1) {?>
                   <a href="nuevousuario.php"><button class="btn btn-success"><i class="fa fa-user-plus"></i> Nuevo Usuario</button></a>
                   <?php }?>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">

                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>

                           <th>Tipo Usuario</th>
                           <th>Nombre</th>
                           <th>Apellido</th>
                           <th>Nombre De Usuario</th>
                           <th>Celular</th>
                           <th>Foto</th>
                           <th>Genero</th>
                           <th>Estado</th>
                           <?php  if ($_SESSION['cargo'] == 1) {?>
                           <th>Acciones</th>
                           <?php } ?>
                         </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "../conexion.php";
                          $qury = mysqli_query($conexion,"SELECT u.idusuario,c.cargo, u.nombre,u.apellido,u.usuario,u.celular,u.foto,u.genero FROM usuario u
                            INNER JOIN cargo c WHERE c.idcargo = u.cargo AND u.estado = '1' ");
                            mysqli_close($conexion);
                      			$result = mysqli_num_rows($qury);
                           if ($result > 0) {
                             while ($data = mysqli_fetch_array($qury)) {
                              if ($data['foto'] != 'img_producto.png') {
                                $foto = 'img/uploads/'.$data['foto'];
                              } else{
                                $foto = 'img/'.$data['foto'];
                              }

                               if ($data["genero"] == 1){
                                 $genero = 'Femenino';
                               } if ($data["genero"] == 2) {
                                 $genero = 'Masculino';
                               } if ($data["genero"] == 3) {
                                 $genero = 'Indefinido';
                               }
                           ?>
                       <tr>
            <td><?php echo $data['cargo']; ?></td>
            <td><?php echo $data['nombre']; ?></td>
            <td><?php echo $data['apellido']; ?></td>
            <td><?php echo $data['usuario']; ?></td>
            <td><?php echo $data['celular']; ?></td>
            <td class="img_producto"><img src="<?php echo $foto; ?>" alt="<?php echo $data['usuario']; ?>" width = "50"> </td>
            <td><?php echo $genero; ?></td>


            <td><button class="btn btn-success btn-xs">Activado</button></td>
            <?php  if ($_SESSION['cargo'] == 1) {?>
              <td>
              <div class="btn-group">
              <a href="editarusuario.php?id=<?php echo $data['idusuario']; ?>"><span class="btn btn-warning"><i class="fa fa-pencil"></i></span></a>
              <?php if($data["idusuario"] != 1){ ?>
              <a href="eliminarusuario.php?id=<?php echo $data['idusuario']; ?>"><button class="btn btn-danger"><i class="fa fa-times"></i></button></a>
              <?php } ?>
              </div>
            </td>
            <?php } ?>
          </tr>
          <?php }         }          ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
                </div>
              </div>


                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php
require "plantilla/footer.php";
?>
  </body>
</html>
