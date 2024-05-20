@extends('UserComponents.Layouts.layout')

@section('content')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            display: none;
            /* Hidden by default */
            z-index: 9999;
            /* Ensure it's on top of other elements */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>


    <div class="container ">
        <div class="row mb-4">
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <form id="filter-form" method="GET" action="">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="category" id="all" value="all"
                            {{ request('id') ? '' : 'checked' }}>
                        <label class="form-check-label" for="all">All</label>
                    </div>
                    @foreach ($categories as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="category{{ $category->id }}"
                                value="{{ $category->id }}" {{ request('id') == $category->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
        <div class="row" id="products-container">
            @include('UserComponents.partials.products', ['products' => $products])
        </div>
    </div>

    <!-- Loader -->

    <div class="loader-div  ">

        <div id="loader" class="loader"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="category"]').change(function() {
                var category = $(this).val();
                var url = category === 'all' ? '{{ route('category.products') }}' :
                    '{{ url('/categories/products') }}/' + category;

                // Show the loader
                $('#loader').show();
                $('#products-container').hide();

                window.location.href = url



                // Send an AJAX request to load the products
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        category: category
                    },
                    success: function(data) {
                        $('#products-container').show();
                        $('#products-container').html(data);
                        // Hide the loader
                        $('#loader').hide();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        // Hide the loader in case of an error
                        $('#loader').hide();
                    }
                });
            });
        });
    </script>
@endsection
