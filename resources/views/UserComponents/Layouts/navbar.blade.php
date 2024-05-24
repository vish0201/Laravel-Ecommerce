<style>
    /* Navbar hover effect and smooth UI */
    .navbar-custom .nav-link {
        transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
        color: #4D869C;
        /* Default link color from palette */
    }

    .navbar-custom .nav-link:hover {
        color: #004662;
        /* Change color on hover */
        transform: scale(1.1);
    }

    .navbar-custom .nav-link.active {
        font-weight: bold;
        /* Highlight active link */
        color: #006891;
        margin-left: 5px;
        margin-right: 5px;

    }

    .navbar-custom .nav-link:hover .badge {
        transform: scale(1.1);
        /* Scale badge on hover */
    }

    .navbar-custom .nav-link .badge {
        transition: transform 0.3s ease-in-out;
    }

    /* Smooth transition for navbar toggler */
    .navbar-toggler-icon {
        transition: transform 0.3s ease-in-out;
    }

    .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
        transform: rotate(90deg);
        /* Rotate toggler icon */
    }

    /* Navbar background color from palette */
    .navbar-custom {
        background-color: #CDE8E5;
    }

    /* Right side icons color and interactivity */
    .navbar-nav .nav-link .bi {
        transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover .bi {
        color: #7AB2B2;
        /* Icon color on hover */
        transform: scale(1.1);
    }

    .navbar-custom .nav-link .badge {
        background-color: #EEF7FF;
        /* Badge color from palette */
    }

    /* Logo styling */
    .navbar-custom .navbar-brand {
        color: #4D869C;
        font-weight: bold;
        font-family: cursive;
        transition: color 0.3s ease-in-out;

    }
</style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('user.index') }}">Dot - Com</a>

            <!-- Toggler button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{  route('about') }}">About</a>
                    </li>
                </ul>
            </div>

            <!-- Right side icons -->
            <div class="navbar-nav justify-content-end">

                @if (Auth::check())
                    @php
                        $cartLength = \App\Models\Cart::where('user_id', Auth::id())->count();
                    @endphp
                    <a class="nav-link position-relative" href="{{ route('cart.page') }}">
                        <span
                            class="position-absolute top-25 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartLength }}</span>
                        <i class="bi bi-cart3 fs-4"></i>
                    </a>
                @endif


                <a class="nav-link position-relative" href="#">
                    <span
                        class="position-absolute top-25 start-100 translate-middle badge rounded-pill bg-danger">2</span>
                    <i class="bi bi-bell fs-4"></i>
                </a>


                @if (auth()->check())
                    <a class="nav-link position-relative" href="{{ route('user.profile') }}">
                        <img src="{{ "/" .  env('PROFILE_DIR') . "/". auth()->user()->profile_picture }}" alt="Profile Picture"
                            class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a class="nav-link position-relative" href="{{ route('user.login') }}">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>
                @endif


            </div>
        </div>
    </nav>

    <script>
        // JavaScript to dynamically set active class based on URL
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = window.location.href;
            const navLinks = document.querySelectorAll(".navbar-nav .nav-link");




            navLinks.forEach(link => {
                if (link.href === currentLocation) {
                    link.classList.add("active");
                }
            });
        });
    </script>
