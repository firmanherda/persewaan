<div class="modal-header">
    <h5 class="modal-title">Detail Verifikasi Member</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

  </div>
  <div class="modal-body">
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
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
  </div>
