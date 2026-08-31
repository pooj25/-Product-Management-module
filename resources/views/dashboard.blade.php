@extends('products.layout')

@section('content')
<div class="space-y-16">
    <div class="text-center max-w-4xl mx-auto opacity-0 animate-slide-up" style="animation-delay: 0.1s;">
        <h2 class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
            Command Your <br><span class="text-gradient">Inventory</span>
        </h2>
        <p class="text-xl md:text-2xl text-slate-500 leading-relaxed font-light">Experience the future of product management. Monitor your stock, evaluate your assets, and stay ahead of shortages in real-time.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 opacity-0 animate-slide-up" style="animation-delay: 0.3s;">
        <!-- Total Products -->
        <div class="glass-panel p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-bold tracking-wider text-slate-500 uppercase mb-2">Total Products</p>
                    <h3 class="text-6xl font-black text-slate-900 drop-shadow-lg">{{ $totalProducts }}</h3>
                </div>
                <div class="p-4 bg-primary/20 rounded-2xl border border-primary/30 text-primary shadow-[0_0_15px_rgba(99,102,241,0.3)] group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>

        <!-- Total Quantity -->
        <div class="glass-panel p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-bold tracking-wider text-slate-500 uppercase mb-2">Total Quantity</p>
                    <h3 class="text-6xl font-black text-slate-900 drop-shadow-lg">{{ $totalQuantity }}</h3>
                </div>
                <div class="p-4 bg-purple-500/20 rounded-2xl border border-purple-500/30 text-purple-400 shadow-[0_0_15px_rgba(168,85,247,0.3)] group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>
        
        <!-- Total Value -->
        <div class="glass-panel p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-bold tracking-wider text-slate-500 uppercase mb-2">Inventory Value</p>
                    <h3 class="text-5xl font-black text-slate-900 drop-shadow-lg">₹{{ number_format($totalValue, 2) }}</h3>
                </div>
                <div class="p-4 bg-accent/20 rounded-2xl border border-accent/30 text-accent shadow-[0_0_15px_rgba(236,72,153,0.3)] group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts -->
    <div class="glass-panel p-10 opacity-0 animate-slide-up" style="animation-delay: 0.5s;">
        <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-6">
            <h3 class="text-3xl font-extrabold text-slate-900 flex items-center">
                <span class="w-4 h-4 rounded-full bg-rose-500 mr-4 shadow-[0_0_15px_rgba(244,63,94,1)] animate-pulse"></span>
                Critical Stock Alerts
            </h3>
        </div>
        
        @if($lowStockProducts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($lowStockProducts as $item)
                    <div class="bg-white/60 border border-slate-200 rounded-3xl p-6 hover:bg-white/80 transition-colors group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-rose-500/10 rounded-full blur-2xl -mr-10 -mt-10 group-hover:bg-rose-500/20 transition-colors"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <h4 class="text-2xl font-bold text-slate-900">{{ $item->name }}</h4>
                            <span class="px-4 py-1.5 text-sm font-bold rounded-full bg-rose-500/20 text-rose-400 border border-rose-500/30 shadow-[0_0_10px_rgba(244,63,94,0.2)]">
                                {{ $item->quantity }} Left
                            </span>
                        </div>
                        <p class="text-slate-500 text-base mb-8 relative z-10 font-medium">Price: ₹{{ number_format($item->price, 2) }}</p>
                        <a href="{{ route('products.edit', $item->id) }}" class="inline-flex items-center text-base font-bold text-primary group-hover:text-slate-900 transition-colors relative z-10 bg-primary/10 px-4 py-2 rounded-xl">
                            Restock Now 
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-3xl p-12 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-emerald-500/20 rounded-full flex items-center justify-center mb-6 text-emerald-400 shadow-[0_0_30px_rgba(16,185,129,0.3)]">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h4 class="text-3xl font-extrabold text-slate-900 mb-3">All Systems Go</h4>
                <p class="text-slate-500 text-lg">Inventory is extremely healthy. No items are running low.</p>
            </div>
        @endif
    </div>
    
    <div class="mt-16 text-center opacity-0 animate-slide-up" style="animation-delay: 0.7s;">
        <a href="{{ route('products.index') }}" class="btn-premium text-lg px-10 py-4 shadow-[0_10px_30px_rgba(99,102,241,0.4)]">
            Access Database
            <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </a>
    </div>
</div>
@endsection
