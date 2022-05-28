<form action="{{ route('admin.member.store') }}" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
      <h5 class="modal-title">Tambah Member</h5>
      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      @csrf
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" id="nama"required autocomplete="nama">
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email"required autocomplete="email">
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">No. HP</label>
        <input type="tel" name="no_hp" class="form-control" id="hp"required autocomplete="no_hp">
      </div>
      <div class="mb-3">
        <label for="text" class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" id="alamat"required autocomplete="alamat">
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password"required autocomplete="password">
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary text-white">Tambah</button>
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    </div>
  </form>
