@extends('user.app')
@section('content')

    <div class="card w-100">
        <div class="card-body">
            <h4 class="card-title">
                <style>
                div.a {
                    text-align: right;
                }
            </style>
                <div class="a">

                    {{-- <p> NOT {{ Auth::user()->nama }} ? <a href="{{ route('homeuser') }}"> LOGOUT </a> </p> --}}
                    </div>

                <p><strong>Profil {{ Auth::user()->nama }}&nbsp;</p> </strong>
            </h4>

            <br>
            <div class="row">
                <p class="col-sm-2">Nama</p>
                <div class="col-sm-10">
                    <p class="card-text">{{ Auth::user()->nama }}</p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Email</p>
                <div class="col-sm-10">
                    <p class="card-text">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Nomor Telepon</p>
                <div class="col-sm-10">
                    <p class="card-text">{{ Auth::user()->no_hp }}</p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Alamat</p>
                <div class="col-sm-10">
                    <p class="card-text">{{ Auth::user()->alamat }}</p>
                </div>
            </div>


            <div class="row">
                <p class="col-sm-2">Status</p>
                <div class="col-sm-10">
                    {{-- facade --}}
                    @if (Auth::user()->status == 'pending')
                        <a class="card-text" href="{{ route('verifikasiprofiluser') }}">Belum di Verifikasi
                        </a>
                        {{-- helper --}}
                    @elseif(Auth::user()->status == 'ditolak')

                        <a class="card-text" href="{{ route('verifikasiprofiluser') }}">Verifikasi ditolak,
                            Verifikasi lagi </a>
                        @elseif(Auth::user()->status == 'menunggu')
                        <p class="card-text"> Menunggu Persetujuan Admin </p>
                    @else
                        <p class="card-text">Diterima</p>
                    @endif
                </div>
            </div>


            <div class="row">
                <p class="col-sm-2">Tanggal ter daftar</p>
                <div class="col-sm-10">
                    <p class="card-text">{{ Auth::user()->created_at }}</p>
                </div>
            </div>
            <a href="{{ route('homeuser') }}" class="btn btn-primary"> Back </a>
        </div>
    </div>
    </div>


@endsection
