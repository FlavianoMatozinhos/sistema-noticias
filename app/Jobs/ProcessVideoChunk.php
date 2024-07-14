<?php

namespace App\Jobs;

use App\Models\Post;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ProcessVideoChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileName;
    protected $videoPath;
    protected $postId;

    public function __construct($videoPath, $fileName, $postId)
    {
        $this->videoPath = $videoPath;
        $this->fileName = $fileName;
        $this->postId = $postId;
    }

    public function handle()
    {
        $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);

        $post = Post::find($this->postId);

        FFMpeg::fromDisk('public')
            ->open($this->videoPath)
            ->exportForHLS()
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->save("videos/" . $this->fileName . ".m3u8");

        $post->update([
            'status' => 'completed',
            'temporary_video' => "",
        ]);
    }
}