@extends('admin.app')

@section('content')
  <div class="card w-100 mt-4">
    <div class="card-header">
      <h2 class="card-title">Detail Riwayat Transaksi</h2>
    </div>
    <div class="card-body container-fluid">
      <div class="container-fluid mx-auto h5">
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Nama: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $riwayats->user->nama }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Alamat: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $riwayats->user->alamat }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">No HP: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $riwayats->user->no_hp }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Total: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">@rupiah($riwayats->total_harga)</div>
        </div>
      </div>

      <table class="table table-bordered w-100 mt-5">
        <thead>
          <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Kondisi Barang</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($riwayats->transaksiDetails as $rd)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $rd->barang->nama }}</td>
              <td>{{ $rd->status }}</td>
              <td>{{ $rd->denda }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection


