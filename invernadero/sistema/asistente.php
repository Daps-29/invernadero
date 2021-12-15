<?php
session_start();
if (empty($_SESSION['active'])) {
  header('location: index.php');
}

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

    <script src="asistente/js/jquery-3.1.1.js"></script>
    <script src="asistente/js/artyom.min.js"></script>
    <script src="asistente/js/artyomCommands.js"></script>
       <script type="text/javascript">
      function ventana(theUrl,winName, virtual, myWidth, myHeight, isCenter){
        if(window.screen)if(isCenter)if(isCenter=="true") {
            var myLeft=(screen.width-myWidth)/2;
            var myTop=(screen.height-myHeight)/2;
            virtual+=(virtual!="")?',':'';
            virtual+=',left='+myLeft+',top='+myTop;
        }
        window.open(theUrl,winName,virtual+((virtual!='')?',':'')+'width='+myWidth+',height='+myHeight);
      }
      function asistente(){
        ventana('asistente/asi.php','Asistente virtual Invernadero','','900','504','true');
      }
      function g_cmd(){
        ventana('asistente/g_cmd.php','Guardar comandos','','900','504','true');
      }
      function cmd(){
        ventana('asistente/comando.php','Comandos','','900','1024','true');
      }
    </script>
    <style type="text/cs">
            #b{
              border-top-left-radius: 30px;
              border-bottom-right-radius: 30px;
              padding: 12px;
              background-color: aqua;
              border: 2px solid #ccc;
              color:white;
            }
            </style>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Asistente Invernadero</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-15" style="overflow:hidden;">
                              <!-- page content -->
        <div >
          <!-- top tiles -->

          <!-- top tiles -->
          <div class="tile_count">

          <div style="float: left; padding:20px; margin-left:5px;top:50px; position:absolute;">
                  <a class="btn btn-success" id="b" href="#" onclick="asistente()">ASISTENTE VIRTUAL</a>

<button class="btn btn-danger" data-toggle="modal" data-target="#modal" ><i class="fa fa-list"></i> COMANDOS</button>
                <!--  <a class="btn btn-success" id="b" href="#" onclick="g_cmd()">GUARDAR COMANDOS</a>
                  <a class="btn btn-success" id="b" href="#" onclick="cmd()">COMANDOS</a> -->
          </div>
          <img src="img/img.jpg" style="background-size: cover">
        </div>


        </div>
        <!-- /page content -->
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-ms" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Comandos del asistente virtual</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>

  <div class="form-group">
    <label for="recipient-name" class="col-form-label">PARA EMPEZAR A USAR EL INVERNADERO:<strong> hola</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">PARA AGREGAR USUARIOS:<strong> registrar usuario</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">PARA LA LISTA DE USUARIOS:<strong> usuarios</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">REALIZAR UNA NUEVA SIEMBRA:<strong> nueva siembra</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">PARA VER LAS FRUTILLAS COSECHADAS:<strong> cosechas</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">REPORTES DEL ESTADO DEL INVERNADERO:<strong> reportes</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">VER LOS ESPACIOS DISPONIBLES U OCUPADOS:<strong> espacios</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">PARA SABER LA TEMEPRATURA ACTUAL DEL INVERNADERO:<strong> temperatura</strong></label>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">PARA VER LAS FRUTILLAS EN "GERMINACION":<strong> frutillas</strong></label>
  </div>
</form>
</div>
