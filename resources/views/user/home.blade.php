@extends('user.app')
@section('content')
@php
    if (request()->tanggal_sewa && request()->tanggal_batas_kembali){
      $tanggal_sewa = \Carbon\Carbon::parse(request()->tanggal_sewa);
      $tanggal_batas_kembali = \Carbon\Carbon::parse(request()->tanggal_batas_kembali);
    }
@endphp
  <h2 class="text-black mt-2">Selamat Datang</h2>

  @error('status')
    <div class="alert alert-danger" role="alert">
      <div class="d-inline-flex align-items-center">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <span>{{ $message }}</span>
      </div>
    </div>
  @enderror

  <form action="{{ route('user.home') }}" method="GET">
    <input type="date" id="ts" name="tanggal_sewa" value="{{ request()->tanggal_sewa }}"
      min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
    <input type="date" id="tbk" name="tanggal_batas_kembali" value="{{ request()->tanggal_batas_kembali }}"
      min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
    <button type="submit">Cari</button>
    <br>

  </form>
  <h5>Tanggal Sewa : {{ \Carbon\Carbon::parse(request()->tanggal_sewa)->format('d M Y')}} </h5>
  <h5>Tanggal Batas Kembali :{{ \Carbon\Carbon::parse(request()->tanggal_batas_kembali)->format('d M Y')}}</h5>

  @if (request()->tanggal_sewa && request()->tanggal_batas_kembali)
  @if ($tanggal_sewa->lessThan($tanggal_batas_kembali))


  <div class="row row-cols-2 row-cols-md-4">


    @foreach ($barangs as $b)
      @if ($b->stok)
        <div class="col px-2">
          <div id="barang-{{ $b->id }}" data-barang="{{ $b }}" class="card">
            <div class="card-body">
              <img class="mx-auto d-block mb-3" width="100%" src="{{ asset("storage/img/{$b->link_foto}") }}">
              <a class="h4 text-decoration-none fw-bold" href="{{ route('user.barang.show', $b->id) }}"
                class="card-title">{{ $b->nama }} </a>
              <p class="card-text"> @rupiah($b->harga) / Hari</p>
            </div>
            <div class="card-footer">
              <div class="d-inline-flex justify-content-between align-items-center w-100">
                <p class="mb-0">Sisa {{ $b->stok }} barang tersisa</p>
                <button data-bs-toggle="modal" data-bs-target="#modalKeranjang" data-id="{{ $b->id }}"
                  class="btn btn-primary btn-keranjang text-white">Tambah Keranjang</button>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  </div>
  @endif
  @endif
  <div id="modalKeranjang" class="modal fade" data-barang="" tabindex="-1">
    <form class="modal-dialog" action="{{ route('user.keranjang.store') }}" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="foto" class="mx-auto d-block mb-3" width="100%">
          <p id="nama" class="h4 text-decoration-none fw-bold card-title"></p>
          <p id="harga" class="card-text"></p>
          <p id="stok" class="card-text"></p>
          <div class="d-inline-flex mt-4 align-content-center justify-content-between w-100">
            <div class="pe-4">
              <input type="number" class="form-control" autocomplete="off" name="jumlah" min="1" id="jumlah"
                placeholder="Jumlah" value="1">
            </div>
            <p class="h5 my-auto flex-grow-1">Subtotal: <span id="subtotal"></span> <span id="lamaSewa"></span>
            </p>
          </div>

          @csrf
          <input id="barang" type="hidden" class="d-none" name="barang">
          <input id="st" type="hidden" class="d-none" name="subtotal">
          <input id="tanggal_sewa" type="hidden" class="d-none" name="tanggal_sewa">
          <input id="tanggal_batas_kembali" type="hidden" class="d-none" name="tanggal_batas_kembali">

        </div>
        <div class="row">
          <div class="col">
            @if (auth()->user()->status == 'diterima')
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            @else
              <div class="modal-footer">
                <p style="color:red">*Verifikasi Akun Terlebih Dahulu Pada Halaman Profil !</p>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" disabled> Tambah</button>
              </div>
            @endif
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      var barangs = @json($barangs);
      var keranjang = @json($keranjang);
      var tanggalSewa = new Date($('#ts').val());
      var tanggalKembali = new Date($('#tbk').val());
      var bedaTanggal = Math.abs(tanggalKembali - tanggalSewa);
      var lamaSewa = Math.ceil(bedaTanggal / (1000 * 60 * 60 * 24));
      var modal = $('#modalKeranjang');

      $('.btn-keranjang').each(function(i, v) {
        $(v).click(function() {
          var id = $(this).data('id');
          var barang = $(`#barang-${id}`).data('barang');
          modal.data('barang', barang);
        });
      });

      modal.on('shown.bs.modal', function() {
        var barang = $(this).data('barang');
        var subtotal = (barang.harga * lamaSewa).toLocaleString('id-ID');


        $('#barang').val(barang.id);
        $('#st').val(barang.harga * lamaSewa);
        $('#tanggal_sewa').val($('#ts').val());
        $('#tanggal_batas_kembali').val($('#tbk').val());
        $('#lamaSewa').text(`(Lama sewa ${lamaSewa} hari)`);

        $('#subtotal').text("Rp " + subtotal);

        $('#foto').prop('src', `/storage/img/${barang.link_foto}`);
        $('#nama').text(barang.nama);
        $('#harga').text(`Rp ${(barang.harga).toLocaleString('id-ID')} / hari`);
        $('#stok').text(`Sisa ${barang.stok} barang tersisa`);

        $('#jumlah').prop('max', barang.stok);
        $('#jumlah').change(function() {
          var jumlah = $(this).val();
          var subtotal = (jumlah * barang.harga * lamaSewa).toLocaleString('id-ID');
          $('#st').val(jumlah * barang.harga * lamaSewa);

          $('#subtotal').text("Rp " + subtotal);
        });
      });

      modal.on('hidden.bs.modal', function() {
        $('#subtotal').text("");
        $('#jumlah').prop('value', 1);
        $('#jumlah').unbind();
      });

      $('#form-checkout').on('submit', function(e) {
        e.preventDefault();

        var checkoutable = true;

        barangs.forEach(function(barang) {
          keranjang.keranjangDetails.forEach(function(keranjang) {
            if (keranjang.barang_id == barang.id && keranjang.jumlah > barang.stok) {
              checkoutable = false
            }
          })
        });

        if (checkoutable) {
          $(this).unbind();
          $(this).submit();
        }
      });
    });
  </script>
@endpush
