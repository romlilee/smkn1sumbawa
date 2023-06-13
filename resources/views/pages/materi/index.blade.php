@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            @if (auth()->user()->level == 'admin' || auth()->user()->level == 'guru')
                <h4>Data Materi Praktikum</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.kelas.tambahvideo') }}" class="btn btn-primary">
                        Tambah
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Judul Materi</th>
                                <th>Kelas</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (!empty($data))
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{$item->name_video}}</td>
                                <td>
                                    {{ $item->nama_kelas}}
                                </td>
                                <td>
                                    <a href="{{ route('admin.kelas.detail',Crypt::encrypt($item->id)) }}" class="btn btn-warning">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection