<?php
session_start();


 ?>
<!DOCTYPE html>
<html lang="en">

<?php
require "plantilla/header.php";
 ?><script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
    //  defaultView: 'timeGridDay',

    header:{
      left: 'prev,next, today',
      center: 'title',
      right: 'dayGridMonth, timeGridWeek, timeGridDay'
    },
    customButtons:{
      Miboton:{
        text:"Botón",
        click:function(){
          alert("hola mundo");
          $('#modal').modal();
        }
      }
    },
    dayClick:function(info){
      //$('#modal').modal();
      console.log(info);

    },
    eventClick:function(info) {

    },
    events:'http://localhost/invernadero/sistema/eventos.php'

    });
    calendar.setOption('locale','Es');
    calendar.render();
  });

</script>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php
require "plantilla/nav.php";
require "plantilla/nave.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Calendario de eventos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                      <div id='calendar'></div>

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
