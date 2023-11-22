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
</head>

<body>

	<div>
		<img src="{{ asset('icon_home1.png') }}" alt="description of myimage" class="img-fluid float-right" id="img_h1">
		<div id="home_t1" class="col-md-6 col-sm-12 mx-auto text-center text-sm-start fs-1">
			<p>Learn. Cook. Share.</p>
			<p>Cooking Made Easy.</p>
			<p class="fs-5">Say good bye to long and frustrating food blogs and recipe videos. Access our recipe cards to prepare any dish in minutes.</p>
		</div>
		<button type="button" class="btn btn-primary" id="home_btn1">Explore</button>

	</div>

	<div>
		<p class="text-lg-right text-center fs-2" id="home_t2">View All Dishes</p>
	</div>



	<div>
		<div class="container" style="margin-left: 60px">
			<div class="row">
				<div class="col-12 d-flex justify-content-center  flex-wrap" style="padding-right: 120px; margin-left:120px">
					@foreach ($dishes_all as $dishes)
					<div class="container_allDishes">
						<div class="card" style="width: 16rem;margin-bottom: 20px;margin-right:30px; box-shadow:20p 20px black;">

							<a href="/dish/{{$dishes->id}}"><img src="{{URL::asset('uploads/dishes/' . $dishes->dish_image)}}" class="card-img-top"></a>
							<div class="card-body">
								<h5 class="card-title">{{$dishes->dish_name}}</h5>
								<h6 class="card-subtitle mb-2 text-muted">Cuisine: {{$dishes->dish_cuisine}} </h6>
								<p class="card-subtitle mb-2 text-muted" style="font-size:small">By: {{$dishes->dish_email}} </p>
								<p class="card-text">Ingredients: {{$dishes->dish_ingredients}}</p>
								<p class="card-text">Preparation Time: {{$dishes->dish_time}}</p>
							</div>
						</div>
					</div>
					@endforeach

				</div>

			</div>

		</div>
	</div>

</body>
<style type="text/css">
	#search_bar {
		display: block;
		height: auto;
		width: 100%;
		float: right;
	}

	#home_t2 {
		display: inline-flex;
		height: auto;
		width: 100%;
		align-content: center;
		float: right;
		align-items: center;
		padding-left: 40%;
		font-family: "Trirong", serif;
		background-color: #abd6ff;
	}

	#img_h1 {
		display: block;
		max-width: 45%;
		height: auto;
		align-content: end;
		float: right;
	}

	body {
		background-color: whitesmoke;
	}

	#home_t1 {
		display: block;
		height: auto;
		align-content: start;
		float: left;
		padding-left: 16%;
		padding-top: 10%;
		background-color: whitesmoke;
		font-family: "Trirong", serif;
	}

	#home_btn1 {
		display: block;
		height: auto;
		align-content: start;
		float: left;
		margin-left: 26%;
		margin-top: 2%;
		font-family: "Trirong", serif;
	}

	* {
		font-family: "Trirong", serif;
	}
</style>
<script>

</script>

</html>
@stop