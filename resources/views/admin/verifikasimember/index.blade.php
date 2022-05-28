@extends('admin.app')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Verifikasi Member</h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableVerifikasiMember" class="table table-striped">
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
                <tr class="listVerifikasiMember">
                  <td>{{ $m->user->id }}</td>
                  <td>{{ $m->user->nama }}</td>
                  <td>{{ $m->user->email }}</td>
                  <td>{{ $m->user->status }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btnDetailVerifikasiMember btn btn-sm btn-secondary text-white"
                      data-id="{{ $m->id }}">Detail</button>
                    <button class="btnAksi btn btn-sm btn-primary text-white mx-2" data-id="{{ $m->id }}"
                      data-aksi="diterima">Terima</button>
                    <button class="btnAksi btn btn-sm btn-danger text-white" data-id="{{ $m->id }}"
                      data-aksi="ditolak">Tolak</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <form id="formVerifikasi" action="{{ url('admin/verifikasimember/') }}" method="POST" hidden>
    @method('PATCH')
    @csrf
    <input id="formVerifikasiAksi" name="aksi" />
  </form>

  <div id="modalVerifikasiMember" class="modal fade" tabindex="-1">
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
        <div id="modalVerifikasiMemberContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listVerifikasiMember #btnEditVerifikasiMember').click(function() {
        const id = $(this).data('id');
        $('#modalVerifikasiMember').modal('show');
        $('#modalVerifikasiMemberContent').html('');
        $('#modalLoading').show();
        $.get(`verifikasimember/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });

      $('.listVerifikasiMember .btnDetailVerifikasiMember').click(function() {
        const id = $(this).data('id');
        $('#modalVerifikasiMember').modal('show');
        $('#modalVerifikasiMemberContent').html('');
        $('#modalLoading').show();
        $.get(`verifikasimember/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalVerifikasiMemberContent').html(res);
        });
      });

      $('.btnAksi').click(function() {
        const id = $(this).data('id');
        const aksi = $(this).data('aksi');
        const url = $('#formVerifikasi').attr('action') + `/${id}`;

        $('#formVerifikasi').attr('action', url);
        $('#formVerifikasiAksi').val(aksi);
        $('#formVerifikasi').submit();
      });

      $('#tableVerifikasiMember').DataTable({
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
