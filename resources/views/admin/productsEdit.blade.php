@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="table-content">
                    <h1 class="card-header text-center mb-4">{{ __('Edit Product') }}</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $product->name) }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="price"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row mb-3">
                                <label for="quantity"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
                                <div class="col-md-6">
                                    <input id="quantity" type="number"
                                        class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                        value="{{ old('quantity', $product->quantity) }}" required>
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Product') }}
                                    </button>
                                    <a href="{{ route('admin.home') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
