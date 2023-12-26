document.addEventListener('DOMContentLoaded', async () => {

    const chatbox = document.getElementById("chatbox");
    const chatContainer = document.getElementById("chat-container");
    const userInput = document.getElementById("user-input");
    const sendButton = document.getElementById("send-button");
    const openChatButton = document.getElementById("open-chat");
    const closeChatButton = document.getElementById("close-chat");

    let isChatboxOpen = true; // Set the initial state to open

    // Function to toggle the chatbox visibility
    function toggleChatbox() {
        chatContainer.classList.toggle("hidden");
        isChatboxOpen = !isChatboxOpen; // Toggle the state
    }

    // Add an event listener to the open chat button
    openChatButton.addEventListener("click", toggleChatbox);

    // Add an event listener to the close chat button
    closeChatButton.addEventListener("click", toggleChatbox);

    // Add an event listener to the send button
    sendButton.addEventListener("click", function () {
        const userMessage = userInput.value;
        if (userMessage.trim() !== "") {
            addUserMessage(userMessage);
            respondToUser(userMessage);
            userInput.value = "";
        }
    });



    userInput.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            const userMessage = userInput.value;
            addUserMessage(userMessage);
            respondToUser(userMessage);
            userInput.value = "";
        }
    });


    // create msg for user side
    function addUserMessage(message) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("mb-2", "text-right");
        const msgElement = document.createElement('p')
        msgElement.classList = 'bg-green-600 text-white rounded-lg py-2 px-4 inline-block'
        msgElement.textContent = message
        messageElement.appendChild(msgElement)
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    function addBotMessage(message, color = '') {
        const messageElement = document.createElement("div");
        messageElement.classList.add("mb-2");
        messageElement.innerHTML = `<p class=" ${color && color}bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block">${message}</p>`;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }



    function addBotThinking(reponded) {
        if (reponded) {

            const messageElement = document.createElement("div");
            messageElement.classList.add("mb-2");
            messageElement.innerHTML = `<p id='think' class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 flex justify-start items-center gap-x-1">Thinking            
            <span class='h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce [animation-delay:-0.3s]'></span>
            <span class='h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce [animation-delay:-0.15s]'></span>
            <span class='h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce'></span></p>`;
            chatbox.appendChild(messageElement);
            chatbox.scrollTop = chatbox.scrollHeight;
        } else {
            document.getElementById('think').remove()
        }
    }

    function respondToUser(userMessage) {

        // chatbot logic
        const API_URL = 'https://api.openai.com/v1/chat/completions';
        const API_KEY = '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';

        //display msg thinging
        addBotThinking(true)
        const requestOptions = {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${API_KEY}` // Added space after 'Bearer'
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo",
                max_tokens: 100,
                messages: [{
                    role: "user",
                    content: `${userMessage}`
                }]
            })
        };

        fetch(API_URL, requestOptions)
            .then(res => res.json()) // Fixed 'than' to 'then'
            .then(data => {
                //remove msg thinging
                addBotThinking(false)
                console.log(data);
                addBotMessage(data.choices[0].message.content);

            })
            .catch(error => {

                //remove msg thinging
                addBotMessage('Oops something went wrong, Please try again .APi KEY', 'bg-red-50 text-red-500');


                addBotThinking(false)
            });




    }

    // Automatically open the chatbox on page load
    // toggleChatbox();
})