@extends('dashboard')
@section('content')
<style>
    span svg {
        width: 20px;
    }

</style>

<div class="container " style="margin-top: 10px;">
    <form action="{{route('order.store')}}" method="post">
    @csrf
    <div style="display: flex; justify-content:space-between; margin-inline: 20px; margin-bottom: 20px;" class="ds">
        <h3 class="fs-4">Pilih Produk Untuk di Order</h3>
        <button type="submit" class="btn bg-success text-white" style="width: 100px">[+] Order</button>
    </div>
    <div class="mb-3 col-6">
        <label for="exampleInputEmail1" class="form-label">Nama Customer:</label>
        <input type="text" class="form-control" name="nama_customer" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>
    <div class="card">
        <div class="card-body">
            <table class="table">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td><input type="checkbox" name="itemsid[]" value="{{$product->id}}"></td>
                        <td>{{$product->nama}}</td>
                        <td>{{number_format($product->harga)}}</td>
                        <td>{{$product->stok}}</td>
                        <td>
                            <select name="qtys[{{$product->id}}]" class="form-control" id="qtys">
                                @for($i=1;$i<=$product->stok;$i++)
                                <option value="{{$i}}">{{$i}}</option>
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
    </form>
    </div>
</div>

@endsection
