@extends('dashboard')
@section('content')
<style>
    span svg {
        width: 20px;
    }

</style>

<div class="container " style="margin-top: 10px;">
    <a type="button" class="btn bg-success text-white mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
        style="width:150px">+Tambah Produk</a>
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
                        {{-- <th scope="col">#</th>
                        <th scope="col">Code</th> --}}
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        {{-- <td><input type="checkbox" name="itemsid[]" value="{{$product->id}}"></td>
                        <td>{{$product->code}}</td> --}}
                        <td>{{$product->nama}}</td>
                        <td>Rp.{{number_format($product->harga)}}</td>
                        <td>{{$product->stok}}</td>
                        <td>
                            <form method="POST" action="{{ route('product.destroy', $product) }}">
                                <a href="{{route('product.edit', $product)}}" class="btn bg-primary btm-sm">edit</a> |
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm bg-danger">HAPUS</button>
                            </form>
                        </td>
                        
                    </tr>
                    @empty
                    <tr>Data Kosong</tr>
                    @endforelse
                </tbody>
            </table>
            <div class="row">{{ $products->links() }} </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('product.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" required id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stok" required id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-white bg-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn text-white bg-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
