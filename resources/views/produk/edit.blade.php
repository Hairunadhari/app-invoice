@extends('dashboard')
@section('content')
<div class="container " style="">
  <h1 class="mb-2">Form Edit</h1>
  <div class="card">
    <div class="card-body">
        <form action="{{route('product.update', $product)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control" value="{{ old('nama', $product->nama) }}"  id="exampleFormControlInput1" name="nama" >
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Harga</label>
              <input type="number" class="form-control" value="{{ old('harga', $product->harga) }}"  id="exampleFormControlInput1" name="harga" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Stok</label>
                <input type="number" class="form-control" value="{{ old('stok', $product->stok) }}"  id="exampleFormControlInput1" name="stok" >
            </div>
            <button type="submit" class="btn bg-success">Update</button>
        </form>
    </div>
  </div>
</div>

@endsection