if (annyang) {

    //Variable para almacenar las voces de nuestro sistema.
    var voices;

    //Inicializamos utter.
    var utter = new SpeechSynthesisUtterance();
    utter.rate = 1;
    utter.pitch = 0.5;
    utter.lang = 'es-ES';

    //Cargamos las voces que tenemos en nuestro sistema y las mostarmos en un arreglo por consola.
    window.speechSynthesis.onvoiceschanged = function () {
        voices = window.speechSynthesis.getVoices();
        console.log(voices);
    };

    //Definimos los comandos a utilizar.
    var commands = {
        'nuevo usuario': function () {
            utter.text = 'Claro que si, espero haber sido util';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/nuevousuario.php";
        },
        'usuarios': function () {
            utter.text = 'Enseguida, espero haber sido util';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/usuario.php";
        },
        'nueva siembra': function () {
            utter.text = 'Ahora mismo, espero que todas las frutillas salgan muy dulces';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/nuevafrutilla.php";
        },

        'cosechas': function () {
            utter.text = 'Estas son todas las frutillas cosechadas';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/cosecha.php";
        },
        'reportes': function () {
            utter.text = 'Aqui estan los reportes, estoy para servirle';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/reportefecha.php";
        },
        'espacios': function () {
            utter.text = 'Aqui estan los espacios, espero que pueda sembrar mas frutillas';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/espacios.php";
        },
        'temperatura': function () {
            utter.text = 'La temperatura del invernadero es de 23 grados centigrados y la humedad de 47 ';
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
        },
        'frutillas': function () {
            utter.text = 'Estas son todas las frutillas por el momento';
            //Setea la voz que queremos usar en base a nuestra lista.
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
            window.location.href = "https://iotinvernadero.ml/sistema/frutilla.php";
        },
        'hola': function () {
            utter.text = 'hola soy tu asistente virtual Fibi, cual es tu nombre?';
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
        'cuentame un chiste': function () {
            chistes = ['Por qué las focas del circo miran siempre hacia arriba?.   Porque es donde están los focos.',
                'Conocí a mi pareja en un elevador.   Soy el amor de subida',
                'Por que estás hablando con esas zapatillas?   Porque pone "converse"',
                'Buenos dias, me gustaria alquilar "Batman Forever".   No es posible, tiene que devolverla tomorrow',
                'Que forman tres mujeres con su periodo.      Una regla de tres.',
                'Conoces el chiste de pocoyo     Tampocoyo'
            ];
            utter.text = chistes[Math.floor(Math.random() * chistes.length)]
            utter.voice = voices[10];
            window.speechSynthesis.speak(utter);
        }
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
