@extends('user.app')
@section('content')
{{-- <form action="{{url('user/showbarang', $barang[0]->id)}}" method="POST">
    {{ csrf_field() }} --}}

<div class="modal-header">
    <h5 class="modal-title">Detail Barang</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <h5>Profil</h5>
    {{-- <img class="mx-auto d-block mb-3" width="50%" src="{{asset('storage/drrose.JPG')}}"> --}}
    {{-- <img src="{{asset('storage/Capture.JPG')}}" width="50px" class="img-fluid"> --}}
    <div class="mx-2 mb-3">
        <div class="row">
          <dt class="col-4">Nama</dt>
          <dd class="col-8">{{ $barang->nama }}</dd>
        </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Stock</dt>
    <dd class="col-8">{{ $barang->stok }}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Harga</dt>
        <dd class="col-8">{{ $barang->harga }}</dd>
      </div>
    </div>

    {{-- <div class="card m-3" style="width: 18rem;">
        <img class="card-img-top" src="{{asset("storage/".$barang[0]->link_foto)}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$barang[0]->nama}}</h5>
          <p class="card-text"> RP. {{$barang[0]->harga}} / Hari</p>
          <p class="card-text"> {{$barang[0]->kategori->nama}}</p>

        <input type="number" name='jumlah' id="jumlah"/>


      </div> --}}

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>

    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Masukkan Keranjang') }}</button>
</form>
@endsection
