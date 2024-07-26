<?php

namespace App\Console;

use App\Jobs\ProcessVideoChunk;
use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $pendingVideo = Post::where('status', 'processing')->first();

        if ($pendingVideo) {
            $id =  $pendingVideo->id;

            $videoPath = 'videos/' . $pendingVideo->temporary_video;

            $fileName = $pendingVideo->temporary_video;

            $schedule->job(new ProcessVideoChunk($videoPath, $fileName, $id))->everyMinute();
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
