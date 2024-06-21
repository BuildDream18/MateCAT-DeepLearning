<?php

namespace App\Http\Controllers;

use App\Http\Requests\HireTranslator;
use App\Http\Requests\NewProjectRequest;
use App\Jobs\TranslateMatecat;
use App\Jobs\TranslateDeepL;
use App\Jobs\TranslateMatecatAnalysis;
use App\Models\AiTranslation;
use App\Models\AiTranslationAnalysis;
use App\Models\AiTranslationHire;
use App\Models\AiTranslationResult;
use App\Models\Translator;
use App\Models\MT_model;
use App\Providers\MatecatProvider;
use App\Providers\DeepLProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{

    public function index()
    {
        $config = [
            'key' => '',
        ];
        $mt_models = MT_model::get();
        $matecatProvider = new MatecatProvider($config);
        $Matecat_languages = $matecatProvider->languages();

        $DeepLProvider = new DeepLProvider($config);
        $DeepL_languages = $DeepLProvider->languages();


        return view('ai.new-project', [
            'Matecat_languages' => $Matecat_languages,
            'DeepL_languages' => $DeepL_languages,
            'mt_models' => $mt_models]);
    }

    public function newProject(NewProjectRequest $request)
    {
        $hash = Str::random(50);

        $files = [];
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $contents = $file->getContent();
                $path = $hash . "/" . $name;
                Storage::put($path, $contents);
                $files[] = $path;
            }
        }


        $aiTranslation = new AiTranslation();
        $aiTranslation->hash = $hash;
        $aiTranslation->mtmodel_id = MT_model::select('id')->where('name', $request->input('mt_model'))->first()->id;
        $aiTranslation->project_name = $request->projectName;
        $aiTranslation->source_lang = $request->sourceLang;
        $aiTranslation->target_lang = $request->targetLang;
        $aiTranslation->email = $request->ownerEmail;
        $aiTranslation->files = json_encode($files, true);
        $aiTranslation->save();

        $aiTranslationId = $aiTranslation->id;
        $mt_model_id = $aiTranslation->mtmodel_id;

        //Create aiTranslationResult column

        $aiTranslationResult = new AiTranslationResult();
        $aiTranslationResult->ai_translation_id = $aiTranslationId;
        if($aiTranslation->mtmodel_id === 1){
            $aiTranslationResult->provider = "Matecat";
        } else {
            $aiTranslationResult->provider = "DeepL";
        }

        $aiTranslationResult->save();

        $aiTranslationResultId = $aiTranslationResult->id;

        if($aiTranslation->mtmodel_id === 1)
        {
            $data = [
                'project_name' => $request->projectName,
                'source_lang' => $request->sourceLang,
                'target_lang' => $request->targetLang,
                'tms_engine' => 1,
                'mt_engine' => 1,
                'owner_email' => $request->ownerEmail,
                'get_public_matches' => true,
            ];

            TranslateMatecat::dispatchNow($aiTranslationResultId, $hash, $data, $files);
        } else {
            $data =[
                'source_lang' => $request->sourceLang,
                'target_lang' => $request->targetLang,
                'name' => $request->ownerEmail,
                'entries' => "love\tlove",
                "entries_format" => "tsv",
            ];

            TranslateDeepL::dispatchNow($aiTranslationResultId, $hash, $data, $files);
        }

        return redirect()->route('summary', ['hash' => $hash]);
    }

    public function summary($hash)
    {
        $aiTranslation = AiTranslation::where('hash', $hash)->first();
        $projectName = $aiTranslation->project_name;
        $sourceLang = $aiTranslation->source_lang;
        $targetLang = $aiTranslation->target_lang;
        $mt_model_check = $aiTranslation->mtmodel_id;
        return view('ai.summary', [
            'hash' => $hash,
            'projectName' => $projectName,
            'sourceLang' => $sourceLang,
            'targetLang' => $targetLang,
            'mt_model_check' => $mt_model_check,
        ]);
    }


    public function translationStatus($hash)
    {
        $aiTranslation = AiTranslation::where('hash', $hash)->first();
        $aiTranslationResult = AiTranslationResult::select('file', 'provider')->where('ai_translation_id', $aiTranslation->id)->where('status', 'success')->get();
        return response()->json($aiTranslationResult);
    }


    public function analysis($hash)
    {
        $aiTranslation = AiTranslation::where('hash', $hash)->first();
        $aiTranslationAnalysis = AiTranslationAnalysis::where('ai_translation_id', $aiTranslation->id)->first();
        return response()->json($aiTranslationAnalysis);
    }

    public function downloadFile(Request $request)
    {
        if (Storage::exists($request->file)) {
            return Storage::download($request->file);
        }
        return redirect(route('ai-home'));
    }

    public function hireTranslator($hash)
    {
        $aiTranslation = AiTranslation::where('hash', $hash)->first();
        $projectName = $aiTranslation->project_name;
        $sourceLang = $aiTranslation->source_lang;
        $targetLang = $aiTranslation->target_lang;

        if($aiTranslation->mtmodel_id === 1){
            $translators = Translator::whereJsonContains('languages', [$sourceLang, $targetLang])->get();
        } else {
            $translators = Translator::where(function ($query) use ($sourceLang, $targetLang) {
                $query->where('languages', 'like', '%"'.strtolower($sourceLang).'"%')
                      ->orWhere('languages', 'like', '%"'.strtolower($targetLang).'"%');
            })->get();
        }

        return view('ai.hire-translator', ['hash' => $hash, 'projectName' => $projectName, 'sourceLang' => $sourceLang, 'targetLang' => $targetLang, 'translators' => $translators]);

    }

    public function actionHireTranslator($hash, HireTranslator $request)
    {
        $aiTranslation = AiTranslation::where('hash', $hash)->first();
        $aiTranslationHire = new AiTranslationHire();
        $aiTranslationHire->ai_translation_id = $aiTranslation->id;
        $aiTranslationHire->translator_id = $request->translator_id;
        $aiTranslationHire->save();

        return view('ai.hire-translator-result');

    }

}
