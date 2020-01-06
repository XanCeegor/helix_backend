<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Upload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //schedule to delete files older than 2 days
        $schedule->call(function () {
            $upload = Upload::where('created_at', '<=', Carbon::now()->subDays(2)->toDateTimeString())->get(); //get list of uploads older than 2 days
            foreach ($upload->files as $file) {
                Storage::delete($file->path . '.enc');   //delete all the files for this upload.
                $file->delete();    //delete each record of each file for this upload
            }
            $upload->delete();  //delete the upload record
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
