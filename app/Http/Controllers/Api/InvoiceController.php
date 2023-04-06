<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        //get all posts
        $invoices = Order::paginate(5);
        return response()->json([
            'data' => $invoices
        ]);
    }

    public function show(Order $invoice){
        $invoices = Order::with('orderitem','invoice')->where('id',$invoice->id)->first();
        return response()->json([
            'data' => $invoices
        ]);
    }
}
