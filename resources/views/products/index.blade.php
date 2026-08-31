@extends('products.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Product List</h2>
        <a class="btn-success" href="{{ route('products.create') }}">
            <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Create New Product
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded shadow-sm animate-fade-in" role="alert">
            <p class="font-medium">{{ $message }}</p>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($products as $product)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $product->description }}">{{ $product->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">₹{{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $product->quantity }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline-flex space-x-2">
                            <a class="btn-primary text-xs py-1.5 px-3" href="{{ route('products.edit', $product->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger text-xs py-1.5 px-3">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($products->isEmpty())
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 text-sm italic">
                        No products found. Start by creating one!
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
