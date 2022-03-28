@extends('admin.app')

@section('content')
<form action="{{route('admin.barangdisewa.update', $bsd->id)}}" method="POST">
@csrf
@method("PUT")
  <div class="card w-100 mt-4">
    <div class="card-header">
      <h2 class="card-title">Detail Pesanan</h2>
    </div>
    <div class="card-body container-fluid">
      <div class="container-fluid mx-auto h5">
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Id Transaksi: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->id }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Nama: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->user->nama }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Alamat: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->user->alamat }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">No HP: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->user->no_hp }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Tanggal Sewa : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->tanggal_sewa }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Tanggal Batas Kembali : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->tanggal_batas_kembali }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Terlambat : </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $bsd->tanggal_sewa }} Hari</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Total: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">@rupiah($bsd->total_harga)</div>
        </div>
      </div>

      <table class="table table-bordered w-100 mt-5">
        <thead>
          <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Kondisi Barang</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bsd->transaksiDetails as $b)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $b->barang->nama }}</td>
              <td>{{ $b->barang->harga }}</td>
              <td>
                <select name="status[]">
                  <option value="Baik" @if ($b->status == "Baik") selected @endif >Baik</option>
                  <option value="Hilang"@if ($b->status == "Hilang") selected @endif >Hilang</option>
                  <option value="Rusak"@if ($b->status == "Rusak") selected @endif >Rusak</option>
                </select>
              </td>
              <td>
                <input class="form-control" type="hidden" mine="0" name="id[]" value="{{$b->id}}">
                <input class="form-control" type="number" mine="0" name="denda[]" value="{{$b->denda?:0}}">
              </td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="d-inline-flex justify-content-between">
      @if ($bsd->status_transaksi == 'Belum Dikembalikan')

        <div><button class="btn btn-aksi btn-primary text-white" data-transaksi="{{ $bsd->id }}" type="submit">Konfirmasi</button>
            {{-- <a href="{{ route('admin.barangdisewa.show', $b->transaksi->id) }}" class="btn btn-primary align-self-lg-start">Detail</a> --}}
        </div>
      @endif
    </div>
  </div>
</form>
  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
  {{-- <x-dialog id="dialogEdit" title="Edit Transaksi Detail">
    <x-slot name="body">
      @include('components.dialog-loading')
    </x-slot>


  </x-dialog> --}}
@endsection

@push('scripts')

  <script>
    $(function() {
      // $('.btn-aksi').click(function() {
      //   const id = $(this).data('transaksi'); //data-transaksi
      //   $.ajax({
      //     type:"put",
      //     url:route('admin.barangdisewa.update'),
      //   });

      // }}
      $('.btn-edit').click(function() {
        const id = $(this).data('id');
        $('#dialogEdit').modal('show');

        loadTransaksiDetail(id);
      });
    });

    function loadTransaksiDetail(id) {
      $.get(route('admin.barangdisewa.edit', id), function(res) {
        $('#dialogBody').html(res);
      });
    }
  </script>
@endpush
