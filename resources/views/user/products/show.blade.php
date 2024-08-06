@extends('user.layout.app')

@section('content')
    <div class="container mt-4">
        <h2>Product Details</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    @if ($product->images->isNotEmpty())
                        <img src="{{ Storage::url($product->images->first()->image_path) }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="img-fluid rounded-start" alt="No Image">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                        <p class="card-text"><strong>Supplier:</strong> {{ $product->supplier->name }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                        <p class="card-text"><strong>Stock Quantity:</strong> {{ number_format($product->stock_quantity) }}</p>
                        <p class="card-text"><strong>SKU:</strong> {{ $product->sku }}</p>
                        <p class="card-text"><small class="text-muted">Created At  {{ $product->created_at->diffForHumans() }}</small></p>
                        <p class="card-text"><small class="text-muted">Last updated {{ $product->updated_at->diffForHumans() }}</small></p>
                        <hr>
                    </div>
                </div>
            </div>

            @if ($product->images->isNotEmpty())
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $index => $image)
                            <div class="carousel-item @if($index == 0) active @endif" data-bs-interval="10000">
                                <img src="{{ Storage::url($image->image_path) }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
        <a href="{{ route('products.edit', Hashids::encode($product->id)) }}" class="btn btn-primary">Edit Product</a>
        <form action="{{ route('products.destroy', Hashids::encode($product->id)) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
    </div>
@endsection
