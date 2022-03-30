@extends('admin.app')
@section('content')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Riwayat Transaksi</h1>
  </div>
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>
    </div>
    <div class="card-body">
      <table class="table" id="tableRiwayatTransaksi" width="100%">
        <thead>
          <tr>
            <th>Id Transaksi</th>
            <th>Nama</th>
            <th>Tanggal Sewa</th>
            <th>Tanggal Kembali</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($riwayats as $r)
            <tr class="listRiwayatTransaksi">
              <td> {{ $r->id }}</td>
              <td>{{ $r->user->nama }}</td>
              <td>{{ $r->tanggal_sewa }}</td>
              <td>{{ $r->tanggal_batas_kembali }}</td>
              <td>
                <br>
                <a href="{{ route('admin.riwayattransaksi.show', $r->id) }}"
                  class="text-center btn btn-primary align-self-lg-start text-center">Detail</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
<div id="modalRiwayatTransaksi" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      {{-- Loading --}}
      <div id="modalLoading" class="row h-100 align-items-center">
        <div class="col align-self-center">
          <div class="d-flex my-5 justify-content-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Memuat...</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Content --}}
      <div id="modalRiwayatTransaksiContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {

    $('.listRiwayatTransaksi .btnDetailRiwayatTransaksi').click(function() {
      const id = $(this).data('id');
      $('#modalRiwayatTransaksi').modal('show');
      $('#modalRiwayatTransaksiContent').html('');
      $('#modalLoading').show();
      $.get(`member/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalRiwayatTransaksiContent').html(res);
      });
    });
    $('#tableRiwayatTransaksi').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'No',
          orderable: true
        },
        {
          name: 'Nama',
          orderable: true
        },
        {
          name: 'Tanggal Sewa',
          orderable: false
        },
        {
          name: 'Batas Pengembalian',
          orderable: true
        },
        {
          name: '',
          orderable: false
        }
      ]
    });

  });
</script>
@endpush
