@extends('user.app')
@section('content')
  @if ($errors->any())
    <h4>{{ $errors->first() }}</h4>
  @endif

  <form class="mt-2" action="{{ route('user.keranjang.store') }}" method="POST">
    @csrf
    <div class="card">
      <div class="card-body p-4 p-md-5">
        <div class="d-inline-flex align-content-center text-black">
          <a class="my-auto me-2 text-black" href="{{ route('user.home') }}"><i class="fa fa-arrow-left"
              style="font-size: 1.5em;"></i></a>
          <span class="h2 fw-bold my-auto">Detail Barang</span>
        </div>
        <div class="row mt-4">
          <img class="col-12 col-md-6" width="100%" src="{{ asset("storage/img/{$barang->link_foto}") }}">
          <div class="col-12 col-md-6 ps-md-4 mt-4 mt-sm-0">
            <div class="d-flex flex-column justify-content-between h-100">
              <div class="row">
                <p class="text-black h3 fw-bold pb-2">{{ $barang->nama }}</p>
                <p class="text-black h2 fw-bold">@rupiah($barang->harga)</p>
                <p class="mt-4 mb-1 text-black fw-bold">Detail</p>
                <hr />
                <p>{{ $barang->deskripsi }}</p>
              </div>

              <div class="row">
                <p class="h6 px-0">Stok: <span>{{ $barang->stok }}</span></p>
                <div class="d-inline-flex align-content-center justify-content-between w-100 px-0">
                  <input type="hidden" class="d-none" name="barang" value="{{ request()->barang }}">
                  <div class="flex-grow-1 pe-4">
                    <input type="number" class="form-control w-100" autocomplete="off" name="jumlah" min="1"
                      max="{{ $barang->stok }}" id="jumlah" placeholder="Jumlah" value="1">
                  </div>
                  <p class="h5 my-auto">Subtotal: <span id="subtotal">@rupiah($barang->harga)</span>
                  </p>
                </div>

                <button type="submit" class="btn btn-primary text-white col-12 mt-4"
                  @if (auth()->user()->status != 'diterima') disabled @endif>{{ __('Masukkan Keranjang') }}
                </button>
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
        var subtotal = (jumlah * harga).toLocaleString('id-ID');

        $('#subtotal').text("Rp " + subtotal);
      });
    });

    $(document).on('DOMContentLoaded', () => {
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
