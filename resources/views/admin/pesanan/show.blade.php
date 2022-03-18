@extends('admin.app')

@section('content')
  <div class="card w-100 mt-4">
    <div class="card-header">
      <h2 class="card-title">Detail Pesanan</h2>
    </div>
    <div class="card-body container-fluid">
      <div class="container-fluid mx-auto h5">
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Nama: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $transaksi->user->nama }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Alamat: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $transaksi->user->alamat }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">No HP: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $transaksi->user->no_hp }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Total: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">@rupiah($transaksi->total_harga)</div>
        </div>
      </div>

      <table class="table table-bordered w-100 mt-5">
        <thead>
          <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Status</th>
            <th>Denda</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaksi->transaksiDetails as $td)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $td->barang->nama }}</td>
              <td>{{ $td->status ?: '-' }}</td>
              <td>{{ $td->denda ?: '-' }}</td>
              <td class="text-center">
                <button type="button" class="btn button-primary btn-link btn-edit" data-id="{{ $td->id }}">
                  <i class="fa fa-edit"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <x-dialog id="dialogEdit" title="Edit Transaksi Detail">
    <x-slot name="body">
      @include('components.dialog-loading')
    </x-slot>
    <x-slot name="footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </x-slot>
  </x-dialog>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('.btn-edit').click(function() {
        const id = $(this).data('id');
        $('#dialogEdit').modal('show');

        loadTransaksiDetail(id);
      });
    });

    function loadTransaksiDetail(id) {
      $.get(route('admin.pesanan.edit', id), function(res) {
        $('#dialogBody').html(JSON.stringify(res));
      });
    }
  </script>
@endpush
