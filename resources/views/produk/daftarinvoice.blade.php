@extends('dashboard')
@section('content')
<style>
    span svg {
        width: 20px;
    }

</style>

<div class="container " style="margin-top: 10px;">
    {{-- <form action="{{route('order.store')}}" method="post">
    @csrf --}}
    <div style="display: flex; justify-content:space-between; margin-inline: 20px; margin-bottom: 20px;" class="ds">
        <h3 class="fs-4">Daftar Invoice</h3>
        {{-- <button type="submit" class="btn bg-success text-white" style="width: 100px">[+] Order</button> --}}
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
                        <th scope="col">Invoice Id</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Tanggal Order</th>
                        <th scope="col">Jumlah Item</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;    
                    @endphp
                    @forelse ($orders as $order)
                    
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$order->nama_customer}}</td>
                        <td>{{ $order->created_at->format('j M Y, g:i a') }}</td>
                        <td> {{totalorderitem($order->id)}}</td>
                        <td>
                            <form method="POST" action="{{ route('order.destroy', $order) }}">
                                <a href="{{route('invoice', $order->id)}}" class="btn btn-sm bg-success">Invoice</a> |
                                <a href="{{route('editinvoice', $order->id)}}" class="btn btn-sm bg-primary">Edit</a> |
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
            {{-- <div class="row">{{ $products->links() }} </div> --}}
        </div>
    {{-- </form> --}}
    </div>
</div>

@endsection
