<?php

namespace App\Jobs;

use App\Models\MCQ;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportMCQJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $mcqs = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $mcqs)
    {
        $this->mcqs = $mcqs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        MCQ::insert($this->mcqs);
    }
}
