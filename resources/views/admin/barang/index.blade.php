@extends('admin.app')
@section('content')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Barang</h1>
    <button id="btnTambahBarang" class="d-sm-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i>
      <span class="ms-1 text-white">Tambah Barang</span>
    </button>
  </div>
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Barang Persewaan </h6>
    </div>
    <div class="card-body">

      <table class="table" id="tableBarang" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Foto</th>
            <th>Kategori</th>
            <th>Harga per hari</th>
            <th>Stock</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barangs as $b)
            <tr class="listBarang">
              <td>{{ $b->id }}</td>
              <td>{{ $b->nama }}</td>
              <td><img height="100" src="{{ asset("storage/img/{$b->link_foto}") }}"></td>
              <td>{{ $b->kategori->nama }}</td>
              <td>@rupiah($b->harga)</td>
              <td>{{ $b->stok }}</td>
              <td>
                <div class="d-inline-flex justify-content-center align-items-center w-100">
                  <button id="btnEditBarang" data-id="{{ $b->id }}"
                    class="btn btn-sm btn-secondary text-white">Edit</button>
                  <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger ms-2 text-white"> Hapus </button>
                  </form>
                </div>
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
<div id="modalBarang" class="modal fade" tabindex="-1">
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
      <div id="modalBarangContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#btnTambahBarang').click(function() {
      $('#modalBarang').modal('show');
      $('#modalBarangContent').html('');
      $('#modalLoading').show();
      $.get(`barang/create`, function(res) {
        $('#modalLoading').hide();
        $('#modalBarangContent').html(res);
      });
    });
    $('.listBarang #btnEditBarang').click(function() {
      const id = $(this).data('id');
      $('#modalBarang').modal('show');
      $('#modalBarangContent').html('');
      $('#modalLoading').show();
      $.get(`barang/${id}/edit`, function(res) {
        $('#modalLoading').hide();
        $('#modalBarangContent').html(res);
      });
    });
    $('#tableBarang').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'No',
          orderable: true
        },
        {
          name: 'Nama Barang',
          orderable: true
        },
        {
          name: 'Foto',
          orderable: false
        },
        {
          name: 'Kategori',
          orderable: true
        },
        {
          name: 'Harga per hari',
          type: 'html-num',
          orderable: true
        },
        {
          name: 'Stock',
          orderable: true
        },
        {
          name: '',
          orderable: false
        }
      ],
    });
  });
</script>
@endpush
