@extends('products.layout')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-12 opacity-0 animate-slide-up">
        <div>
            <h2 class="text-5xl font-extrabold text-white tracking-tight mb-3">Product <span class="text-gradient">Database</span></h2>
            <p class="text-xl text-gray-400 font-light">Manage, edit, and oversee your inventory entries.</p>
        </div>
        <div class="mt-8 md:mt-0">
            <a class="btn-premium shadow-[0_10px_30px_rgba(99,102,241,0.4)]" href="{{ route('products.create') }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Entry
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="glass-panel border-emerald-500/30 bg-emerald-500/10 p-6 mb-10 opacity-0 animate-fade-in flex items-center rounded-2xl">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center mr-5 text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <p class="font-bold text-lg text-emerald-300">{{ $message }}</p>
        </div>
    @endif

    <div class="glass-panel overflow-hidden opacity-0 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/5 border-b border-white/10">
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-gray-400 uppercase">ID</th>
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-gray-400 uppercase">Product</th>
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-gray-400 uppercase">Description</th>
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-gray-400 uppercase">Price</th>
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-gray-400 uppercase">Qty</th>
                        <th class="px-10 py-6 text-center text-sm font-bold tracking-widest text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($products as $product)
                    <tr class="hover:bg-white/5 transition-colors duration-200 group">
                        <td class="px-10 py-7 text-base text-gray-500 font-mono">{{ $loop->iteration }}</td>
                        <td class="px-10 py-7 text-base font-extrabold text-white">{{ $product->name }}</td>
                        <td class="px-10 py-7 text-base text-gray-400 max-w-[250px] truncate" title="{{ $product->description }}">{{ $product->description ?? '—' }}</td>
                        <td class="px-10 py-7 text-base font-bold text-accent">₹{{ number_format($product->price, 2) }}</td>
                        <td class="px-10 py-7 text-base">
                            <span class="px-4 py-1.5 inline-flex text-sm font-bold rounded-full {{ $product->quantity < 5 ? 'bg-rose-500/20 text-rose-400 border border-rose-500/30 shadow-[0_0_10px_rgba(244,63,94,0.2)]' : 'bg-primary/20 text-primary border border-primary/30 shadow-[0_0_10px_rgba(99,102,241,0.2)]' }}">
                                {{ $product->quantity }}
                            </span>
                        </td>
                        <td class="px-10 py-7 text-center">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Initiate deletion? This cannot be undone.');" class="inline-flex space-x-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                <a class="text-gray-400 hover:text-white transition-all bg-white/5 hover:bg-white/10 p-3 rounded-2xl hover:shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:-translate-y-1" href="{{ route('products.edit', $product->id) }}" title="Edit">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-rose-400 transition-all bg-white/5 hover:bg-rose-500/10 p-3 rounded-2xl hover:shadow-[0_0_15px_rgba(244,63,94,0.2)] hover:-translate-y-1" title="Delete">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($products->isEmpty())
                    <tr>
                        <td colspan="6" class="px-10 py-24 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mb-6 text-gray-500">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">Database is Empty</h3>
                                <p class="text-gray-400 text-lg">No entries found. Click 'New Entry' to populate the database.</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
