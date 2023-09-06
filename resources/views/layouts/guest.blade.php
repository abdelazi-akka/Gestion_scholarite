<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">



    </head>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300;600&display=swap');
body {
    font-family: 'Raleway', sans-serif;
    background-color: #F7F7F7;
}

.login-1 {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.login-form {
    margin: 120px 80px;
    overflow: hidden;
}

.img-box {
    max-height: 700px;
    display: flex;
    align-items: center;
}

.login-form .login-box {
    font-size: 1rem;
    padding: 15px 15px 15px 30px;
}

.login-form .login-box .login-title {
    font-size: 40px;
    font-weight: 600;
    color: #151865;
}

.login-form .login-box .login-p {
    font-weight: 300;
    color: #151865;
    font-size: 20px;
}

.login-form .back-img {
    max-width: 100%;
    height: auto;
}

.login-form .check-field {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.login-form a {
    color: #151865;
    text-decoration: none;
}

.login-form .form-group, .login-form .input-group {
    padding: 15px 20px 5px 0px;
}

.login-form .form-group label {
    margin-bottom: .5rem;
    font-size: 1rem;
}

.login-form .form-group .form-control {
    padding: .810rem 1rem;
    border-color: #45B4D0;
    border-radius:0;
    font-weight: 300;
    color: #151865;
    font-size: 20px;
    margin-bottom: 10px;
}

.login-form .btn-primary {
    background-color: #45B4D0;
    border-color: #45B4D0;
    padding: 0.8rem 2.6rem;
    font-weight: 500;
    -webkit-transition: all 0.5s ease;
    transition: all 0.5s ease;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
    margin: 10px 0px 20px;
    border-radius: 5px;
}

.login-form .btn-primary:hover {
    background-color: #006adb;
    border-color: #006adb;
}

.login-form .btn-link {
    color: #1428bf;
}

@media screen and (max-width: 767px) {
    .login-1 {
        padding: 0px;
        overflow: visible;
        height: 100%;
    }

    .login-form {
        margin: 10px;
        overflow: visible;
    }
}
</style>
    <body class="font-sans text-gray-900 antialiased">
                {{ $slot }}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>
