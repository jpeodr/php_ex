<!DOCTYPE html>  
<html lang="pt-br">  
<head>  
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <title>Chat em PHP</title>  
    <style>  
        * {
            font-family: "DM Sans", sans-serif;
        }
        #chat-box {
            display: flex;
            justify-content: center;
            align: center;  
            width: 100%;  
            height: 400px;  
            background: grey;  
            color: #fff;  
            border: 2px solid #ccc;  
            overflow-y: scroll;  
            font-size: 30px;
            flex-direction: column;
        }  
        #nickname {
            border-style: solid;
            border-radius: 20px;
            padding-left: 10px;
            margin: 5px;
            height: 30px;
            width: 200px;
        }
        #message {
            border-style: solid;
            border-radius: 20px;
            padding-left: 10px;
            height: 80px;
            width: 400px;
        }
        button {
            border-radius: 40px;
            width: 150px;
            height: 40px;
            border: none;
            font-size: 15px;
            background-color: grey;
            color: white;
            font-weight: 400;
            margin: 5px;
        }
        .conteudo {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            margin: 10px;
        }
        
        #imagemPerfil, #imagemMensagem {
            padding: 15px;
        }
        
    </style>  
</head>  
<body align="center">  
    <h1>Chat em PHP</h1>  
    <div id="chat-box"></div>  
    <div class="conteudo">  
        <input type="text" id="nickname" placeholder="Seu apelido"> 
        <input type="file" id="imagemPerfil">
        <input type="text" id="message" placeholder="Sua mensagem">
        <input type="file" id="imagemMensagem">  
        <button onclick="sendMessage()">Enviar</button>  
        <button onclick="clearChat()">Limpar Chat</button>  
    </div>  
    <script>  
        function sendMessage() {
            var nickname = document.getElementById('nickname').value;  
            var message = document.getElementById('message').value; 
            var imagemPerfil = document.getElementById('imagemPerfil').files[0];
            var imagemMensagem = document.getElementById('imagemMensagem').files[0];

            if (nickname && message) {
                var formData = new FormData();
                formData.append('nickname', nickname);
                formData.append('message', message);
                if (imagemPerfil) {
                    formData.append('imagemPerfil', imagemPerfil);
                }
                if (imagemMensagem) {
                    formData.append('imagemMensagem', imagemMensagem);
                }

                var xhr = new XMLHttpRequest();  
                xhr.open('POST', 'postMessages.php', true);
                xhr.send(formData);

                document.getElementById('message').value = '';
            }
        }


        function getMessages() {  
            var xhr = new XMLHttpRequest();  
            xhr.open('GET', 'getMessages.php', true);  
            xhr.onload = function() {  
                if (this.status === 200) {  
                    document.getElementById('chat-box').innerHTML = this.responseText;  
                }  
            };  
            xhr.send();  
        }  

        function clearChat() {  
            var xhr = new XMLHttpRequest();  
            xhr.open('POST', 'clearChat.php', true);  
            xhr.onload = function() {  
                if (this.status === 200) {  
                    document.getElementById('chat-box').innerHTML = '';  
                }  
            };  
            xhr.send();  
        }
        setInterval(getMessages, 1000);  
    </script>  
</body>  
</html>