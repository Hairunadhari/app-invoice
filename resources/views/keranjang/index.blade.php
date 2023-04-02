@extends('dashboard')
@section('content')
<style>
    span svg {
        width: 20px;
    }

</style>

<div class="container " style="margin-top: 10px;">
    <div class="card">
        <div class="card-body">
            <table class="table">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
        </div>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Jumlah Pesan</th>
                <th scope="col">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
                @forelse ($keranjang as $p)
                <tr>
                <td>{{$no++}}</td>
                <td>{{$p->user->name}}</td>
                <td>{{$p->produk->nama}}</td>
                <td>{{$p->produk->deskripsi}}</td>
                <td>{{$p->jumlah_pesan}}</td>
                @if (Auth::user()->level == 'admin')
                    <td><a href="" class="btn bg-success text-white" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2{{$p->id}}">Kirim Tagihan</a>
                    </td>
                @else
                    <td>
                        <form action="{{ route('keranjang.destroy', $p) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white bg-danger">HAPUS</button>
                        </form>
                    </td>
                @endif
                @empty
                </tr>
                <div class="alert alert-danger">
                    Data Produk belum Tersedia.
                </div>
                
                @endforelse


        </tbody>
        </table>
        <div class="row">{{ $keranjang->links() }}</div>
    </div>
    <form action="{{route('pesanan.store')}}" method="post">
        @forelse ($keranjang as $k)
        @csrf
        <input type="text" name="keranjang_id[]" value="{{$k->id}}">
        @empty
        @endforelse
        <button type="submit" class="btn bg-success text-white">Pesan</button>
    </form>
</div>

</div>
<!-- Modal -->
@forelse ($keranjang as $p)
<div class="modal fade " id="exampleModal2{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('tagihan.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <input type="hidden" value="{{$p->id}}">
                            <label for="exampleInputEmail1" class="form-label">Tanggal Pemesanan</label>
                            <input type="text" value="{{$p->created_at->format('j M Y')}}" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Terakhir Pembayaran</label>
                            <input type="date" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Jumlah Pesan</th>
                                    <th scope="col">Harga Produk</th>
                                    <th scope="col">Total harga</th>
                                  </tr>
                                </thead>
                                @php
                                    $total = $p->jumlah_pesan * $p->produk->harga;
                                @endphp
                                <tbody>
                                  <tr>
                                    <th>{{$p->produk->nama}}</th>
                                    <th>{{$p->produk->deskripsi}}</th>
                                    <th>{{$p->jumlah_pesan}}</th>
                                    <th>Rp.{{number_format($p->produk->harga)}}</th>
                                    <th>Rp.{{number_format($total)}}</th>
                                  </tr>
                                </tbody>
                              </table>
                              <label for="">Total akhir:</label>
                              <input type="number" class="form-control" name="total_harga" value="{{$total}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-white bg-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white bg-primary">Kirim</button>
                </div>
            </form>

        </div>
    </div>
</div>
@empty

@endforelse
<h1 class="mt-5">SAAT TAMBAH PESANAN STOCK BELUM BERKURANG</h1>
@endsection
