@extends('products.layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-12">
    <div>
        <h2 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-3">
            Purchase <span class="text-gradient">Management</span>
        </h2>

```
    <p class="text-xl text-slate-500 font-light">
        Manage product purchases and stock entries.
    </p>
</div>

<div class="mt-8 md:mt-0">
    <a href="{{ route('purchases.create') }}" class="btn-premium shadow-[0_10px_30px_rgba(99,102,241,0.4)]">
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        New Purchase
    </a>
</div>
```

</div>

@if ($message = Session::get('success')) <div class="glass-panel border-emerald-500/30 bg-emerald-500/10 p-6 mb-8 rounded-2xl"> <p class="font-bold text-lg text-emerald-800">
{{ $message }} </p> </div>
@endif

<div class="glass-panel overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="bg-white/60 border-b border-slate-200">
                    <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                        Invoice
                    </th>

```
                <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Supplier
                </th>

                <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Purchase Date
                </th>

                <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Total
                </th>

                <th class="px-8 py-6 text-center text-sm font-bold tracking-widest text-slate-500 uppercase">
                    Actions
                </th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">
            @forelse ($purchases as $purchase)
                <tr class="hover:bg-white/60 transition-colors duration-200">
                    <td class="px-8 py-6 font-bold text-slate-900">
                        {{ $purchase->invoice_number }}
                    </td>

                    <td class="px-8 py-6 text-slate-600">
                        {{ $purchase->supplier->name }}
                    </td>

                    <td class="px-8 py-6 text-slate-600">
                        {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}
                    </td>

                    <td class="px-8 py-6 font-bold text-indigo-600">
                        ₹{{ number_format($purchase->total_amount, 2) }}
                    </td>

                    <td class="px-8 py-6 text-center">
                        <a
                            href="{{ route('purchases.show', $purchase->id) }}"
                            class="px-4 py-2 rounded-xl bg-indigo-100 text-indigo-700 font-bold hover:bg-indigo-200 transition"
                        >
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">
                            No purchases found
                        </h3>

                        <p class="text-slate-500">
                            Create your first purchase to update product stock.
                        </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
```

</div>
@endsection
