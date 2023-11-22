@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @foreach ($maindish as $it)
    <div class="container_allDishes" style="margin: 40px;">
        <div class="container m-5" style="background-color: whitesmoke;">
            <div class="row">
                <div class="col-lg-6">
                    <img class="w-50 shadow" style=" height:250px; margin-left:230px; margin-top:20px;margin-bottom:20px" src="{{URL::asset('uploads/dishes/' . $it->dish_image)}}" />
                </div>
                <div class="col-lg-6">
                    <div class="p-5 mt-3">
                        <h1 class="display-4">{{$it->dish_name}}</h1>
                        <p>Cuisine: {{$it->dish_cuisine}}</p>
                        <p class="lead">By: {{$it->dish_email}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container m-5" style="background-color: whitesmoke;margin-bottom:40px">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5 mt-3">
                        <h1>Ingredients</h1>
                        <p >{{$it->dish_ingredients}}</p>
                        
                        <h1>Preparation Time</h1>
                        <p > {{$it->dish_time}}</p>
                        <h1>Directions</h1>
                        <p > {{$it->dish_dir}}</p>
                    </div>
                </div>
            </div>
        </div>



    </div>
    @endforeach

</body>

</html>
<style>
    body {
        background-color: #d1e9ff;
    }
</style>
@stop