

<?php
include "arduino/conexion.php";
  $query = mysqli_query($conexion,"SELECT * FROM sensor ORDER BY id DESC LIMIT 0,1");
   mysqli_close($conexion);
   $data = mysqli_fetch_assoc($query);
   if ($data["riego"] == 1){ ?>

     <button class="btn btn-success btn-xs"><i class="fa fa-tint fa-3x" aria-hidden="true"></i> RIEGO ENCENDIDO</button>
       <?php
   } else { ?>
     <button class="btn btn-danger"><i class="fa fa-tint fa-3x" aria-hidden="true"></i> RIEGO APAGADO</button>
       <?php
   }if ($data["ventilador"] == 1){ ?>

     <button class="btn btn-success btn-xs"><i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i> VENTILADOR ENCENDIDO</button>
       <?php
   } else { ?>
     <button class="btn btn-danger"><i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i> VENTILADOR APAGADO</button>
       <?php
  
   }if ($data["foco_seco"] == 1){ ?>

     <button class="btn btn-danger"><i class="fa fa-times fa-3x" aria-hidden="true"></i> SENSOR ARRUINADO</button><?php
   } else { ?>
     <button class="btn btn-success btn-xs"><i class="fa fa-check fa-3x" aria-hidden="true"></i> SENSOR FUNCIONANDO</button>
       <?php
   }?>
