<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container" style="width: 50%">
        <div class="table-content">
            <h1 class="card-header text-center mb-4">{{ __('Product Details') }}</h1>

            <div class="card-body">
                <h2>{{ $product->name }}</h2>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                {{-- <p><strong>Quantity:</strong> {{ $product->description }}</p> --}}
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary btn-rd">
                {{ __('Edit Product') }}
            </a>
            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-rd" onclick="return confirm('Are you sure you want to delete this product?')">
                    {{ __('Delete Product') }}
                </button>
            </form>
            <a href="{{ route('admin.home') }}" class="btn btn-secondary btn-rd">
                {{ __('Back to Products') }}
            </a>
        </div>
    </div>
@endsection
