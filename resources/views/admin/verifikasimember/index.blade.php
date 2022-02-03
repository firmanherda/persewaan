@extends('admin.app')
@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Member</h1>
        {{-- <button id="btnTambahMember" class="d-sm-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-plus fa-sm text-white-50"></i>
          <span class="ms-1 text-white">Tambah Member</span>
        </button> --}}
      </div>
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table id ="tableVerifikasiMember" class="table table-striped">
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
                            <td>{{ $m->id }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->email }}</td>
                            <td>{{$m->status}}</td>>
                            <td>
                                <button class="btnDetailVerifikasiMember btn btn-sm btn-primary text-white"
                    data-id="{{ $m->id }}">Detail</button>
                    {{-- <button id="btnEditVerifikasiMember" data-id="{{ $m->id }}"
                      class="btn btn-sm btn-secondary ms-1 text-white">Edit</button> --}}
                                {{-- <form action="{{route('member.destroy', $m->id)}}" method="POST">
                                    {{ method_field("DELETE")}}
                                    {{ csrf_field() }}
                                    <button type="submit" class="badge badge-primary badge-sm"> Hapus </button>
                                {{-- <a href="#" class="badge badge-primary badge-sm">Hapus</a> --}}
                                {{-- </form> --}}
                            </td>
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
    //   $('#btnTambahMember').click(function() {
    //     $('#modalMember').modal('show');
    //     $('#modalMemberContent').html('');
    //     $('#modalLoading').show();
    //     $.get(`member/create`, function(res) {
    //       $('#modalLoading').hide();
    //       $('#modalMemberContent').html(res);
    //     });
    //   });

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
