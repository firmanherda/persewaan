<form action="{{ route('admin.barang.update', $barang->id) }}" method="POST">
    <div class="modal-header">
      <h5 class="modal-title">Edit Barang   </h5>
      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    {{-- echo tes; --}}
    <div class="modal-body">
      @method('PUT')
      @csrf
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Barang</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{$barang->nama }}">
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $barang->deskripsi }}">
      </div>
      <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="text" name="stok" class="form-control" id="stok" value="{{ $barang->stok }}">
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" name="harga" class="form-control" id="harga" value="{{ $barang->harga }}">
      </div>

    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary text-white">Edit</button>
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    </div>
  </form>
