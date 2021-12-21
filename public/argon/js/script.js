var map;
function buildMap(location=null){
    setTimeout(
        function() 
        {
            var kampus = L.layerGroup();
            var fakultas = L.layerGroup();
            var jurusan = L.layerGroup();
            var gedung = L.layerGroup();
            var prodi = L.layerGroup();
            
            // var mGolden = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(cities);
            
            var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
            
            var grayscale = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
            var streets = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
            var satellite = L.tileLayer(mbUrl, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
            
            if(location == null){
                map = L.map('map', {
                    center: [-7.30950 , 112.69711],
                    zoom: 15,
                    layers: [streets,kampus,fakultas,jurusan,gedung,prodi] // ini menu yang tampil pertama kali
                });
            }
            else{
                map = L.map('map', {
                    center: location,
                    zoom: 17,
                    layers: [streets,kampus,fakultas,jurusan,gedung,prodi] // ini menu yang tampil pertama kali
                });
            }
            
            var pointIcon = L.Icon.extend({
                options: {
                    shadowUrl: 'assets/img/icons/toga_shadow.png',
                    iconSize:     [40, 40],
                    shadowSize:   [60, 40],
                    iconAnchor:   [20, 20],
                    shadowAnchor: [12, 20],
                    popupAnchor:  [0, -25]
                }
            });
            var togaIcon = new pointIcon({iconUrl: 'assets/img/icons/toga.png'}); // ini untuk custom icon - prodi
            
            
            // digunakan untuk menampilkan titik tengah dari tiap gedung. bisa difilter dengan menyesuaikan query databaase.
            centerGedung.point.forEach(coordinate => L.marker(coordinate).bindPopup('Ini pusat lokasinya').addTo(kampus));
            
            // fungsi hightlight ketika hover mouse
            function highlightFeature(e) {
                var layer = e.target;
            
                layer.setStyle({
                    weight: 5,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.7
                });
            }
            
            //  fungsi-fungsi reset style ketika mouse out - setelah terjadi hover
            function resetKampusHighlight(e) {
                kampusLayer.resetStyle(e.target);
            }
            
            function resetFakultasHighlight(e) {
                fakultasLayer.resetStyle(e.target);
            }
            
            function resetGedungHighlight(e) {
                gedungLayer.resetStyle(e.target);
            }
            
            // fungsi efek zoom - digunakan ketika event klik (bisa dimanfaatkan pada event lainnya)
            function zoomToFeature(e) {
                map.fitBounds(e.target.getBounds());
                
            }
            
            // fungsi-fungsi untuk tiap layer (disederhanakan lagi agar tidak boilerplate)
            function onEachKampus(feature, layer) {
                var popupContent = '<p>Area Kampus, ' + feature.properties.wilayah + '</p>';
            
                if (feature.properties && feature.properties.popupContent) {
                    popupContent += feature.properties.popupContent;
                }
            
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetKampusHighlight,
                    click: zoomToFeature
                });
            }
            
            function onEachFakultas(feature, layer) {
                var popupContent = '<p>Area Fakultas, ' + feature.properties.namaFakultas + '</p>';
            
                if (feature.properties && feature.properties.popupContent) {
                    popupContent += feature.properties.popupContent;
                }
            
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetFakultasHighlight,
                    click: zoomToFeature
                });
            }
            
            function onEachJurusan(feature, layer) {
                var popupContent = '<p>Area Jurusan, ' + feature.properties.namaJurusan + '</p>';
            
                if (feature.properties && feature.properties.popupContent) {
                    popupContent += feature.properties.popupContent;
                }
            
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetFakultasHighlight,
                    click: zoomToFeature
                });
            }
            
            function onEachGedung(feature, layer) {
                var popupContent = '<p>Area Gedung, ' + feature.properties.namaGedung + '</p>';
            
                if (feature.properties && feature.properties.popupContent) {
                    popupContent += feature.properties.popupContent;
                }
            
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetGedungHighlight,
                    click: zoomToFeature
                });
            }
            
            function onEachProdi(feature, layer) {
                var popupContent = '<p>Posisi Prodi, ' + feature.properties.namaProdi + '</p>';
            
                if (feature.properties && feature.properties.popupContent) {
                    popupContent += feature.properties.popupContent;
                }
            
                layer.bindPopup(popupContent);
            }
            
            // fungsi-fungsi style untuk tiap feature (area kampus, area fakultas, area gedung)
            function style_kampus(feature){
                var wilayah = feature.properties.wilayah
                var warna = wilayah == "Kampus Unesa Ketintang" ? '#781D42' :
                            wilayah == "Kampus Unesa Lidah" ? '#706D42' : 'grey';
                return {fillColor: warna, color: '#666666', fillOpacity: 0.3, weight: 1};
            }
            
            function style_fakultas(feature){
                var idFakultas = feature.properties.idFakultas;
                var warna = idFakultas == 2 ? 'green' :
                            idFakultas == 5 ? 'blue' :
                            idFakultas == 4 ? '#F0D290' :
                            idFakultas == 3 ? 'red' :
                            idFakultas == 7 ? 'purple' :
                            idFakultas == 8 ? 'yellow' :
                            idFakultas == 9 ? '#32C1CD' :
                            idFakultas == 6 ? '#461111' : 'grey';
                return {fillColor: warna, color: '#666666', fillOpacity: 0.3, weight: 2};
            }
            
            function style_gedung(feature){
                var idFakultas = feature.properties.idFakultas;
                return {fillColor: '#FC9918', color: '#666666', fillOpacity: 0.7, weight: 2};
            }
            
            // komponen-komponen layer yang ditampilkan dari data geojson
            var kampusLayer = L.geoJSON(areaKampus, {
                style: style_kampus,
                onEachFeature: onEachKampus
            }).addTo(kampus);
            
            var fakultasLayer = L.geoJSON(areaFakultas, {
                style: style_fakultas,
                onEachFeature: onEachFakultas
            }).addTo(fakultas);
            
            var jurusanLayer = L.geoJSON(areaJurusan, {
                style: style_fakultas,
                onEachFeature: onEachJurusan
            }).addTo(jurusan);
            
            var gedungLayer = L.geoJSON(areaGedung, {
                style: style_gedung,
                onEachFeature: onEachGedung
            }).addTo(gedung);
            
            var prodiLayer = L.geoJSON(pointProdi, {
                pointToLayer: function (feature, coordinate) {
                    return L.marker(coordinate, {icon: togaIcon});
                },
                onEachFeature: onEachProdi
            }).addTo(prodi);
            
            //  variabel untuk menampilkan jenis maps
            var baseLayers = {
                'Streets': streets,
                'Satellite': satellite,
                'Grayscale': grayscale
            };
            
            //  variabel untuk menampilkan pilihan layer komponen
            var overlays = {
                'Kampus': kampus,
                'Fakultas': fakultas,
                'Jurusan': jurusan,
                'Gedung': gedung,
                'Prodi': prodi
            };
            
            // menambahkan kontrol menu kedalam map
            var layerControl = L.control.layers(baseLayers, overlays).addTo(map);
        }, 1000
    );
}