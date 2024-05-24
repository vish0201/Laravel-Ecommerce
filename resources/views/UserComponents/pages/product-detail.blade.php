{{-- product-detail.blade.php --}}

@extends('UserComponents.Layouts.layout')


@section('content')
    <style>
        .product-container {
            margin-top: 20px;
            background-color: white;
            border-radius: 10px;
            padding: 20px;


        }

        .product-image {
            max-width: 100%;
            min-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .thumbnail {
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;

        }

        .thumbnail:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-image-container {
            margin-right: 40px;
            
        }

        .product-details {
            padding: 20px;
        }

        .product-details h2 {
            color: #4D869C;
        }

        .product-details .price {
            color: #7AB2B2;
            font-size: 1.5em;
        }

        .product-details .old-price {
            text-decoration: line-through;
            color: #CDE8E5;
        }

        .product-details .btn {
            background-color: #4D869C;
            color: white;
        }

        .specifications {
            margin-top: 20px;
        }

        .specifications h5 {
            color: #7AB2B2;
        }

        .customer-reviews {
            margin-top: 40px;
        }

        .customer-reviews h5 {
            color: #4D869C;
        }
    </style>

    <body>
        <div class="container product-container">
            <div class="row gap-5">
                <div class="col-md-2">
                    <div class="thumbnails">
                        @foreach ($product->images as $image)
                            <img src="{{ '/' . env('PRODUCT_DIR') . '/' . $image }}" class="thumbnail "
                                alt="{{ $product->name }}">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4  ">
                    <img id="mainImage" src="{{ '/' . env('PRODUCT_DIR') . '/' . $product->images[0] }}"
                        class="product-image    " alt="{{ $product->name }}">
                </div>
                <div class="col-md-5 product-details">
                    <h2 class="text-capitalize ">{{ $product->name }}</h2>
                    <p>{{ $product->category->name }}</p>
                    <p class="price">₹ {{ number_format($product->price) }} <span class="old-price">₹
                            {{ number_format($product->original_price) }}</span></p>
                    <p>100% Original Products</p>
                    <p>Easy 7 days returns and exchanges</p>
                    <div class="d-flex gap-4">

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" class="d-none" value="1" min="1">
                            <button type="submit" class="btn btn-block">Add to cart</button>
                        </form>



                        <form action="{{ route('bookmark.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-block">Add to Wishlist</button>
                        </form>



                    </div>


                    <div class="specifications">
                        <h5>Product Details</h5>
                        <p>{{ $product->description }} </p>

                    </div>
                </div>
            </div>
            <div class="customer-reviews">
                <h5>Customer Reviews</h5>
                <p>No review available for this product</p>
            </div>
        </div>
    </body>




    <script>
        $(document).ready(function() {
            var mainImageSrc = $('#mainImage').attr('src');

            $('.thumbnail').hover(function() {
                // On mouse enter
                var newSrc = $(this).attr('src');

            

                $('#mainImage').fadeOut(100, function() {
                    $(this).attr('src', newSrc).fadeIn(100);
                });
            }, function() {
                // On mouse leave
                $('#mainImage').fadeOut(200, function() {
                    $(this).attr('src', mainImageSrc).fadeIn(200);
                });


            });
        });
    </script>
@endsection
