<?php 
session_start();
if($_SESSION['cargo'] != 1)
{
  header("location: plantilla.php");
}
include "../conexion.php";
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  

    <title>Lista Usuarios</title>

    <?php include "includes/bootstrap.php"; ?>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <?php include "includes/nav.php"; ?>


      <?php 
            $busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_usuarios.php");
				mysqli_close($conexion);
			}      
      ?>

               <!-- page content -->
       
          <div class="right_col" role="main">
          <div class="">
                <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de usuarios</h2>
                  
                  
                  </div>
                  
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <a href="nuevousuario.php"><button class="btn btn-success btn-xs">Nuevo Usuario</button></a>
                    <!--BUSCADOR -->
                    <form action="buscar_usuario.php" method="get" class="form_search">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                    <button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
                    </form><!--FIN BUSCADOR-->

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
                           <th>Acciones</th>
                         </tr> 

                        </thead>

        <tbody>
           <?php 
           $cargo = '';
           if($busqueda == 'Administrador')
           {
               $cargo = " OR rol LIKE '%1%' ";

           }else if($busqueda == 'Empleado'){

               $cargo = " OR rol LIKE '%2%' ";

           }else if($busqueda == 'JefeCultivo'){

               $cargo = " OR rol LIKE '%3%' ";
           }
           //Paginador
			$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM usuario 
																WHERE ( idusuario LIKE '%$busqueda%' OR 
																		apellido LIKE '%$busqueda%' OR 
																		usuario LIKE '%$busqueda%' OR 
																		celular LIKE '%$busqueda%' 
																		$cargo  ) 
																AND estado = 1  ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 8;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
      $total_paginas = ceil($total_registro / $por_pagina);
      //fin query para paginador
         $qury = mysqli_query($conexion,"SELECT u.idusuario,c.cargo, u.nombre,u.apellido,u.usuario,u.celular,u.foto,u.genero FROM usuario u INNER JOIN cargo c ON u.cargo = c.idcargo  
                                                                        WHERE ( u.idusuario LIKE '%$busqueda%' OR 
																		u.apellido LIKE '%$busqueda%' OR 
																		u.usuario LIKE '%$busqueda%' OR 
																		u.celular LIKE '%$busqueda%' OR 
																		u.cargo LIKE '%$busqueda%'  ) 
																AND estado = 1  
                                                                ORDER BY u.idusuario ASC LIMIT $desde,$por_pagina");
         
         $result = mysqli_num_rows($qury);
         if ($result > 0) {
           while ($data = mysqli_fetch_array($qury)) {
             
         ?>
           <tr>
            <td><?php echo $data['cargo']; ?></td>
            <td><?php echo $data['nombre']; ?></td>
            <td><?php echo $data['apellido']; ?></td>
            <td><?php echo $data['usuario']; ?></td>
            <td><?php echo $data['celular']; ?></td>
            <td><?php echo $data['foto']; ?></td>
            <td><?php echo $data['genero']; ?></td>
            

            <td><button class="btn btn-success btn-xs">Activado</button></td>
            <td>      
              <div class="btn-group">
              <a href="editarusuario.php?id=<?php echo $data['idusuario']; ?>"><span class="btn btn-warning"> <i class="fa fa-pencil"></i></span></a>
              <?php if($data["idusuario"] != 1){ ?>
                <a href="eliminarusuario.php?id=<?php echo $data['idusuario']; ?>"><button class="btn btn-danger"><i class="fa fa-times"></i></button></a>
              <?php } ?>
            </div>
            </td>
          </tr>
          <?php }         }          ?>
        </tbody>
        </table>
        <!--DIV PAGINADOR-->
        <?php 
	
	if($total_registro != 0)
	{
 ?>
      <div class="paginador">
      <ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div><?php } ?><!-- FIN DEL PAGINADOR-->
                  </div>
                </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- /page content -->

        
      </div>
    </div>
    <?php include "includes/scripts.php"; ?>
  </body>
</html>

