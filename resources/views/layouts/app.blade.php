<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS agregado en cada página -->
    @yield('css')

    <!-- Fuentes -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

    <!--Bootstra  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.min.css') }}"/>
    <!-- Confirm -->
    <link href="{{ asset('plugins/jquery_confirm/css/jquery-confirm.css') }}" rel="stylesheet">
    <!-- Gijgo -->
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Styles Custsom -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>

    <div class="wrapper">

        @include('layouts.sidebar')
        @routes
        <div id="content">  

            @include('layouts.navbar')            
            <div class="container-fluid">
            
                @include('flash::message')
                @yield('content')
            </div>

        </div>

    </div>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Datatable -->
    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <!-- Notificaciones -->
    <script src="{{ asset('plugins/bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script> 
    <!-- Confirm -->
    <script src="{{ asset('plugins/jquery_confirm/js/jquery-confirm.min.js') }}"></script>
    <!-- Gijgo -->
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/messages/messages.es-es.js" type="text/javascript"></script>

    <!-- JS agregado en cada página -->
    @yield('js')

    <script type="text/javascript">
        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

             $('[data-toggle="tooltip"]').tooltip();
   
        })
    </script>

</body>
</html>
