
<?php
session_start();
if($_SESSION['cargo']!=1 and $_SESSION['cargo'] !=3){
  header("location: ./");
}

 ?>
<!DOCTYPE html>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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

   <div class="row">
       <div class="col-md-12">
         <div class="x_panel">
           <div class="x_title">
             <h2>Grafica Humedad</h2>
             <ul class="nav navbar-right panel_toolbox">
               <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
               </li>
             </ul>
             <div class="clearfix"></div>
           </div>
           <div class="x_content">

             <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
               <div class="col-md-15" style="overflow:hidden;">


               <iframe src="grafico/grafico_humedad.php" id="myFrame" height="500" width="900" ></iframe>
               <?php
               //include("graficohumedad.php");
               ?>
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
