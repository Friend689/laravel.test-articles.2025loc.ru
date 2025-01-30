<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ProcessComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $articleId;
    protected $commentData;

    /**
     * Create a new job instance.
     */
    public function __construct($articleId, $commentData)
    {
        $this->articleId = $articleId;
        $this->commentData = $commentData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $article = Article::find($this->articleId);
        $article->comments()->create($this->commentData);
    }
}
