@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container table-content">
        <div class="p-3">
            <h1 class="text-center mb-5">{{ __('My Cart') }}</h1>

            <div class="text-right mb-5" style="text-align:right;">
                <form action="{{ route('users.empty') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-rd">Empty Cart</button>
                </form>
            </div>

            <table id="products-table" class="table">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Unit Price') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Subtotal') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->product->name }}</td>
                            <td>Rs {{ number_format($cartItem->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('users.update', ['cartItem' => $cartItem->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="quantity"
                                            style="width: 50px!important; margin-right: 10px"
                                            value="{{ $cartItem->quantity }}" min="1">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary btn-rd">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="text-success">Rs
                                {{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('users.remove', ['cartItem' => $cartItem->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-rd">X</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $total += $cartItem->product->price * $cartItem->quantity;
                        @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-5" style="text-align:right;">
                <h3>Total: Rs {{ number_format($total, 2) }}</h3>
            </div>

            <div class="row mt-5">
                <div class="col-6"><a href="{{ route('home') }}" style="width: 100%"
                        class="btn btn-secondary btn-rd">Continue Shopping</a></div>
                <div class="col-6"><a href="{{ route('users.report') }}" style="width: 100%"
                        class="btn btn-primary btn-rd">Checkout</a></div>
            </div>
        </div>
    </div>

    <!-- Add the required JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
