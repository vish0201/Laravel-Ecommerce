<!-- resources/views/UserComponents/pages/cart.blade.php -->

@extends('UserComponents.Layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="row gap-4 ">
            <div class="col-md-7 ">

                <div class="d-flex justify-content-between  align-content-center ">
                    <h2>Cart</h2>
                    @if ($cartItems)
                        <h6>Subtotal: ₹ {{ $subtotal }}</h6>
                    @endif
                </div>

                @if ($cartItems->isEmpty())
                    <p class="w-100  ">Your cart is empty.</p>
                    <a href="{{ route('category.products') }}">
                        <h3 class="w-100 text-end   ">Explore Products.</h3>
                    </a>
                @else
                    @foreach ($cartItems as $item)
                        <div class=" mb-3">
                            <div class="row bg-light  p-3 shadow rounded-3  align-content-center   ">
                                <div class="col-md-2 border-end border-2 border-dark ">
                                    <img class="object-fit-contain "
                                        src="{{ '/' . env('PRODUCT_DIR') . '/' . $item->product->images[0] }}"
                                        width="100" height="75" alt="">
                                </div>

                                <div class="col-md-3">
                                    <h5 class="mb-0">{{ $item->product->name }}</h5>
                                    <p class="my-0">{{ $item->product->description }}</p>
                                </div>


                                <div class="col-md-3 my-auto ">
                                    <p class="">Price: ₹{{ $item->product->price }}</p>
                                </div>
                                <div class="col-md-3 my-auto">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        id="update-form-{{ $item->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="updateQuantity('{{ $item->id }}', -1)">-</button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" class="form-control" id="quantity-{{ $item->id }}">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="updateQuantity('{{ $item->id }}', 1)">+</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="col-md-1 my-auto ">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <input type="number" name="quantity" class="d-none" value="1" min="1">
                                        <button type="submit" class="btn border-0 ">
                                            <i class="bi bi-trash-fill fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-3 {{ $cartItems->isEmpty() ? 'd-none' : '' }} ">
                <h2>Cart Totals</h2>
                <div>
                    <p>Subtotal: ₹ {{ $subtotal }}</p>
                    <p>Shipping: ₹ {{ $shipping }}</p>
                    <p>Total: ₹ {{ $total }}</p>
                </div>
                {{-- <a href="{{ route('checkout') }}" class="btn btn-primary mt-3">Proceed to Checkout</a> --}}
            </div>
        </div>
    </div>
@endsection

<script>
    function updateQuantity(itemId, delta) {
        const quantityInput = document.getElementById('quantity-' + itemId);
        let currentValue = parseInt(quantityInput.value);

        if (isNaN(currentValue)) {
            currentValue = 1;
        }

        const newValue = currentValue + delta;

        if (newValue >= 1) {
            quantityInput.value = newValue;
            document.getElementById('update-form-' + itemId).submit();
        }
    }
</script>
