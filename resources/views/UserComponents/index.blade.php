@extends('UserComponents.Layouts.layout')

@section('content')
    <style>
        .banner-slider {
            position: relative;
            width: 80%;
            margin: auto;
            overflow: hidden;
            border-radius: 30px;
            margin-top: 12px;
        }

        .banner-slider .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .banner-slider .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .banner-slider img {
            width: 100%;
            height: auto;
            display: block;
        }

        .banner-slider .prev,
        .banner-slider .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .banner-slider .prev {
            left: 10px;
        }

        .banner-slider .next {
            right: 10px;
        }
    </style>

    <div class="banner-slider">
        <div class="slides">
            @foreach ($banners as $index => $banner)
                <div class="slide">
                    <img style="max-height: 500px" src="{{ '/' . env('BANNER_DIR') . $banner->image }}"
                        alt="Banner {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
        <button class="prev">&lt;</button>
        <button class="next">&gt;</button>
    </div>




    <h2 class="text-center p-3 mt-4"> - Categories - </h2>
    <div class="container p-3">
        <div class="row">
            @foreach ($category as $categories)
                <div class="col-md-3 d-flex justify-content-center mb-4">
                    <a href="{{ route('category.products', ['id' => $categories->id]) }}" class="text-decoration-none w-100 h-100 d-flex flex-column align-items-center position-relative">
                        <img src="{{ env('CATEGORY_DIR') . $categories->image }}" class="img-fluid rounded-5 shadow mb-3" style="object-fit: cover; height: 200px; width: 100%;" alt="{{ $categories->name }}">
                        <h3 class="text-center text-capitalize text-dark">{{ $categories->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    







    <script>
        $(document).ready(function() {
            let currentIndex = 0;
            const slides = $('.slides .slide');
            const totalSlides = slides.length;

            function showSlide(index) {
                if (index >= totalSlides) {
                    index = 0;
                } else if (index < 0) {
                    index = totalSlides - 1;
                }
                currentIndex = index;
                const newTransform = `translateX(-${index * 100}%)`;
                $('.slides').css('transform', newTransform);
            }

            $('.next').click(function() {
                showSlide(currentIndex + 1);
            });

            $('.prev').click(function() {
                showSlide(currentIndex - 1);
            });

            // Auto slide every 5 seconds
            setInterval(function() {
                showSlide(currentIndex + 1);
            }, 3000);
        });
    </script>
@endsection
