<div class="modal-header">
    <h5 class="modal-title">Detail Member</h5>
    {{-- <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button> --}}

  </div>
  <div class="modal-body">
    <h5></h5>
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
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">No HP</dt>
        <dd class="col-8">{{ $member->no_hp }}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Alamat</dt>
        <dd class="col-8">{{ $member->alamat }}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Tanggal Daftar</dt>
        <dd class="col-8">{{ \Carbon\Carbon::parse($member->created_at)->format('d M Y - H:i:s') }}</div></dd>
      </div>
    </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
