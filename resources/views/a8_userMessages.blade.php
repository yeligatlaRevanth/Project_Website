@extends('layout')

@section('content')
<div class="container-fluid" style="padding: 20px;">
    <div class="row">
        <div class="col-md-12">
            <p class="message-heading" style="color: #f79402;">Chat Center</p>
        </div>
    </div>
    <div class="row">
        <!-- User list column -->
        <div class="col-md-3 user-list-container" style="padding-top: 30px;"> <!-- Adjust the width as needed -->
            <div class="user-list">
                <h2 style="font-size: x-large;border-bottom:3px solid white;">Friends</h2>
                <!-- User list content goes here -->
                <ul id="user-list" style="padding-top: 10px; list-style: none; padding-right:30px;">
                    @foreach($users as $user)
                    <li style="margin-bottom: 10px;">
                        <div class="user" style="display: flex; align-items: center; cursor: pointer;" data-user-id="{{ $user->id }}">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User Icon" style="width: 30px; margin-right: 10px;">
                            <span>{{ $user->name }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Chat container column -->
        <div class="col-md-9 chat-main-container"> <!-- Adjust the width as needed -->
            <!-- User info row -->
            <div class="row-user-name ms-3 col-md-9">
                <h5>User Name</h5>
            </div>

            <!-- Chat area -->
            <div class="chat-container mt-4 ">
                <div class="chat-area" style="height: 60vh;"> <!-- Set the width as needed -->
                    <!-- Chat history -->
                    <div class="chat-history">
                        <!-- Message history will be dynamically populated -->
                    </div>
                </div>
                <!-- Chat input -->
                <div class="chat-input">
                    <div class="input-group">
                        <input type="text" id="message-input" class="form-control" placeholder="Enter text here...">
                        <button id="send-message" class="btn btn-send-message" type="button"><i class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="empty_space"></div>
<style>
    .ms-6 {
        margin-left: 4rem;
    }

    .chat-main-container {
        border-top: 2px solid #f79402;
        padding-top: 20px;
        overflow-x: hidden;
    }

    .row-user-name {
        color: #f79402;
        background-color: white;
        padding-bottom: 10px;
        border-bottom: 2px solid #f79402;
    }

    .user-list-container {
        border: 3px solid black;
        border-radius: 10px;
        background-color: #f79402;
        color: white;
    }

    .empty_space {
        margin-top: 4rem;
    }

    .message-heading {
        font-size: xx-large;
        text-align: left;
    }

    .btn-send-message {
        background-color: #f79402;
        color: white;
    }
</style>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for user list items
        // Event listener for user list items
        document.querySelectorAll('.user').forEach(item => {
            item.addEventListener('click', event => {
                // Find the closest ancestor with the 'data-user-id' attribute
                const userId = event.target.closest('.user').getAttribute('data-user-id');
                console.log('User ID:', userId); // Check the extracted user ID
                const username = event.target.textContent.trim();
                loadChatHistory(userId, username);
                // Update the username display
                document.querySelector('.row-user-name h5').textContent = username;

                // Update URL with user ID
                history.pushState(null, null, `/messages/${userId}`);
            });
        });


        // Function to load chat history for a specific user
        function loadChatHistory(userId, username) {
            // Clear the existing chat history
            document.querySelector('.chat-history').innerHTML = '';

            // Fetch chat history from the server
            axios.get(`/messages/${userId}`)
                .then(function(response) {
                    // Process the received chat history data
                    const chatHistory = response.data;
                    console.log(chatHistory);

                    // Check if chatHistory is an array
                    if (Array.isArray(chatHistory)) {
                        // Append each message to the chat history
                        chatHistory.forEach(function(message) {
                            appendMessage(message);
                        });
                    } else {
                        console.error('Chat history is not an array:', chatHistory);
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        // Function to append a message to the chat history
        function appendMessage(message) {
            const timestamp = message.timestamp;
            const content = message.content;
            const sender = message.sender;

            const messageData = `
                <li class="clearfix" style="list-style: none;">
                    <div class="message-data" style="display: flex; align-items: center;">
                        <div style="display: flex; flex-direction: column;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar" style="width: 30px; margin-right: 10px;">
                            <span class="message-data-time" style="font-size: 10px;">${timestamp}</span>
                        </div>
                        <div class="message other-message" style="background-color: #e2e2e2; border-radius: 10px; padding: 5px;">${content}</div>
                    </div>
                </li>
            `;
            // Append the new message to the chat history
            document.querySelector('.chat-history').innerHTML += messageData;
        }

        var pusher = new Pusher('465e3653be5b696fa7a2', {
            cluster: 'ap2',
            encrypted: true
        });

        var channel = pusher.subscribe('chat');

        // Event listener for receiving messages
        channel.bind('App\\Events\\MessageSent', function(data) {
            // Handle received message
            appendMessage(data);
        });

        // Event listener for sending messages
        // Event listener for sending messages
        document.getElementById('send-message').addEventListener('click', function() {
            var messageInput = document.getElementById('message-input').value;
            var userId = document.querySelector('.row-user-name h5').textContent.trim(); // Get the userId from the username display
            // Send the message to the server
            axios.post(`/messages/${userId}`, { // Include userId in the URL
                    message: messageInput
                })
                .then(function(response) {
                    // Check if the response contains a message
                    if (response.data && response.data.message) {
                        // Append the sent message to the chat history
                        appendMessage(response.data.message);
                        // Clear the message input field
                        document.getElementById('message-input').value = '';
                    } else {
                        console.error('Message not found in response:', response);
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        });

    });
</script>
@endsection