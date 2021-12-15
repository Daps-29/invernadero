<?php
                 include "../conexion.php";
                  

                    $queery = mysqli_query($conexion,"SELECT temperatura as temp FROM sensor ORDER BY id DESC LIMIT 1");
                     
                     $max = mysqli_fetch_assoc($queery);
                    ?>
                    
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-eyedropper"></i></div>
                          <div class="count"><?php echo $max['temp']; ?></div>
                          <h3>Temp.</h3>
                        </div>
                       