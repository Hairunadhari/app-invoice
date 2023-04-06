@extends('dashboard')
@section('content')
<div class="container " style="">
  <h1 class="mb-2">Form Edit</h1>
  <div class="card">
    <div class="card-body">
        <form action="{{route('updateinvoice', $invoices->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Order id</label>
                <input type="text" class="form-control" value="{{ $invoices->id}}"  id="exampleFormControlInput1" name="orderid" readonly >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Issued</label>
                <input type="text" class="form-control" value="{{$invoices->tanggalissued}}"  id="exampleFormControlInput1" name="tanggalissued" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">status</label>
                <input type="number" class="form-control" value="{{$invoices->status}}"  id="exampleFormControlInput1" name="status" >
            </div>
            <button type="submit" class="btn bg-success">Update</button>
        </form>
    </div>
  </div>
</div>

@endsection