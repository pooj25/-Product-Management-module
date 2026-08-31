@extends('products.layout')

@section('content')
<div class="flex justify-between items-center mb-6 border-b pb-4">
    <h2 class="text-2xl font-bold text-gray-700">Add New Product</h2>
    <a class="btn-secondary" href="{{ route('products.index') }}">
        &larr; Back to List
    </a>
</div>

@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm animate-fade-in" role="alert">
        <strong class="font-bold">Whoops!</strong>
        <span class="block sm:inline">There were some problems with your input.</span>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="col-span-1 md:col-span-2">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" class="input-field" placeholder="e.g. iPhone 15" value="{{ old('name') }}">
        </div>

        <div class="col-span-1 md:col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4" class="input-field" placeholder="Brief details about the product...">{{ old('description') }}</textarea>
        </div>

        <div class="col-span-1">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (₹) <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">₹</span>
                </div>
                <input type="number" step="0.01" name="price" id="price" class="input-field pl-7" placeholder="0.00" value="{{ old('price') }}">
            </div>
        </div>

        <div class="col-span-1">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity <span class="text-red-500">*</span></label>
            <input type="number" name="quantity" id="quantity" class="input-field" placeholder="0" value="{{ old('quantity') }}">
        </div>
    </div>

    <div class="pt-4 flex justify-end">
        <button type="submit" class="btn-primary w-full md:w-auto px-8 py-3 text-lg">
            Save Product
        </button>
    </div>
</form>
@endsection
