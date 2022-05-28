@extends('user.app')
@section('content')
  <div class="card w-100">
    <div class="card-body">
      <h4 class="card-title">
        <p><strong>Profil {{ $user->nama }}&nbsp;</p> </strong>
      </h4>

      <br>
      <div class="row">
        <p class="col-sm-2">Id User</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $user->id }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Nama</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $user->nama }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Email</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $user->email }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Nomor Telepon</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $user->no_hp }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Alamat</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $user->alamat }}</p>
        </div>
      </div>

      <div class="row">
        <p class="col-sm-2">Status</p>
        <div class="col-sm-10">
          @if ($user->status == 'pending')
            <a class="card-text" href="{{ route('user.profil.verifikasi.create') }}">Belum di Verifikasi
            </a>
          @elseif($user->status == 'ditolak')
            <a class="card-text" href="{{ route('user.profil.verifikasi.create') }}">Verifikasi ditolak,
              Verifikasi lagi </a>
          @elseif($user->status == 'menunggu')
            <p class="card-text">: Menunggu Persetujuan Admin </p>
          @else
            <p class="card-text">: Diterima</p>
          @endif
        </div>
      </div>

      <div class="row">
        <p class="col-sm-2">Tanggal ter daftar</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i:s') }}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
