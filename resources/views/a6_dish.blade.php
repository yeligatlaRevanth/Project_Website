@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Details</title>
    <!-- Define specific styles for this view -->
    <style>
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .container_allDishes .container {
            background-color: #f79402;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    @foreach ($maindish as $it)
    <div class="container_allDishes" style="margin: 40px;">
        <div class="text-center mb-4">
            <h2>Dish Details</h2>
        </div>

        <div class="container">
            <div class="row mt-4" style="padding-top: 30px;">
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <img class="w-50 shadow mt-3" style="height:250px;" src="{{URL::asset('uploads/dishes/' . $it->dish_image)}}" />
                </div>
                <div class="col-lg-6">
                    <div class="p-4">
                        <h1>{{$it->dish_name}}</h1>
                        <h4>Preparation Time: {{$it->dish_time}}</h4>
                        <h5>Description: {{$it->dish_description}}</h5>
                        <h4 class="lead">By: {{$it->dish_email}}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6" style="padding-left: 120px;">
                    <div class="p-5 mt-3">
                        <h1>Ingredients</h1>
                        <ul>
                            @php
                            $ingredientsString = trim($it->dish_ingredients, '"');
                            $ingredients = explode('%_%', $ingredientsString);
                            @endphp
                            @foreach ($ingredients as $ingredient)
                            <li>{{ trim($ingredient) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 mt-3">
                        <h1>Directions</h1>
                        <ul>
                            @php
                            $directionsString = trim($it->dish_dir, '"');
                            $directions = explode('%_%', $directionsString);
                            @endphp
                            @foreach ($directions as $direction)
                            <li>{{ trim($direction) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</body>

</html>
@stop
