<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Services\GoogleSheetService;
use App\Models\TextRow;

class Kernel extends ConsoleKernel
{
    /**
     * Laravel ishga tushganda chaqiriladigan komandalar
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Jadvalga asoslangan ishlar (scheduler)
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $sheet = new \App\Services\GoogleSheetService();

            $rows = \App\Models\TextRow::allowed()->get()->map(function ($item) {
                return [
                    $item->id,
                    $item->text,
                    $item->status,
                ];
            })->toArray();

            $sheet->write($rows);
        })->everyMinute();
    }

    
}