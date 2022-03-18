@extends('admin.app')
@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Alternatif</h1>
        <button id="btnTambahAlternatif" class="d-sm-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-plus fa-sm text-white-50"></i>
          <span class="ms-1 text-white">Tambah Alternatif</span>
        </button>
      </div>
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table id ="tableAlternatif" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($alternatif as $a)
                        <tr class="listAlternatif">
                            <td>{{ $a->id }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>
                                <button class="btnDetailKriteria btn btn-sm btn-primary text-white"
                    data-id="{{ $a->id }}">Detail</button>
                    <button id="btnEditAlternatif" data-id="{{ $a->id }}"
                        class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                    </td>




                                {{-- <form action="{{route('member.destroy', $m->id)}}" method="POST">
                                    {{ method_field("DELETE")}}
                                    {{ csrf_field() }}
                                    <button type="submit" class="badge badge-primary badge-sm"> Hapus </button>
                                {{-- <a href="#" class="badge badge-primary badge-sm">Hapus</a> --}}
                                {{-- </form> --}}

                        </tr>
                    @endforeach
                    </tbody>

        </table>
    </div>
    <a href="{{ route('homeadmin') }}" class="btn btn-primary"> Back </a>
</div>
    </div>
</div>
</div>
</div>
<div id="modalKriteria" class="modal fade" tabindex="-1">
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
        <div id="modalAlternatifContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
        $('.listAlternatif #btnEditAlternatif').click(function() {
        const id = $(this).data('id');
        $('#modalAlternatif').modal('show');
        $('#modalAlternatifContent').html('');
        $('#modalLoading').show();
        $.get(`alternatif/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalAlternatifContent').html(res);
        });
      });
      $('#btnTambahAlternatif').click(function() {
        $('#modalAlternatif').modal('show');
        $('#modalAlternatifContent').html('');
        $('#modalLoading').show();
        $.get(`alternatif/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalAlternatifContent').html(res);
        });
      });

    $('.listAlternatif .btnDetailAlternatif').click(function() {
      const id = $(this).data('id');
      $('#modalAlternatif').modal('show');
      $('#modalAlternatifContent').html('');
      $('#modalLoading').show();
      $.get(`alternatif/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalAlternatifContent').html(res);
      });
    });
      $('#tableAlternatif').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'ID',
            orderable: true
          },
          {
            name: 'Nama',
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
