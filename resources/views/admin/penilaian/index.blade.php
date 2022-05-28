@extends('admin.app')
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Penilaian</h1>
    {{-- <button id="btnTambahAlternatif" class="d-sm-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i>
      <span class="ms-1 text-white">Tambah Alternatif</span>
    </button> --}}
  </div>
  <div class="card shadow mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table id="tableAlternatif" class="table table-striped">
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
                  <button data-id="{{ $a->id }}"
                    class="btnEditAlternatif btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="modalAlternatif" class="modal fade" tabindex="-1">
    <div id="modalAlternatifContent" class="modal-dialog">

    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listAlternatif .btnEditAlternatif').click(function() {
        const id = $(this).data('id');

        $.get(route('admin.penilaian.edit', id), function(data) {
          $('#modalAlternatifContent').html(data);
          $('#modalAlternatif').modal('show');
        });
      });

      $('#btnTambahAlternatif').click(function() {
        $('#modalAlternatif').modal('show');
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
