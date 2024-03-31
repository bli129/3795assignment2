<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
    <title>Laravel Expense Manager - @yield('title')</title>
    @yield('styles')
</head>
<body>

@yield('navbar') <!-- This will be where the nav bar is optionally included -->

<div class="container">
    @yield('content')
</div>



<style>
    body {
        background-color: #FEFAE0;
    }

    .form-group {
        width: 100%;
    }

    .form-control {
        background-color: #FAEDCD;
        border: none;
        width: 50%;
        /* center it */
        margin-left: auto;
        margin-right: auto;
        border-radius: 10px;
    }

   
    .btn-custom {
        background-color: #D4A373; /* Set the button's background color */
        border: 1px solid #D4A373; /* Set the border color to the same as the background */
        color: #ffffff; /* Optional: Change the text color if needed */
    }

    .btn-custom:hover {
        background-color: #BB9169; /* Slightly darker shade when hovered */
        border: 1px solid #BB9169; /* Border color to match the background on hover */
    }


    </style>




</body>
</html>
