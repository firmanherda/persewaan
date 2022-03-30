@extends('admin.app')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Member</h1>
      <button id="btnTambahMember" class="d-sm-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        <span class="ms-1 text-white">Tambah Member</span>
      </button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableMember" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($members as $m)
                <tr class="listMember">
                  <td>{{ $m->id }}</td>
                  <td>{{ $m->nama }}</td>
                  <td>{{ $m->email }}</td>
                  <td>{{ $m->status }}</td>>
                  <td>
                    <button class="btnDetailMember btn btn-sm btn-primary text-white"
                      data-id="{{ $m->id }}">Detail</button>
                    <button id="btnEditMember" data-id="{{ $m->id }}"
                      class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
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
  </div>
  <div id="modalMember" class="modal fade" tabindex="-1">
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
        <div id="modalMemberContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listMember #btnEditMember').click(function() {
        const id = $(this).data('id');
        $('#modalMember').modal('show');
        $('#modalMemberContent').html('');
        $('#modalLoading').show();
        $.get(`member/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });
      $('#btnTambahMember').click(function() {
        $('#modalMember').modal('show');
        $('#modalMemberContent').html('');
        $('#modalLoading').show();
        $.get(`member/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });

      $('.listMember .btnDetailMember').click(function() {
        const id = $(this).data('id');
        $('#modalMember').modal('show');
        $('#modalMemberContent').html('');
        $('#modalLoading').show();
        $.get(`member/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });
      $('#tableMember').DataTable({
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
            name: 'Email',
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
