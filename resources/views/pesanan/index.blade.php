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
            @forelse ($pesanan as $p)
            
            <tr>
                <td>{{$no++}}</td>
                <td>{{$p->id}}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
        </table>
    </div>
</div>

</div>
<h1 class="mt-5">SAAT TAMBAH PESANAN STOCK BELUM BERKURANG</h1>
@endsection
