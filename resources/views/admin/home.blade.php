@extends('admin.app')
@section('content')
  <div class="row">
    <div class="card col-6">
      <div class="card-body">
        <div class="col-3 p-4">
          <p>MEMBER TERDAFTAR</p>
          <span class="h3 d-block font-weight-normal mb-2">{{ $users->count() }}</span>
        </div>
      </div>
    </div>
    <div class="card w-50">
      <div class="card-body">
        <div class="col-3 p-4">
          <p>BARANG YANG SEDANG DISEWA</p>
          <span class="h3 d-block font-weight-normal mb-2">{{ $sedangdisewa }}</span>
        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="card shadow mb-3">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Pemasukan </h6>
      </div>
      <div class="card-body">

        <table class="table" id="tablePengeluaran" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Member</th>
              <th>Tanggal Sewa</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pemasukans as $t)
              <tr class="listPengeluaran">
                <td>{{ $t->id }}</td>
                <td>{{ $t->user->nama }}</td>
                <td>{{ $t->created_at->format('d M Y') }}</td>
                <td>@rupiah($t->total_harga)</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>



    <div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block"></h1>
        <button id="btnTambahPengeluaran" class="d-sm-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-plus fa-sm text-white-50"></i>
          <span class="ms-1 text-white">Tambah Pengeluarans</span>
        </button>
      </div>
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> Pengeluaran </h6>
        </div>
        <div class="card-body">

          <table class="table" id="tablePengeluaran" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pengeluarans as $p)
                <tr class="listPengeluaran">
                  <td>{{ $p->id }}</td>
                  <td>{{ $p->nama }}</td>
                  <td>@rupiah($p->total_harga)</td>
                  <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y - H:i:s') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div id="modalPengeluaran" class="modal fade" tabindex="-1">
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
        <div id="modalPengeluaranContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#btnTambahPengeluaran').click(function() {
        $('#modalPengeluaran').modal('show');
        $('#modalPengeluaranContent').html('');
        $('#modalLoading').show();
        $.get(`pengeluaran/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalPengeluaranContent').html(res);
        });
      });
      $('#tablePengeluaran').DataTable({
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
            name: 'Total Harga',
            orderable: false
          },
          {
            name: 'Tanggal',
            orderable: true
          }
        ],
      });
    });
  </script>
@endpush
