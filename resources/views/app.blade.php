@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = app()->getLocale(),
        'locales' => config('app.locales'),
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payroll</title>

    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.css') }}">
    <!-- Font Awesome CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css"> -->
    <!-- Font Awesome CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- DataTables Default CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css"> -->

    <!-- JavaScript -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script> -->
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/cd0ffee7a9.js" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> -->
    <!-- Custom JavaScript -->
    <script type="text/javascript" src="{{ asset('resources/js/dashboard.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('resources/js/Home.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('resources/js/jquery-3.7.1.js') }}"></script> -->
    <!-- jQuery UI -->
    <!-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script> -->

    <script>
        window.config = @json($config);
    </script>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"><router-view></router-view></div>
    
    @vite('resources/js/app.js')

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"crossorigin="anonymous"></script> -->

</body>

</html>
