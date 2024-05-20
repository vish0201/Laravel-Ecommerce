<!-- resources/views/UserComponents/pages/cart.blade.php -->

@extends('UserComponents.Layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h2>Cart</h2>
            @if($cartItems->isEmpty())
                <p>Your cart is empty.</p>
            @else
                @foreach($cartItems as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    
                                    <h5 class="card-title">{{ $item->product->name }}</h5>
                                    <p class="card-text">{{ $item->product->description }}</p>
                                    <p class="card-text">Price: ${{ $item->product->price }}</p>
                                </div>
                                <div>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-outline-secondary">-</button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control">
                                            <button type="submit" class="btn btn-outline-secondary">+</button>
                                        </div>
                                    </form>



                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                        
                                            @method('DELETE')
                             
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <input type="number" name="quantity" class="d-none" value="1" min="1">
                                        <button type="submit" class="btn border-0 position-absolute top-0 end-0">
                                            <i class="bi bi-trash-fill fs-5"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-4">
            <h2>Cart Totals</h2>
            <div>
                <p>Subtotal: ${{ $subtotal }}</p>
                <p>Shipping: ${{ $shipping }}</p>
                <p>Total: ${{ $total }}</p>
            </div>
            {{-- <a href="{{ route('checkout') }}" class="btn btn-primary mt-3">Proceed to Checkout</a> --}}
        </div>
    </div>
</div>
@endsection
