<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class IncrementField implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $articleId;
    protected $field;

    /**
     * Create a new job instance.
     */
    public function __construct($articleId, $field)
    {
        $this->articleId = $articleId;
        $this->field = $field;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Article::where('id', $this->articleId)->increment($this->field);
    }
}
