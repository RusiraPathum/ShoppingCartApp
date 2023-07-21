@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container table-content">
        <div class="p-3">
            <h1 class="text-center">{{ __('Products Details') }}</h1>

            <div class="mt-3 mb-5" style="text-align:right;">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    {{ __('Add New Product') }}
                </a>
            </div>

            <table id="products-table" class="table">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Price') }}</th>
                        {{-- <th>{{ __('Quantity') }}</th> --}}
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            {{-- <td>{{ $product->quantity }}</td> --}}
                            <td>
                                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-primary btn-sm btn-rd">
                                    {{ __('View') }}
                                </a>
                                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-secondary btn-sm btn-rd">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-rd" onclick="return confirm('Are you sure you want to delete this product?')">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
