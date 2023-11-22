@extends('layout')
@section('content')

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>

<body>
	<div class="mybg">

	</div>

	<div class="content">
		<div class="container-bg min-vh-100 d-flex justify-content-center align-items-center">
			<div>
				@if(session()->has('error'))
				<div class="alert alert-danger">{{session('error')}}</div>
				@endif
				@if(session()->has('success'))
				<div class="alert alert-success">{{session('success')}}</div>
				@endif
			</div>


			<form action="{{route('signup.post')}}" method="POST" style="background-color: #abd6ff; border-radius: 10%; padding:30px; box-shadow:0 2px 4px 0 rgba(0,0,0,.2);">
				@csrf
				<p>Sign Up</p>
				<div class="mb-3">
					<label class="form-label"></label>
					<input type="text" class="form-control" placeholder="Full Name" name="name">
				</div>
				<div class="mb-3">
					<label class="form-label"></label>
					<input type="email" class="form-control" placeholder="Email" name="email">
					<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				</div>
				<div class="mb-3">
					<label class="form-label"></label>
					<input type="password" class="form-control" placeholder="Password" name="password1">
				</div>
				<div class="mb-3">
					<label class="form-label"></label>
					<input type="password" class="form-control" placeholder="Confirm Password" name="password2">
				</div>
				<button type="submit" class="btn" style="margin-left: 35%; background-color:#0384fc">Submit</button>
			</form>
		</div>


	</div>





</body>

<style type="text/css">
	* {
		font-family: "Trirong", serif;
	}

	body{
		background-image: url('/images/bg_signup.jpg');
		background-repeat: no-repeat;
		background-size: cover ;
	}

</style>

</html>

@stop