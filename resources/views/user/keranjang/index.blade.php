@extends('user.app')
@section('content')
  <h2>Keranjang </h2>

  @error('status')
    <div class="alert alert-danger" role="alert">
      <div class="d-inline-flex align-items-center">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <span>{{ $message }}</span>
      </div>
    </div>
  @enderror

  @php
  if ($keranjang) {
      $tanggalSewa = \Carbon\Carbon::parse($keranjang->tanggal_sewa);
      $tanggalKembali = \Carbon\Carbon::parse($keranjang->tanggal_batas_kembali);
      $lamaSewa = $tanggalSewa->diffInDays($tanggalKembali);
  }
  @endphp

  <div class="bg-white p-4 rounded shadow">
    @if ($keranjang)
      <form action="{{ route('user.transaksi.store') }}" method="POST">
        @csrf
        <input type="date" name="tanggal_sewa" value="{{ $tanggalSewa }}" hidden>
        <input type="date" name="tanggal_batas_kembali" value="{{ $tanggalKembali }}" hidden>
        <p>Tanggal Sewa : {{ $tanggalSewa->format('d M Y') }}</p>
        <p>Tanggal Kembali : {{ $tanggalKembali->format('d M Y') }}</p>
        <p>Lama Sewa : {{ $lamaSewa }} Hari</p>
        <div class="d-flex justify-content-between align-middle">
          @foreach ($keranjang->keranjangDetails as $k)
            <div class="col-2">
              <img class="img-fluid" src="{{ asset("storage/img/{$k->barang->link_foto}") }}"
                alt="{{ $k->barang->nama }}">
            </div>
            <div class="my-auto @if (!$k->checkoutable) bg-danger @endif">
              <p>{{ $k->barang->nama }}</p>
              {{-- <input type="number" class="form-control" autocomplete="off" name="jumlah" min="1" id="jumlah"
                placeholder="Jumlah" value="{{ $k->jumlah }}"> --}}
              <p>Jumlah: {{ $k->jumlah }}</p>
              <p class="subtotal" data-subtotal="{{ $k->barang->harga * $k->jumlah * $lamaSewa }}">
                Subtotal: @rupiah($k->barang->harga * $k->jumlah * $lamaSewa)</p>

            </div>


          @endforeach

        </div>
        <button  class="btn btn-sm btn-danger" href="{{ route('user.keranjang.destroy', $keranjang->id) }}" onclick="event.preventDefault(); document.getElementById('delete').submit();">
          Delete
        </button>
        <div class="row">
          {{-- <a href="{{ route('user.keranjang.destroy', $keranjang->id) }}" onclick="event.preventDefault(); document.getElementById('delete').submit();">
            Delete
          </a> --}}

          <div class="col">
            <button type="submit" class="btn btn-primary text-white">{{ __('Checkout') }}</button>
          </div>
        </div>
      </form>
      <form id="delete" action="{{ route('user.keranjang.destroy', $keranjang->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE');
      </form>
    @else
      <p>KERANJANG KOSONG, SILAHKAN TAMBAH BARANG PADA HALAMAN UTAMA!</p>
    @endif
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
