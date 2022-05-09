<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;

class PurgeWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Erasing 2 month old data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Weather::whereDate('date', '<=', now()->subMonths(2))->delete();
            $this->info('Deleted');
        } catch (\Exception $e) {
            $this->error('Error occurred '. $e->getMessage());
        }
        return 0;
    }
}
