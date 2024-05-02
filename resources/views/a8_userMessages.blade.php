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
                <!-- User list content goes here -->
                <!-- User list content goes here -->
                <ul style="padding-top: 10px; list-style: none; padding-right:30px;">
                    <li style="margin-bottom: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User Icon" style="width: 30px; margin-right: 10px;">
                            <span>User John</span>
                        </div>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User Icon" style="width: 30px; margin-right: 10px;">
                            <span>User Smith</span>
                        </div>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User Icon" style="width: 30px; margin-right: 10px;">
                            <span>User Alice</span>
                        </div>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="User Icon" style="width: 30px; margin-right: 10px;">
                            <span>User Mike</span>
                        </div>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="User Icon" style="width: 30px; margin-right: 10px;">
                            <span>User Emily</span>
                        </div>
                    </li>
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
                        <!-- Message history -->
                        <ul class="m-b-0">
                            <li class="clearfix" style="list-style: none;">
                                <div class="message-data" style="display: flex; align-items: center;">
                                    <div style="display: flex; flex-direction: column;">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar" style="width: 30px; margin-right: 10px;">
                                        <span class="message-data-time" style="font-size: 10px;">10:10 AM, Today</span>
                                    </div>
                                    <div class="message other-message" style="background-color: #e2e2e2; border-radius: 10px; padding: 5px;"> Hi Aiden, how are you? How is the project coming along? </div>
                                </div>
                            </li>
                            <!-- Add more message items here -->
                            <li class="clearfix" style="list-style: none;">
                                <div class="message-data" style="display: flex; align-items: center; justify-content: flex-end;">
                                    <div class="message my-message" style="background-color: #d4e6f1; border-radius: 10px; padding: 5px;"> Hi! I'm doing great, thanks for asking. The project is coming along nicely. </div>

                                    <div style="display: flex; flex-direction: column;">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="avatar" style="width: 30px; margin-left: 10px;">
                                        <span class="message-data-time" style="font-size: 10px;">10:12 AM, Today</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Chat input -->
                <div class="chat-input">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter text here...">
                        <button class="btn btn-send-message" type="button"><i class="fa fa-paper-plane"></i></button>
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
@endsection