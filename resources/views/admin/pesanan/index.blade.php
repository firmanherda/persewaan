@extends('admin.app')
@section('content')
  <form id="form-aksi" class="card w-100" method="POST">
    @csrf
    @method('PUT')
    <input id="aksi" type="hidden" name="aksi">
    <input id="customer" type="hidden" name="customer">
    <div class="card-body">
      <h4 class="card-title">
        {{-- <p><strong>Profil {{ $pesanans->user_id }}&nbsp;</p> </strong> --}}
      </h4>

      <br>
      {{-- <div class="row">
        <p class="col-sm-2">Nama</p>
        <div class="col-sm-10">
          <p class="card-text">{{ $pesanans->user_id }}</p>
        </div>
      </div> --}}
      @foreach ($pesanans as $data)
        <div class="row">
          <p class="col-sm-2">Tanggal Order</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->created_at }}</p>
          </div>
        </div>
        <div class="row">
          <p class="col-sm-2">Total Harga</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->total_harga }}</p>
          </div>
        </div>
        <div class="row">
          <p class="col-sm-2">Tanggal Sewa</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->tanggal_sewa }}</p>
          </div>
        </div>
        <div class="row">
          <p class="col-sm-2">Tanggal Batas Kembali</p>
          <div class="col-sm-10">
            <p class="card-text">{{ $data->tanggal_batas_kembali }}</p>
          </div>
        </div>
        <div class="row">
          <div class="d-inline-flex justify-content-between">
            @if ($data->status == 'Menunggu Pembayaran')
              <div><button class="btn btn-aksi btn-primary text-white" data-transaksi="{{ $data->id }}"
                  data-aksi="Berhasil" data-customer="{{ $data->user->id }}" type="submit">Konfirmasi</button>
                <button class="btn btn-aksi btn-secondary text-dark" data-transaksi="{{ $data->id }}"
                  data-aksi="Ditolak" data-customer="{{ $data->user->id }}" type="submit">Tolak</button>
              </div>
            @else
              <p>Transaksi {{ $data->status }}</p>
            @endif
            <a href="{{ route('admin.pesanan.show', $data->id) }}" class="btn btn-primary align-self-lg-start">Detail</a>
          </div>
        </div>
        <hr>
      @endforeach
      <a href="{{ route('homeadmin') }}" class="btn btn-primary"> Back </a>
  </form>
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
