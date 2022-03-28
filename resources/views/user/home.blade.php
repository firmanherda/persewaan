@extends('user.app')
@section('content')
  <h2 class="text-black mt-2">Barang</h2>
  <input type="date" name="tanggal_sewa">
  <input type="date" name="tanggal_batas_kembali">
  <div class="row row-cols-2 row-cols-md-4">

    @foreach ($barangs as $b)
      <div class="col px-2">
        <div class="card">
          <div class="card-body">
            <img class="mx-auto d-block mb-3" width="100%" src="{{ asset("storage/img/{$b->link_foto}") }}">
            <a class="h4 text-decoration-none fw-bold" href="{{ route('user.barang.show', $b->id) }}"
              class="card-title">{{ $b->nama }} </a>
            <p class="card-text"> @rupiah($b->harga) / Hari</p>
            <a href="{{ route('user.barang.show', $b->id) }}" class="btn btn-primary">LIHAT DETAIl</a>
            {{-- @if ($user->status == 'pending')
            <button type="button" class="btn btn-secondary btn-lg" disabled>LIHAT DETAIL</button>
            @else
            <a href="{{ route('user.barang.show', $b->id) }}" class="btn btn-primary">LIHAT DETAIl</a>
            @endif --}}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
