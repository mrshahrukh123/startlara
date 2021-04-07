<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <title>{{ $title }}</title>
</head>
<body class="sb-nav-fixed">
    <main>
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
</body>
</html>
