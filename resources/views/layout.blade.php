<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DishExchange</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

    @if(Auth::check())
    <nav class="navbar navbar-light navbar-expand-lg" style="box-shadow: none; background-color: whitesmoke;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Dish<span style="color:#f79402;">Exchange</span> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/recipes">Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blogs">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex rounded-pill">
                    <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-orange rounded-pill" type="submit"><i class="fa fa-search text-orange"></i></button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/userprofile">
                            <img class="nav-link" src="{{asset('navbar_usericon.png')}}" style="width:40px;">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @else
    <nav class="navbar navbar-light navbar-expand-lg" style="box-shadow: none; background-color: whitesmoke;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Dish<span style="color:#f79402;">Exchange</span> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/recipes">Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blogs">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex rounded-pill">
                    <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-orange rounded-pill" type="submit"><i class="fa fa-search text-orange"></i></button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item login-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item spacer"></li>
                    <li class="nav-item signup-item">
                        <a class="nav-link" href="/signup">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif

    <div>
        @yield('content')
    </div>


    <footer class="text-center text-white" style="background-color: whitesmoke;">
        <!-- Grid container -->
        <!-- Copyright -->
        <div class="text-center text-dark p-3">
            © 2024 Capstone Project By- Durga Revanth
        </div>
        <!-- Copyright -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section >
                <!-- Facebook -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-linkedin"></i></a>
                <!-- Github -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->


    </footer>

</body>

<style>
    .navbar-nav .spacer {
        margin-right: 10px;
        /* Adjust the margin as needed */
    }

    .navbar-nav .login-item .nav-link {
        color: orange;
        border: 2px solid orange;
        border-radius: 20px;
        margin-left: 10px;
        padding: 8px 30px;
        background-color: white;
    }

    .navbar-nav .login-item .nav-link:hover {
        color: white;
        background-color: orange;
    }

    .navbar-brand {
        font-size: 30px !important;
    }

    html {
        background-color: whitesmoke;
    }

    .navbar {
        background-color: whitesmoke;
    }

    .navbar-default {
        overflow: visible !important;
    }

    .navbar-nav {
        margin-right: 20px;
        margin-left: 10%;
    }

    .navbar-nav>.li>.dropdown-menu {
        background-color: black;
    }

    .navbar-nav .nav-item .nav-link:hover {
        background-color: #f79402;
        border-radius: 30px;
    }

    .form-control {
        border-radius: 20px;
    }

    .text-orange {
        color: orange;
    }

    .btn-outline-orange {
        color: orange;
        border-color: orange;
    }

    .btn-outline-orange:hover {
        color: white;
        background-color: orange;
        border-color: orange;
        border-radius: 20px;
    }

    .navbar-nav .signup-item .nav-link {
        color: white;
        background-color: orange;
        border-radius: 20px;
        padding: 8px 20px;
        margin-right: 10px;
        /* Add margin between Signup and Login */
        margin-bottom: 5px;
        /* Adjust padding as needed */
    }

    .navbar-nav .signup-item .nav-link:hover {
        color: orange;
        background-color: white;
    }


    body,
    .navbar-brand,
    .navbar-nav .nav-link,
    .form-control {
        font-family: 'Trirong', sans-serif;
    }
</style>

</html>