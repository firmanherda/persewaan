@extends('user.app')
@section('content')
  <h2>Barang user </h2>

  <div class="bg-white p-4 rounded shadow">
    <div class="d-flex justify-content-between align-middle">
      @foreach ($keranjangs as $keranjang)
        <div class="col-2">
          <img class="img-fluid" src="{{ asset("storage/img/{$keranjang->barang->link_foto}") }}"
            alt="{{ $keranjang->barang->nama }}">
        </div>
        <div class="my-auto">
          <p>{{ $keranjang->barang->nama }}</p>
          <p class="subtotal" data-subtotal="{{ $keranjang->barang->harga * $keranjang->jumlah }}">
            @rupiah($keranjang->barang->harga * $keranjang->jumlah)</p>
        </div>
      @endforeach
    </div>

    <div class="row">
      <div class="col"></div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('.subtotal').each(function() {
        var subtotal = $(this).data('subtotal');
        console.log(subtotal);
      })
    });
  </script>
@endpush
