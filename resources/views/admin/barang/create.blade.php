{{-- @extends('admin.app')
@section('content') --}}
<form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Barang</h5>

    </div>
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <label class="control-label col-sm-2" for="nama">Nama barang :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" placeholder="Tulis nama barang" name="nama">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="kategori">Kategori :</label>
            <div class="col-sm-10">
                <select name="kategori" class="form-control" id="kategori">
                    @foreach ($kategoris as $ak)
                        <option value="{{ $ak->id }}"> {{ $ak->nama }}</option>
                    @endforeach
                </select>
            </div>
            <br>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="stok">Stok barang :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="stok" placeholder="Tulis stok barang" name="stok">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="harga">Harga Barang :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="harga" placeholder="Tulis harga barang per hari"
                    name="harga">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="deskripsi">Deskripsi Barang:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="deskripsi" placeholder="Tulis Deskripsi barang "
                    name="deskripsi">
            </div>
        </div>
        <br>

        <br>
        <div class="form-group">
            <b>File Gambar (jpg)</b><br />
            <input type="file" placeholder="t" name="file">
        </div>


    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    </div>
</form>
{{-- @endsection --}}
