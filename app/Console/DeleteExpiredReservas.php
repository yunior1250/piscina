<?php

namespace App\Console;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Console\Command as ConsoleCommand;


class DeleteExpiredReservas extends ConsoleCommand
{
    protected $signature = 'reservas:delete-expired';
    protected $description = 'Delete expired reservas';

    public function handle()
    {
        // Obtiene la fecha y hora actual
        $now = Carbon::now();

        // Busca las reservas que tienen la hora final menor a la fecha y hora actual
        $expiredReservas = Reserva::where('hora_final', '<', $now)->get();

        // Elimina las reservas vencidas
        foreach ($expiredReservas as $reserva) {
            $reserva->delete();
        }

        $this->info('Se han eliminado las reservas vencidas.');
    }
}
