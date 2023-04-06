<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('produk.daftarinvoice',compact('orders'));
    }

    public function orderproduk(){
        $products = Product::where('stok','>', 0 )->get();
        return view('produk.orderproduk',compact('products'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $itemsid = $request->itemsid;

        // dd($itemsid);
        if(is_null($itemsid)){
            return redirect(route('orderproduk'))->with(['error'=>'anda belum pilih produk!']);
        }else{
            $order = new Order;
            $todaydate = '1';
            $order->nama_customer = $request->nama_customer;
            $order->save();

            $order_id = $order->id;
            $totalitem = count($itemsid);
            $qtys = $request->qtys;
            for ($i=0;$i<$totalitem;$i++) { 
                $pid = $itemsid[$i];
                $qty = $qtys[$pid];
                $product = Product::find($pid);
                $product->stok -= $qty; 
                $product->save(); 
                $orderitem = new Orderitem;
                $orderitem->order_id = $order_id;
                $orderitem->product_id = $pid;
                $orderitem->qty = $qty;
                $orderitem->save();
            }
            return redirect(url('daftarinvoice'))->with(['success'=>'data berhasil diorder']);
        }
    }
    public function editinvoice($order_id){
        $order = Order::find($order_id);
        $products = Product::where('stok','>', 0)->get();
        $items = Orderitem::where('order_id',$order_id)->get();
        $productitems = array();
        $qtys = array();
        foreach($items as $item){
            $productitems[$item->product_id] = $item->product_id;
            $qtys[$item->product_id] = $item->qty;
        }
        return view('produk.editorderproduk',compact('products','items','productitems','qtys','order'));
    }

    public function updateorder(Request $request,$id)
    {
        $itemsid = $request->itemsid;
        if(is_null($itemsid)){
            return redirect(url('product'))->with(['error'=>'anda belum pilih produk!']);
        }else{
            $order = Order::find($id);
            $order->nama_customer = $request->nama_customer;
            $order->save();
            $totalitem = count($itemsid);
            $qtys = $request->qtys;
            Orderitem::where('order_id',$id)->delete();
            for ($i=0;$i<$totalitem;$i++) { 
                $pid = $itemsid[$i];
                $qty = $qtys[$pid];
                $product = Product::find($pid);
                $product->stok -= $qty; 
                $product->save(); 
                $orderitem = new Orderitem;
                $orderitem->order_id = $id;
                $orderitem->product_id = $pid;
                $orderitem->qty = $qty;
                $orderitem->save();
            }
            return redirect(url('order'))->with(['success'=>'order berhasil diedt']);
        }
    }

    public function destroy(Order $order)
    {
        $order->orderitem()->delete($order);
        $order->invoice()->delete($order);
        $order->delete($order);
        return redirect(route('daftarinvoice'))->with(['success'=>'data orderan dihapus']);
    }
    
    public function invoice($order_id)
    {
        $invoice = Invoice::where('order_id',$order_id)->first();
        // dd($invoice);
        if(is_null($invoice)){
            $invoice = new Invoice;
            $invoice->order_id = $order_id;
            $invoice->tanggalissued = date('Y-m-d');
            $invoice->save();
        }
        $order = Order::find($order_id);
        $customer_id = $order->user_id;
        $orderitems = Orderitem::where('order_id',$order_id)->get();
        return view('produk.invoice',compact('order','orderitems','invoice'));
    }

    
}
