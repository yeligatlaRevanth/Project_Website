@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
	<!-- Add Font Awesome CDN link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<style type="text/css">
		body {
			background-color: whitesmoke;
			overflow-x: hidden;
			/* Hide horizontal scrollbar */
		}

		.segment-control {
			display: flex;
			justify-content: flex-start;
			margin-bottom: 10px;
			/* Adjusted margin */
			margin-left: 20px;
			/* Adjusted margin */
		}

		.segment-item {
			padding: 8px 16px;
			margin: 0 5px;
			border: none;
			background-color: #f0f0f0;
			color: #666;
			cursor: pointer;
			font-size: 16px;
			outline: none;
			border-radius: 20px;
			transition: background-color 0.3s ease;
		}

		.segment-item.active {
			color: #fff;
			background-color: #f79402;
		}

		.segment-item:hover {
			background-color: #f9d7b8;
		}

		#home_t1 {
			font-family: "Trirong", serif;
			background-color: #f79402;
			color: white;
			border-top-left-radius: 20px;
			border-bottom-left-radius: 20px;
			width: 70%;
			/* Adjusted width */
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 20px;
		}

		#home_t1 p {
			margin-bottom: 0;
			font-size: 24px;
		}

		#home_t1 p:nth-child(1),
		#home_t1 p:nth-child(2) {
			font-size: 26px;
		}

		#home_t1 p:nth-child(3) {
			margin-top: 20px;
			margin-bottom: 50px;
			font-size: 18px;
		}

		#home_btn1 {
			background-color: white;
			color: #f79402;
			border-color: #f79402;
		}

		#img_h1 {
			width: 40%;
			height: auto;
			border-top-right-radius: 20px;
			border-bottom-right-radius: 20px;
		}

		.container_allDishes {
			display: flex;
			margin-top: 20px;
			margin-bottom: 20px;
			overflow-x: hidden;
			/* Hide horizontal scrollbar */
		}

		.container_allDishes .card {
			flex: 0 0 auto;
			width: 16rem;
			margin-right: 20px;
		}

		.container {
			max-width: 100%;
		}

		.col-lg-9 {
			width: 90%;
			/* Adjusted width */
		}

		@media (max-width: 768px) {
			.container_allDishes .card {
				width: 80%;
			}

			#home_t1 {
				width: 100%;
				/* Adjusted width */
			}
		}

		.container1 {
			margin-left: 4rem;
		}

		/* Hide scrollbar for Firefox */
		.container_allDishes::-webkit-scrollbar,
		body::-webkit-scrollbar {
			display: none;
		}
	</style>
</head>

<body>

	<div class="container text-center mt-5">
		<div class="row align-items-center justify-content-center">
			<div class="col-lg-9 col-md-12 col-sm-12 mx-auto d-flex rounded overflow-hidden" style="background-color: #f0f0f0;">
				<div id="home_t1" class="p-4">
					<p>Learn. Cook. Share.</p>
					<p>Cooking Made Easy.</p>
					<p class="fs-5">Say goodbye to long and frustrating food blogs and recipe videos. Access our recipe cards to prepare any dish in minutes.</p>
					<button type="button" class="btn btn-primary mt-3" id="home_btn1">Explore</button>
				</div>
				<img src="{{ asset('icon_home2.jpg') }}" alt="description of myimage" class="img-fluid" id="img_h1">
			</div>
		</div>
	</div>


	<div class="container1 mt-5">
		<div class="row">
			<div class="col-12">
				<p id="starving-section" class="text-lg-right text-center fs-2 mt-5" style="font-family:Trirong"><span style="color:#f79402;">Starving?</span> We got you covered</p>
				<p class="text-lg-right text-center fs-6" style="font-family:Trirong">Search across the wide range of dishes that our users love</p>

			</div>
		</div>
	</div>


	<div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="d-flex align-items-center">
						<button class="btn btn-link" id="scroll-left"><i class="fas fa-chevron-left"></i></button>
						<div class="container_allDishes" id="container-all-dishes">
							<!-- Cards content -->
							@foreach ($dishes_all as $dishes)<div class="card">
								<a href="/dish/{{$dishes->id}}"><img src="{{URL::asset('uploads/dishes/' . $dishes->dish_image)}}" style="height:250px" class="card-img-top"></a>
								<div class="card-body">
									<h5 class="card-title">{{$dishes->dish_name}}</h5>
									<p class="card-subtitle mb-2 text-muted" style="font-size:small">By: {{$dishes->dish_email}} </p>
									<p class="card-text">Preparation Time: {{$dishes->dish_time}}</p>
								</div>
							</div>@endforeach
						</div>
						<button class="btn btn-link" id="scroll-right"><i class="fas fa-chevron-right"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.getElementById('scroll-left').addEventListener('click', function() {
			document.getElementById('container-all-dishes').scrollLeft -= 100;
		});

		document.getElementById('scroll-right').addEventListener('click', function() {
			document.getElementById('container-all-dishes').scrollLeft += 100;
		});

		document.getElementById('home_btn1').addEventListener('click', function() {
			// Get the Y-coordinate of the section to scroll to
			const sectionY = document.getElementById('starving-section').offsetTop;

			// Scroll smoothly to the section
			window.scrollTo({
				top: sectionY,
				behavior: 'smooth'
			});
		});
	</script>

</body>

</html>

@stop