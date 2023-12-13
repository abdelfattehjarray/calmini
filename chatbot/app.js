// Selecting the necessary elements from the DOM
const chatBody = document.querySelector(".chat-body");
const txtinput = document.querySelector("#txtinput");
const send = document.querySelector(".send");
const loadingEle = document.querySelector(".loading");
const chatButton = document.querySelector(".chatButton");
const chatHeader = document.querySelector(".chat-header");
const container = document.querySelector(".chatcontainer");

// Hiding the chat container initially
container.style.display = "none";

// Initializing variables
let isShowChat = false;
let isShowIcon = true;

// Event listener for showing/hiding the chat container
chatButton.addEventListener("click", () => {
  if (!isShowChat) {
    container.style.display = "block";
    chatButton.style.display = "none";
    isShowChat = true;
  }
});

chatHeader.addEventListener("click", () => {
  if (isShowIcon) {
    container.style.display = "none";
    isShowChat = false;
    chatButton.style.display = "block";
  }
});

// Event listener for sending user message
send.addEventListener("click", () => renderUserMessage());

// Event listener for sending user message when Enter key is pressed
txtinput.addEventListener("keyup", (event) => {
  if (event.keyCode === 13) {
    renderUserMessage();
  }
});

// Function to render user message
const renderUserMessage = () => {
  const userInput = txtinput.value;
  renderMessageEle(userInput, "user");
  txtinput.value = "";
  toggleLoading(false);
  renderChatbotResponse(userInput);
  // console.log(renderChatbotResponse(userInput));
  
};

// Function to render chatbot response
const renderChatbotResponse = (userInput) => {
  const res = getChatbotResponse(userInput);
  
};

// Function to render message elements
const renderMessageEle = (txt, type) => {
  let className = "user-message";
  const messageEle = document.createElement("div");
  const txtNode = document.createTextNode(txt);
  
  messageEle.append(txtNode);
  if (type !== "user") {
    // console.log(txtNode);
      
    className = "chatbot-message";
    messageEle.classList.add(className);
    const botResponseContainer = document.createElement("div");
    botResponseContainer.classList.add("bot-response-container");
    const botImg = document.createElement("img");
    botImg.setAttribute("src", "../chatbot/images/chatbot.png");
    botResponseContainer.append(botImg);
    botResponseContainer.append(messageEle);
    chatBody.append(botResponseContainer);
  } else {
    messageEle.classList.add(className);
    chatBody.append(messageEle);
  }
};

// Function to get chatbot response
const getChatbotResponse = (userInput) => {
  chatBotService
    .getBotResponse(userInput)
    .then((response) => {
      renderMessageEle(response);
      // ***************
      console.log(response);

      if(response !== ""){
        if(!synth.speaking){
            textToSpeech(response);
        }
        if(response.length > 80){
            setInterval(()=>{
                if(!synth.speaking && !isSpeaking){
                    isSpeaking = true;
                   // speechBtn.innerText = "Convert To Speech";
                }else{
                }
            }, 500);
            if(isSpeaking){
                synth.resume();
                isSpeaking = false;
                speechBtn.innerText = "Pause Speech";
            }else{
                synth.pause();
                isSpeaking = true;
                speechBtn.innerText = "Resume Speech";
            }
        }else{
            //speechBtn.innerText = "Convert To Speech";
        }
    }

      setScrollPosition();
      toggleLoading(true);
      
    })
    .catch((error) => {
      setScrollPosition();
      toggleLoading(true);
    });
    
};

// Function to set the scroll position to the bottom of the chat container
const setScrollPosition = () => {
  if (chatBody.scrollHeight > 0) {
    chatBody.scrollTop = chatBody.scrollHeight;
  }
};

// Function to toggle loading animation
const toggleLoading = (show) => loadingEle.classList.toggle("hide", show);

