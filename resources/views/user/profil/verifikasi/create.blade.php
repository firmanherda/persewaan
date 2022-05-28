@extends('user.app')
@section('content')
  <form action="{{ route('user.profil.verifikasi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h3 class="text-gray mb-4" class="text-center">Verifikasi Member</h3>
    <div class="card" style="border-radius: 15px;">
      <div class="card-body">
        <div class="row align-items-center pt-4 pb-3">
          <div class="col-md-3 ps-5">
            <h6 class="mb-0">Nama Lengkap</h6>
          </div>
          <div class="col-md-9 pe-5">
            <input type="text" name="nama" class="form-control form-control-lg"
              placeholder="Nama Lengkap sesuai di Identitas" />
          </div>
        </div>
        <hr class="mx-n3">
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <h6 class="mb-0">Nomer Identitas</h6>
          </div>
          <div class="col-md-9 pe-5">
            <input type="text" name="nomer" class="form-control form-control-lg" placeholder="Nomer Identitas" />
          </div>
        </div>
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <h6 class="mb-0">Alamat Identitas</h6>
          </div>
          <div class="col-md-9 pe-5">
            <input type="text" name="alamat" class="form-control form-control-lg" placeholder="Alamat sesuai Identitas" />
          </div>
        </div>
        <hr class="mx-n3">
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <h6 class="mb-0">Tanggal Lahir</h6>
          </div>
          <div class="col-md-9 pe-5">
            <input type="date" name="tanggal" class="form-control form-control-lg"
              placeholder="Tanggal lahir sesuai Identitas" />
          </div>
        </div>
        <hr class="mx-n3">
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <h6 class="mb-0">Upload Foto Identitas</h6>
          </div>
          <div class="col-md-9 pe-5">
            <input class="form-control form-control-lg" name="foto" type="file" />
            <div class="small text-muted mt-2">Upload Foto Identitas. Max file size 50 MB</div>
          </div>
        </div>
        <hr class="mx-n3">
        <div class="px-5 py-4">
          <button type="submit" class="btn btn-primary btn-lg">VERIFIKASI</button>
        </div>
      </div>
    </div>
  </form>
@endsection
