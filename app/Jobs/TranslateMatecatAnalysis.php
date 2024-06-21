<?php

namespace App\Jobs;

use App\Models\AiTranslation;
use App\Models\AiTranslationAnalysis;
use App\Models\AiTranslationResult;
use App\Providers\MatecatProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TranslateMatecatAnalysis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id, $hash, $idProject, $projectPass;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $hash, $idProject, $projectPass)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->idProject = $idProject;
        $this->projectPass = $projectPass;
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
        $projectStatus = $matecat->projectStatus($this->idProject, $this->projectPass);

        $aiTranslationResult = AiTranslationResult::where('id', $this->id)->where('provider', "matecat")->first();
        $aiTranslation = AiTranslation::where('id', $aiTranslationResult->ai_translation_id)->first();


        $aiTranslationAnalysis = new AiTranslationAnalysis();
        $aiTranslationAnalysis->ai_translation_id = $aiTranslation->id;
        $aiTranslationAnalysis->analysis = json_encode($projectStatus["data"]["summary"], true);
        $aiTranslationAnalysis->save();
    }
}
