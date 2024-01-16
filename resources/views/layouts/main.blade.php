<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="title" content="{{$title}}">
    <meta name="descxription" content="{{$description}}">
    <meta name="robots" content="INDDEX,FOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>{{$title}}</title>
    @yield('header');
</head>


<body>
    @yield('content');
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/')
    ]); ?>
        </script>
</body>

</html>