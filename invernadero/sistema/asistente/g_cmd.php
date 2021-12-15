<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Asistente Invernadero</title>
    <link rel="stylesheet" href="asistente/css/bootstrap.min.css">
    <script src="asistente/js/jquery-3.1.1.js"></script>
    <script src="asistente/js/artyom.min.js"></script>
    <script src="asistente/js/artyomCommands.js"></script>
    <style type="text/css">
           
            body{
              background-image: url(img/img.jpg);
                background-color: cover; 
            }
            /*.container{
              width: 60px;
              margin-left: auto;
              margin-right: auto;
            }*/

    </style>
  </head>

  <body> 
    <div class="container" style="margin-top: 30px;">
            <div class="modal-body">
              <div class="form-group">
              <button type="button" class="btn btn-info"><img src="img/btnc.svg" width="20px"></button>
                <button type="button" class="btn btn-danger"><img src="img/btn.svg" width="20px"></button>
                
              </div>
              <span id="resultados_ajax"></span>
              <form class="form-horizontal" method="post" id="guardar_comandos" name="guardar_comandos">
                  <input type="text" id="texto" name="comando" class="form-control" style="height: 52px;color: #fff;border-top-right-radius: 16px; border-top-left-radius: 16px;border: 3px solid #10d6f0;font-family: monospace; background:#14557fc7;">
                <br>
                  <select id="tipo" name="tipo" class="form-control" style="margin-top: 5px; height: 52px;color: #fff;border-top-right-radius: 16px; border-top-left-radius: 16px;border: 3px solid #10d6f0; background: #14557fc7;">
                
                  <option value="">ELEGIR TIPO DE COMANDO</option>
                  <option value="1">RESPUESTA</option>
                  <option value="2">URL</option>
                  </select><br>
                  <textarea class="form-control" id="resp" name="respuesta" style="margin-top:5px; height: 90px;padding:10px; color: #fff;border-top-right-radius: 16px; border-top-left-radius: 16px;border: 3px solid #10d6f0;font-family: monospace; background:#14557fc7;"></textarea>
                  <br>
                  <button type="submit" class="btn btn-info" id="guardar_comando">Guardar Comando</button>
                </form>
            </div>

    </div>
       
  </body>
</html>
