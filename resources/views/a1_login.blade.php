@extends('layout')
@section('content')

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
	<style type="text/css">
    .container-bg {
        border-radius: 20%;
    }

    * {
        font-family: "Trirong", serif;
    }

    body {
        background-color: white;
    }
</style>
</head>

<body>
    <div class="content">
        <!-- Customize the size of the total container below -->
        <div class="container-bg min-vh-100 d-flex justify-content-center align-items-center mt-4" style="height:75%;">
            <form action="{{ route('login.post') }}" method="POST" style="border-radius: 20%; padding: 20px;">
                @csrf
                <div style="display: flex;">
                    <div style="flex: 1; background-color: #fde5c2; padding: 20px; border-top-left-radius: 20px; border-bottom-left-radius: 0px; display: flex; flex-direction: column; justify-content: center;">
                        <div style="text-align: center; margin-bottom: 20px;">
                            <p style="font-size:2em;">Login</p>
                        </div>
                        <div class="mb-3" style="text-align: left; margin-left: 20px;">
                            <label class="form-label" style="font-size:1em;">Email address</label>
                            <input type="email" class="form-control" name="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3" style="text-align: left; margin-left: 20px;">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn" style="margin-left: 250px; margin-top:40px; background-color:#f79402; color:white; width: 100px;">Submit</button> <!-- Adjust width as needed -->
                    </div>
                    <div style="flex: 1;">
                        <img src="icon_login2.jpg" alt="Login Icon" style="width: 100%; height: auto; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>




</html>

@stop
