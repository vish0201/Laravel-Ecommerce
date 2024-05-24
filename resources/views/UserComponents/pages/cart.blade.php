<!-- resources/views/UserComponents/pages/cart.blade.php -->

@extends('UserComponents.Layouts.layout')

@section('content')

    <style>

    </style>
    <div class="container mt-5">
        <div class="row gap-4 ">
            <div class="col-md-7 ">
                <div class="d-flex justify-content-between align-content-center ">
                    <h2>Cart</h2>
                    @if ($cartItems)
                        <h6>Subtotal: ₹ <span id="subtotal">{{ $subtotal }}</span></h6>
                    @endif
                </div>

                @if ($cartItems->isEmpty())
                    <p class="w-100">Your cart is empty.</p>
                    <a href="{{ route('category.products') }}">
                        <h3 class="w-100 text-end">Explore Products.</h3>
                    </a>
                @else
                    @foreach ($cartItems as $item)
                        <div class="mb-3">
                            <div class="row p-4  bg-light  shadow rounded-3 align-content-center">
                                <div class="col-md-2 border-end border-2 border-dark">
                                    <img class="object-fit-contain"
                                        src="{{ '/' . env('PRODUCT_DIR') . '/' . $item->product->images[0] }}"
                                        width="100" height="75" alt="">
                                </div>

                                <div class="col-md-4 col-lg-3">
                                    <h5 class="mb-0">{{ $item->product->name }}</h5>
                                    <p style="font-size: 14px" class="mb-0">{{ $item->product->category->name }}</p>
                                    <p style="font-size: 14px" class="my-0 text-truncate ">{{ $item->product->description }}
                                    </p>
                                </div>

                                <div class="col-md-3 col-lg-3 my-auto">
                                    <p class="">Price: ₹<span
                                            id="price-{{ $item->id }}">{{ $item->product->price }}</span></p>
                                </div>

                                <div class="col-md-3 col-lg-3 my-auto">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        id="update-form-{{ $item->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <button type="button" class="btn border-0   "
                                                onclick="updateQuantity('{{ $item->id }}', -1)">
                                                {{ $item->quantity == 1 ? '' : '-' }} </button>
                                            <input type="number" readonly name="quantity" value="{{ $item->quantity }}"
                                                min="1" class=" w-25  text-center border-0  bg-transparent    "
                                                id="quantity-{{ $item->id }}">
                                            <button type="button" class="btn  border-0 "
                                                onclick="updateQuantity('{{ $item->id }}', 1)">+</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-1 col-lg-1 my-auto">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <input type="number" name="quantity" class="d-none" value="1" min="1">
                                        <button type="submit" class="btn border-0">
                                            <i class="bi bi-trash-fill text-danger fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-3 mt-5 {{ $cartItems->isEmpty() ? 'd-none' : '' }}">
                <div class="bg-light p-3 rounded-3 shadow">
                    <h4 class="text-center  mb-4 ">Cart summary</h4>
                    <div id="cart-summary">
                        <ul class="list-unstyled   justify-content-between ">
                            @foreach ($cartItems as $item)
                                <li>{{ $item->product->name . ' x ' . $item->quantity }} <span class="float-end"
                                        id="item-total-{{ $item->id }}">
                                        ₹{{ $item->product->price * $item->quantity }}</span></li>
                            @endforeach
                        </ul>
                        <hr>
                        <p>Subtotal: <span class="float-end  " id="summary-subtotal">₹{{ $subtotal }}</span></p>
                        <p>Shipping: <span class="float-end  " id="summary-shipping">₹{{ $shipping }}</span></p>
                        <hr>

                        <p>Total: <span class="float-end " id="summary-total">₹{{ $total }}</span></p>

                        <a href="">
                            <button class=" btn btn-block w-100 "
                                style="background-color: #4D869C;
                color: white;"> Checkout </button>
                        </a>
                    </div>
                </div>
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

    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form[id^="update-form-"]');
        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const itemId = this.id.split('-')[2];
                const quantityInput = document.getElementById('quantity-' + itemId);
                const priceElement = document.getElementById('price-' + itemId);
                const itemTotalElement = document.getElementById('item-total-' + itemId);

                const price = parseFloat(priceElement.innerText);
                const quantity = parseInt(quantityInput.value);
                const itemTotal = price * quantity;

                itemTotalElement.innerText = itemTotal;

                updateCartSummary();
                this.submit();
            });
        });
    });

    function updateCartSummary() {
        let subtotal = 0;
        const itemTotalElements = document.querySelectorAll('[id^="item-total-"]');
        itemTotalElements.forEach(element => {
            subtotal += parseFloat(element.innerText);
        });

        const shipping = parseFloat(document.getElementById('summary-shipping').innerText);
        const total = subtotal + shipping;

        document.getElementById('summary-subtotal').innerText = subtotal;
        document.getElementById('summary-total').innerText = total;
    }
</script>
