@extends('user.app')
@section('content')
  <div class="modal-header">
    <h5 class="modal-title">Detail Barang</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <h5>Profil</h5>
    <img class="mx-auto d-block mb-3" width="25%" src="{{ asset("storage/img/{$barang->link_foto}") }}">
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Kategori</dt>
        <dd class="col-8">{{ $barang->kategori->nama }}</dd>
      </div>
    </div>
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

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    </div>

    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Masukkan Keranjang') }}</button>
    </form>
  @endsection
