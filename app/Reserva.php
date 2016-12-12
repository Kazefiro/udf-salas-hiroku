<?php

namespace UDF;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $primaryKey = 'cod_reserva';


    protected $fillable = [
        'obs_reserva',
        'nom_horario' ,
        'nom_periodo' ,
        'dat_inicio',
        'dat_termino',
        'cod_sala'

    ];

    public function sala(){

        return $this->hasOne(Sala::class);

    }

    public static function getCount(){
        return self::count();
    }

    public static function pegaReservasDoDia($periodo, $horario){
        $codDia = date('N') + 1;
        $codDia = ($codDia == 7) ? 'S' : $codDia;
        return self::select('cod_sala')->where('nom_periodo', 'ilike', $periodo)
            ->whereRaw('current_date between dat_inicio and dat_termino')
            ->whereRaw("nom_horario ilike '%{$codDia}{$horario}%'")->count();
    }

    public $timestamps = false;

}
