@extends('dashboard')
@section('content')
<style>
    span svg {
        width: 20px;
    }

</style>
<form action="{{route('updateorder', $order->id)}}" method="post">
@csrf
<div class="container " style="margin-top: 10px;">
    <div style="display: flex; justify-content:space-between; margin-inline: 20px; margin-bottom: 20px;" class="ds">
        <h3 class="fs-4">Edit Order</h3>
        <button type="submit" class="btn bg-success text-white" style="width: 100px">Update</button>
    </div>
    <div class="mb-3 col-6">
        <label for="exampleInputEmail1" class="form-label">Nama Customer:</label>
        <input type="text" class="form-control" name="nama_customer" value="{{$order->nama_customer}}" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
    <div class="card">
        <div class="card-body">
            <table class="table">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td><input type="checkbox" name="itemsid[]" value="{{$product->id}}" {{isset($productitems[$product->id])?"checked":""}}></td>
                        <td>{{$product->code}}</td>
                        <td>{{$product->nama}}</td>
                        <td>{{number_format($product->harga)}}</td>
                        <td>
                            <select name="qtys[{{$product->id}}]" class="form-control" id="qtys">
                            @for($i=1;$i<=$product->stok;$i++)
                            <option value="{{$i}}" {{isset($qtys[$product->id])?(($qtys[$product->id]==$i)?"selected":""):""}}>{{$i}}</option>
                            @endfor
                            </select>
                        </td>
                        
                    </tr>
                    @empty
                    <tr>Data Kosong</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>

@endsection
