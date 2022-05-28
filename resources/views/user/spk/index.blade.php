@extends('user.app')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">
        Bobot Kriteria
      </h4>
    </div>

    <form id="formHitung" class="card-body" action="{{ route('user.spk.hitung') }}" method="POST">
      @csrf
      <table class="table table-responsive">
        <p>Harap Memasukkan Nilai Bobot Total 100
        </p>
        <thead>
          <tr>
            @foreach ($kriterias as $kriteria)
              <th class="text-center">{{ $kriteria->nama }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($kriterias as $kriteria)
              <td>
                <input type="text" name="bobots[]" class="bobot form-control">
              </td>
            @endforeach
          </tr>
        </tbody>
      </table>

      <button class="btn button-primary" type="submit">Hitung</button>
    </form>
  </div>

  @if (isset($step1))
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="heading1">
          <h5 class="mb-0">
            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"
              aria-controls="collapse1">
              Matrix Keputusan
            </button>
          </h5>
        </div>

        <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-bs-parent="#accordion">
          <div class="card">
            <div class="card-body">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                      <th class="text-center">{{ $kriteria->nama }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($penilaians as $penilaian1)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $penilaian1[0]->alternatif->nama }}</td>
                      @foreach ($penilaian1 as $p1)
                        <td class="text-center">{{ $p1->nilai }}</td>
                      @endforeach
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" class="text-center">Total</td>
                    @foreach ($step1['totals'] as $total)
                      <td class="text-center">{{ $total->total }}</td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  @endif

  @if (isset($step2))
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
              aria-controls="collapseTwo">
              Normalisasi Matriks X
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
          <div class="card">
            <div class="card-body">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                      <th class="text-center">{{ $kriteria->nama }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($step2 as $penilaian2)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $penilaian2[0]->alternatif->nama }}</td>
                      @foreach ($penilaian2 as $p2)
                        <td class="text-center">{{ $p2->nilai }}</td>
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  @endif

  @if (isset($step3))
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true"
              aria-controls="collapse3">
              Matriks Keputusan Berbobot Yang Ternomalisasi
            </button>
          </h5>
        </div>
        <div id="collapse3" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
          <div class="card">
            <div class="card-body">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                      <th class="text-center">{{ $kriteria->nama }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($step3 as $penilaian3)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $penilaian3[0]->alternatif->nama }}</td>
                      @foreach ($penilaian3 as $p3)
                        <td class="text-center">{{ $p3->nilai }}</td>
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  @endif

  @if (isset($step4))
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true"
              aria-controls="collapse4">
              Menghitung nilai Max Mix
            </button>
          </h5>
        </div>
        <div id="collapse4" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
          <div class="card">
            <div class="card-body">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nilai Max</th>
                    <th>Nilai Min</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($step4 as $penilaian4)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $step1['penilaians'][$loop->iteration][0]->alternatif->nama }}</td>
                      <td>{{ $penilaian4['Benefit']['nilai_indeks'] }}</td>
                      <td>{{ $penilaian4['Cost']['nilai_indeks'] }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" class="text-center">Total</td>
                    <td></td>
                    <td>{{ $step4->sum('Cost.nilai_indeks') }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  @endif
  @if (isset($step5))

            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true"
                      aria-controls="collapse5">
                      Bobot relatif tiap Alternatif
                    </button>
                  </h5>
                </div>
                <div id="collapse5" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                  <div class="card">
                    <div class="card-body">
                      <table class="table table-responsive">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Alternatif</th>
                            <th>1/S<sub>-i</sub></th>
                            <th>S<sub>-i</sub> * Total 1/S<sub>-i</sub></th>
                            <th>Q<sub>i</sub></th>
                            <th>U<sub>i</sub></th>
                            <th>Hasil</th>
                          </tr>
                        </thead>
                        <tbody>
            @foreach ($step3 as $penilaian5)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penilaian5[0]->alternatif->nama }}</td>
                <td>{{ $step5['step51'][$loop->iteration]['Cost']['nilai'] }}</td>
                <td>{{ $step5['step52'][$loop->iteration]['nilai'] }}</td>
                <td>{{ $step5['step53'][$loop->iteration]['nilai'] }}</td>
                @if ($step5['step54'][$loop->iteration]['nilai'] == $max)
                  <td class="text-primary fw-bold">{{ $step5['step54'][$loop->iteration]['nilai'] }} (Max)</td>
                @else
                  <td>{{ $step5['step54'][$loop->iteration]['nilai'] }}</td>
                @endif
                <td>{{ $step5['step55'][$loop->iteration]['nilai'] }}%</td>
              </tr>
            @endforeach
            <tr>
              <td colspan="2" class="text-center">Total</td>
              <td>{{ $step5['step51']['sum_cost'] }}</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  @endif


@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#formHitung').submit(function(e) {
        e.preventDefault();

        var bobots = $("input[name='bobots[]'").map(function() {
          return parseInt($(this).val());
        }).get();

        var total = bobots.reduce((a, b) => (a + b), 0);

        if (total != 100) {
          alert('Nilai Total input Harus 100 & Kolom Tidak boleh kosong!');
        } else {
          $(this).unbind('submit').submit();
        }
      });
    });
  </script>
@endpush
