@extends('products.layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-10 opacity-0 animate-slide-up">

<div>
    <h2 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-3">
        Product <span class="text-gradient">Database</span>
    </h2>

    <p class="text-xl text-slate-500 font-light">
        Manage, search, filter, and oversee your inventory entries.
    </p>
</div>

<div class="mt-8 md:mt-0">

    <a
        class="btn-premium shadow-[0_10px_30px_rgba(99,102,241,0.4)]"
        href="{{ route('products.create') }}"
    >
        <svg
            class="w-6 h-6 mr-3"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 4v16m8-8H4"
            ></path>
        </svg>

        New Entry
    </a>

</div>


</div>

@if ($message = Session::get('success'))

<div class="glass-panel border-emerald-500/30 bg-emerald-500/10 p-6 mb-8 opacity-0 animate-fade-in flex items-center rounded-2xl">


<div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center mr-5 text-emerald-500">

    <svg
        class="w-6 h-6"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2.5"
            d="M5 13l4 4L19 7"
        ></path>
    </svg>

</div>

<p class="font-bold text-lg text-emerald-800">
    {{ $message }}
</p>


</div>

@endif

<div class="glass-panel p-6 mb-8 opacity-0 animate-slide-up">


<form
    method="GET"
    action="{{ route('products.index') }}"
    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4"
>

    <div>

        <label class="block text-sm font-bold text-slate-600 mb-2">
            Search Products
        </label>

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search products..."
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400"
        >

    </div>


    <div>

        <label class="block text-sm font-bold text-slate-600 mb-2">
            Category
        </label>

        <select
            name="category"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400"
        >

            <option value="">
                All Categories
            </option>

            @foreach ($categories as $category)

            <option
                value="{{ $category->id }}"
                {{ request('category') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>

            @endforeach

        </select>

    </div>


    <div>

        <label class="block text-sm font-bold text-slate-600 mb-2">
            Stock Status
        </label>

        <select
            name="stock"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400"
        >

            <option value="">
                All Stock
            </option>

            <option
                value="in_stock"
                {{ request('stock') === 'in_stock' ? 'selected' : '' }}
            >
                In Stock
            </option>

            <option
                value="low_stock"
                {{ request('stock') === 'low_stock' ? 'selected' : '' }}
            >
                Low Stock
            </option>

            <option
                value="out_of_stock"
                {{ request('stock') === 'out_of_stock' ? 'selected' : '' }}
            >
                Out of Stock
            </option>

        </select>

    </div>


    <div>

        <label class="block text-sm font-bold text-slate-600 mb-2">
            Sort By
        </label>

        <select
            name="sort"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/70 focus:outline-none focus:ring-2 focus:ring-indigo-400"
        >

            <option value="">
                Default
            </option>

            <option
                value="price_asc"
                {{ request('sort') === 'price_asc' ? 'selected' : '' }}
            >
                Price: Low to High
            </option>

            <option
                value="price_desc"
                {{ request('sort') === 'price_desc' ? 'selected' : '' }}
            >
                Price: High to Low
            </option>

        </select>

    </div>


    <div class="flex flex-col justify-end gap-2">

        <button
            type="submit"
            class="w-full px-5 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition"
        >
            Search
        </button>

        <a
            href="{{ route('products.index') }}"
            class="w-full px-5 py-3 rounded-xl bg-slate-200 text-slate-700 font-bold text-center hover:bg-slate-300 transition"
        >
            Clear Filters
        </a>

    </div>

</form>


</div>

<div class="glass-panel overflow-hidden opacity-0 animate-slide-up">


<div class="overflow-x-auto">

    <table class="w-full text-left whitespace-nowrap">

        <thead>

            <tr class="bg-white/60 border-b border-slate-200">

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    ID
                </th>

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Product
                </th>

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Category
                </th>

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Description
                </th>

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Price
                </th>

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Qty
                </th>

                <th class="px-6 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Stock
                </th>

                <th class="px-6 py-6 text-center text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Actions
                </th>

            </tr>

        </thead>


        <tbody class="divide-y divide-slate-200">

            @forelse ($products as $product)

            <tr class="hover:bg-white/60 transition-colors duration-200 group">

                <td class="px-6 py-7 text-base text-slate-400 font-mono">
                    {{ $products->firstItem() + $loop->index }}
                </td>

                <td class="px-6 py-7 text-base font-extrabold text-slate-900">
                    {{ $product->name }}
                </td>

                <td class="px-6 py-7 text-base text-slate-500">

                    @if ($product->category)

                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-indigo-500/20 text-indigo-600 border border-indigo-500/30">
                        {{ $product->category->name }}
                    </span>

                    @else

                    <span class="text-gray-500 italic">
                        Uncategorized
                    </span>

                    @endif

                </td>

                <td
                    class="px-6 py-7 text-base text-slate-500 max-w-[250px] truncate"
                    title="{{ $product->description }}"
                >
                    {{ $product->description ?? '—' }}
                </td>

                <td class="px-6 py-7 text-base font-bold text-indigo-600">
                    ₹{{ number_format($product->price, 2) }}
                </td>

                <td class="px-6 py-7 text-base font-bold text-slate-700">
                    {{ $product->quantity }}
                </td>

                <td class="px-6 py-7">

                    @if ($product->quantity == 0)

                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-rose-500/20 text-rose-600 border border-rose-500/30">
                        Out of Stock
                    </span>

                    @elseif ($product->quantity >= 1 && $product->quantity <= 5)

                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-amber-500/20 text-amber-700 border border-amber-500/30">
                        Low Stock
                    </span>

                    @else

                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-emerald-500/20 text-emerald-700 border border-emerald-500/30">
                        In Stock
                    </span>

                    @endif

                </td>


                <td class="px-6 py-7 text-center">

                    <form
                        action="{{ route('products.destroy', $product->id) }}"
                        method="POST"
                        onsubmit="return confirm('Initiate deletion? This cannot be undone.');"
                        class="inline-flex space-x-3"
                    >

                        <a
                            class="text-slate-500 hover:text-indigo-600 transition-all bg-white/60 hover:bg-white/80 p-3 rounded-xl hover:-translate-y-1"
                            href="{{ route('products.edit', $product->id) }}"
                            title="Edit"
                        >

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                ></path>
                            </svg>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="text-slate-500 hover:text-rose-500 transition-all bg-white/60 hover:bg-rose-500/10 p-3 rounded-xl hover:-translate-y-1"
                            title="Delete"
                        >

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                ></path>
                            </svg>

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8" class="px-10 py-24 text-center">

                    <div class="flex flex-col items-center justify-center">

                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-5 text-slate-400">

                            <svg
                                class="w-10 h-10"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a1 1 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                ></path>
                            </svg>

                        </div>

                        <h3 class="text-2xl font-bold text-slate-900 mb-2">
                            No products found.
                        </h3>

                        <p class="text-slate-500 mb-5">
                            Try changing your search or filters.
                        </p>

                        <a
                            href="{{ route('products.index') }}"
                            class="px-5 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition"
                        >
                            Clear Filters
                        </a>

                    </div>

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>


</div>

@if ($products->total() > 0)

<div class="flex flex-col md:flex-row justify-between items-center mt-8 gap-5">


<p class="text-slate-500 font-medium">

    Showing

    <span class="font-bold text-slate-700">
        {{ $products->firstItem() }}
    </span>

    –

    <span class="font-bold text-slate-700">
        {{ $products->lastItem() }}
    </span>

    of

    <span class="font-bold text-slate-700">
        {{ $products->total() }}
    </span>

    products

</p>

<div>
    {{ $products->links() }}
</div>


</div>

@endif

@endsection
