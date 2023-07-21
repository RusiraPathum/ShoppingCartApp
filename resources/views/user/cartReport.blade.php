@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1 class="text-center mb-5">{{ __('Cart Report') }}</h1>
        @php
            $total = 0;
        @endphp
        <table id="report-table" class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Unit Price') }}</th>
                    <th>{{ __('Quantity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->product->price }}</td>
                        <td>{{ $cartItem->quantity }}</td>
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

    </div>
@endsection
