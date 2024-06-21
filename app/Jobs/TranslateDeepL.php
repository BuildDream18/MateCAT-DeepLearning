<?php

namespace App\Jobs;

use App\Models\AiTranslation;
use App\Models\AiTranslationAnalysis;
use App\Models\AiTranslationResult;
use App\Providers\DeepLProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class TranslateDeepL implements ShouldQueue
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
        // $config = [
        //     'key' => '',
        // ];
        $DeepL = new DeepLProvider($this->data);

        $new_glossary = $DeepL->create_glossary($this->data);

        $translate_data = [
            'source_lang' => $this->data['source_lang'],
            'target_lang' => $this->data['target_lang'],
            'glossary_id' => $new_glossary['glossary_id'],
        ];

        $new_translate = $DeepL->translate($translate_data, $this->files);

        $translation = $DeepL->get_document($new_translate['document_id'], $new_translate['document_key']);

        $aiTranslationResult = AiTranslationResult::where('id', $this->id)->where('provider', "deepl")->first();
        $aiTranslation = AiTranslation::where('id', $aiTranslationResult->ai_translation_id)->first();

        $aiTranslationAnalysis = new AiTranslationAnalysis();
        $aiTranslationAnalysis->ai_translation_id = $aiTranslation->id;
        $aiTranslationAnalysis->analysis = json_encode([ "STATUS" => "DONE" ], true);
        $aiTranslationAnalysis->save();

        $aiTranslationResult = AiTranslationResult::where('id', $this->id)->where('provider', "deepl")->first();
        $aiTranslation = AiTranslation::where('id', $aiTranslationResult->ai_translation_id)->first();

        $headers = $translation->headers();

        $contentDisposition = $headers['content-disposition'][0];
        $escapedContentDisposition = addslashes($contentDisposition);

        preg_match('/filename\*?=(?:UTF-8\'\')?([^;\n]+)/', $escapedContentDisposition, $output_array);

        $fileName = $aiTranslation->target_lang."_".$output_array[1];
        $contents = $translation->body();

        $path = $this->hash . "/translation-files/" . $fileName;
        Storage::put($path, $contents);

        $aiTranslationResult->file = $path;
        $aiTranslationResult->status = 'success';
        $aiTranslationResult->save();
    }
}
