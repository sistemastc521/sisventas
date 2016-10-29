<?php

namespace sisventas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     protected $table = 'venta';

    protected $primaryKey = 'idiventa';

    public $timestamps=false;

    protected $fillable =[
	'idcliente',
	'tipo_comprobante',
	'serie_comprobante',
	'numero_comprobante',
	'fecha_hora',
	'impuesto',
	'total_venta',
	'estado',
	'idproyecto',
	'anticipo'

	];

    protected $guarded = [
    ];


}
