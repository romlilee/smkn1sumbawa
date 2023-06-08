@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Materi Praktikum</h4>
                <div class="card-header-action">
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kelas.simpanvideo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Kelas</label>
                        <select class="form-control" data-toggle="select" name="kelas_id" required>
                            <option selected hidden>Pilih Kelas</option>
                            @foreach ($kelas as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Judul Video</label>
                        <input type="text" name="name_video" class="form-control @error('name_video') is-invalid @enderror" value="{{ old('name_video') }}">
                        @error('name_video')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Kode embed Video Youtube</label>
                        <input type="text" name="url_video" class="form-control @error('url_video') is-invalid @enderror" value="{{ old('url_video') }}">
                        @error('url_video')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Simpan Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection