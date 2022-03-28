{{-- @extends('admin.app')
@section('content') --}}
<form action="{{ route('admin.kriteria.store') }}" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
      <h5 class="modal-title">Tambah Barang</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
  </div>
  <div class="modal-body">
      @csrf
      <div class="form-group">
          <label class="control-label col-sm-2" for="nama">Nama Kriteria:</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" placeholder="Tulis Kriteria" name="nama">
          </div>
      </div>
      <br>
      {{-- <div class="form-group">
          <label class="control-label col-sm-2" for="kategori">Kategori :</label>
          <div class="col-sm-10">
              <select name="kategori" class="form-control" id="kategori">
                  @foreach ($kategoris as $ak)
                      <option value="{{ $ak->id }}"> {{ $ak->nama }}</option>
                  @endforeach
              </select>
          </div>
          <br>
      </div> --}}
      <div class="form-group">
          <label class="control-label col-sm-2" for="kode">Kode :</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="kode" placeholder="Tulis Kode" name="kode">
          </div>
      </div>
      <br>
      <div class="form-group">
          <label class="control-label col-sm-2" for="jenis">Jenis : </label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="jenis" placeholder="Tulis Jenis"
                  name="jenis">
          </div>
      </div>
      <br>


  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</form>
{{-- @endsection --}}
