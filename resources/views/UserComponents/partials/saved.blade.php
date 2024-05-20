<div id="saved" class="tab-pane p-3">
    <h2>Saved</h2>
    <div class="row">
        @foreach ($savedProducts as $savedProduct)
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100 position-relative">
                    <img style="max-height: 200px" src="{{ '/' . env('PRODUCT_DIR') . '/' . $savedProduct->product->images[0] }}"
                        class="card-img-top  object-fit-contain" alt="{{ $savedProduct->product->name }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-capitalize">{{ $savedProduct->product->name }}</h5>
                            <p class="card-text price">${{ $savedProduct->product->price }}</p>
                        </div>
                        <td>{{ $savedProduct->product->category->name }}</td>
                        @if ($savedProduct->product->featured)
                            <p class="card-text featured">Featured Product</p>
                        @endif
                    </div>
                    @php
                        $userId = auth()->id();
                        $productId = $savedProduct->product->id;
                        $isProductInCart = \App\Models\Cart::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->exists();

                        $isProductBookmarked = \App\Models\Bookmark::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->exists();
                    @endphp

                    <!-- Cart and Bookmark forms -->
                    <div class="">
                        <form action="{{ $isProductInCart ? route('cart.remove') : route('cart.add') }}"
                            method="POST">
                            @csrf
                            @if ($isProductInCart)
                                @method('DELETE')
                            @endif
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="product_id"
                                value="{{ $savedProduct->product->id }}">
                            <input type="number" name="quantity" class="d-none" value="1"
                                min="1">
                            <button type="submit" class="btn border-0 position-absolute top-0 start-0">
                                <i
                                    class="bi {{ $isProductInCart ? 'bi-cart-check-fill' : 'bi-cart' }} fs-5"></i>
                            </button>
                        </form>

                        <form
                            action="{{ $isProductBookmarked ? route('bookmark.remove') : route('bookmark.add') }}"
                            method="POST">
                            @csrf
                            @if ($isProductBookmarked)
                                @method('DELETE')
                            @endif
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="product_id"
                                value="{{ $savedProduct->product->id }}">
                            <button type="submit" class="btn border-0 position-absolute top-0 end-0">
                                <i
                                    class="bi {{ $isProductBookmarked ? 'bi-bookmark-check-fill' : 'bi-bookmark' }} fs-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
