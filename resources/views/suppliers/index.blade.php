@extends('products.layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-12">
    <div>
        <h2 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-3">
            Supplier <span class="text-gradient">Management</span>
        </h2>
        <p class="text-xl text-slate-500 font-light">
            Manage your supplier information and purchase sources.
        </p>
    </div>

```
<div class="mt-8 md:mt-0">
    <a href="{{ route('suppliers.create') }}" class="btn-premium shadow-[0_10px_30px_rgba(99,102,241,0.4)]">
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Supplier
    </a>
</div>
```

</div>

@if ($message = Session::get('success'))

<div class="glass-panel border-emerald-500/30 bg-emerald-500/10 p-6 mb-8 rounded-2xl">
    <p class="font-bold text-lg text-emerald-800">{{ $message }}</p>
</div>
@endif

@if ($message = Session::get('error'))

<div class="glass-panel border-rose-500/30 bg-rose-500/10 p-6 mb-8 rounded-2xl">
    <p class="font-bold text-lg text-rose-700">{{ $message }}</p>
</div>
@endif

<div class="glass-panel overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="bg-white/60 border-b border-slate-200">
                    <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">Supplier</th>
                    <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">Phone</th>
                    <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">Email</th>
                    <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">Status</th>
                    <th class="px-8 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase text-center">Actions</th>
                </tr>
            </thead>

```
        <tbody class="divide-y divide-slate-200">
            @forelse ($suppliers as $supplier)
            <tr class="hover:bg-white/60 transition-colors duration-200">
                <td class="px-8 py-6 font-bold text-slate-900">
                    {{ $supplier->name }}
                </td>

                <td class="px-8 py-6 text-slate-600">
                    {{ $supplier->phone }}
                </td>

                <td class="px-8 py-6 text-slate-600">
                    {{ $supplier->email ?? '—' }}
                </td>

                <td class="px-8 py-6">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $supplier->status === 'Active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                        {{ $supplier->status }}
                    </span>
                </td>

                <td class="px-8 py-6 text-center">
                    <div class="inline-flex space-x-3">
                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                           class="px-4 py-2 rounded-xl bg-indigo-100 text-indigo-700 font-bold hover:bg-indigo-200 transition">
                            Edit
                        </a>

                        <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 rounded-xl bg-rose-100 text-rose-700 font-bold hover:bg-rose-200 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-20 text-center">
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">
                        No suppliers found
                    </h3>
                    <p class="text-slate-500">
                        Add your first supplier to get started.
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
