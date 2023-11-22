@extends('layout')
@section('content')



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/294239cf6e.js" crossorigin="anonymous"></script>
</head>

<body>

	<div class="modal fade" id="addDishModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Add Dish</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" enctype="multipart/form-data" action="{{route('dishadd.post')}}">
						@csrf
						<div>
							<label class="form-label" for="customFile">Upload Dish Image</label>
							<input type="file" name="dish_image" class="form-control" id="customFile" />
						</div>
						<p style="font-size: smaller;">A dish picture is useful for people to see the final recipe</p>
						<div class="mb-3">
							<label class="form-label">Name of Dish</label>
							<input type="text" name="dish_name" class="form-control" id="input_nameOfDish">
						</div>
						<p style="font-size: big;">Select Cuisine Type</p>

						<select name="dish_cuisine" class="selectpicker">
							<option value="American">American</option>
							<option value="Chinese">Chinese</option>
							<option value="Indian">Indian</option>
							<option value="Italian">Italian</option>
						</select>
						<p style="font-size: big; margin-top:20px">Ingredients</p>
						<textarea id="ta_ingr" name="dish_ingredients" rows="4" cols="47"></textarea>

						<p style="font-size: big; margin-top:20px">Directions</p>
						<textarea id="ta_dir" name="dish_dir" rows="4" cols="47"></textarea>

						<p style="font-size: big; margin-top:20px">Preparation Time</p>
						<input type="text" name="dish_time" placeholder="30 Minutes, 1.5 Hours etc." style="padding-right: 250px;">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>

				</div>

			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-3">

				<div class="me-2 mt-5">
					<div id="user_basic_container" style=" background-color: #deefff; height:580px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
						<div class=".img-fluid. max-width:500px;" id="user_basic">
							<img src="{{asset('icon_userprofile.png')}}" id="ub_img">
							<p class="h3" id="ub_name">{{Auth::user()->name}}</p>
							<p class="h6" id="ub_desc">Testing new user.Loves cooking in free time. LPU undergrad student.</p>
						</div>


						<div id="ub_deets1">
							<p>Level</p>
							<h5><span class="badge bg-secondary">Novice</span></h5>
						</div>
						<div id="ub_deets2">
							<p>Member Since</p>
							<h5><span class="badge bg-secondary">Nov 11, 2023</span></h5>
						</div>

						<div class="row">
							<div class="col-6">
								<a type="button" href="/logout" class="btn btn-primary" style="display:flex; margin: auto;margin-top :20px;width:80px">Logout</a>
							</div>
							<div class="col-6">
								<a type="button" href="#" class="btn btn-primary" style="display:flex; width:60px;margin-top :20px">Edit</a>
							</div>
						</div>
						<div>

						</div>

					</div>
				</div>
			</div>

			<div class="col-9">
				<!-- Right Column Row -1 Starts Below -->
				<div class="row mt-5 ms-6" id="abt_user">
					<div class="col-12">
						<div class="row w-100 ">
							<div class="col-12 d-flex align-content-center ">
								<h1 style="font-size: 25px;font-weight:600; margin-top:20px" id="abt">About</h1>
							</div>

						</div>
						<div class="row mt-2 ">
							<div class="col-3" id="posMar">
								<p style="font-weight: 600;">Full Name</p>
							</div>
							<div class="col-3" id="negMar">
								<p>{{Auth::user()->name}}</p>
							</div>
							<div class="col-3" id="posMar">
								<p style="font-weight: 600;">Gender</p>
							</div>
							<div class="col-3" id="negMar">
								<p>Male</p>
							</div>
						</div>

						<div class="row">
							<div class="col-3">
								<p style="font-weight: 600;" id="posMar">Email</p>
							</div>
							<div class="col-3" id="negMar">
								<p>{{Auth::user()->email}}</p>
							</div>
							<div class="col-3">
								<p style="font-weight: 600; margin-left: 20px;" id="posMar">Location</p>
							</div>
							<div class="col-3" id="negMar">
								<p>Hyderabad</p>
							</div>
						</div>
					</div>
				</div>
				<!-- Right column Row - 2 starts below -->
				<div class="row" id="user_posts">
					<div class="col-12" style="background-color: #deefff; " ;>
						<div class="row mt-4">
							<div class="col-3">
								<p class="ms-4" style="font-size: 25px;font-weight:600" id="posts">Posts</p>
							</div>
							<div class="col-9 d-flex justify-content-end ">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDishModal">
									Create Post
								</button>
							</div>
						</div>
						<div class="row">

							<div class="container_user_posts" style="margin-left: 60px;height:580px;">
								<div class="container d-flex justify-content-center  flex-wrap" style="padding-right: 120px;">
									@foreach ($dishes_all as $dishes)
									<div class="container_allDishes">
										<div class="card" style="width: 16rem;margin-bottom: 20px;margin-right:20px; box-shadow:20p 20px black">
											<img src="{{URL::asset('uploads/dishes/' . $dishes->dish_image)}}" class="card-img-top">
											<div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
												<h5 class="card-title">{{$dishes->dish_name}}</h5>
												<h6 class="card-subtitle mb-2 text-muted">Cuisine: {{$dishes->dish_cuisine}} </h6>
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

				</div>
			</div>
		</div>
	</div>
	</div>

	</div>

</body>
<script>
	$(document).ready(function() {
		$('.selectpicker').change(function() {
			var selectedCuisine = $(this).children("option:selected").val();
			console.log(selectedCuisine);
		})
	})
</script>

<style type="text/css">
	.container_user_posts {
		display: flex;
		flex-wrap: wrap;
		padding-top: 20px;
		margin-top: 20px;
	}

	.card {
		background-color: whitesmoke;
	}

	.selectpicker {
		padding-right: 350px;
	}

	.dropdown-toggle::after {
		margin-left: 340px;
	}

	.container_dish>.dish_desc {
		display: flex;
		justify-content: flex-start;
		flex-wrap: wrap;
		font-size: smaller;
	}

	.container_dish>.dish_title {
		display: flex;
		justify-content: center;
		flex-wrap: wrap;
	}

	.container_dish {
		background-color: whitesmoke;
	}

	.container_dish>img {
		width: 200px;
		height: 200px;
	}

	.container_allDishes {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	#abt {
		font-size: larger;
	}

	#user_posts {
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		background-color: #deefff;
		height: 52%;
		align-items: center;
		margin-top: 30px;
	}

	#posMar {
		margin-left: 12px;
		
	}

	#negMar {
		margin-left: -12px;
	}

	#abt::before {
		content: url('https://fontawesome.com/icons/user?f=classic&s=solid&pc=%23000000');
		width: 20px;
		height: auto;
		display: inline-block;
	}

	#abt_user {
		background-color: #deefff;
		display: block;
		overflow: auto;
		align-items: center;
		 box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

	}

	#ub_deets1,
	#ub_deets2 {
		background-color: #9fb1bf;
		width: 90%;
		height: auto;
		margin: auto;
		display: flex;
		justify-content: space-between;
		padding-top: 8px;
		padding-left: 12px;
		padding-right: 12px;

	}

	#ub_img {
		width: 80%;
		height: 40vh;
		margin-left: 10%;
		margin-top: 8%;
	}

	#ub_desc {
		margin-left: 6%;

	}

	#ub_name {
		margin-left: 30%;
		margin-top: 4%;
	}

	body {
		background-image: url('/bg_signup.jpg');
	}

	* {
		font-family: "Trirong", serif;
	}
</style>

</html>
@stop