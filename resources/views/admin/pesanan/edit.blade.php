@extends('admin.app')
@section('content')
  <div class="card w-100">
    <div class="card-body">
      <h4 class="card-title">
        {{-- <p><strong>Profil {{ $pesanans->user_id }}&nbsp;</p> </strong> --}}
      </h4>

      @foreach ($pesanans as $data)
        <div class="row">
          <p class="col-sm-2">Tanggal Order</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->created_at }}</p>
          </div>
        </div>
        <div class="row">
          <p class="col-sm-2">Total Harga</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->total_harga }}</p>
          </div>
        </div>
        <div class="row">
          <p class="col-sm-2">Tanggal Sewa</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->tanggal_sewa }}</p>
          </div>
        </div>
        <div class="row">
          <p class="col-sm-2">Tanggal Batas Kembali</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->tanggal_batas_kembali }}</p>
          </div>
        </div>
        <button class="btn btn-primary">Submit</button>
        <button class="btn btn-secondary">Decline</button>
        <hr>
      @endforeach
    </div>
  </div>
@endsection
