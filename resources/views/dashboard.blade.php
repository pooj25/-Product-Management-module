@extends('products.layout')

@section('content')
<div class="space-y-8">
    <div class="border-b pb-4">
        <h2 class="text-3xl font-extrabold text-gray-800">Dashboard Overview</h2>
        <p class="text-gray-500 mt-1">Get a bird's-eye view of your inventory.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Inventory -->
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 shadow-lg text-white transform transition duration-500 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-blue-100">Total Products</h3>
                    <p class="text-5xl font-black mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>
        
        <!-- Total Value -->
        <div class="bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl p-6 shadow-lg text-white transform transition duration-500 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-teal-100">Total Inventory Value</h3>
                    <p class="text-4xl font-black mt-2">₹{{ number_format($totalValue, 2) }}</p>
                </div>
                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts -->
    <div class="mt-8 bg-gray-50 rounded-2xl p-6 border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="bg-red-100 text-red-500 p-2 rounded-lg mr-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </span>
            Low Stock Alerts (Quantity &lt; 5)
        </h3>
        
        @if($lowStockProducts->count() > 0)
            <div class="bg-white border border-gray-200 shadow-sm rounded-xl overflow-hidden">
                <ul class="divide-y divide-gray-100">
                    @foreach($lowStockProducts as $item)
                        <li class="p-5 flex justify-between items-center hover:bg-red-50 transition duration-150">
                            <div>
                                <p class="text-base font-bold text-gray-900">{{ $item->name }}</p>
                                <p class="text-sm text-gray-500">Price: ₹{{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="flex flex-col sm:flex-row items-end sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-700 animate-pulse-slow">
                                    Only {{ $item->quantity }} left!
                                </span>
                                <a href="{{ route('products.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm underline decoration-indigo-300 underline-offset-4">Restock &rarr;</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-6 rounded-xl flex items-center shadow-sm">
                <div class="bg-emerald-100 p-2 rounded-full mr-4 text-emerald-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-lg font-bold">All Good!</h4>
                    <p class="text-emerald-700 text-sm mt-1">All your products are well stocked. No items have less than 5 quantity.</p>
                </div>
            </div>
        @endif
    </div>
    
    <div class="mt-8 pt-6 border-t text-center">
        <a href="{{ route('products.index') }}" class="btn-primary inline-flex items-center text-lg px-8 py-4">
            Manage All Products
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>
</div>
@endsection
