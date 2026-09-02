@extends('products.layout')

@section('content')

<div class="max-w-6xl mx-auto">
    <div class="mb-10">
        <h2 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-3">
            Create <span class="text-gradient">Purchase</span>
        </h2>

```
    <p class="text-xl text-slate-500 font-light">
        Add purchased products and automatically update stock.
    </p>
</div>

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
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Supplier
                </label>

                <select
                    name="supplier_id"
                    class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    required
                >
                    <option value="">Select Supplier</option>

                    @foreach ($suppliers as $supplier)
                        <option
                            value="{{ $supplier->id }}"
                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                        >
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Invoice Number
                </label>

                <input
                    type="text"
                    name="invoice_number"
                    value="{{ old('invoice_number') }}"
                    placeholder="INV-001"
                    class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Purchase Date
                </label>

                <input
                    type="date"
                    name="purchase_date"
                    value="{{ old('purchase_date', date('Y-m-d')) }}"
                    class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    required
                >
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-2xl font-bold text-slate-900">
                Purchased Products
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full mb-6">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left py-4 px-3">Product</th>
                        <th class="text-left py-4 px-3">Quantity</th>
                        <th class="text-left py-4 px-3">Purchase Price</th>
                        <th class="text-left py-4 px-3">Subtotal</th>
                        <th class="text-center py-4 px-3">Action</th>
                    </tr>
                </thead>

                <tbody id="purchaseItems">
                    <tr class="purchase-row">
                        <td class="p-3">
                            <select
                                name="items[0][product_id]"
                                class="product-select w-full px-4 py-3 rounded-xl border border-slate-200"
                                required
                            >
                                <option value="">Select Product</option>

                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td class="p-3">
                            <input
                                type="number"
                                name="items[0][quantity]"
                                class="quantity w-full px-4 py-3 rounded-xl border border-slate-200"
                                min="1"
                                value="1"
                                required
                            >
                        </td>

                        <td class="p-3">
                            <input
                                type="number"
                                name="items[0][purchase_price]"
                                class="purchase-price w-full px-4 py-3 rounded-xl border border-slate-200"
                                min="0"
                                step="0.01"
                                value="0"
                                required
                            >
                        </td>

                        <td class="p-3">
                            <input
                                type="text"
                                class="subtotal w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100"
                                value="₹0.00"
                                readonly
                            >
                        </td>

                        <td class="p-3 text-center">
                            <button
                                type="button"
                                class="remove-row px-4 py-3 rounded-xl bg-rose-100 text-rose-700 font-bold"
                            >
                                Remove
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button
            type="button"
            id="addRow"
            class="px-5 py-3 rounded-xl bg-indigo-100 text-indigo-700 font-bold hover:bg-indigo-200 transition mb-8"
        >
            + Add Product Row
        </button>

        <div class="flex justify-end mb-8">
            <div class="w-full md:w-80 bg-slate-100 rounded-2xl p-6">
                <p class="text-sm font-bold text-slate-500 mb-2">
                    Total Amount
                </p>

                <p id="totalAmount" class="text-3xl font-extrabold text-indigo-600">
                    ₹0.00
                </p>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="btn-premium">
                Save Purchase
            </button>

            <a
                href="{{ route('purchases.index') }}"
                class="px-6 py-3 rounded-xl bg-slate-200 text-slate-700 font-bold hover:bg-slate-300 transition"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
```

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let rowIndex = 1;

    const purchaseItems = document.getElementById('purchaseItems');
    const addRowButton = document.getElementById('addRow');
    const totalAmount = document.getElementById('totalAmount');

    function calculateTotal() {
        let total = 0;

        document.querySelectorAll('.purchase-row').forEach(function (row) {
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.purchase-price').value) || 0;
            const subtotal = quantity * price;

            row.querySelector('.subtotal').value = '₹' + subtotal.toFixed(2);

            total += subtotal;
        });

        totalAmount.textContent = '₹' + total.toFixed(2);
    }

    function addCalculationEvents(row) {
        row.querySelector('.quantity').addEventListener('input', calculateTotal);
        row.querySelector('.purchase-price').addEventListener('input', calculateTotal);

        row.querySelector('.remove-row').addEventListener('click', function () {
            const rows = document.querySelectorAll('.purchase-row');

            if (rows.length > 1) {
                row.remove();
                calculateTotal();
            }
        });
    }

    document.querySelectorAll('.purchase-row').forEach(addCalculationEvents);

    addRowButton.addEventListener('click', function () {
        const newRow = document.createElement('tr');

        newRow.classList.add('purchase-row');

        newRow.innerHTML = `
            <td class="p-3">
                <select
                    name="items[${rowIndex}][product_id]"
                    class="product-select w-full px-4 py-3 rounded-xl border border-slate-200"
                    required
                >
                    <option value="">Select Product</option>

                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </td>

            <td class="p-3">
                <input
                    type="number"
                    name="items[${rowIndex}][quantity]"
                    class="quantity w-full px-4 py-3 rounded-xl border border-slate-200"
                    min="1"
                    value="1"
                    required
                >
            </td>

            <td class="p-3">
                <input
                    type="number"
                    name="items[${rowIndex}][purchase_price]"
                    class="purchase-price w-full px-4 py-3 rounded-xl border border-slate-200"
                    min="0"
                    step="0.01"
                    value="0"
                    required
                >
            </td>

            <td class="p-3">
                <input
                    type="text"
                    class="subtotal w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100"
                    value="₹0.00"
                    readonly
                >
            </td>

            <td class="p-3 text-center">
                <button
                    type="button"
                    class="remove-row px-4 py-3 rounded-xl bg-rose-100 text-rose-700 font-bold"
                >
                    Remove
                </button>
            </td>
        `;

        purchaseItems.appendChild(newRow);

        addCalculationEvents(newRow);

        rowIndex++;
    });

    calculateTotal();
});
</script>

@endsection
