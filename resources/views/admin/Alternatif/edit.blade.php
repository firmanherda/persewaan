<form action="{{ route('admin.alternatif.update', $alternatif->id) }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Alternatif   </h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  {{-- echo tes; --}}
  <div class="modal-body">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Alternatif</label>
      <input type="text" name="nama" class="form-control" id="nama" value="{{$alternatif->nama }}">
    </div>

  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Edit</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
