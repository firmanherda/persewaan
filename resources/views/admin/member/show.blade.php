<div class="modal-header">
    <h5 class="modal-title">Detail Member</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

  </div>
  <div class="modal-body">
    <h5>Profil</h5>

    {{-- <img class="mx-auto d-block mb-3" width="50%" src="{{asset('storage/drrose.JPG')}}"> --}}
    {{-- <img src="{{asset('storage/Capture.JPG')}}" width="50px" class="img-fluid"> --}}

    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Nama</dt>
        <dd class="col-8">{{ $member->nama }}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Email</dt>
        <dd class="col-8">{{ $member->email }}</dd>
      </div>
    </div>

    {{-- <div class="mx-2">
      <h5>Servis</h5>
      <div class="row">
        <dt class="col-4">Service</dt>
        <ul class="col-8">
          @foreach ($dokter->service as $service)
            <li class="badge bg-primary">{{ $service->nama }}</li>
          @endforeach
        </ul>
      </div> --}}
    {{-- </div> --}}

    {{-- <div class="mx-2">
      <h5>Deskripsi</h5>
      <p>{{ $dokter->deskripsi }}</p>
    </div>
  </div> --}}
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
  </div>
