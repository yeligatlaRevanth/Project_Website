@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Center the container horizontally and vertically */
        .container {
            position: relative; /* Position relative to contain absolute positioned elements */
            width: 100%; /* Full width */
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style the image */
        .styled-image {
            width: 100%; /* Full width */
            height: auto; /* Maintain aspect ratio */
        }

        /* Style the overlay text */
        .overlay-text {
            position: absolute;
            top: 50%;
            left: 25%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }
        
        /* Style the image title */
        .image-title {
            color: maroon; /* Change text color to maroon */
        }

        /* Style the paragraph */
        .para {
            color: black; /* Change text color to black */
        }

        /* Make the website responsive */
        @media (max-width: 768px) {
            .container {
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('icon_allDishes.jpg') }}" alt="Description of the image" class="styled-image">
        <div class="overlay-text">
            <h2 class="image-title">Meal Kit Plan</h2>
            <h2 class="image-title">For Every Household</h2>
            <p class="para">A well-organized paragraph supports or develops a single <br>controlling idea, which is expressed in a sentence<br> called the topic sentence.</p>
        </div>
    </div>
</body>
</html>
@stop