<?php

namespace App\Jobs;

use App\Providers\MatecatProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Jobs\TranslateMatecatAnalysis;
use App\Jobs\TranslateMatecatStatus;
use Illuminate\Support\Facades\Cache;

class TranslateMatecat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;


    private $id, $hash, $data, $files;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $hash, $data, $files)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->data = $data;
        $this->files = $files;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $config = [];
        $matecat = new MatecatProvider($config);

        $newProject = $matecat->newProject($this->data, $this->files);
        $idProject = $newProject['id_project'];
        $projectPass = $newProject['project_pass'];

        // Check if the jobs have already been dispatched
        $statusJobKey = 'status_job_' . $this->id;
        $analysisJobKey = 'analysis_job_' . $this->id;

        if (!Cache::has($statusJobKey)) {
            TranslateMatecatStatus::dispatchNow($this->id, $this->hash, $idProject, $projectPass);
            Cache::put($statusJobKey, true, now()->addMinutes(10));
        }

        if (!Cache::has($analysisJobKey)) {
            TranslateMatecatAnalysis::dispatchNow($this->id, $this->hash, $idProject, $projectPass);
            Cache::put($analysisJobKey, true, now()->addMinutes(10));
        }
    }
}
