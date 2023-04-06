@extends('dashboard')
@section('content')
<div class="container mt-5 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                
                <hr>
                <div class="table-responsive p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td>To</td>
                                <td>From</td>
                            </tr>
                            <tr class="content">
                                <td class="font-weight-bold"><strong>{{$order->nama_customer}}</strong> <br>{{$order->created_at->format('j M 
                                y h:i:s')}} <br>Jakarta</td>
                                <td class="font-weight-bold">Admin<br>{{$invoice->created_at->format('j M Y h:i:s')}} <br> Depok</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="products p-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="add">
                                <td><strong>Nama Produk</strong></td>
                                <td><strong>Harga</strong></td>
                                <td><strong>Quantity</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                            </tr>
                            @php
                                $total = 0; // variabel untuk menyimpan total dari hasil perkalian
                            @endphp
                            @foreach ($orderitems as $orderitem)
                            @php ($product = productdetail($orderitem->product_id)) @endphp
                            @php
                                $subtotal = $product->harga * $orderitem->qty; // variabel untuk menyimpan hasil perkalian pada setiap baris
                                $total += $subtotal; // menambahkan hasil perkalian pada variabel total
                            @endphp
                            <tr class="content">
                                <td>{{$product->nama}}</td>
                                <td>Rp.{{number_format($product->harga)}}</td>
                                <td>{{$orderitem->qty}}</td>
                                <td class="text-center">Rp.{{number_format($subtotal)}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="products p-2">
                    <table class="table table-borderless">
                       
                        <tbody>
                            <tr class="add">
                            <td>Subtotal : Rp. {{number_format($total)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
              
            </div>
        </div>
    </div>
</div>    
@endsection