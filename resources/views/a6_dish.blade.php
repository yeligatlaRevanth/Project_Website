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
        /* Remove bullets for the list */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        /* Override background color and text color for the container */
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
        <!-- Title section -->
        <div class="text-center mb-4">
            <h2>Dish Details</h2>
        </div>

        <!-- First row -->
        <div class="container">
            <div class="row mt-4" style="padding-top: 30px;">
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <!-- Dish image -->
                    <img class="w-50 shadow mt-3" style="height:250px;" src="{{URL::asset('uploads/dishes/' . $it->dish_image)}}" />
                </div>
                <div class="col-lg-6">
                    <!-- Dish name, cuisine, and user email -->
                    <div class="p-4">
                        <h1>{{$it->dish_name}}</h1>
                        <h4>Cuisine: {{$it->dish_cuisine}}</h4>
                        <h4>Preparation Time: {{$it->dish_time}}</h4>
                        <h4 class="lead">By: {{$it->dish_email}}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second row -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6" style="padding-left: 120px;">
                    <!-- Ingredients -->
                    <div class="p-5 mt-3">
                        <h1>Ingredients</h1>
                        <ul>
                            @php
                            $ingredients = explode(',', $it->dish_ingredients);
                            @endphp
                            @foreach ($ingredients as $ingredient)
                            <li>{{$ingredient}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Directions -->
                    <div class="p-5 mt-3">
                        <h1>Directions</h1>
                        @php
                        $directions = explode('%', $it->dish_dir);
                        @endphp
                        @foreach ($directions as $direction)
                        <p>{{$direction}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</body>

</html>
@stop