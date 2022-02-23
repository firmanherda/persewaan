@extends('user.app')
@section('content')
  <h2 class="text-black mt-2">Detail Barang</h2>

  @if ($errors->any())
    <h4>{{ $errors->first() }}</h4>
  @endif

  <form action="{{ route('user.keranjang.store') }}" method="POST">
    @csrf
    <div class="card">
      <div class="card-body">
        <img class="mx-auto d-block mb-3" width="25%" src="{{ asset("storage/img/{$barang->link_foto}") }}">
        <div class="mx-2 mb-3">
          <div class="row">
            <dt class="col-4">Kategori</dt>
            <dd class="col-8">{{ $barang->kategori->nama }}</dd>
          </div>
        </div>
        <div class="mx-2 mb-3">
          <div class="row">
            <dt class="col-4">Nama</dt>
            <dd class="col-8">{{ $barang->nama }}</dd>
          </div>
        </div>
        <div class="mx-2 mb-3">
          <div class="row">
            <dt class="col-4">Stock</dt>
            <dd class="col-8">{{ $barang->stok }}</dd>
          </div>
        </div>
        <div class="mx-2 mb-3">
          <div class="row">
            <dt class="col-4">Harga</dt>
            <dd class="col-8">{{ $barang->harga }}</dd>
          </div>
        </div>

        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
          data-bs-target="#modalJumlah">{{ __('Masukkan Keranjang') }}</button>

        <div id="calendar"></div>
      </div>
    </div>

    <div id="modalJumlah" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukkan keranjang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="h5">Subtotal: <span id="subtotal">Rp {{ $barang->harga }}</span></p>
            <div class="d-inline-flex align-items-center">
              <input type="hidden" name="barang" value="{{ request()->barang }}">
              <div class="pe-2 flex-grow-1">
                <input type="number" class="form-control w-100" name="jumlah" min="1" max="{{ $barang->stok }}"
                  id="jumlah" placeholder="Jumlah" value="1">
              </div>
              <div class="ps-2">
                <button type="submit" class="btn btn-primary text-white">Masukkan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('scripts')
  <script>
    $(function() {
      var harga = {{ $barang->harga }};

      $('#jumlah').change(function() {
        var jumlah = $(this).val();
        var subtotal = $('#subtotal').text("Rp " + (jumlah * harga));
      })
    });

    $(document).on('DOMContentLoaded', function() {
      var calendar = new FullCalendar.Calendar($('#calendar'), {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,listWeek'
        }
      });
    })
  </script>
@endpush
