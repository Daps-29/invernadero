<?php
session_start();
if (empty($_SESSION['active'])) {
  header('location: ../index.php');

}

 ?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="reporte/js/jquery.js"></script>


      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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

                <!-- <h2 class="text-center">Para empezar a utilizar el asistente PHOEBY diga ¨HOLA¨</h2>-->

            <div class="row">

              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Control del invernadero</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="row top_tiles">
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i id="colortierra" class="fa fa-globe"></i></div>
                          <div class="count"><b id="tierra">--</b> %</div>
                          <h3>HUMEDAD TIERRA</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i id="colorhum" class="fa fa-tint"></i></div>
                          <div class="count"><b id="humedad">--</b> %</div>
                          <h3>HUMEDAD AIRE</h3>
                        </div>
                      </div>
                      <div  class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i  id="colortemp" class="fa fa-eyedropper"></i></div>
                          <div class="count"><b id="temp">--</b> °C</div>
                          <h3>Temperatura</h3>
                        </div>

                      </div >
                      <div  class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i id="colorcalidad" class="fa fa-eyedropper"></i></div>
                          <div class="count"><b id="calidad">--</b> ICA</div>
                          <h3>Calidad Aire</h3>
                        </div>

                      </div >
                      </div>

                        <div class="col-lg-6 mt-5">
                          <h4>VENTILADOR</h4>
                         <div class="card-body">
                                <div class="checkbox">
                                  <input type="checkbox" id ="ventilador" onchange="process_vent() "  data-toggle="toggle" data-offstyle="danger" data-onstyle="success">
                                </div>
                          </div>
                        </div>

                        <div class="col-lg-6 mt-5">
                          <h4>BOMBA DE AGUA (RIEGO)</h4>
                         <div class="card-body">
                                <div class="checkbox">
                                  <input type="checkbox" id ="bomba" onchange="process_bomba() "  data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
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
  <!-- LIBRERIA MQTT-->
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<!-- LIBRERIA ASISTENTE-->
<script src="asistente/js/annyang.min.js"></script>
<script src="asistente/js/artyom.min.js"></script>
<script src="asistente/js/artyom.js"></script>
<script src="asistente/js/artyomCommands.js"></script>
<script type="text/javascript">

/*
******************************
****** PROCESOS  *************
******************************
*/

function update_values(temp, humedad, calidad, tierra){
  $("#temp").html(temp);
  $("#humedad").html(humedad);
  $("#tierra").html(tierra);
  $("#calidad").html(calidad);
  if (temp > 19) {
    process_vent();
  }
  if (temp < 18) {
    process_vent();
  }
if (tierra < 20) {


  process_bomba();
}
if (tierra > 21) {

  process_bomba();
}
  //COLORES DIV AIRE
  if(calidad >= 241 & calidad <= 500){
    document.getElementById('colorcalidad').style.color='#FF3333';
    document.getElementById('calidad').style.color='#FF3333';
  }

  if(calidad >= 0 & calidad <= 80){
    document.getElementById('colorcalidad').style.color='#8DFF33';
    document.getElementById('calidad').style.color='#8DFF33';
  }
  if(calidad >= 81 & calidad <= 120){
    document.getElementById('colorcalidad').style.color='#338DFF';
    document.getElementById('calidad').style.color='#8DFF33';
  }
  if(calidad >= 121 & calidad <= 180){
    document.getElementById('colorcalidad').style.color='#FC900F';
    document.getElementById('calidad').style.color='#8DFF33';
  }
  if(calidad >= 180 & calidad <= 240){
    document.getElementById('colorcalidad').style.color='#B9362D';
    document.getElementById('calidad').style.color='#B9362D';
  }
//COLORES PARA DIV TIERRA
  if(tierra >= 20 & tierra <= 60){
    document.getElementById('colortierra').style.color='#8DFF33';
    document.getElementById('tierra').style.color='#8DFF33';
  }
  if(tierra >= 0 & tierra <= 19){
    document.getElementById('colortierra').style.color='#FF3333';
    document.getElementById('tierra').style.color='#FF3333';
  }
//COLORES DIV TEMPER
  if(temp >= 0 & temp <= 18){
    document.getElementById('colortemp').style.color='#27EBFF';
    document.getElementById('temp').style.color='#27EBFF';
  }
  if(temp >= 19 & temp <= 100){
    document.getElementById('colortemp').style.color='#FF3333';
    document.getElementById('temp').style.color='#27EBFF';
  }

  //COLORES DIV HUMEDAD
    if(humedad >= 0 & humedad <= 70){
      document.getElementById('colorhum').style.color='#87A7FA';
      document.getElementById('humedad').style.color='#87A7FA';
    }
    if(humedad >= 71){
      document.getElementById('colorhum').style.color='#FF3333';
      document.getElementById('humedad').style.color='#87A7FA';
    }


}

