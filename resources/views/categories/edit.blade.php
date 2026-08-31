@extends('products.layout')

@section('content')
<div class="max-w-4xl mx-auto opacity-0 animate-slide-up">
    <div class="flex justify-between items-center mb-10 pb-6 border-b border-slate-200">
        <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Edit <span class="text-gradient">{{ $category->name }}</span></h2>
        <a class="btn-outline" href="{{ route('categories.index') }}">
            &larr; Back to Categories
        </a>
    </div>

    @if ($errors->any())
        <div class="glass-panel border-rose-500/30 bg-rose-500/10 p-6 mb-10 animate-fade-in rounded-2xl">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full bg-rose-500/20 flex items-center justify-center mr-4 text-rose-400 shadow-[0_0_15px_rgba(244,63,94,0.3)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <strong class="font-extrabold text-xl text-rose-800">Validation Error</strong>
            </div>
            <ul class="list-disc list-inside text-base text-rose-700 ml-14 space-y-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="glass-panel p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
            <div class="col-span-1 md:col-span-2">
                <label for="name" class="block text-sm font-bold text-slate-600 mb-3 tracking-wide uppercase">Category Name <span class="text-rose-500">*</span></label>
                <input type="text" name="name" id="name" class="input-premium focus:ring-accent/50 focus:border-accent" placeholder="e.g. Mobiles" value="{{ old('name', $category->name) }}">
            </div>

            <div class="col-span-1 md:col-span-2">
                <label for="status" class="block text-sm font-bold text-slate-600 mb-3 tracking-wide uppercase">Status <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select name="status" id="status" class="input-premium focus:ring-accent/50 focus:border-accent bg-white appearance-none">
                        <option value="Active" {{ old('status', $category->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status', $category->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-8 flex justify-end border-t border-slate-200 relative z-10">
            <button type="submit" class="btn-premium bg-gradient-to-r from-accent to-purple-600 shadow-[0_10px_30px_rgba(236,72,153,0.4)] text-lg">
                Update Category
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection
