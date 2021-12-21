<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ url('') }}">
            <img src="{{ asset('argon') }}/img/brand/unesamap.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">         
                </a>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ url('') }}">
                            <img src="{{ asset('argon') }}/img/brand/unesamap.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <h2>Filter</h2>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-kampus" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-kampus">
                        <i class="ni ni-hat-3 text-primary"></i> {{ __('Kampus') }}
                    </a>
                    <div class="collapse" id="navbar-kampus">
                        <ul class="nav nav-sm flex-column">
                            @foreach($kampus as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="filterKampus({{ $item->id }});">
                                    {{ $item->nama_wilayah }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-fakultas" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-fakultas">
                        <i class="ni ni-hat-3 text-success"></i> {{ __('Fakultas') }}
                    </a>
                    <div class="collapse" id="navbar-fakultas">
                        <ul class="nav nav-sm flex-column">
                            @foreach($fakultas as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="filterFakultas({{ $item->id }});">
                                    {{ $item->letak_sebaran }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-jurusan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-jurusan">
                        <i class="ni ni-hat-3 text-warning"></i> {{ __('Jurusan') }}
                    </a>
                    <div class="collapse" id="navbar-jurusan">
                        <ul class="nav nav-sm flex-column">
                            @foreach($jurusan as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="filterJurusan({{ $item->id }});">
                                    {{ $item->nama_jurusan }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-prodi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-prodi">
                        <i class="ni ni-hat-3 text-info"></i> {{ __('Prodi') }}
                    </a>
                    <div class="collapse" id="navbar-prodi">
                        <ul class="nav nav-sm flex-column">
                            @foreach($prodi as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="filterProdi({{ $item->id }});">
                                    {{ $item->nama_prodi }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-gedung" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-gedung">
                        <i class="ni ni-hat-3 text-default"></i> {{ __('Gedung') }}
                    </a>
                    <div class="collapse" id="navbar-gedung">
                        <ul class="nav nav-sm flex-column">
                            @foreach($gedung as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="filterGedung({{ $item->id }});">
                                    {{ $item->nama_gedung }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item m-4 bg-danger">
                    <a class="nav-link text-white text-center d-block" href="#" onclick="filterReset();">
                        Reset
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
