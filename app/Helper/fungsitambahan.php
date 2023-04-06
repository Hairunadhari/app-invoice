<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Auth;


function totalorderitem($orderid){
    $totalorderitem = Orderitem::where('order_id', $orderid)->get()->sum('qty');
    return $totalorderitem;
}
function productdetail($pid){
    $product = Product::find($pid);
    return $product;
}

?>