@extends('layout.app-ujian')

@section('title', 'Quiz | SMKN 1 Sumbbawa')

@section('content')
<!-- Style untuk timer-->
<style>
    h1{
        color: #001e81;
        font-weight: 100;
        font-size: 40px;
        margin: 40px 0px 20px;
    }

    #clockdiv{
        font-family: sans-serif;
        color: #fff;
        display: inline-block;
        font-weight: 100;
        text-align: center;
        font-size: 25px;
    }

    #clockdiv > div{
        padding: 10px;
        border-radius: 3px;
        background: #00d9ff;
        display: inline-block;
    }

    #clockdiv div > span{
        padding: 15px;
        border-radius: 3px;
        background: #001e81;
        display: inline-block;
    }

    .smalltext{
        padding-top: 5px;
        font-size: 16px;
        color: black;
    }
    
</style>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Ujian</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
              <li class="breadcrumb-item" aria-current="page">Mulai Ujian</li>
              <li class="breadcrumb-item active" aria-current="page">{{ $mapel->nama_mapel }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <div class="row">
            <div class="col-sm-4"><h3 class="mb-0">Nama Mata Pelajaran: {{ $mapel->nama_mapel }}</h3></div>
            <div class="col-sm-4"><h3 class="text-center">Jumlah Soal: {{$soal1}}</h3></div>
            <div class="col-sm-4"><h3 class="text-right">Waktu Ujian: {{ $selisi->selisih_menit }} Menit</h3></div>
          </div>


        </div>
        <!-- Pemanggilan timer -->
        <div class="row mb-3" id="clockdiv" data-end-time="{{ $selisi->selisih_menit }}">
            <h1 class="text-center">Ujian akan berakhir pada:</h1>
            <div>
                <span class="hours"></span>
                <div class="smalltext">Jam</div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="smalltext">Menit</div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="smalltext">Detik</div>
            </div>
        </div>
        <div class="card-body">
            <form action="/kirim-jawaban" method="POST">
                @csrf
                <input type="hidden" name="id_mapel" value="{{$mapel->id}}" readonly>
                @foreach ($soal as $key => $value)
                <input type="hidden" name="id_soal{{$key+1}}" value="{{$value->id}}">
                <input type="hidden" name="jawaban{{$key+1}}" value="0">
                <div class="card mt-5">
                    <div class="card-header">
                        Pertanyaan {{$key+1}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            {!! $value->nama_soal !!}
                        </h5>
                        @foreach ($value->opsi as $op)
                        <li class="ml-5">
                            <input type="radio" name="jawaban{{$key+1}}" value="{{$op->nama_opsi}}">
                            {{$op->nama_opsi}}
                        </li>
                        @endforeach
                        <input type="hidden" name="index" value="<?php echo $key+1 ?>">
                        <input type="hidden" name="id_soal" value="{{ $value->id }}">
                    </div>
                </div>
                @endforeach
                <div class="modal-footer">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Selesai</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-script')
<script type="text/javascript">
   // Fitur timer (hasil copas awkwkkwk)
  function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  
  return {
    total,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    const t = getTimeRemaining(endtime);

    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}

const endTime = new Date(parseInt(document.getElementById('clockdiv').getAttribute('data-end-time')));
const deadline = new Date(Date.parse(new Date()) + endTime.getTime() * 60 * 1000);
initializeClock('clockdiv', deadline);

// halaman akan tersubmit otomatis pada 1 jam 30 menit kedepan
window.setTimeout(function() {
        document.getElementById("submit").click();
    }, 5400000);

</script>
@endpush