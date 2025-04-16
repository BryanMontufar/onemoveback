<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Autos;
use App\Models\Compra;
use App\Models\Reparaciones;
use App\Models\Ventas;
use Illuminate\Support\Facades\Storage;

class ImportarAutos extends Command
{
    protected $signature = 'importar:autos';
    protected $description = 'Importa autos y sus datos relacionados desde un archivo CSV';

    public function handle()
    {
        $path = storage_path('app/datos_autos.csv');

        if (!file_exists($path)) {
            $this->error("El archivo no se encuentra en: $path");
            return 1;
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            $this->error("No se pudo abrir el archivo.");
            return 1;
        }

        // Detectar delimitador automáticamente
        $firstLine = fgets($handle);
        $delimiter = str_contains($firstLine, ';') ? ';' : ',';
        rewind($handle);

        // Leer encabezados
        $headers = fgetcsv($handle, 0, $delimiter);
        $headers = array_map('trim', $headers);

        $fila = 0;
        $importados = 0;

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            $fila++;

            // Verificar que la fila tenga el mismo número de columnas que los encabezados
            if (count($headers) !== count($row)) {
                $this->warn("Fila $fila ignorada: columnas incompatibles.");
                continue;
            }
        
            $row = array_combine($headers, $row);

            // Insertar auto
            $auto = Autos::create([
                'acta' => $row['acta'],
                'placa' => $row['placa'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'kilometraje' => $row['kilometraje'],
                'anio' => $row['anio'],
                'color' => $row['color'],
                'estatus' => $row['estatus'],
                'fecha_ingreso' => date('Y-m-d', strtotime($row['fecha_ingreso'])),
            ]);

            // Insertar compra
            Compra::create([
                'auto_id' => $auto->id,
                'vendedor' => $row['vendedor'],
                'cedula_ruc' => $row['cedula_ruc'],
                'valor_auto' => $row['valor_auto'],
                'abono' => $row['abono'],
                'saldo_pagar' => $row['saldo_pagar'],
                'fecha_pago' => date('Y-m-d', strtotime($row['fecha_pagar'])),
                'estado' => $row['estado'],
                'matri_rev_mul' => $row['matri_rev_mul'] ?? null,
                'comision_compra' => $row['comision_compra'],
                'comisionista_compra' => $row['comisionista_compra'],
                'estado_comision_compra' => $row['estado_comision_compra'],
                'precio_final_compra' => $row['precio_final_compra'],
                'forma_pago' => $row['forma_pago'],
                'placa_rpp' => $row['placa_rpp'],
                'observaciones' => $row['observaciones'],
            ]);

            // Insertar reparaciones
            Reparaciones::create([
                'auto_id' => $auto->id,
                'lavada' => $row['lavada'],
                'detailing' => $row['detailing'],
                'pulida' => $row['pulida'],
                'pintura' => $row['pintura'],
                'electrico' => $row['electrico'],
                'mecanica' => $row['mecanica'],
                'gasolina' => $row['gasolina'],
                'publicacion' => $row['publicacion'],
                'fotos' => $row['fotos'],
                'papeles' => $row['papeles'],
                'poder' => $row['poder'],
                'varios' => $row['varios'],
                'autostudio' => $row['autostudio'],
                'accesorios' => $row['accesorios'],
                'cargas' => $row['cargas'],
                'avaluo' => $row['avaluo'],
                'fideval' => $row['fideval'],
                'CUV' => $row['CUV'],
                'costo_total_preparacion' => $row['costo_total_preparacion'],
                'canc_consg' => $row['canc_consg'],
                'estado_ctr' => $row['estado_ctr'],
                'fecha_pago_reparacion' => $row['fecha_pago_reparacion'] ? date('Y-m-d', strtotime($row['fecha_pago_reparacion'])) : null,
            ]);

            // Insertar venta
            Ventas::create([
                'auto_id' => $auto->id,
                'comision_venta' => $row['comision_venta'],
                'comisionista_venta' => $row['comisionista_venta'],
                'estado_pago_comision' => $row['estado_pago_comision'],
                'costo_final_auto' => $row['costo_final_auto'],
                'fecha_venta' => $row['fecha_venta'] ? date('Y-m-d', strtotime($row['fecha_venta'])) : null,
                'comprador' => $row['comprador'],
                'forma_pago' => $row['forma_pago'],
                'papeles' => $row['papeles2'],
                'notaria' => $row['notaria'],
                'placa_rpp' => $row['placa_rpp'],
                'observaciones' => $row['observaciones'],
                'valor_vendido' => $row['valor_vendido'],
                'valor_abonado' => $row['valor_abonado'],
                'saldo' => $row['saldo'],
                'estado_cobro' => $row['estado_cobro'],
                'fecha_cobro' => $row['fecha_cobro'] ? date('Y-m-d', strtotime($row['fecha_cobro'])) : null,
            ]);
        }

        $this->info('Datos importados correctamente.');
    }
}
