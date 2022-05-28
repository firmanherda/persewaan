@extends('admin.app')
@section('content')
{{-- @php
$tanggal_sewa = \Carbon\Carbon::parse($data->tanggal_sewa);
$tanggal_batas_kembali = \Carbon\Carbon::parse($data->tanggal_batas_kembali);
$lamaSewa = $tanggal_sewa->diffInDays($tanggal_batas_kembali);
@endphp --}}
  <div class="container-fluid">
    <p class="h3 my-4 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Pesanan Masuk</p>

    <form id="form-aksi" method="POST">
      @csrf
      @method('PUT')
      <input id="aksi" type="hidden" name="aksi">
      <input id="customer" type="hidden" name="customer">
      @forelse ($pesanans as $data)
        <div class="card w-100">
          <div class="card-body">
            <div class="row">
              <p class="col-sm-2">ID Transaksi</p>
              <div class="col-sm-10">
                <p class="card-text">{{ $data->id }}</p>
              </div>
            </div>
            <div class="row">
              <p class="col-sm-2">Tanggal Order</p>
              <div class="col-sm-10">
                <p class="card-text">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s') }}</p>
              </div>
            </div>
            <div class="row">
              <p class="col-sm-2">Total Harga</p>
              <div class="col-sm-10">
                <p class="card-text">{{ $data->total_harga }}</p>
              </div>
            </div>
            {{-- <div class="row">
              <p class="col-sm-2">Durasi Sewa/p>
              <div class="col-sm-10">
                <p class="card-text">{{$lamaSewa }} Hari</p>
              </div>
            </div> --}}
            <div class="row">
              <p class="col-sm-2">Tanggal Sewa</p>
              <div class="col-sm-10">
                <p class="card-text">{{ \Carbon\Carbon::parse($data->tanggal_sewa)->format('d M Y') }}</p>
              </div>
            </div>
            <div class="row">
              <p class="col-sm-2">Tanggal Batas Kembali</p>
              <div class="col-sm-10">
                <p class="card-text">{{ \Carbon\Carbon::parse($data->tanggal_batas_kembali)->format('d M Y') }}</p>
              </div>
            </div>
            <div class="row">
              <div class="d-inline-flex justify-content-between">
                @if ($data->status_pembayaran == 'Menunggu Pembayaran')
                  <div><button class="btn btn-aksi btn-primary text-white" data-transaksi="{{ $data->id }}"
                      data-aksi="Lunas" data-customer="{{ $data->user->id }}" type="submit">Konfirmasi</button>
                    <button class="btn btn-aksi btn-secondary text-dark" data-transaksi="{{ $data->id }}"
                      data-aksi="Ditolak" data-customer="{{ $data->user->id }}" type="submit">Tolak</button>
                    <a href="{{ route('admin.pesanan.show', $data->id) }}"
                      class="btn btn-primary align-self-lg-start">Detail</a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <hr>
      @empty
        kosong
      @endforelse
    </form>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('.btn-aksi').click(function(e) {
        e.preventDefault();
        const {
          transaksi,
          customer,
          aksi
        } = $(this).data();

        $('#aksi').val(aksi);
        $('#customer').val(customer);

        $('#form-aksi').prop('action', route('admin.pesanan.update', transaksi));
        $('#form-aksi').submit();
      });
    });
  </script>
@endpush
