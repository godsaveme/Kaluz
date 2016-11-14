<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
</head>

<body>
    <p id="power">0</p>
</body>
    <!-- jQuery 2.1.4 -->
    <script src="/vendor/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/js/socket.io.js"></script>

    <script>
    var socket = io('http://localhost:6001');
    socket.on("test-channel:Salesfly\\Events\\SomeEvent", function(message){
         // increase the power everytime we load test route
         $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
     });
    </script>

</html>

















