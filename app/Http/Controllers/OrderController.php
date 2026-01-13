<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show order details for any role
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        
        // Check if user has permission to view this order
        if (Auth::user()->hasRole('super_admin|admin_transaksi') || 
            (Auth::user()->hasRole('supplier') && $order->items->contains('supplier_id', Auth::id())) ||
            (Auth::user()->hasRole('dropshipper') && $order->user_id === Auth::id())) {
                
            return view('shared.order-show', compact('order'));
        }
        
        abort(403, 'Unauthorized action.');
    }
    
    // List all orders for admin
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('super_admin|admin_transaksi')) {
            $orders = Order::with(['user', 'items'])->latest()->get();
        } elseif ($user->hasRole('supplier')) {
            $orders = Order::whereHas('items', function($query) use ($user) {
                $query->where('supplier_id', $user->id);
            })->with(['user', 'items'])->latest()->get();
        } else {
            $orders = collect();
        }
        
        return view('shared.orders', compact('orders'));
    }
}
