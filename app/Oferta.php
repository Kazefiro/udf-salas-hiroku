<?php

namespace UDF;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $primaryKey = 'cod_oferta';
    protected $fillable = [
        'nom_oferta' ,
        'cod_disciplina',
        'nom_disciplina',
        'nom_curso',
        'nom_horario',
        'nom_periodo',
        'cod_sala',
        'nom_campus',
        'nom_professor',
        'total_matriculados',
        'ser',
        'carga_horaria'
    ];


    public function sala(){

        return $this->hasOne(Sala::class, 'cod_sala');
    }

    public $timestamps = false;



}
