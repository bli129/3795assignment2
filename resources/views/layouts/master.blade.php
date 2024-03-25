<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
    <title>Laravel Expense Manager - @yield('title')</title>
</head>
<body>

@yield('navbar') <!-- This will be where the nav bar is optionally included -->

<div class="container">
    @yield('content')
</div>

</body>
</html>