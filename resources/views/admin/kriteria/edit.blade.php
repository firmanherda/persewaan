<form action="{{ route('admin.kriteria.update', $kriteria->id) }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Kriteria   </h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  {{-- echo tes; --}}
  <div class="modal-body">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Kriteria</label>
      <input type="text" name="nama" class="form-control" id="nama" value="{{$kriteria->nama }}">
    </div>
    <div class="mb-3">
      <label for="kode" class="form-label">Kode</label>
      <input type="text" name="kode" class="form-control" id="kode" value="{{ $kriteria->kode }}">
    </div>
    <div class="mb-3">
      <label for="jenis" class="form-label">Jenis</label>
      <input type="text" name="jenis" class="form-control" id="jenis" value="{{ $kriteria->jenis }}">
    </div>

  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Edit</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
