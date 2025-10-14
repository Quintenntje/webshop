<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-weekly-newsletter')
            ->weeklyOn(1, '09:00')
            ->timezone('Europe/Brussels'); 
    }
}