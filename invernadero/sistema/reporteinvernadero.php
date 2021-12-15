<?php
session_start();
if($_SESSION['cargo']!=1 and $_SESSION['cargo'] !=2){
  header("location: ./");
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
<?php
include "datos/medidor.php";

 ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Datos Temperatura y Humedad</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                    <div id="Medidores"></div>
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
