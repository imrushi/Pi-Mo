var socket = io.connect('http://localhost:3000');

var message = document.getElementById('speed');

object.addEventListener("change", function(){
    socket.emmit('connect' ,{
        message: message.value
    });
    message.value = "";
});

console.log(message);