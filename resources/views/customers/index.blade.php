@extends('products.layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-10">
    <div>
        <h2 class="text-4xl font-extrabold text-slate-900 mb-2">
            Customer <span class="text-gradient">Management</span>
        </h2>
        <p class="text-slate-500 text-lg">
            Manage and view customer information.
        </p>
    </div>

    <div class="mt-6 md:mt-0">
        <a href="{{ route('customers.create') }}" class="btn-premium">
            + Add Customer
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="mb-6 p-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 font-semibold">
        {{ $message }}
    </div>
@endif

<div class="glass-panel p-6 rounded-2xl mb-8">

    <form action="{{ route('customers.index') }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Customer..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <div>
                <select
                    name="status"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    <option value="">All Customers</option>

                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-premium">
                    Search
                </button>

                <a
                    href="{{ route('customers.index') }}"
                    class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold transition"
                >
                    Clear
                </a>
            </div>

        </div>
    </form>

</div>

<div class="glass-panel overflow-hidden rounded-2xl">

    <div class="overflow-x-auto">

        <table class="w-full text-left whitespace-nowrap">

            <thead>
                <tr class="bg-white/60 border-b border-slate-200">
                    <th class="px-6 py-5 text-sm font-bold text-slate-500 uppercase">#</th>
                    <th class="px-6 py-5 text-sm font-bold text-slate-500 uppercase">Customer</th>
                    <th class="px-6 py-5 text-sm font-bold text-slate-500 uppercase">Phone</th>
                    <th class="px-6 py-5 text-sm font-bold text-slate-500 uppercase">Email</th>
                    <th class="px-6 py-5 text-sm font-bold text-slate-500 uppercase">City</th>
                    <th class="px-6 py-5 text-sm font-bold text-slate-500 uppercase">Status</th>
                    <th class="px-6 py-5 text-center text-sm font-bold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">

                @forelse ($customers as $customer)

                    <tr class="hover:bg-white/60 transition">

                        <td class="px-6 py-5 text-slate-500">
                            {{ $customers->firstItem() + $loop->index }}
                        </td>

                        <td class="px-6 py-5 font-bold text-slate-900">
                            {{ $customer->name }}
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $customer->phone }}
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $customer->email ?? '—' }}
                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $customer->city ?? '—' }}
                        </td>

                        <td class="px-6 py-5">

                            @if ($customer->status === 'Active')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-rose-100 text-rose-700">
                                    Inactive
                                </span>
                            @endif

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-3">

                                <a
                                    href="{{ route('customers.show', $customer->id) }}"
                                    class="px-4 py-2 rounded-lg bg-indigo-100 text-indigo-700 font-semibold hover:bg-indigo-200 transition"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('customers.edit', $customer->id) }}"
                                    class="px-4 py-2 rounded-lg bg-amber-100 text-amber-700 font-semibold hover:bg-amber-200 transition"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('customers.destroy', $customer->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-4 py-2 rounded-lg bg-rose-100 text-rose-700 font-semibold hover:bg-rose-200 transition"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-slate-500 text-lg">
                            No customers found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@if ($customers->hasPages())

    <div class="mt-8">
        {{ $customers->links() }}
    </div>

@endif

@endsection