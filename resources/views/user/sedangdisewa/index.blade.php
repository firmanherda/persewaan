@extends('user.app')
@section('content')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Barang Sedang Disewa</h1>
  </div>
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Barang Sedang Disewa </h6>
    </div>
    <div class="card-body">


      <table class="table" id="tableBarangSedangDisewa" width="100%">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Tanggal Sewa</th>
            <th>Batas Pengembalian</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sd as $b)
            <tr class="listBarangSedangDisewa">
              <td>{{ $b->user->nama }}</td>
              <td>{{ $b->tanggal_sewa }}</td>
              <td>{{ $b->tanggal_batas_kembali }}</td>
              <td>{{ $b->status_transaksi }}</td>
              <td>
                <br>
                {{-- <a href="{{ route('barang.edit', ['barang' => $b->id]) }}"
                                    class="badge badge-success badge-sm">Edit</a>
                                <br> --}}
                <button id="btnEditBarangSedangDisewa" data-id="{{ $b->id }}"
                  class="btn btn-primary align-self-lg-start">Detail</button>
              </td>
              {{-- <a href="{{route('barang.show'), [barang=>$b->id]}}" class="badge badge-succes badge-sm">Detail</a> --}}

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <a href="{{ route('user.home') }}" class="btn btn-primary"> Back </a>
    </div>
  </div>
</div>
</div>
</div>
<div id="modalBarangSedangDisewa" class="modal fade" tabindex="-1">
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
      <div id="modalBarangSedangDisewaContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    // $('#btnTambahBarang').click(function() {
    //   $('#modalBarangSedangDisewa').modal('show');
    //   $('#modalBarangSedangDisewaContent').html('');
    //   $('#modalLoading').show();
    //   $.get(`barangSedangDisewa/create`, function(res) {
    //     $('#modalLoading').hide();
    //     $('#modalBarangContent').html(res);
    //   });
    // });
    $('.listBarangSedangDisewa #btnEditBarangSedangDisewa').click(function() {
      const id = $(this).data('id');
      $('#modalBarangSedangDisewa').modal('show');
      $('#modalBarangSedangDisewaContent').html('');
      $('#modalLoading').show();
      $.get(`barang/${id}/edit`, function(res) {
        $('#modalLoading').hide();
        $('#modalBarangSedangDisewaContent').html(res);
      });
    });
    $('.listBarangSedangDisewa .btnDetailBarangSedangDisewa').click(function() {
      const id = $(this).data('id');
      $('#modalBarangSedangDisewa').modal('show');
      $('#modalBarangSedangDisewaContent').html('');
      $('#modalLoading').show();
      $.get(`member/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalBarangSedangDisewaContent').html(res);
      });
    });
    $('#tableBarangSedangDisewa').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
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
          name: 'Status',
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
