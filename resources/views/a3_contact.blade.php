@extends('layout')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        #id {
            border: none;
            outline: none;
        }

        .pic-side {
            height: 100%;
        }

        .pic {
            width: 100%;
            height: auto;
        }

        .t-name {
            height: 30px;
            width: 80%;
            /* Adjusted width */
        }

        .t-mail {
            height: 30px;
            width: 80%;
            /* Adjusted width */
        }

        .t-query {
            height: 200px;
            width: 80%;
            /* Adjusted width */
        }

        .but1 {
            text-align: center;
        }

        .but {
            width: 100px;
            height: 50px;
            border-width: 0px;
            border-radius: 20px;
        }

        .tt {
            border-radius: 10px;
            border-color: indigo;
        }

        .body {
            font-family: "Trirong";
        }
        .mt-6{
            margin-top: 14rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="contact-side mt-6">
                    <h1 class="ml-3">Contact Us</h1>
                    <p class="ml-3">We are here to help! Send us your query via email at <a class="link" target="_blank" href="mailto:revanthyeligatla@gmail.com">revanth@gmail.com</a> for any issues you are facing.</p>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="pic-side mt-5 text-center"> <!-- Center aligning the image -->
                    <img class="pic" src="{{asset('icon_contactUs.jpeg')}}" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>

@stop