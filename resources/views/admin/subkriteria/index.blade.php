@extends('admin.app')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Sub Kriteria</h1>

    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          @foreach ($subkriteria as $m)
          <p>{{$m->nama}}</p>
          <button  class="btnTambahKriteria d-sm-block btn btn-sm btn-primary shadow-sm" data-kriteria="{{$m->id}}">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            <span class="ms-1 text-white">Tambah Sub Kriteria </span>
          </button>
          <table id="tableKriteria-{{$m->id}}" class="table table-striped">
            <thead>
              <tr>
                <th>No </th>
                <th>Nama </th>
                <th>Nilai </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $m->subKriterias as $sk)
                <tr class="listKriteria">
                  <td>{{ $sk->id }}</td>
                  <td>{{ $sk->nama }}</td>
                  <td>{{ $sk->nilai }}</td>
                  <td>
                    <button data-id="{{ $sk->id }}"
                      class="btnEditKriteria btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <div id="modalKriteria" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        {{-- Content --}}
        <div id="modalKriteriaContent">
          <form action="{{ route('admin.subkriteria.store') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub Kriteria</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @csrf
                <input type="hidden" name="kriteria_id" value="" id="kriteriaid">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nama">Nama Sub Kriteria :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" placeholder="Tulis nama Sub Kriteria" name="nama">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="stok">Nilai :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nilai" placeholder="Tulis Nilai" name="nilai">
                    </div>
                </div>
                <br>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <div id="modalEditKriteria" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        {{-- Content --}}
        <div id="modalKriteriaContent">
          <form action="{{ route('admin.subkriteria.store') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Kriteria</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @csrf
                <input type="hidden" name="kriteria_id" value="" id="kriteriaid">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nama">Nama Sub Kriteria :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" placeholder="Tulis nama Sub Kriteria" name="nama">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="stok">Nilai :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nilai" placeholder="Tulis Nilai" name="nilai">
                    </div>
                </div>
                <br>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  {{-- @extends('admin.app')
@section('content') --}}

{{-- @endsection --}}

@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listKriteria .btnEditKriteria').click(function() {
        const id = $(this).data('id');
        $('#modalEditKriteria').modal('show');
        $('#kriteriaid').val(id);
      });
      $('.btnTambahKriteria').click(function() {
        var kriteria = $(this).data('kriteria');
        $('#modalKriteria').modal('show');
        $('#kriteriaid').val(kriteria);
      });

      $('.listKriteria .btnDetailKriteria').click(function() {
        const id = $(this).data('id');
        $('#modalKriteria').modal('show');
        $('#modalKriteriaContent').html('');
        $('#modalLoading').show();
        $.get(`kriteria/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalKriteriaContent').html(res);
        });
      });
      $('#tableKriteria').DataTable({
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
            name: 'Nilai',
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
