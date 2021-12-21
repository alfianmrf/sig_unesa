<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <link type="text/css" href="{{ asset('argon') }}/css/style.css" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
        @include('layouts.navbars.sidebar')
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
        <script>
            var areaKampus = {
                "type": "FeatureCollection",
                "features": [],
            };

            var areaFakultas = {
                "type": "FeatureCollection",
                "features": [],
            };

            var areaJurusan = {
                "type": "FeatureCollection",
                "features": [],
            };

            var areaGedung = {
                "type": "FeatureCollection",
                "features": [],
            };

            var pointProdi = {
                "type": "FeatureCollection",
                "features": [],
            };

            var centerGedung = {
                "point": []
            };

            $.get({
                url: "{{ route('resultKampus') }}",
                success: function(data) {
                    $.each(data, function(index, value) {
                        areaKampus.features.push(
                            {
                                "type": "Feature",
                                "geometry": JSON.parse(value['area']),
                                "properties": {
                                    "wilayah": value['nama_wilayah']
                                },
                                "id": value['id']
                            }
                        )
                    })
                }
            });

            $.get({
                url: "{{ route('resultFakultas') }}",
                success: function(data) {
                    $.each(data, function(index, value) {
                        areaFakultas.features.push(
                            {
                                "type": "Feature",
                                "geometry": JSON.parse(value['area']),
                                "properties": {
                                    "idFakultas": value['id_fakultas'],
                                    "namaFakultas": value['letak_sebaran']
                                },
                                "id": value['id']
                            }
                        )
                    })
                }
            });

            $.get({
                url: "{{ route('resultJurusan') }}",
                success: function(data) {
                    $.each(data, function(index, value) {
                        areaJurusan.features.push(
                            {
                                "type": "Feature",
                                "geometry": JSON.parse(value['area']),
                                "properties": {
                                    "idFakultas": value['id_fakultas'],
                                    "namaJurusan": value['nama_jurusan']
                                },
                                "id": value['id']
                            }
                        )
                    })
                }
            });

            $.get({
                url: "{{ route('resultGedung') }}",
                success: function(data) {
                    $.each(data, function(index, value) {
                        areaGedung.features.push(
                            {
                                "type": "Feature",
                                "geometry": JSON.parse(value['area']),
                                "properties": {
                                    "namaGedung": value['nama_gedung']
                                },
                                "id": value['id']
                            }
                        )
                    })
                }
            });

            $.get({
                url: "{{ route('resultProdi') }}",
                async: "false",
                success: function(data) {
                    $.each(data, function(index, value) {
                        pointProdi.features.push(
                            {
                                "type": "Feature",
                                "geometry": JSON.parse(value['area']),
                                "properties": {
                                    "namaProdi": value['nama_prodi']
                                },
                                "id": value['id']
                            }
                        )
                    })
                }
            });

            $.get({
                url: "{{ route('centerGedung') }}",
                success: function(data) {
                    $.each(data, function(index, value) {
                        centerGedung.point.push(
                            [
                                value['yValue'], value['xValue']
                            ]
                        )
                    })
                }
            });
        </script>
        <script src="{{ asset('argon') }}/js/script.js"></script>
        <script>
            buildMap();

            $("#fakultas").click(function(event) {
                areaFakultas = {
                    "type": "FeatureCollection",
                    "features": [],
                };
                $.get({
                    url: "{{ route('resultFakultass') }}",
                    success: function(data) {
                        $.each(data, function(index, value) {
                            areaFakultas.features.push(
                                {
                                    "type": "Feature",
                                    "geometry": JSON.parse(value['area']),
                                    "properties": {
                                        "idFakultas": value['id_fakultas'],
                                        "namaFakultas": value['letak_sebaran']
                                    },
                                    "id": value['id']
                                }
                            )
                        })
                        map.remove();
                        buildMap();
                    }
                });
            });
        </script>
    </body>
</html>