<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalQuantity = Product::sum('quantity');
        // sum price * quantity for total inventory value
        $totalValue = Product::sum(DB::raw('price * quantity'));
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        return view('dashboard', compact('totalProducts', 'totalQuantity', 'totalValue', 'lowStockProducts'));
    }
}
