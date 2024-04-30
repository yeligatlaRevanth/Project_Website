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

		.ms-6 {
			margin-left: 5rem;
		}
	</style>
</head>

<body>
	<div class="content">
		<div class="container-bg min-vh-100 d-flex justify-content-center align-items-center mt-4 ms-6" style="width:90%;height:auto;"> <!-- Adjust height as needed -->
			<form action="{{ route('signup.post') }}" method="POST" style="display: flex;">
				@csrf
				<div style="flex: 1; display: flex;">
					<img src="icon_signup.jpg" alt="Login Icon" style="width: 50%; height: auto; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
					<div style="background-color: #fde5c2; padding: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; display: flex; flex-direction: column; justify-content: center; flex: 2;">
						<div style="text-align: center; margin-bottom: 20px;">
							<p style="font-size:2em;">Sign Up</p>
						</div>
						<div class="ms-3 me-">
							<div class="mb-3" style="text-align: left;">
								<label class="form-label" style="font-size:1em;">Full Name</label>
								<input type="text" class="form-control" placeholder="Full Name" name="name">
							</div>
							<div class="mb-3" style="text-align: left;">
								<label class="form-label" style="font-size:1em;">Email address</label>
								<input type="email" class="form-control" placeholder="Email" name="email">
								<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
							</div>
							<div class="mb-3" style="text-align: left;">
								<label class="form-label" style="font-size:1em;">Password</label>
								<input type="password" class="form-control" placeholder="Password" name="password1">
							</div>
							<div class="mb-3" style="text-align: left;">
								<label class="form-label" style="font-size:1em;">Confirm Password</label>
								<input type="password" class="form-control" placeholder="Confirm Password" name="password2">
							</div>
							<button type="submit" class="btn" style="background-color:#f79402;width: 100px;margin-left: 250px;">Submit</button> <!-- Adjust other styles as needed -->


						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>

@stop