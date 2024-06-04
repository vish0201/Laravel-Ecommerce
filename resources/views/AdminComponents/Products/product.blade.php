@extends('AdminComponents.Layouts.layout')

@section('content')

    <div class="container">
        @if ($products->isEmpty())
            <h1>No products added</h1>
            <button class="btn btn-primary mt-3"><a href="{{ route('product.create') }}" style="color: white;">Add
                    Products</a></button>
        @else
            <div class="d-flex justify-content-between align-content-center ">
                <h3>All Product </h3>
                <button class="btn btn-outline-dark rounded-5 mt-3"><a class="text-decoration-none"
                        href="{{ route('product.create') }}" style="color: white;"> ➕ </a></button>
            </div>


            <table class="table mt-3 shadow bg-black table-hover table-striped border-none" style="border-radius: 10px; ">
                <thead class="thead-light ">
                    <tr>
                        <th>Sr .</th>
                        <th></th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $counter++ }}</td>


                            <td class="text-center" style="width : 10px ">
                                <form method="POST"
                                    action="{{ route('product.toggle-featured', ['product' => $product->id]) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn ">
                                        <h3>{{ $product->featured ? '★' : '☆' }}</h3>
                                    </button>
                                </form>
                            </td>


                            <td class="text-center product-images  ">
                                
                                <div class="hover-container  " onmouseover="showImages(this)" onmouseout="hideImages(this)">

                                    <img src="{{ '/' . env('PRODUCT_DIR') . '/' . $product->images[0] }}" width="40">

                                    <div class="absolute-div shadow z-3">
                                        <div class="image-overlay  ">
                                            @foreach ($product->images as $image)
                                                <img src="{{ '/' . env('PRODUCT_DIR') . '/' . $image }}"
                                                    class="overlay-image border-start   border-black  " alt="Product Image">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </td>


                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>${{ $product->price }}</td>
                            <td>
                                <form method="POST" action="{{ route('product.delete', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn "
                                        onclick="return confirm('Are you sure you want to delete this product?')"> <i class="bi bi-trash text-danger  fs-4 " ></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="">
                {{ $products->links() }}
            </div>
            
        @endif
    </div>

@endsection

<script>
    function showImages(element) {
        const overlay = element.querySelector('.absolute-div');
        overlay.style.display = 'block';
    }

    function hideImages(element) {
        const overlay = element.querySelector('.absolute-div');
        overlay.style.display = 'none';
    }
</script>


<style>
    .hover-container {
        position: relative;
    }

    .absolute-div {
        position: absolute;
        top: 0;
        left: 0;
        display: none;
        background-color: white;
        margin-top: 34px;
        padding: 12px;
        border-radius: 12px;
    }

    .hover-container:hover .absolute-div {
        display: block;
    }

    .image-overlay {
        display: flex;
        gap: 12px;
    }
    .image-overlay img {
        width: 68px;
    }
</style>
