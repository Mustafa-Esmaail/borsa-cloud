
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App Socket.io</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            .chat-row {
                margin: 50px;
            }


             ul {
                 margin: 0;
                 padding: 0;
                 list-style: none;
             }


             ul li {
                 padding:8px;
                 background: #928787;
                 margin-bottom:20px;
             }


             ul li:nth-child(2n-2) {
                background: #c3c5c5;
             }


             .chat-input {
                 border: 1px soild lightgray;
                 border-top-right-radius: 10px;
                 border-top-left-radius: 10px;
                 padding: 8px 10px;
                 color:#fff;
             }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="row chat-row">
                <div class="chat-content">
                    <ul>
                        <img sr="<?php echo e(asset('storage/chat_img/wTYnNpNn1mBASEZbcHmBouqRGAtHRnAMtncayxG3.jpg')); ?>">

                    </ul>
                </div>

                <div class="chat-section">
                    <div class="chat-box">
                        <div class="chat-input bg-primary" id="chatInput" contenteditable="">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>


        <script>
            const socket = io('http://localhost:3000');

            // Replace USER_ID with the actual user ID
            const userId = 5;

            // Join the private room when connected
            socket.on('connect', () => {
            socket.emit('privateMessage', {
                userId: userId,
                message: 'Hello, this is a private message!',
            });
            });

            // Listen for private messages in the private room
            socket.on('privateMessage', (data) => {
            console.log(`Received private message: ${data.message} from user ${data.sender}`);
            });





            // $(function() {
            //     let ip_address = '127.0.0.1';
            //     let socket_port = '3000';
            //     let socket = io(ip_address + ':' + socket_port);

            //     let chatInput = $('#chatInput');

            //     chatInput.keypress(function(e) {
            //         let message = $(this).html();
            //         console.log(message);
            //         if(e.which === 13 && !e.shiftKey) {
            //             socket.emit('sendChatToServer', message);
            //             chatInput.html('');
            //             return false;
            //         }
            //     });

            //     socket.on('sendChatToClient', (message) => {
            //         $('.chat-content ul').append(`<li>${message}</li>`);
            //     });
            // });
        </script>
    </body>
</html>
<?php /**PATH /home3/borsacloud/public_html/resources/views/welcome.blade.php ENDPATH**/ ?>