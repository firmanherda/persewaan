@extends('admin.app')
@section('content')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
{{-- <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Daftar Barang</h1>
        {{-- <button type="button" class="mt-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Barang</button> --}}
{{-- <a href="{{ route('barang.create') }}" class="btn btn-primary"> Tambah Barang </a> --}}

{{-- </div> --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
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
                            <td><img height="100" src="{{ asset($b->link_foto) }}"></td>
                            <td>{{ $b->kategori->nama }}</td>
                            <td>{{ number_format($b->harga, 0, '.', '.') }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>
                                <br>
                                {{-- <a href="{{ route('barang.edit', ['barang' => $b->id]) }}"
                                    class="badge badge-success badge-sm">Edit</a>
                                <br> --}}
                                <button id="btnEditBarang" data-id="{{ $b->id }}"
                                    class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                                    <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="badge badge-primary badge-sm"> Hapus </button>
                                        {{-- <a href="#" class="badge badge-primary badge-sm">Hapus</a> --}}
                                    </form>
                                </td>
                                {{-- <a href="{{route('barang.show'), [barang=>$b->id]}}" class="badge badge-succes badge-sm">Detail</a> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('homeadmin') }}" class="btn btn-primary"> Back </a>
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
            ]
        });

    });
</script>
@endpush
