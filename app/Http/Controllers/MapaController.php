<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MapaController extends Controller
{
    function traerSectores(){
        $sectores = DB::select("SELECT json_build_object(
            'type',     'FeatureCollection',
            'features', json_agg(feature)
            )
            FROM (
              SELECT json_build_object(
                'type',       'Feature',
                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                'properties', json_build_object(
                    'id', id,
                    'sector', sector,
                    'ubigeo', ubigeo,
                    'nom_dist',nom_dist
                 )
              ) AS feature
              FROM (SELECT * FROM majes_cartografia.sectores) row) features;");

        return response()->json($sectores);
    }

    function traerManzana(){
        $manzanas = DB::select("SELECT json_build_object(
            'type',     'FeatureCollection',
            'features', json_agg(feature)
            )
            FROM (
              SELECT json_build_object(
                'type',       'Feature',
                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                'properties', json_build_object(
                    'id', id,
                    'cod_mz', cod_mz,
                    'mz_urb', mz_urb,
                    'ubigeo',ubigeo,
                    'cod_sect',cod_sect,
                    'cod_uu',cod_uu,
                    'nom_uu',nom_uu,
                    'año_cart,',año_cart,
                    'nom_dist,',nom_dist
                 )
              ) AS feature
              FROM (SELECT * FROM majes_cartografia.mzn_39) row) features;");

        return response()->json($manzanas);
    }

    function traerLote(){
        $lotes = DB::select("SELECT json_build_object(
            'type',     'FeatureCollection',
            'features', json_agg(feature)
            )
            FROM (
              SELECT json_build_object(
                'type',       'Feature',
                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                'properties', json_build_object(
                    'id', id,
                    'cod_sect', cod_sect,
                    'cod_lote', cod_lote,
                    'ubigeo',ubigeo,
                    'nom_dist',nom_dist,
                    'cod_uu',cod_uu,
                    'nom_uu',nom_uu,
                    'anio_cart',anio_cart,
                    'shape_leng',shape_leng,
                    'shape_area',shape_area,
                    'cod_mz',cod_mz,
                    'lot_urb',lot_urb,
                    'cod_terr',cod_terr,
                    'cat',cat,
                    'mz_urb',mz_urb
                 )
              ) AS feature
              FROM (SELECT * FROM majes_cartografia.lot_49) row) features;");

        return response()->json($lotes);
    }

    function traerLote39(){
        $lotes = DB::select("SELECT json_build_object(
            'type',     'FeatureCollection',
            'features', json_agg(feature)
            )
            FROM (
              SELECT json_build_object(
                'type',       'Feature',
                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                'properties', json_build_object(
                    'id', id,
                    'cod_lot', cod_lot,
                    'lot_urb', lot_urb,
                    'cod_mz',cod_mz,
                    'mz_urb',mz_urb,
                    'ubigeo',ubigeo,
                    'cod_sect',cod_sect,
                    'cod_uu',cod_uu,
                    'nom_uu',nom_uu,
                    'año_cart',año_cart,
                    'cpu',cpu,
                    'cod_terr',cod_terr,
                    'num_mun',num_mun,
                    'partida',partida
                 )
              ) AS feature
              FROM (SELECT * FROM majes_cartografia.lote_39) row) features;");

        return response()->json($lotes);
    }

    function traerVia(){
        $vias = DB::select("SELECT json_build_object(
            'type',     'FeatureCollection',
            'features', json_agg(feature)
            )
            FROM (
              SELECT json_build_object(
                'type',       'Feature',
                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                'properties', json_build_object(
                    'id', id,
                    'nom_via', nom_via,
                    'ubigeo', ubigeo,
                    'cod_sect',cod_sect,
                    'cod_tipo',cod_tipo,
                    'cod_via',cod_via,
                    'nro_cuadra',nro_cuadra,
                    'nro_cuadra',nro_cuadra
                 )
              ) AS feature
              FROM (SELECT * FROM majes_cartografia.via_39) row) features;");

        return response()->json($vias);
    }

    function traerImagen(Request $request){
        return DB::select("SELECT 'data:image/gif;base64,' || encode(foto, 'base64') AS imagen FROM sect_39  WHERE id_lote = '".$request->id_lote."' limit 1");
    }
}
