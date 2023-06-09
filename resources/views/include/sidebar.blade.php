<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a href="/">
        <img src="{{ asset('/assets/img/logo-kecil-text_revisi-min.png') }}" style="width:74%;height:64%;margin-left:10%;">
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          @if (auth()->user()->level == 'admin')
          <li class="nav-item">
            <a class="nav-link {{Request::is('/home') ? 'active' : ''}}" href="/home">
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
              <i class="fas fa-university"></i>
              <span class="nav-link-text">Data Materi</span>
            </a>
            <div class="collapse" id="navbar-forms">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="/matapelajaran" class="nav-link">Mata Pelajaran</a>
                </li>
                <li class="{{Request::path() == 'admin/kelas' ? 'active' : '' }}">
                  <a href="{{ route('admin.kelas') }}" class="nav-link">Materi Praktikum</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.blog') }}" class="nav-link">Materi Teori</a>
                </li>
              </ul>
            </div>
          </li>
          <!-- <li class="{{Request::path() == 'admin/blog' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kelas') }}">
              <i class="fas fa-university"></i><span>materi</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link {{Request::is('guru') ? 'active' : ''}}" href="/guru">
              <i class="fas fa-user-tie text-red"></i>
              <span class="nav-link-text">Guru</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('kelas') ? 'active' : ''}}" href="/kelas">
              <i class="fas fa-school text-blue"></i>
              <span class="nav-link-text">Kelas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('siswa') ? 'active' : ''}}" href="/siswa">
              <i class="fas fa-users text-yellow"></i>
              <span class="nav-link-text">Siswa</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
              <i class="ni ni-single-copy-04 text-pink"></i>
              <span class="nav-link-text">Data Quiz</span>
            </a>
            <div class="collapse" id="navbar-forms">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="/soal" class="nav-link">Soal</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('jadwal') ? 'active' : ''}}" href="/jadwal">
              <i class="fas fa-calendar-alt text-primary"></i>
              <span class="nav-link-text">Jadwal Quiz</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('Quiz') ? 'active' : ''}}" href="/Quiz">
              <i class="far fa-file-alt text-success"></i>
              <span class="nav-link-text">Quiz</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('petugas') ? 'active' : ''}}" href="/petugas">
              <i class="fas fa-users-cog"></i>
              <span class="nav-link-text">Petugas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('nilai-siswa') ? 'active' : ''}}" href="/nilai-siswa">
              <i class="fas fa-archive text-primary"></i>
              <span class="nav-link-text">Daftar Nilai</span>
            </a>
          </li>

          @elseif (auth()->user()->level == 'guru')
          <li class="nav-item">
            <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="/">
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
              <i class="fas fa-university"></i>
              <span class="nav-link-text">Data Materi</span>
            </a>
            <div class="collapse" id="navbar-forms">
              <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                  <a href="/matapelajaran" class="nav-link">Mata Pelajaran</a>
                </li>
                <li class="{{Request::path() == 'admin/kelas' ? 'active' : '' }}">
                  <a href="{{ route('admin.kelas') }}" class="nav-link">Materi Praktikum</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.blog') }}" class="nav-link">Materi Teori</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
              <i class="ni ni-single-copy-04 text-pink"></i>
              <span class="nav-link-text">Data Quiz</span>
            </a>
            <div class="collapse" id="navbar-forms">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="/matapelajaran" class="nav-link">Mata Pelajaran</a>
                </li>
                <li class="nav-item">
                  <a href="/soal" class="nav-link">Soal</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('jadwal') ? 'active' : ''}}" href="/jadwal">
              <i class="fas fa-calendar-alt text-primary"></i>
              <span class="nav-link-text">Jadwal Quiz</span>
            </a>
          </li>
          @elseif (auth()->user()->level == 'kepsek')
          <li class="nav-item">
            <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="/">
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('guru') ? 'active' : ''}}" href="/guru">
              <i class="fas fa-user-tie text-red"></i>
              <span class="nav-link-text">Guru</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('jadwal') ? 'active' : ''}}" href="/jadwal">
              <i class="fas fa-calendar-alt text-primary"></i>
              <span class="nav-link-text">Jadwal Quiz</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('nilai-siswa') ? 'active' : ''}}" href="/nilai-siswa">
              <i class="fas fa-archive text-primary"></i>
              <span class="nav-link-text">Daftar Nilai</span>
            </a>
          </li>

          @elseif (auth()->user()->level == 'siswa')
          <li class="nav-item">
            <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="/">
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
              <i class="fas fa-university"></i>
              <span class="nav-link-text">Data Materi</span>
            </a>
            <div class="collapse" id="navbar-forms">
              <ul class="nav nav-sm flex-column">
                <li class="{{Request::path() == 'admin/kelas' ? 'active' : '' }}">
                  <a href="{{ route('admin.kelas') }}" class="nav-link">Materi Praktikum</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.blog') }}" class="nav-link">Materi Teori</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('ujian') ? 'active' : ''}}" href="/ujian">
              <i class="far fa-file-alt text-success"></i>
              <span class="nav-link-text">Quiz</span>
            </a>
          </li>

          @endif

        </ul>
      </div>
    </div>
  </div>
</nav>