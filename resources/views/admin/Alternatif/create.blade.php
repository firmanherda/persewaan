<form action="{{ route('admin.alternatif.store') }}" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
      <h5 class="modal-title">Tambah Alternatif</h5>
  </div>
  <div class="modal-body">
      @csrf
      <div class="form-group">
          <label class="control-label col-sm-2" for="nama">Nama Alternatif:</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" placeholder="Tulis Alternatif" name="nama">
          </div>
      </div>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  </div>
</form>
