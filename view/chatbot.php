
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Asssitance</title>
    <link rel="stylesheet" href="../chatbot/style.css" />
  
</head>

<body>
 
<button hidden></button>            
<br><br><br><br><br><br><br><br> 
<br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br>
 
    <div class="chatcontainer collapse">
        <div class="chat-header">
            <div class="logo">
                <img src="../chatbot/images/chaticon.png" alt="icon">
            </div>
            <div class="title">ChatBot</div>
        </div>
        <div class="outer">
            <select></select>
            <button id="mute" value="off"><img id="muteBtn" src="../chatbot/images/volume.png" alt="icon"></button>
        </div>

        <div class="chat-body">
            <div class="loading hide">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
                <div class="circle circle-3"></div>
            </div>
        </div>
        <div class="chat-input">
            <div class="input-sec">
                <input type="text" id="txtinput" class="convert_text" placeholder="Type here" autofocus>
            </div>
            <button id="click_to_record"><img src="../chatbot/images/microphone.png" alt="send"></button>
            <div class="send">
                <img src="../chatbot/images/send-message.png" alt="send">
            </div>
        </div>
    </div>
    <button class="chatButton">
        <img src="../chatbot/images/chaticon.png" alt="icon" />
    </button>






    <script src="../chatbot/app.js"></script>
   
</body>

</html>