@extends('products.layout')

@section('content')

<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10">
        <div>
            <h2 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-3">
                Purchase <span class="text-gradient">Details</span>
            </h2>

```
        <p class="text-xl text-slate-500 font-light">
            View complete purchase information.
        </p>
    </div>

    <div class="mt-6 md:mt-0">
        <a
            href="{{ route('purchases.index') }}"
            class="px-6 py-3 rounded-xl bg-slate-200 text-slate-700 font-bold hover:bg-slate-300 transition"
        >
            Back to Purchases
        </a>
    </div>
</div>

<div class="glass-panel p-8 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <p class="text-sm font-bold text-slate-500 uppercase mb-2">
                Invoice Number
            </p>

            <p class="text-xl font-extrabold text-slate-900">
                {{ $purchase->invoice_number }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-500 uppercase mb-2">
                Supplier
            </p>

            <p class="text-xl font-extrabold text-slate-900">
                {{ $purchase->supplier->name }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-500 uppercase mb-2">
                Purchase Date
            </p>

            <p class="text-xl font-extrabold text-slate-900">
                {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}
            </p>
        </div>
    </div>
</div>

<div class="glass-panel overflow-hidden">
    <div class="p-8 border-b border-slate-200">
        <h3 class="text-2xl font-bold text-slate-900">
            Purchased Products
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="bg-white/60 border-b border-slate-200">
                    <th class="px-8 py-5 text-sm font-bold tracking-widest text-slate-500 uppercase">
                        Product
                    </th>

                    <th class="px-8 py-5 text-sm font-bold tracking-widest text-slate-500 uppercase">
                        Quantity
                    </th>

                    <th class="px-8 py-5 text-sm font-bold tracking-widest text-slate-500 uppercase">
                        Purchase Price
                    </th>

                    <th class="px-8 py-5 text-sm font-bold tracking-widest text-slate-500 uppercase">
                        Subtotal
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @foreach ($purchase->purchaseItems as $item)
                    <tr class="hover:bg-white/60 transition-colors duration-200">
                        <td class="px-8 py-6 font-bold text-slate-900">
                            {{ $item->product->name }}
                        </td>

                        <td class="px-8 py-6 text-slate-600">
                            {{ $item->quantity }}
                        </td>

                        <td class="px-8 py-6 font-semibold text-indigo-600">
                            ₹{{ number_format($item->purchase_price, 2) }}
                        </td>

                        <td class="px-8 py-6 font-bold text-slate-900">
                            ₹{{ number_format($item->subtotal, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 p-8 flex justify-end">
        <div class="w-full md:w-80 bg-slate-100 rounded-2xl p-6">
            <p class="text-sm font-bold text-slate-500 uppercase mb-2">
                Total Amount
            </p>

            <p class="text-3xl font-extrabold text-indigo-600">
                ₹{{ number_format($purchase->total_amount, 2) }}
            </p>
        </div>
    </div>
</div>
```

</div>
@endsection
