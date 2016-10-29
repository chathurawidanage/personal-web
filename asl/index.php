<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
    </head>
    <body>
        <input type="text" id="textTxt"/>
        <button id="startBtn">Start</button>
        <video autoplay controls src="" width="360" height="240" id="video" autobuffer></video>
            <?php
            // put your code here
            ?>
    </body>
    <script type="text/javascript">
        $('#startBtn').click(function () {
            var text = $('#textTxt').val();
            $.get("fetch.php", {word: text}, function (data) {
                alert(data);
                vidDiv = document.getElementById('video');
                $response = $.parseJSON(data);
                if (parseInt($response.error) === 200) {
                    vidDiv.src = decodeURI($response.payload);
                } else {

                    alert($response.error);
                }
            });
        });
        /*
         var recognition = new webkitSpeechRecognition();
         recognition.continuous = true;
         recognition.interimResults = true;
         
         recognition.onresult = function (event) {
         var interim_transcript = '';
         for (var i = event.resultIndex; i < event.results.length; ++i) {
         if (event.results[i].isFinal) {
         //final_transcript += event.results[i][0].transcript;
         } else {
         interim_transcript += event.results[i][0].transcript;
         }
         }
         
         document.querySelector('input').value = interim_transcript;
         
         
         
         };
         
         document.querySelector('button').addEventListener('click', function () {
         recognition.start();
         });*/
    </script>
</html>
