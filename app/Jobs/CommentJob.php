<?php

namespace App\Jobs;

use App\Models\Comments;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $commentData;
    protected $userID;

    /**
     * Create a new job instance.
     */
    public function __construct(array $commentData, $id)
    {
        $this->commentData = $commentData;
        $this->userID = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Comments::create([
            'user_id' => Auth::id(),
            'news_id' => $this->commentData['news_id'],
            'comment' => $this->commentData['comment']
        ]);
    }
}
