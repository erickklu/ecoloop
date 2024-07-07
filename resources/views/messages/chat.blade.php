<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
</head>

<body>
    <ul id="messages"></ul>
    <input id="receiver_id" type="text" placeholder="ID del Usuario">
    <input id="message" type="text" placeholder="Escribe tu mensaje...">
    <input type="hidden" value="{{ Auth::user()->id }}" id="user_id">
    <button type="button" id="buttonSend">Enviar</button>


    @vite(['resources/js/chat.js'])
    <script>
        function sendMessage() {
            const message = document.getElementById('message').value;
            const receiver_id = document.getElementById('receiver_id').value;
            
            axios.post('/send-message', {
                message,
                receiver_id
            }).then(response => {
                document.getElementById('message').value = '';
            });
        }

        const user_id = document.getElementById("user_id")

        window.onload = () => {

            window.Echo.private('chat.' + user_id.value)
                .listen('MessageSent', (e) => {
                    console.log("sss");
                    const messages = document.getElementById('messages');
                    const messageElement = document.createElement('li');
                    messageElement.textContent = e.message.text;
                    messages.appendChild(messageElement);
                });


            const button = document.getElementById("buttonSend")
            button.addEventListener("click", function() {
                sendMessage();
            })
        }
    </script>
</body>

</html>
