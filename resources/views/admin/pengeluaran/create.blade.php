{{-- @extends('admin.app')
@section('content') --}}
<form action="{{ route('admin.pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
      <h5 class="modal-title">Tambah Pengeluaran</h5>

  </div>
  <div class="modal-body">
      @csrf
      <div class="form-group">
          <label class="control-label col-sm-2" for="nama">Nama : </label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" placeholder="Tulis Nama Pengeluaran" name="nama">
          </div>
      </div>
      <br>
      <br>
      <div class="form-group">
          <label class="control-label col-sm-2" for="harga">Total Harga :</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="total_harga" placeholder="Tulis Total Harga Pengeluaran"
                  name="total_harga">
          </div>
      </div>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
{{-- @endsection --}}
