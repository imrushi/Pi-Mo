var socket  = io.connect("http://52.187.120.32:3000");

socket.on('relo', function(data){
    location.href = "http://52.187.120.32:3000";
});