<?php

namespace App\Jobs;

use App\Models\AiTranslation;
use App\Models\AiTranslationResult;
use App\Providers\MatecatProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TranslateMatecatStatus implements ShouldQueue
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

        $aiTranslationResult = AiTranslationResult::where('id', $this->id)->where('provider', "matecat")->first();
        $aiTranslation = AiTranslation::where('id', $aiTranslationResult->ai_translation_id)->first();

        $config = [];
        $matecat = new MatecatProvider($config);
        $projectStatus = $matecat->projectStatus($this->idProject, $this->projectPass);
        $job = explode('-', key($projectStatus['jobs']['langpairs']));

        $matecatProvider = new MatecatProvider($config);
        $idJob = $job[0];
        $password = $job[1];
        $translation = $matecatProvider->translation($idJob, $password);

        $headers = $translation->headers();

        preg_match('/attachment; .*?filename="(.+?)"/', $headers['Content-Disposition'][0], $output_array);

        // $fileName = $aiTranslation->target_lang."_".$output_array[1];
        $fileName = $aiTranslation->target_lang."_".$output_array[1];
        $contents = $translation->body();

        $path = $this->hash . "/translation-files/" . $fileName;
        Storage::put($path, $contents);

        $aiTranslationResult->file = $path;
        $aiTranslationResult->status = 'success';
        $aiTranslationResult->save();
    }
}
