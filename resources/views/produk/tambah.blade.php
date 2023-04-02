@extends('dashboard')
@section('content')
    <div class="container " style="margin-top: 10px;">
      <h1 class="fw-bold mb-3">Form Input Produk</h1>
      
      <div class="card">
        <div class="card-body">
            <form action="{{route('produk.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control" name="deskripsi" id="exampleFormControlInput1" required  rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah Produk</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="stock" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="harga" required>
                </div>
                <button type="submit" class="btn text-white bg-success">simpan</button>
            </form>
        </div>
      </div>
    </div>
@endsection
