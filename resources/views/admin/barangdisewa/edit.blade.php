<form action="{{ route('admin.barangdisewa.update', $bsd->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3">

      {{-- <input type="text" name="nama" class="form-control" id="nama" value="{{$bsd->status }}"> --}}
      <select name="status">
        <option value="Baik" @if ($bsd->status == "Baik") selected @endif >Baik</option>
        <option value="Hilang"@if ($bsd->status == "Hilang") selected @endif >Hilang</option>
        <option value="Rusak"@if ($bsd->status == "Rusak") selected @endif >Rusak</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="denda" class="form-label">Denda</label>
      <input type="text" name="denda" class="form-control" id="denda" value="{{ $bsd->denda }}">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary text-white">Edit</button>
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
