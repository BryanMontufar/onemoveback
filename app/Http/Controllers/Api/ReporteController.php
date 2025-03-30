<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Autos;

class ReporteController extends Controller
{
    public function generarReporte()
    {
        $reporte = Autos::leftJoin('compras', 'autos.id', '=', 'compras.auto_id')
            ->leftJoin('ventas', 'autos.id', '=', 'ventas.auto_id')
            ->leftJoin('costos_reparacion', 'autos.id', '=', 'costos_reparacion.auto_id')
            ->select(
                'autos.acta',
                'autos.placa',
                'autos.marca',
                'autos.modelo',
                'autos.kilometraje',
                'autos.anio',
                'autos.color',
                'autos.estatus',
                'autos.fecha_ingreso',
                'compras.vendedor',
                'compras.cedula_ruc',
                'compras.valor_auto',
                'compras.abono',
                'compras.saldo_pagar',
                'compras.fecha_pago as compra_fecha_pago',
                'compras.estado',
                'compras.matri_rev_mul',
                'compras.comision_compra',
                'compras.comisionista_compra',
                'compras.estado_comision_compra',	
                'compras.precio_final_compra',
                'compras.forma_pago',
                'compras.placa_rpp',
                'compras.observaciones',
                'costos_reparacion.lavada',
                'costos_reparacion.detailing',
                'costos_reparacion.pulida',
                'costos_reparacion.pintura',
                'costos_reparacion.electrico',
                'costos_reparacion.mecanica',
                'costos_reparacion.gasolina',
                'costos_reparacion.publicacion',
                'costos_reparacion.fotos',
                'costos_reparacion.papeles',
                'costos_reparacion.poder',
                'costos_reparacion.varios',
                'costos_reparacion.autostudio',
                'costos_reparacion.accesorios',
                'costos_reparacion.cargas',
                'costos_reparacion.avaluo',
                'costos_reparacion.fideval',
                'costos_reparacion.costo_total_preparacion',
                'costos_reparacion.canc_consg',
                'costos_reparacion.estado_ctr',
                'costos_reparacion.fecha_pago_reparacion as reparacion_fecha_pago',
                'ventas.comision_venta',
                'ventas.comisionista_venta',
                'ventas.estado_pago_comision',
                'ventas.costo_final_auto',
                'ventas.fecha_venta',
                'ventas.comprador',
                'ventas.forma_pago',
                'ventas.papeles',
                'ventas.notaria',
                'ventas.placa_rpp',
                'ventas.observaciones',
                'ventas.valor_vendido',
                'ventas.valor_abonado',
                'ventas.saldo',
                'ventas.estado_cobro',
                'ventas.fecha_cobro',
            )
            ->get();

        return response()->json($reporte);
    }
}
