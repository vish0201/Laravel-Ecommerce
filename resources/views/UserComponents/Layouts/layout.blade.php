<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Dot - Com</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        ::-webkit-scrollbar {
            width: 5px;
            /* Set width of the scrollbar */
        }
        ::-webkit-scrollbar-thumb {
            background-color: #4D869C;
        }

        ::-webkit-scrollbar-track {
            background-color: #CDE8E5;
        }

        ::-webkit-scrollbar-corner {
            background-color: #EEF7FF;
        }


        html {
            scroll-behavior: smooth;
        }

        .navbar-custom {
            background-color: #4d869c;
        }

        .breadcrumb-custom {
            background-color: #7ab2b2;
        }

        .content-custom {
            background-color: #eff7ff;
            min-height: 100vh;

        }
        .content {
            background-color: #eff7ff;
            min-height: 100vh;
        }
    </style>
</head>

<body>


    <div style="min-height: 40pc" class="fluid-container ">
        <div class=" content-custom">
            <div class="">
                @include('UserComponents.Layouts.notification')
                @include('UserComponents.Layouts.navbar')

                <div class="content">
                    @yield('content')
                </div>
                @include('UserComponents.Layouts.footer')
            </div>
        </div>

    </div>


</body>


</html>
