@extends('user.app')

@section('content')
  <div class="card w-100 mt-4">
    <div class="card-header">
      <h2 class="card-title">Detail Pesanan</h2>
    </div>
    {{-- <h3 class='text-center'>HARAP LAKUKAN PEMBAYARAN MAXIMAL 3 JAM SETELAH PESAN</h3> --}}
    <div class="card-body container-fluid">
      <div class="container-fluid mx-auto h5">
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">ID Transaksi: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $pesananuser->id }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Nama: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $pesananuser->user->nama }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Alamat: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $pesananuser->user->alamat }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">No HP: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $pesananuser->user->no_hp }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Tanggal Order :  </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $pesananuser->created_at->format('d M Y , H:i:s') }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Total Pembayaran : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">@rupiah($pesananuser->total_harga)</div>
        </div>
      </div>
      {{-- <h3 class='text-center'>Note : Pembayaran bisa dilakukan langsung ke Toko atau Transfer ke rekening bank dengan sertakan Format atau Berita ID Transaksi Anda.</h3> --}}

      <table class="table table-bordered w-100 mt-5">
        <thead>
          <tr>
            <th>No.</th>
            <th>Barang</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pesananuser->transaksiDetails as $rd)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $rd->barang->nama }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection


