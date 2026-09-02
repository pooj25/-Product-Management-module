@extends('products.layout')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="mb-10">
        <h2 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-3">
            Edit <span class="text-gradient">Supplier</span>
        </h2>
        <p class="text-xl text-slate-500 font-light">
            Update supplier information.
        </p>
    </div>

```
@if ($errors->any())
    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-6 mb-8">
        <ul class="list-disc pl-5 text-rose-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="glass-panel p-8">
    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Supplier Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $supplier->name) }}"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                required
            >
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number</label>
            <input
                type="text"
                name="phone"
                value="{{ old('phone', $supplier->phone) }}"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                required
            >
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $supplier->email) }}"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Address</label>
            <textarea
                name="address"
                rows="4"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >{{ old('address', $supplier->address) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Status</label>
            <select
                name="status"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                required
            >
                <option value="Active" {{ old('status', $supplier->status) === 'Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="Inactive" {{ old('status', $supplier->status) === 'Inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="btn-premium">
                Update Supplier
            </button>

            <a
                href="{{ route('suppliers.index') }}"
                class="px-6 py-3 rounded-xl bg-slate-200 text-slate-700 font-bold hover:bg-slate-300 transition"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
```

</div>
@endsection
