@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Your existing styles */
        /* Add styles for card layout here */

        .card {
            width: 250px;
            /* Adjust card width */
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%; /* Adjust image width */
            height: 150px; /* Adjust image height */
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .card-title {
            font-size: 16px;
            /* Reduce font size for card title */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-meta {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- First row: Text "Latest Posts" -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Latest Posts</h2>
            </div>
        </div>
    </div>

    <!-- Second row: Cards for dishes -->
    <div class="container mt-5">
        <div class="row card-container ms-5 ">
            @foreach($latest_dishes as $dishes)
            <!-- Adjust column size to fit 4 cards per row -->
            <div class="card me-5 mt-3">
                <a href="/dish/{{$dishes->id}}"><img src="{{URL::asset('uploads/dishes/' . $dishes->dish_image)}}" class="card-img-top"></a>
                <div class="card-content">
                    <h5 class="card-title">{{$dishes->dish_name}}</h5>
                    @php
                    $email_parts = explode('@', $dishes->dish_email);
                    @endphp
                    <p class="card-meta">By: {{$email_parts[0]}} </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
@stop
