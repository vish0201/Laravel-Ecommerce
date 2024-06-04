<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel </title>

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
        .w-5 {
            display: none;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #4D869C;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            overflow: hidden;
            position: relative;
            transition: color 0.3s;
            /* Added transition for color */
        }

        .sidebar a::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #EEF7FF;
            z-index: -1;
            transform: translateX(-100%);
            transition: transform 0.3s;
        }

        .sidebar a:hover::before {
            transform: translateX(0);
        }


        .sidebar a:hover {
            color: #000;
            /* Change color on hover */
        }

        .sidebar a.active {
            color: #000;
            /* Change color for active tab */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            background-color: #EEF7FF;
        }


        .active {
            background-color: #EEF7FF;
            text-align: end;
        }
    </style>
</head>

<body>

    @if (session('admin-login'))
        <div class="sidebar">
            <h4 style="font-family: cursive" class="text-white text-center text-decoration-underline">E-COMMERCE</h4>
            <hr>

            <a href="{{ route('index') }}" class="text-decoration-none "  id="dashboard">Dashboard</a>
            <a href="{{ route('category.category') }}" class="text-decoration-none " id="categories">Categories</a>
            <a href="{{ route('product.product') }}" class="text-decoration-none " id="products">Products</a>
            <a href="{{ route('users') }}" class="text-decoration-none " id="products">Users</a>
            <a href="{{ route('banners') }}" class="text-decoration-none " id="products">Banners</a>



            <a  class="position-absolute  bottom-0 mb-4 w-100  "   href="{{ route('logout') }}" id="logout">Logout    </a>

            <!-- Add more sidebar links as needed -->
        </div>

        <div class="content p-4">
            @yield('content')

            @stack('scripts')


        </div>
    @else
        @include('AdminComponents.login')
    @endif


</body>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentURL = window.location.href;

        var links = document.querySelectorAll('.sidebar a');

        links.forEach(function(link) {
            if (link.href === currentURL) {
                link.classList.add('active');
            }
        });
    });



    

</script>

</html>
