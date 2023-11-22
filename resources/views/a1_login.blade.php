@extends('layout')
@section('content')

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
</head>

<body>
	<div class="mybg"></div>
	<div class="content">
		<div class="container-bg min-vh-100 d-flex justify-content-center align-items-center">

			<form action="{{route('login.post')}}" method="POST" style="background-color: #abd6ff; border-radius: 10%; padding:40px; box-shadow:0 2px 4px 0 rgba(0,0,0,.2);">
				@csrf
				<p>Login</p>
				<div class="mb-3">
					<label class="form-label">Email address</label>
					<input type="email" class="form-control" name="email">
					<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				<button type="submit" class="btn btn-primary" style="margin-top: 12px;">Submit</button>
			</form>
		</div>
	</div>





</body>
<style type="text/css">
	* {
		font-family: "Trirong", serif;
	}

	body {
		background-image: url('/images/bg_signup.jpg');
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>


</html>

@stop