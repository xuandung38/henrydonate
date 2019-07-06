var fs = require( 'fs' );
var app = require('express')();
var https = require('https');
var server = https.createServer({
    key: fs.readFileSync('/etc/nginx/auth-acme/henryfan.me/henryfan.me.key'),
    cert: fs.readFileSync('/etc/nginx/auth-acme/henryfan.me/henryfan.me.crt'),
    ca: fs.readFileSync('/etc/nginx/auth-acme/henryfan.me/henryfan.me.ca'),
    requestCert: false,
    rejectUnauthorized: false
},app);


var redis = require('redis');
 
var io = require('socket.io')(server);
server.listen(8890);
io.on('connection', function (socket) {
 
  console.log("new client connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('message');
 
  redisClient.on("message", function(channel, message) {
    console.log("mew message in queue "+ message + "channel");
    socket.emit(channel, message);
  });
 
  socket.on('disconnect', function() {
    redisClient.quit();
  });
 
});