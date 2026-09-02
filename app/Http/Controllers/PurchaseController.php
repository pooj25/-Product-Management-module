<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')
            ->latest()
            ->get();

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $products = Product::orderBy('name')->get();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.purchase_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $totalAmount = 0;

            foreach ($request->items as $item) {
                $totalAmount += $item['quantity'] * $item['purchase_price'];
            }

            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'invoice_number' => $request->invoice_number,
                'purchase_date' => $request->purchase_date,
                'total_amount' => $totalAmount,
            ]);

            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['purchase_price'];

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'purchase_price' => $item['purchase_price'],
                    'subtotal' => $subtotal,
                ]);

                $product = Product::findOrFail($item['product_id']);

                $product->increment('quantity', $item['quantity']);
            }
        });

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Purchase created successfully and product stock updated.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'purchaseItems.product',
        ]);

        return view('purchases.show', compact('purchase'));
    }
}
