@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/294239cf6e.js" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<!-- User Basic Container -->

			<div class="col-3">
				<div class="me-2 mt-5">
					<div id="user_basic_container" style="background-color: #f79402; height:auto;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius:20px; padding: 20px;">
						<div class="img-fluid max-width:500px;" id="user_basic">
							<form id="user_form" method="POST" action="{{ route('dishadd.post') }}" enctype="multipart/form-data">
								@csrf
								<label for="uploadUserImage">
									<input type="file" id="uploadUserImage" style="display: none;" name="user_image" onchange="userImageUpload()">
									@php
									$avatar = Auth::user()->avatar;
									$avatarUrl = ($avatar && $avatar !== 'avatar.png') ? asset('uploads/users/' . $avatar) : asset('icon_userprofile.png');
									@endphp
									<img src="{{ $avatarUrl }}" id="ub_img" name="ub_img" style="width: 100px; height: 100px; border-radius: 50%; cursor: pointer;">
								</label>
							</form>
							<p class="h3" id="ub_name" style="margin-top: 20px;">{{Auth::user()->name}}</p>
							<p class="h6" id="ub_desc">Testing new user. Loves cooking in free time. LPU undergrad student.</p>
						</div>

						<div class="ubDetails" style="margin-top: 20px;">
							<p>Level</p>
							<h5><span class="badge bg-secondary">{{ $userLevel }}</span></h5>
						</div>
						<div class="ubDetails">
							<p>Member Since</p>
							<h5><span class="badge bg-secondary">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M d, Y') }}</span></h5>
						</div>

						<div style="margin-top: 20px; margin-right:130px;">
							<div>
								<a type="button" href="/logout" class="btn btnStyle" style="display:flex; margin: auto;">Logout</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Segment Control -->
			<div class="col-9">
				<div class="row mt-5 ms-6 mb-6">
					<div class="col-12 mb-5">
						<div class="row w-100">
							<div class="col-12 d-flex align-content-center justify-content-start">
								<ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist">
									<li class="nav-item" role="presentation">
										<button class="nav-link active" id="userPostsTab" data-bs-toggle="tab" data-bs-target="#userPosts" type="button" role="tab" aria-controls="userPosts" aria-selected="true">Your Posts</button>
									</li>
									<li class="nav-item" role="presentation">
										<button class="nav-link" id="profileTab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
									</li>
								</ul>
							</div>
						</div>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="currUserPosts" role="tabpanel" aria-labelledby="userPostsTab">
								<!-- Your Posts section content here -->
								<div class="col-12" style="background-color: whitesmoke; padding: 20px;">
									<div class="row mt-4">
										<div class="col-9">
											<p class="ms-4" style="font-size: 25px;font-weight:600; color: #f79402;" id="posts">Your Posts</p>
										</div>
										<div class="col-3">
											<button type="button" id="btnModal" class="btn btnStyle1" data-bs-toggle="modal" data-bs-target="#addDishModal">Create</button>
										</div>
									</div>
									<div class="row" style="overflow-y: auto; max-height: 300px;">
										<div class="container_user_posts" style="margin-top: 20px;">
											<div class="container d-flex justify-content-start flex-wrap" style="padding-right: 120px;">
												@if (count($dishes_all) === 0)
												<p style="background-color: #f79402; color: white; padding: 10px; margin-top: 10px; cursor: pointer; text-align: center; border-radius: 20px;" onclick="document.getElementById('btnModal').click()">Nothing to show here. Create your first one.</p>
												@else
												@foreach ($dishes_all as $dishes)
												<div class="container_allDishes" style="width: calc(33.33% - 20px); margin-right: 20px; margin-bottom: 20px;">
													<div class="card" style="width: 100%; height:fit-content">
														<a href="/dish/{{$dishes->id}}"><img src="{{URL::asset('uploads/dishes/' . $dishes->dish_image)}}" style="height:140px" class="card-img-top"></a>
														<div class="card-body">
															<h5 class="card-title">{{$dishes->dish_name}}</h5>
														</div>
													</div>
												</div>
												@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profileTab">
								<!-- Profile section content here -->
								<div class="row mt-5 ms-6">
									<div class="col-12">
										<div class="row w-100">
											<div class="col-12 d-flex align-content-center">
												<h1 style="font-size: 25px;font-weight:600; margin-top:20px; color: #f79402;" id="abt">Profile</h1>
											</div>
										</div>
										<div class="row mt-2 userProfile">
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
										<div class="row userProfile">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addDishModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Dish</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- Content loaded from a5_addDishModal.blade.php -->
					<div id="addDishContent" style="max-height: 70vh; overflow-y: auto;"></div>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	function userImageUpload() {
		document.getElementById("user_form").submit(); // Form submission
	}
	$(document).ready(function() {
		$('#addDishModal').on('show.bs.modal', function(event) {
			var modal = $(this);
			// Load content from a5_addDishModal.blade.php using AJAX
			$.ajax({
				url: '{{ route("addDishModal") }}',
				type: 'GET',
				success: function(response) {
					modal.find('#addDishContent').html(response);
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		});
	});
</script>

<script>
	$(document).ready(function() {
		$('#userPostsTab').click(function() {
			$('#currUserPosts').show();
			$('#profile').hide();
		});
		$('#profileTab').click(function() {
			$('#currUserPosts').hide();
			$('#profile').show();
		});
		document.getElementById('uploadUserImage').addEventListener('change', function(event) {
			const file = event.target.files[0];
			if (file && file.type.startsWith('image/')) {
				const reader = new FileReader();
				reader.onload = function(e) {
					document.getElementById('ub_img').src = e.target.result;
				};
				reader.readAsDataURL(file);
			}
		});


	});
</script>
<style type="text/css">
	.mb-6 {
		margin-bottom: 6rem;
	}

	.ubDetails {
		background-color: whitesmoke;
		width: 90%;
		height: auto;
		margin: auto;
		display: flex;
		justify-content: space-between;
		padding-top: 8px;
		padding-left: 12px;
		padding-right: 12px;
		color: black;
		border-radius: 4px;
	}

	.btnStyle1 {
		color: white;
		background-color: #f79402;
	}

	.btnStyle {
		background-color: white;
		color: #f79402;
	}

	.btnStyle1 {
		background-color: #f79402;
		color: white;
	}

	.container_user_posts {
		display: flex;
		flex-wrap: wrap;
		padding-top: 20px;
		margin-top: 20px;
	}

	.card {
		background-color: whitesmoke;
	}

	.userProfile {
		color: black;
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
		background-color: whitesmoke;
		margin-top: 30px;
		padding: 20px;
	}

	#user_basic label {
		display: block;
		text-align: center;
	}

	#posts {
		font-size: 25px;
		font-weight: 600;
		color: #f79402;
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

	body {
		color: white;
		font-family: "Trirong", serif;
	}

	#ub_img {
		width: 100px;
		height: 100px;
		border-radius: 50%;
		margin: 0 auto;
		display: block;
		margin-bottom: 20px;
	}

	.nav-tabs .nav-link {
		color: orange;
	}
</style>

</html>
@stop