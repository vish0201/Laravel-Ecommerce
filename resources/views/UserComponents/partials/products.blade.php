@foreach ($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card product-card h-100 position-relative">
            <div class="image-placeholder" id="placeholder-{{ $product->id }}"></div>
            <img src="{{ '/' . env('PRODUCT_DIR') . '/' . $product->images[0] }}" class="card-img-top d-none  object-fit-contain"
                alt="{{ $product->name }}" id="product-image-{{ $product->id }}" onload="showImage({{ $product->id }})">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title text-capitalize">{{ $product->name }}</h5>
                    <p class="card-text price">${{ $product->price }}</p>
                </div>
                <p class="card-text">{{ $product->description }}</p>
                <td>{{ $product->category->name }}</td>
                @if ($product->featured)
                    <p class="card-text featured">Featured Product</p>
                @endif
            </div>

            @php
                $userId = auth()->id();
                $productId = $product->id;
                $isProductInCart = \App\Models\Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->exists();

                $isProductBookmarked = \App\Models\Bookmark::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->exists();
            @endphp

            <form action="{{ $isProductInCart ? route('cart.remove') : route('cart.add') }}" method="POST">
                @csrf
                @if ($isProductInCart)
                    @method('DELETE')
                @endif
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" class="d-none" value="1" min="1">
                <button type="submit" class="btn border-0 position-absolute top-0 start-0">
                    <i class="bi {{ $isProductInCart ? 'bi-cart-check-fill' : 'bi-cart' }} fs-5"></i>
                </button>
            </form>

            <form action="{{ $isProductBookmarked ? route('bookmark.remove') : route('bookmark.add') }}" method="POST">
                @csrf
                @if ($isProductBookmarked)
                    @method('DELETE')
                @endif
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn border-0 position-absolute top-0 end-0">
                    <i class="bi {{ $isProductBookmarked ? 'bi-bookmark-check-fill' : 'bi-bookmark' }} fs-5"></i>
                </button>
            </form>
        </div>
    </div>
@endforeach

<style>
    .image-placeholder {
        width: 100%;
        padding-top: 75%; /* Aspect ratio 4:3 */
        background-color: #f0f0f0;
        position: relative;
    }

    .image-placeholder::before {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        height: 50%;
        background: linear-gradient(45deg, #ddd, #eee);
        transform: translate(-50%, -50%);
    }


</style>

<script>
    function showImage(productId) {
        var placeholder = document.getElementById('placeholder-' + productId);
        var productImage = document.getElementById('product-image-' + productId);
        if (placeholder && productImage) {
            placeholder.style.display = 'none';
            productImage.classList.add('show');
            productImage.classList.remove('d-none')
        }
    }
</script>



<style>
    .product-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
        height: 200px;
        object-fit: cover;
        border-bottom: 3px solid #CDE8E5;
    }

    .product-card .card-body {
        background-color: #EEF7FF;
        padding: 20px;
    }

    .product-card .card-title {
        color: #4D869C;
        font-size: 1.5em;
        margin-bottom: 15px;
    }

    .product-card .card-text {
        color: #7AB2B2;
        font-size: 1em;
        margin-bottom: 10px;
    }

    .product-card .price {
        font-size: 1.2em;
        font-weight: bold;
        color: #4D869C;
    }

    .product-card .featured {
        font-size: 0.9em;
        font-weight: bold;
        color: #CDE8E5;
        background-color: #7AB2B2;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 10px;
    }
</style>
