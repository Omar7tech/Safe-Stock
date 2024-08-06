@extends('user.layout.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" value="{{ old('stock_quantity') }}" required>
            @error('stock_quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" id="sku" value="{{ old('sku') }}" required>
            @error('sku')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Product Images</label>
            <input type="file" name="images[]" class="form-control" id="images" multiple>
            @error('images.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" id="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->EncodedId }}" {{ old('category_id') == $category->EncodedId ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier (Optional)</label>
            <select name="supplier_id" class="form-control" id="supplier_id">
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->EncodedId }}" {{ old('supplier_id') == $supplier->EncodedId ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
            @error('supplier_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
            @error('is_active')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
@endsection
