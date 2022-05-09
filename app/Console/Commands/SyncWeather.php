<?php

namespace App\Console\Commands;

use App\Events\NoWeatherFound;
use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SyncWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronous weather forecast with api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //remove today's record
        Weather::whereDate('date', Carbon::now())->delete();
        NoWeatherFound::dispatch();
        $this->info('Fetching data asynchronously');
        return true;
    }
}
