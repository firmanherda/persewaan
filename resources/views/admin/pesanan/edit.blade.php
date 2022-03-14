@extends('admin.app')
@section('content')
  <div class="card w-100">
    <div class="card-body">
      <h4 class="card-title">
        {{-- <p><strong>Profil {{ $pesanans->user_id }}&nbsp;</p> </strong> --}}
      </h4>

      <br>
      {{-- <div class="row">
      <p class="col-sm-2">Nama</p>
      <div class="col-sm-10">
        <p class="card-text">{{ $pesanans->user_id }}</p>
      </div>
    </div> --}}
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


      {{-- <div class="row">
      <p class="col-sm-2">Status</p>
      <div class="col-sm-10">
        @if ($user->status == 'pending')
          <a class="card-text" href="{{ route('user.profil.verifikasi.create') }}">Belum di Verifikasi
          </a>
        @elseif($user->status == 'ditolak')
          <a class="card-text" href="{{ route('user.profil.verifikasi.create') }}">Verifikasi ditolak,
            Verifikasi lagi </a>
        @elseif($user->status == 'menunggu')
          <p class="card-text"> Menunggu Persetujuan Admin </p>
        @else
          <p class="card-text">Diterima</p>
        @endif
      </div>
    </div> --}}


      {{-- <div class="row">
      <p class="col-sm-2">Tanggal ter daftar</p>
      <div class="col-sm-10">
        <p class="card-text">{{ $user->created_at }}</p>
      </div>
    </div> --}}
      <a href="{{ route('homeadmin') }}" class="btn btn-primary"> Back </a>
    </div>
  </div>
@endsection
