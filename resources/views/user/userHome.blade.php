<!-- resources/views/user/products.blade.php -->

@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1>{{ __('Products List') }}</h1>

        <div class="mt-3 mb-3" style="text-align:right;">
            <a href="{{ route('users.cart') }}" class="btn btn-success btn-rd">
                {{ __('Go to Cart') }} <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
            </a>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="table-content">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Price: ${{ number_format($product->price, 2) }}</p>
                            <p class="card-text">Quantity: {{ $product->quantity }}</p>
                            <button class="btn btn-primary btn-sm add-to-cart btn-rd" data-product-id="{{ $product->id }}">
                                {{ __('Add to Cart') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                var productId = $(this).data('product-id');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.add') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
