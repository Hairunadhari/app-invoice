@extends('dashboard')
@section('content')
<style>
    span svg {
        width: 20px;
    }

</style>

<div class="container " style="margin-top: 10px;">
    @if (Auth::user()->level == 'admin')
    <a type="button" href="{{route('produk.create')}}" class="btn bg-success mb-3 text-white"
        style="width:180px">+Tambah Produk</a>
    @endif

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
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @forelse ($produk as $p)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$p->nama}}</td>
                        <td>{{$p->deskripsi}}</td>
                        <td>{{$p->stock}}</td>
                        <td>{{$p->harga}}</td>
                        @if (Auth::user()->level == 'admin')
                        <td>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('produk.destroy', $p) }}" method="POST">
                                <a href="{{ route('produk.edit', $p) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-white bg-danger">HAPUS</button>
                            </form>
                        </td>
                        @else
                        <td><button type="button" class="btn text-white bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$p->id}}">[+] Keranjang</button></td>
                        @endif
                          </tr>
                    @empty
                          <div class="alert alert-danger">
                              Data Produk belum Tersedia.
                          </div>
                    @endforelse
                </tbody>
            </table>
            <div class="row">{{ $produk->links() }}</div>
        </div>
    </div>
</div>

<!-- Modal -->
@forelse ($produk as $p)
<div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('keranjang.store')}}" method="post">
        @csrf
      <div class="modal-body">
        <input type="hidden" class="form-control" name="produk_id" value="{{$p->id}}" id="exampleFormControlInput1">
        <label for="">Nama Produk:</label>
        <input type="text" class="form-control" value="{{old('nama', $p->nama)}}" id="exampleFormControlInput1"  required>
        <label for="">Deskripsi:</label>
        <textarea class="form-control" id="exampleFormControlInput1" required  rows="3">{{old('deskripsi', $p->deskripsi)}}</textarea>
        <label for="">Stock:</label>
        <input type="text" class="form-control" value="{{old('stock', $p->stock)}}"  id="exampleFormControlInput1"required>
        <label for="">Harga:</label>
        <input type="text" class="form-control" value="{{old('harga', $p->harga)}}"  id="exampleFormControlInput1"  required>
        <label for="">Jumlah Pesan:</label>
        <input type="number" class="form-control"  id="exampleFormControlInput1" name="jumlah_pesan" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn bg-primary">Pesan</button>
      </div>
    </form>

    </div>
  </div>
</div>
@empty
@endforelse

@endsection
