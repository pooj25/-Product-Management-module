@extends('products.layout')

@section('content')
<div class="max-w-6xl mx-auto opacity-0 animate-slide-up">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 pb-6 border-b border-slate-200">
        <div>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Category <span class="text-gradient">Management</span></h2>
            <p class="text-slate-500">Organize your inventory into categories.</p>
        </div>
        <div class="mt-6 md:mt-0">
            <a class="btn-premium shadow-[0_10px_30px_rgba(99,102,241,0.4)]" href="{{ route('categories.create') }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Category
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="glass-panel border-emerald-500/30 bg-emerald-500/10 p-6 mb-8 opacity-0 animate-fade-in flex items-center rounded-2xl">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center mr-4 text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <p class="font-bold text-emerald-800">{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="glass-panel border-rose-500/30 bg-rose-500/10 p-6 mb-8 opacity-0 animate-fade-in flex items-center rounded-2xl">
            <div class="w-10 h-10 rounded-full bg-rose-500/20 flex items-center justify-center mr-4 text-rose-400 shadow-[0_0_15px_rgba(244,63,94,0.3)]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <p class="font-bold text-rose-800">{{ $message }}</p>
        </div>
    @endif

    <div class="glass-panel overflow-hidden opacity-0 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/60 border-b border-slate-200">
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase">Category Name</th>
                        <th class="px-10 py-6 text-sm font-bold tracking-widest text-slate-500 uppercase text-center">Status</th>
                        <th class="px-10 py-6 text-center text-sm font-bold tracking-widest text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($categories as $category)
                    <tr class="hover:bg-white/60 transition-colors duration-200 group">
                        <td class="px-10 py-7 text-base font-extrabold text-slate-900">{{ $category->name }}</td>
                        <td class="px-10 py-7 text-base text-center">
                            @if($category->status == 'Active')
                                <span class="px-4 py-1.5 inline-flex text-sm font-bold rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 shadow-[0_0_10px_rgba(16,185,129,0.2)]">Active</span>
                            @else
                                <span class="px-4 py-1.5 inline-flex text-sm font-bold rounded-full bg-gray-500/20 text-slate-500 border border-gray-500/30">Inactive</span>
                            @endif
                        </td>
                        <td class="px-10 py-7 text-center">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline-flex space-x-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                <a class="text-slate-500 hover:text-slate-900 transition-all bg-white/60 hover:bg-white/80 p-3 rounded-2xl hover:shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:-translate-y-1" href="{{ route('categories.edit', $category->id) }}" title="Edit">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-500 hover:text-rose-400 transition-all bg-white/60 hover:bg-rose-500/10 p-3 rounded-2xl hover:shadow-[0_0_15px_rgba(244,63,94,0.2)] hover:-translate-y-1" title="Delete">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($categories->isEmpty())
                    <tr>
                        <td colspan="3" class="px-10 py-24 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-white/60 rounded-full flex items-center justify-center mb-6 text-slate-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 mb-2">No Categories</h3>
                                <p class="text-slate-500 text-lg">Create a category to get started.</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
