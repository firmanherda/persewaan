<form action="{{ route('admin.penilaian.update', $alternatif->id) }}" id="formEditAlternatif" class="modal-content"
  method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Alternatif</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body">
    @method('PUT')
    @csrf

    @foreach ($alternatif->penilaians as $i => $p)
      <input type="hidden" name="kriterias[]" value="{{ $p->kriteria->id }}">
      <div class="form-group">
        <label for="{{ $p->kriteria->nama }}" class="fw-bold">{{ $p->kriteria->nama }}</label>
        {{-- {{ $p->kriteria->subKriterias }} --}}
        <select class="form-select" name="subkriterias[]">
          @foreach ($p->kriteria->subKriterias as $j => $sk)
            @if ($sk->nilai == $alternatif->penilaians[$i]['nilai'])
              <option value="{{ $sk->nilai }}" selected>{{ $sk->nama }}</option>
            @else
              <option value="{{ $sk->nilai }}">{{ $sk->nama }}</option>
            @endif
            {{-- <option value="{{ $sk->nilai }}">{{ $sk->nama }}</option> --}}
          @endforeach
        </select>
      </div>
    @endforeach
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-primary text-white">Edit</button>
  </div>
</form>
