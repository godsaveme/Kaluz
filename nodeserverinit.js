var express =   require('express');
var http =      require('http');
var server =    http.createServer(app);

var app = express();

app.get('/', function(req, res){
  res.send('hola mundo');
});

var server = app.listen(3001, function(){
    var host = server.address().address;
  var port = server.address().port;

  console.log('Example app listening at http://%s:%s', host, port);
});
console.log("Listening.....");

const redis =   require('redis');
const io =      require('socket.io');
const client =  redis.createClient();

io.listen(server).on('connection', function(client) {
    const redisClient = redis.createClient();

    redisClient.subscribe('hotel.update','*');

    console.log("Redis server running.....");

    redisClient.on("message", function(channel, message) {
        console.log(channel);
        client.emit(channel, message);
    });

    client.on('disconnect', function() {
        redisClient.quit();
    });

});