// Object containing chatbot responses
const responseObj = {
  hello: "Hey ! How are you doing ?",
  hey: "Hi ! How can I help you?",
  today: new Date().toDateString(),
  time: new Date().toLocaleTimeString(),
  "i love you":"i love you too and i'm here for you!",
  update:"u can update  by click the button of the person you want to update",
  modifier:"u can update  by click the button of the person you want to update",
  modif:"u can update  by click the button of the person you want to update",
  "update?":"u can update  by click the button of the person you want to update in the list existed in medecin ",
  "modifier?":"u can update  by click the button of the person you want to update in the list existed in medecin ",
  "stat?":"u can find two types of stat bar stat which contain the level of experience of the coachs and pie stat contains the type of cochs ",
  "stat":"u can find two types of stat bar stat which contain the level of experience of the coachs and pie stat contains the type of cochs ",
  "statistique":"u can find two types of stat bar stat which contain the level of experience of the coachs and pie stat contains the type of cochs ",
  "statistique?":"u can find two types of stat bar stat which contain the level of experience of the coachs and pie stat contains the type of cochs ",
  "Search.":"you can search a coach by using the search bar or you can put his information in the groupbox situated in the table",
  chercher:"Vous pouvez rechercher un coach de vie en utilisant la barre de recherche ou vous pouvez entrer ses informations dans la groupbox située dans le tableau.",
  "Find.":"you can find a coach by using the search bar or you can put his information in the groupbox situated in the table",
  abcdef:"a b c d e f g h i j k l m n o p q r s t u v w x y z this is the alphabet if you need it ",
  delete:"you can delete a coach by using the delete button and all avis of this coach will disappear or you can delete an avis of a specefic coach",
  "delete?":"you can delete a coach by using the delete button and all avis of this coach will disappear or you can delete an avis of a specefic coach",
  20:"When your professor sees me and how I'm working, he will absolutely give you a 20 in the evaluation.",
  shit:"How dare you!Please Do not use cursing words it can hurt others like it did to me!",
  "fuck you":"How dare you!Please Do not use cursing words it can hurt others like it did to me!",
  fuck:"How dare you!Please Do not use cursing words it can hurt others like it did to me!",
  "you are sweet":"Arigato! Don't tell the others i'm only this sweet with you",
  "":"Did you know?The First Computer Weighed More Than 27 Tons",
  " ":"Did you know?Hackers Write About 6,000 New Viruses Each Month",
  "who are you?":"im bemo your assistant i can tell u anything about this part of website",
  "thanks":"that is my duty to help you don't ever hesitate to ask if u need me",
  "thank you":"that is my duty to help you don't ever hesitate to ask if u need me",

};

// Function to fetch response from the response object
const fetchResponse=(userInput)=>{
    return new Promise((res,reject)=>{
        try{
            setTimeout(()=>{
                res(responseObj[userInput]);
            },1200);
            
        }catch(error){
            reject(error);
        }
    });

};
const chatBotService = {
    getBotResponse(userInput){
        return fetchResponse(userInput);
    },
};
// ******************************************
// ******************************************
// ******************************************





const voiceList = document.querySelector("select"),
speechBtn = document.querySelector("button");

let synth = speechSynthesis,
isSpeaking = true;

voices();

function voices(){
    for(let voice of synth.getVoices()){
        let selected = voice.name === "Google US English" ? "selected" : "";
        let option = `<option value="${voice.name}" ${selected}>${voice.name} (${voice.lang})</option>`;
        
        voiceList.insertAdjacentHTML("beforeend", option);
    }
}

synth.addEventListener("voiceschanged", voices);


let isMuted = false;
const muteButton = document.getElementById("mute");
const muteImg = document.getElementById("muteBtn");

muteButton.addEventListener('click', () => {
  isMuted = !isMuted;
  if (isMuted) {
    muteImg.setAttribute("src", "../chatbot/images/mute.png");
  } else {
    muteImg.setAttribute("src", "../chatbot/images/volume.png");
  }
});

function textToSpeech(text) {
  // console.log("yes");
  // console.log(isMuted);
  let utterance = new SpeechSynthesisUtterance(text);
  for (let voice of synth.getVoices()) {
    if (voice.name === voiceList.value) {
      utterance.voice = voice;
    }
  }

  if (isMuted) {
    synth.cancel(); // stop speaking if the mute flag is set
  } else {
    synth.speak(utterance);
  }
}

const recordBtn = document.getElementById("click_to_record");
recordBtn.addEventListener('click',function(){
  var speech = true;
  window.SpeechRecognition = window.webkitSpeechRecognition;

  const recognition = new SpeechRecognition();
  recognition.interimResults = true;

  recognition.addEventListener('result', e => {
      const transcript = Array.from(e.results)
          .map(result => result[0])
          .map(result => result.transcript)
          
          // txtinput.value="nemchi jawi behy";
          txtinput.value = transcript;
          console.log(transcript);
  });
  
  if (speech == true) {
      recognition.start();
  }
})