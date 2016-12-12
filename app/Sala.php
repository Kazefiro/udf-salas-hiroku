<?php

namespace UDF;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $primaryKey = 'cod_sala';

    protected $fillable = [
        'nom_sala',
        'qtd_assentos',
        'qtd_max_assentos',
        'campus_sala'
    ];

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }

    public function oferta(){
        return $this->belongsTo(Oferta::class);
    }

    public static function pegaSalasDisponiveisPorDia($periodo, $horario){
        $codDia = date('N') + 1;
        $codDia = ($codDia == 7) ? 'S' : $codDia;
        $return = self::select('cod_sala')
            ->whereRaw("cod_sala not in (select distinct cod_sala from udfsala.ofertas
                        where cod_sala is not null and nom_periodo ilike '{$periodo}' and 
            nom_horario ilike '%{$codDia}{$horario}%')")->count();

        return $return;
    }

    public $timestamps = false;

}
