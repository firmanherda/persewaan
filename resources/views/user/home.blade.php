@extends('user.app')
@section('content')
  <h2>Barang user </h2>


  <div class="row row-cols-4">

    @foreach ($barangs as $b)
      {{-- <div class="col"> <img width="100%" src="{{asset("storage/".$b->link_foto)}}"/> </div> --}}

      <div class="card m-3" style="width:18rem;">
        {{-- <img class="card-img-top" src="{{asset("storage/".$b->link_foto)}}" alt="Card image cap"> --}}
        <div class="card-body">
          <img class="mx-auto d-block mb-3" width="50%" src="{{ asset("storage/img/{$b->link_foto}") }}">
          <a class="display-4" href="{{ route('user.barang.index', $b->id) }}"
            class="card-title">{{ $b->nama }} </a>
          <p class="card-text"> RP. {{ $b->harga }} / Hari</p>
          <p class="card-text"> {{ $b->kategori->nama }}</p>
          {{-- <a href="{{ route('user.home.show', ['home' => $b->id]) }}" class="btn btn-primary">Go somewhere</a> --}}
          <a href="{{ route('user.barang.show', $b->id) }}" class="btn btn-primary">LIHAT DETAIl</a>
        </div>
        {{-- <p> {{$b}} </p> --}}
    @endforeach
  @endsection
