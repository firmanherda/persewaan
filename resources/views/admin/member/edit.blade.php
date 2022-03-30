<form action="{{ route('admin.member.update', $member->id) }}" method="POST">
    <div class="modal-header">
      <h5 class="modal-title">Edit Member  </h5>
      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    {{-- echo tes; --}}
    <div class="modal-body">
      @method('PUT')
      @csrf
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Member</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{$member->nama }}">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" id="email" value="{{ $member->email }}">
      </div>
      <div class="mb-3">
        <label for="no_hp" class="form-label">No_Hp</label>
        <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $member->no_hp }}">
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $member->alamat }}">
      </div>

    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary text-white">Edit</button>
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    </div>
  </form>
