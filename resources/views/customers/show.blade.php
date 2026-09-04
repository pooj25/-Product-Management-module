@extends('products.layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-10">

    <div>
        <h2 class="text-4xl font-extrabold text-slate-900 mb-2">
            Customer <span class="text-gradient">Details</span>
        </h2>

        <p class="text-slate-500 text-lg">
            Complete customer information.
        </p>
    </div>

    <div class="mt-6 md:mt-0 flex gap-4">

        <a
            href="{{ route('customers.edit', $customer->id) }}"
            class="btn-premium"
        >
            Edit Customer
        </a>

        <a
            href="{{ route('customers.index') }}"
            class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold transition"
        >
            Back
        </a>

    </div>

</div>

<div class="glass-panel p-8 rounded-2xl">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Customer Name
            </p>

            <p class="text-xl font-bold text-slate-900">
                {{ $customer->name }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Phone Number
            </p>

            <p class="text-xl font-semibold text-slate-800">
                {{ $customer->phone }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Email
            </p>

            <p class="text-lg text-slate-700">
                {{ $customer->email ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Status
            </p>

            @if ($customer->status === 'Active')
                <span class="px-4 py-2 text-sm font-bold rounded-full bg-emerald-100 text-emerald-700">
                    Active
                </span>
            @else
                <span class="px-4 py-2 text-sm font-bold rounded-full bg-rose-100 text-rose-700">
                    Inactive
                </span>
            @endif
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                City
            </p>

            <p class="text-lg text-slate-700">
                {{ $customer->city ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                State
            </p>

            <p class="text-lg text-slate-700">
                {{ $customer->state ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Pincode
            </p>

            <p class="text-lg text-slate-700">
                {{ $customer->pincode ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Created Date
            </p>

            <p class="text-lg text-slate-700">
                {{ $customer->created_at->format('d-m-Y') }}
            </p>
        </div>

        <div class="md:col-span-2">

            <p class="text-sm font-bold text-slate-400 uppercase mb-2">
                Address
            </p>

            <p class="text-lg text-slate-700 leading-relaxed">
                {{ $customer->address ?? '—' }}
            </p>

        </div>

    </div>

</div>

@endsection