<?php

namespace UDF\Http\Controllers;


use UDF\Reserva;
use UDF\Sala;

class IndexController extends Controller
{
    public function index()
    {
        $dia = date('N') + 1;
        $arrayParametros = array(
            'dashboard' => array(
                array(
                    'dsc_disponiveis' => 'Salas Disponiveis (Manhã)',
                    'qtd_disponiveis1' => Sala::pegaSalasDisponiveisPorDia('MANHÃ', 1) - Reserva::pegaReservasDoDia('MANHÃ', 1),
                    'qtd_disponiveis2' => Sala::pegaSalasDisponiveisPorDia('MANHÃ', 2) - Reserva::pegaReservasDoDia('MANHÃ', 2),
                    'dsc_reservadas' => 'Salas Reservadas (Manhã)',
                    'qtd_reservadas1' => Reserva::pegaReservasDoDia('MANHÃ', 1),
                    'qtd_reservadas2' => Reserva::pegaReservasDoDia('MANHÃ', 2),
                ),
                array(
                    'dsc_disponiveis' => 'Salas Disponiveis (Tarde)',
                    'qtd_disponiveis1' => Sala::pegaSalasDisponiveisPorDia('Tarde', 1) - Reserva::pegaReservasDoDia('Tarde', 1),
                    'qtd_disponiveis2' => Sala::pegaSalasDisponiveisPorDia('Tarde', 2) - Reserva::pegaReservasDoDia('Tarde', 2),
                    'dsc_reservadas' => 'Salas Reservadas (Tarde)',
                    'qtd_reservadas1' => Reserva::pegaReservasDoDia('Tarde', 1),
                    'qtd_reservadas2' => Reserva::pegaReservasDoDia('Tarde', 2),
                ),
                array(
                    'dsc_disponiveis' => 'Salas Disponiveis (Noite)',
                    'qtd_disponiveis1' => Sala::pegaSalasDisponiveisPorDia('Noite', 1) - Reserva::pegaReservasDoDia('Noite', 1),
                    'qtd_disponiveis2' => Sala::pegaSalasDisponiveisPorDia('Noite', 2) - Reserva::pegaReservasDoDia('Noite', 2),
                    'dsc_reservadas' => 'Salas Reservadas (Noite)',
                    'qtd_reservadas1' => Reserva::pegaReservasDoDia('Noite', 1),
                    'qtd_reservadas2' => Reserva::pegaReservasDoDia('Noite', 2),
                ),
            ),
            'dia' => ($dia == 7) ? 'S' : $dia
        );

        return view('index', $arrayParametros);
    }

}

