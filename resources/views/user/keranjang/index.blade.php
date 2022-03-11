@extends('user.app')
@section('content')
  <h2>Barang user </h2>

  @error('status')
    <div class="alert alert-danger" role="alert">
      <div class="d-inline-flex align-items-center">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <span>{{ $message }}</span>
      </div>
    </div>
  @enderror

  <div class="bg-white p-4 rounded shadow">
    <div class="d-flex justify-content-between align-middle">
      @foreach ($keranjangs as $keranjang)
        <div class="col-2">
          <img class="img-fluid" src="{{ asset("storage/img/{$keranjang->barang->link_foto}") }}"
            alt="{{ $keranjang->barang->nama }}">
        </div>
        <div class="my-auto @if (!$keranjang->checkoutable) bg-danger @endif">
          <p>{{ $keranjang->barang->nama }}</p>
          <p>Jumlah: {{ $keranjang->jumlah }}</p>
          <p class="subtotal" data-subtotal="{{ $keranjang->barang->harga * $keranjang->jumlah }}">
            Subtotal: @rupiah($keranjang->barang->harga * $keranjang->jumlah)</p>
        </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
          data-bs-target="#modalCheckout">{{ __('Checkout') }}</button>
      </div>
    </div>

    <div id="modalCheckout" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukkan keranjang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('user.transaksi.store') }}" method="POST">
              @csrf
              <input type="date" name="tanggal_sewa">
              <input type="date" name="tanggal_batas_kembali">
              <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- @push('scripts')
  <script>
    $(function() {
      $('.subtotal').each(function() {
        var subtotal = $(this).data('subtotal');
      })
    });
  </script>
@endpush --}}
