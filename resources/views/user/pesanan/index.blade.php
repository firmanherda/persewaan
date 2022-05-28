@extends('user.app')
@section('content')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Pesanan</h1>
  </div>
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
    </div>
    <div class="card-body">
      <table class="table" id="tablePesanan" width="100%">
        <thead>
          <tr>
            <th>ID Transaksi</th>
            <th>Nama</th>
            <th>Tanggal Sewa</th>
            <th>Batas Pengembalian</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pesananuser as $pu)
            <tr class="listpesananuser">
              <td> {{ $pu->id }}</td>
              <td>{{ $pu->user->nama }}</td>
              <td>{{ \Carbon\Carbon::parse($pu->tanggal_sewa)->format('d M Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($pu->tanggal_batas_kembali)->format('d M Y') }}</td>
              @if ($pu->status_pembayaran != 'Lunas')
                <td>{{ $pu->status_pembayaran }}</td>
              @endif
              @if ($pu->status_pengambilan_barang)
                <td>{{ $pu->status_pengambilan_barang }}</td>
              @endif
              <td>
                <br>
                <a href="{{ route('user.pesanan.show', $pu->id) }}"
                  class="btn btn-primary align-self-lg-start">Detail</a>
              </td>

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
<div id="modalPesananUser" class="modal fade" tabindex="-1">
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
      <div id="modalPesananUserContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('.listpesananuser #btnPesananUser').click(function() {
      const id = $(this).data('id');
      $('#modalPesananUser').modal('show');
      $('#modalPesananUserContent').html('');
      $('#modalLoading').show();
      $.get(`pesanan/${id}/edit`, function(res) {
        $('#modalLoading').hide();
        $('#modalPesananUserContent').html(res);
      });
    });
    $('.listpesananuser .btnPesananUser').click(function() {
      const id = $(this).data('id');
      $('#modalPesananUser').modal('show');
      $('#modalPesananUserContent').html('');
      $('#modalLoading').show();
      $.get(`pesanan/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalPesananUserContent').html(res);
      });
    });
    $('#tableBarangSedangDisewa').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'ID Transaksi',
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
          name: 'Status Pembayaran',
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