function process_msg(topic, message){
  // ej: "10,11,12"
  if (topic == "datos"){
    var msg = message.toString();
    var sp = msg.split(",");
    globalThis.temp = sp[0];
    var humedad = sp[1];
    globalThis.tierra = sp[2];
    var calidad = sp[3];
    update_values(temp, humedad, calidad, tierra);
  }
}


function process_vent(){
  if ($('#ventilador').is(":checked") || temp >= 19){
    console.log("Encendido");

    client.publish('ventilador', 'on', (error) => {
      console.log(error || 'vent apagado')
    })
  }else{
    console.log("Apagado");
    client.publish('ventilador', 'off', (error) => {
      console.log(error || 'vent apagado')
    })
  }
}

function process_bomba(){
  if ($('#bomba').is(":checked") || tierra < 20){
    console.log("Encendido");

    client.publish('bomba', '1', (error) => {
      console.log(error || 'Mensaje bomba en')
    })
  }else{
    console.log("Apagado");
    client.publish('bomba', '0', (error) => {
      console.log(error || 'Mensaje bomba ap')
    })
  }
}
/*
******************************
****** CONEXION  *************
******************************
*/

// opciones de conexion
const options = {
      connectTimeout: 4000,

      // Authenticacion
      clientId: 'mqttjs_65e19e36d3',
      username: 'admin',
      password: 'admin',
      keepalive: 60,
      clean: true,
}

var connected = false;

// WebSocket dominio
const WebSocket_URL = 'wss://iotinvernadero.ml:8094/mqtt'


const client = mqtt.connect(WebSocket_URL, options)


client.on('connect', () => {
    console.log('Mqtt conectado')

    client.subscribe('datos', { qos: 0 }, (error) => {
      if (!error) {
        console.log('Suscripción exitosa')
      }else{
        console.log('Error')
      }
    })


})

client.on('message', (topic, message) => {
  console.log('Mensaje recibido bajo tópico: ', topic, ' -> ', message.toString())
  process_msg(topic, message);
})

client.on('reconnect', (error) => {
    console.log('Error al reconectar', error)
})

client.on('error', (error) => {
    console.log('Error de conexión:', error)
})

if (annyang) {

    //Variable para almacenar las voces de nuestro sistema.
    var voices;

    //Inicializamos utter.
    var utter = new SpeechSynthesisUtterance();
    utter.rate = 1;
    utter.pitch = 0.5;
    utter.lang = 'es-AR';

    //Cargamos las voces que tenemos en nuestro sistema y las mostarmos en un arreglo por consola.
    window.speechSynthesis.onvoiceschanged = function () {
        voices = window.speechSynthesis.getVoices();
        console.log(voices);
    };

    //Definimos los comandos a utilizar.
    var commands = {
        'Ventilador': function () {
          client.publish('bomba', 'on', (error) => {
            console.log(error || 'Mensaje enviado!!!')
          })
            utter.text = 'Claro que si, encendiendo ventiladores';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
        },
        'Apagar ventilador': function () {
          client.publish('bomba', 'off', (error) => {

            console.log(error || 'Mensaje enviado!!!')
          })
            utter.text = 'Enseguida, apagando ventiladores';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
        },



        'hola': function () {

            utter.text = 'Hola cual es tu nombre';
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            //Guarda el nombre que le decimos por voz.
            annyang.addCallback('result', function (phrases) {
                //Imprime el nombre por consola.
                console.log("Nombre: ", phrases[0]);
                //Para el evento result.
                annyang.removeCallback('result');
                //Nos dice hola + el nombre que le digamos por voz.
                utter.text = 'Hola, en que puedo ayudarte, ' + phrases[0];
                window.speechSynthesis.speak(utter);
            });
        },
        //Array que devuelve aleatoriamente un elemento del array, en este caso un chiste.

    };

    //Esto nos sirve para ver que escucha el programa en tiempo real.
    /*
    annyang.addCallback('result', function(phrases) {
      console.log("I think the user said: ", phrases[0]);
      console.log("But then again, it could be any of the following: ", phrases);
       });
       */


    //Sumamos todos los comandos a annyang.
    annyang.addCommands(commands);

    //Annyang comienza a escuchar.
    annyang.start({ autoRestart: false, continuous: true });
}


</script>
  </body>
</html>
