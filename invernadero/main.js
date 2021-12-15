const video = document.getElementById('video');

function startVideo() {
    navigator.getUserMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

        navigator.getUserMedia(
            { video: {} },
            stream => video.srcObject = stream,
            err => console.log(err)
        )
}

//startVideo();

//recibe un array por parametro
//cada promesa que querramos ejecutar
Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('models'),
    faceapi.nets.faceExpressionNet.loadFromUri('models'),
    faceapi.nets.ageGenderNet.loadFromUri('models')
]).then(startVideo);

video.addEventListener('play', async () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);
    const displaySize = { width: video.width, height: video.height };
    //sobrepones el video por el canvas
    faceapi.matchDimensions(canvas, displaySize);
    //empzamos con las detecciones
    setInterval(async () => {
        //metodo con detect all faceapi devuelve una promesa
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions();
        //console.log(detections);
        //redimencionar para el tamano del canvas
        const resizedDetections = faceapi.resizeResults(detections, displaySize);
        //borramos el canvas
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        //ahora las pintamos
        faceapi.draw.drawDetections(canvas, resizedDetections);
        faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
        faceapi.draw.drawFaceExpressions(canvas, resizedDetections);
        //faceapi.draw.drawAgeGender(canvas, resizedDetections);
    }, 100);
});
