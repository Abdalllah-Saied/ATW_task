<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use Carbon\Carbon;


class ForceDeleteSoftDeletedPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $softDeletedPosts = Post::onlyTrashed()->where('deleted_at', '<=', $thirtyDaysAgo)->get();
        foreach ($softDeletedPosts as $post) {
            $post->forceDelete();
        }
    }
}
