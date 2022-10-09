<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/ol.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/ol-ext.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/ol3-layerswitcher.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/smartadmin-production-plugins.min.css') }}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/smartadmin-production.min.css') }}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/smartadmin-skins.min.css') }}">

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/black-tie/theme.min.css">
        
        <title>Municipalidad Majes</title>
    </head>
    <style>
        input[type='radio']:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #d1d3d1;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        input[type='radio']:checked:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: red;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        .fullscreen:-moz-full-screen {
            height: 100%;
        }
        .fullscreen:-webkit-full-screen {
            height: 100%;
        }
        .fullscreen:-ms-fullscreen {
            height: 100%;
        }
        .fullscreen:fullscreen {
            height: 100%;
        }
        .fullscreen {
            margin-bottom: 10px;
            width: 100%;
            height: 400px;
            z-index: 99 !important ;
        }
        .ol-rotate {
            top: 3em;
        }
        .map {
            width: 100%;
            height: 100%;
        }
        .ol-legend > canvas {
            float: left;
        }
        .ol-legend > div.ol-legend {
            position: relative;
        }

        .ui-dialog { z-index: 1000 !important ;}
        .ui-front { z-index: 1000 !important; }

        .ol-overlay.menu {
            width: 25%;
            background: #ECF6CE;
            color: #333;
            box-shadow: 0px 0px 5px #000;
            padding: 0.5em;
            -webkit-transition: all 0.25s;
            transition: all 0.25s;
        }
        .ol-overlay.menu .ol-closebox {
            left: 1em;
            top: 0.5em;
        }
        .ol-overlay.menu .ol-closebox:before {
            content:"\f0c9";
            font-family:FontAwesome;
        }
        #menu {
            padding-top: 1.5em;
            font-size: 1em;
        }
        .slide-left{
            background: #ECF6CE;
        }
        .ol-control.menu {
            top: 0.5em;
            left: 0.5em;
        }
        .ol-zoom {
            left: auto;
            right: 0.5em;
        }
        .ol-rotate {
            right: 3em;
        }
        .ol-touch .ol-rotate {
            right: 3.5em;
        }
        .ol-overlay img {
            max-width: 100%;
        }
        .data,
        .data p {
            margin:0;
            text-align: center;
            font-size:0.9em;
        }
        .layer-switcher {
            top: 5em !important;
        }
    </style>
    <body>

        <div id="dialog" title="Predio"></div>
              
        <div class="card shadow-lg bg-white rounded">
            <div class="card-body fullscreen" id="fullscreen" style="height: 800px">
                <div id="map" style="background: white;" class="map"></div>
            </div>
        </div>

        <div id="menu">
            <div class="sidepanel">
                <div class="container pt-5 pl-3">
                <span class="sidepanel-title pt-5 h3 text-center" style="color:black;font-weight:bold">Municipalidad Majes</span>
                    <div class="row pt-5 px-0 mx-0">
                        <div class="widget-body">
                            <div class="tree smart-form">
                                <ul role="group">
                                    <li class="parent_li" role="treeitem">
                                        <span style=" border: 1px dotted #999;width: 100%; color: black" class="h5"><i class="fa fa-lg fa-minus-circle"></i> Administracion Capas</span>
                                        <ul role="group">
                                            <li>
                                                <span style="width: 100%"> 
                                                    <label class="checkbox inline-block" style="color:black !important ">
                                                    <input type="checkbox" checked="checked" name="checkbox-inline" id="chkSectores" onchange="valida_capa('chkSectores')">
                                                    <i></i><FONT SIZE=+1>Sectores</FONT></label> 
                                                </span>
                                            </li>
                                            <li>
                                                <span style="width: 100%"> 
                                                    <label class="checkbox inline-block" style="color:black !important ">
                                                    <input type="checkbox" name="checkbox-inline" id="chkManzana" onchange="valida_capa('chkManzana')">
                                                    <i></i><FONT SIZE=+1>Manzana - 39</FONT></label> 
                                                </span>
                                            </li>
                                            <li>
                                                <span style="width: 100%"> 
                                                    <label class="checkbox inline-block" style="color:black !important ">
                                                    <input type="checkbox" name="checkbox-inline" id="chkLote39" onchange="valida_capa('chkLote39')">
                                                    <i></i><FONT SIZE=+1>Lote - 39</FONT></label> 
                                                </span>
                                            </li>
                                            <li>
                                                <span style="width: 100%"> 
                                                    <label class="checkbox inline-block" style="color:black !important ">
                                                    <input type="checkbox" name="checkbox-inline" id="chkVia" onchange="valida_capa('chkVia')">
                                                    <i></i><FONT SIZE=+1>Vias - 39</FONT></label> 
                                                </span>
                                            </li>
                                            <li>
                                                <span style="width: 100%"> 
                                                    <label class="checkbox inline-block" style="color:black !important ">
                                                    <input type="checkbox" name="checkbox-inline" id="chkLote" onchange="valida_capa('chkLote')">
                                                    <i></i><FONT SIZE=+1>Lote - 49</FONT></label> 
                                                </span>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>

    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/ol.js') }}"></script>
    <script src="{{ asset('assets/js/ol-ext.js') }}"></script>
    <script src="{{ asset('assets/js/ol3-layerswitcher.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/js/block_ui.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
            $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(':visible')) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
                }
                e.stopPropagation();
            });			
        })

        window.app = {};
        var app = window.app;
        
        app.CustomToolbarControl = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.innerHTML = 'N';

            var button1 = document.createElement('button');
            button1.innerHTML = 'some button';

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };

            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';
            element.style='width:700px !important'

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });

        };
        ol.inherits(app.CustomToolbarControl, ol.control.Control);

        var map = new ol.Map({
            controls: ol.control.defaults({
                attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                    collapsible: false
                })
            }).extend([
                new app.CustomToolbarControl(),
                new ol.control.FullScreen({
                    source: 'fullscreen'
                    })
            ]),
            layers: [
                new ol.layer.Group({
                    'title': 'Capas Base',
                    layers: [
                        new ol.layer.Tile({
                            title: 'Capa Water Color',
                            type: 'base',
                            visible: false,
                            source: new ol.source.Stamen({
                                layer: 'watercolor'
                            })
                        }),
                        new ol.layer.Tile({
                            title: 'Capa Open Street Maps',
                            type: 'base',
                            visible: true,
                            source: new ol.source.OSM()
                        }),
                        new ol.layer.Tile({
                            title: 'Capa Blanco',
                            type: 'base',
                            visible: false
                        }),
                        new ol.layer.Tile({
                            title: "Capa Toner",
                            type: 'base',
                            visible: false,
                            source: new ol.source.Stamen({
                                layer: 'toner'
                            })
                        }),
                        new ol.layer.Tile({
                            title: 'Capa Satelite',
                            visible: false,
                            type: 'base',
                            source: new ol.source.BingMaps({
                                key: 'EqfF5l6dY2LLMQa8JHlI~voA5TXsAVOQgFOP74piAbg~Aqg-emVFCImabFdRRDvdjqh1rB6Bl9l8ZkcmL7nGveSeeNkV7iSRC7XTHi1XeUVu',
                                imagerySet: 'Aerial'
                            })
                        })
                    ]
                })
            ],
            target: 'map',
            view: new ol.View({
                center: [-11000000, 4600000],
                zoom: 5,
                minZoom: 5
            })
        });
        
        var layerSwitcher = new ol.control.LayerSwitcher({
            tipLabel: 'Légende',
            collapsed: false
        });

        map.addControl(layerSwitcher);

        var menu = new ol.control.Overlay ({ 
            closeBox : true, 
            className: "slide-left menu", 
            content: $("#menu").get(0)
        });
        map.addControl(menu);

        var t = new ol.control.Toggle({
            html: '<i class="fa fa-bars" ></i>',
            className: "menu",
            title: "Menu",
                onToggle: function() { menu.toggle(); }
            });
        map.addControl(t);

        var select = new ol.interaction.Select({});
        map.addInteraction(select);

        // On selected => show/hide popup
        select.getFeatures().on('add', function(e){
            var feature = e.element;
            var img = $("<img>").attr("src", feature.get("img"));
            var info = $("<div>").append( $("<p>").text(feature.get("text")));
            var content = $("<div>")
                .append( img )
                .append(info);
            $(".data").html(content);
        });
        
        select.getFeatures().on('remove', function(e){
            $(".data").html("");
        });

        function crearSectores()
        {
            $.ajax({url: 'traerSectores',
                type: 'GET',
                beforeSend:function()
                {
                    $('#map').block({ 
                        message: '<h1><img src="assets/img/loader.gif" />CARGANDO INFORMACION</h1>', 
                        css: { border: '5px solid #a00',width: '40%' } 
                    });
                },
                success: function(r)
                {
                    geojson_sectores = JSON.parse(r[0].json_build_object);
                    var format_sectores= new ol.format.GeoJSON();
                    var features_sectores = format_sectores.readFeatures(geojson_sectores,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_sectores = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_sectores.addFeatures(features_sectores);
                    lyr_sectores = new ol.layer.Vector({
                        source:jsonSource_sectores,
                        style: styleSectores,
                        title: "SECTORES"
                    });
                    map.addLayer(lyr_sectores);
                    var extent = lyr_sectores.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                    $('#map').unblock(); 
                }
            });
        }
        crearSectores();

        function styleSectores(feature, resolution){
            return new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: feature.get('color'),
                width: 3
            }),
                text: new ol.style.Text({
                    Placement: 'line',
                    textAlign: "center",
                    text: feature.get('layer'),
                    Baseline:'middle',
                    maxAngle: 6.283185307179586,
                    rotation: 0,
                    fill: new ol.style.Fill({
                        color: 'white',
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 2,
                        lineCap: 'butt',
                    }),
                })
            });
        }

        function valida_capa(check)
        {
            if($("#"+check).prop('checked'))
            {
                if(check=='chkSectores')
                {
                    crearSectores();
                }
                if(check=='chkManzana')
                {
                    crearManzana();
                }
                if(check=='chkLote39')
                {
                    crearLote39();
                }
                if(check=='chkLote')
                {
                    crearLote();
                }
                if(check=='chkVia')
                {
                    crearVia();
                }
            }
            else
            {
                if(check=='chkSectores')
                {
                    map.removeLayer(lyr_sectores);
                }
                if(check=='chkManzana')
                {
                    map.removeLayer(lyr_manzana);
                }
                if(check=='chkLote39')
                {
                    map.removeLayer(lyr_lote39);
                }
                if(check=='chkLote')
                {
                    map.removeLayer(lyr_lote);
                }
                if(check=='chkVia')
                {
                    map.removeLayer(lyr_via);
                }
            }
        }

        function crearManzana()
        {
            $.ajax({url: 'traerManzana',
                type: 'GET',
                beforeSend:function()
                {
                    $('#map').block({ 
                        message: '<h1><img src="assets/img/loader.gif" />CARGANDO INFORMACION</h1>', 
                        css: { border: '5px solid #a00',width: '40%' } 
                    });
                },
                success: function(r)
                {
                    geojson_manzana = JSON.parse(r[0].json_build_object);
                    var format_manzana= new ol.format.GeoJSON();
                    var features_manzana = format_manzana.readFeatures(geojson_manzana,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_manzana = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_manzana.addFeatures(features_manzana);
                    lyr_manzana = new ol.layer.Vector({
                        source:jsonSource_manzana,
                        style: styleManzana,
                        title: "MANZANA"
                    });
                    map.addLayer(lyr_manzana);
                    var extent = lyr_manzana.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                    $('#map').unblock(); 
                }
            });
        }

        function styleManzana(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: '#8181F7',
                    width: 2,
                    lineCap: 'butt',
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(80, 57, 237, 0.6)',
                })
            });
        }

        function crearLote39()
        {
            $.ajax({url: 'traerLote39',
                type: 'GET',
                beforeSend:function()
                {
                    $('#map').block({ 
                        message: '<h1><img src="assets/img/loader.gif" />CARGANDO INFORMACION</h1>', 
                        css: { border: '5px solid #a00',width: '40%' } 
                    });
                },
                success: function(r)
                {
                    geojson_lote39 = JSON.parse(r[0].json_build_object);
                    var format_lote39= new ol.format.GeoJSON();
                    var features_lote39 = format_lote39.readFeatures(geojson_lote39,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_lote39 = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_lote39.addFeatures(features_lote39);
                    lyr_lote39 = new ol.layer.Vector({
                        source:jsonSource_lote39,
                        style: styleLote39,
                        title: "LOTES39"
                    });
                    map.addLayer(lyr_lote39);
                    var extent = lyr_lote39.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                    $('#map').unblock(); 
                }
            });
        }

        function styleLote39(feature, resolution){
            return new ol.style.Style({
               stroke: new ol.style.Stroke({
                color: "#FF0000",
                width: 3
              }),
              text: new ol.style.Text({
                font: '12px Roboto',
                text: feature.get('cod_lot')
                })
            });
        }

        function crearLote()
        {
            $.ajax({url: 'traerLote',
                type: 'GET',
                beforeSend:function()
                {
                    $('#map').block({ 
                        message: '<h1><img src="assets/img/loader.gif" />CARGANDO INFORMACION</h1>', 
                        css: { border: '5px solid #a00',width: '40%' } 
                    });
                },
                success: function(r)
                {
                    geojson_lote = JSON.parse(r[0].json_build_object);
                    var format_lote= new ol.format.GeoJSON();
                    var features_lote = format_lote.readFeatures(geojson_lote,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_lote = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_lote.addFeatures(features_lote);
                    lyr_lote = new ol.layer.Vector({
                        source:jsonSource_lote,
                        style: styleLote,
                        title: "LOTES"
                    });
                    map.addLayer(lyr_lote);
                    var extent = lyr_lote.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                    $('#map').unblock(); 
                }
            });
        }

        function styleLote(feature, resolution){
            return new ol.style.Style({
               stroke: new ol.style.Stroke({
                color: "#FF0000",
                width: 3
              }),
              text: new ol.style.Text({
                font: '12px Roboto',
                text: feature.get('cod_lote')
                })
            });
        }

        function crearVia()
        {
            $.ajax({url: 'traerVia',
                type: 'GET',
                beforeSend:function()
                {
                    $('#map').block({ 
                        message: '<h1><img src="assets/img/loader.gif" />CARGANDO INFORMACION</h1>', 
                        css: { border: '5px solid #a00',width: '40%' } 
                    });
                },
                success: function(r)
                {
                    geojson_via = JSON.parse(r[0].json_build_object);
                    var format_via= new ol.format.GeoJSON();
                    var features_via = format_via.readFeatures(geojson_via,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_via = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_via.addFeatures(features_via);
                    lyr_via = new ol.layer.Vector({
                        source:jsonSource_via,
                        style: styleVia,
                        title: "VIA"
                    });
                    map.addLayer(lyr_via);
                    var extent = lyr_via.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                    $('#map').unblock(); 
                }
            });
        }

        function styleVia(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: '#031961',
                    width: 4,
                    lineCap: 'butt',
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 0, 0.3)',
                }),
                
            });
        }

        
        map.on('click', function(evt) {
            var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
                if(layer.get('title')=='LOTES39')
                {   
                    $.ajax({url: 'traerImagen',
                        type: 'GET',
                        data: {
                            id_lote: feature.get('cod_sect')+feature.get('cod_mz')+feature.get('cod_lot')
                        },
                        beforeSend:function()
                        {
                            $('#map').block({ 
                                message: '<h1><img src="assets/img/loader.gif" />CARGANDO INFORMACION</h1>', 
                                css: { border: '5px solid #a00',width: '40%' } 
                            });
                        },
                        complete:function(data){
                            $('#map').unblock(); 
                        },
                        success: function(rspta)
                        {
                            var $pop = $("#dialog").dialog({
                                minWidth: 700,
                                minHeight: 250,
                                appendTo: "#fullscreen",
                            });
                            if(rspta.length != 0)
                            {
                                $pop.html('<img src="'+rspta[0].imagen+'">');
                            }
                            else
                            {
                                $pop.html('<div class="row text-center"><h3>EL PREDIO NO TIENE IMAGEN</h3></div>');
                            }
                        },
                        error:function(error){
                            $('#map').unblock(); 
                        }
                    });                    
                }
            });
        });

    </script>
    </body>
</html>
