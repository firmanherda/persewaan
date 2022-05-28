@extends('user.app')

@section('content')
@php
$tanggal_sewa = \Carbon\Carbon::parse($sd->tanggal_sewa);
$tanggal_batas_kembali = \Carbon\Carbon::parse($sd->tanggal_batas_kembali);
$now = \Carbon\Carbon::now()->toDateString();
$lamaSewa = $tanggal_sewa->diffInDays($tanggal_batas_kembali);
if ($now > $tanggal_batas_kembali) {
    $terlambat = $tanggal_batas_kembali->diffInDays($now);
}

@endphp
<form action="{{route('admin.barangdisewa.update', $sd->id)}}" method="POST">
@csrf
@method("PUT")
  <div class="card w-100 mt-4">
    <div class="card-header">
      <h2 class="card-title">Detail Pesanan</h2>
    </div>
    <div class="card-body container-fluid">
      <div class="container-fluid mx-auto h5">
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Id Transaksi: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $sd->id }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Nama: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $sd->user->nama }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Alamat: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $sd->user->alamat }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">No HP: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold ">{{ $sd->user->no_hp }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Tanggal Sewa : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $sd->tanggal_sewa }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Tanggal Batas Kembali : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $sd->tanggal_batas_kembali}}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Durasi Sewa : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold"> {{ $lamaSewa }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Terlambat : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">
            @if (isset($terlambat))
              {{ $terlambat }} Hari
            @else
              -
            @endif
          </div>
         <div class="row justify-content-center mt-2">
            <div class="col-5 col-md-2 pe-1 text-end">Denda : </div>
            <div class="col-7 col-md-4 ps-1 fw-bold">
              @if (isset($terlambat))
                @rupiah($sd->transaksiDetails->sum('barang.harga') * $terlambat)
              @else
                -
              @endif
            </div>
          </div>
        {{-- <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Total: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">@rupiah($sd->total_harga)</div> --}}
        </div>
      </div>

      <table class="table table-bordered w-100 mt-5">
        <thead>
          <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sd->transaksiDetails as $b)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $b->barang->nama }}</td>
              <td>{{ $b->barang->harga }}</td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection


