<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DeepLProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    const BASE_URL = "https://api-free.deepl.com/v2";
    // const BASE_API_URL = self::BASE_URL . "api/";
    public function languages(){
        $authKey = config('app.deepl_authkey');

        $response = Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $authKey,
        ]);

        $response = $response->get(self::BASE_URL . "/languages?type=target");

        return $response->json();
    }

    public function create_glossary($data) {
        $authKey = config('app.deepl_authkey');
        $response = Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $authKey,
        ]);

        $response = $response->post(self::BASE_URL . "/glossaries", $data);

        Log::info('glossary check', [
            'data'=> $data,
            'key' => $authKey,
            'res' => $response,
        ]);

        return $response->json();
    }

    public function translate($data, $files)
    {
        $authKey = config('app.deepl_authkey');
        $response = Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $authKey,
        ])->asMultipart();

        foreach ($files as $file) {
            $fileName = last(explode('/', $file));
            $readFile = Storage::get($file);
            $response = $response->attach('file[]', $readFile, $fileName);
        }
        $url = self::BASE_URL . '/document';
        $response = $response->post($url, $data);

        return $response->json();
    }

    public function get_document($document_id, $document_key)
    {
        $authKey = config('app.deepl_authkey');
        $response = Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $authKey,
        ]);

        $response = $response->post(self::BASE_URL . "/document/" . $document_id . "/result", [
            'document_key' => $document_key
        ]);

        // Check if the response contains the "Document translation is not done" message
        $responseBody = $response->body();
        if ($responseBody === "{\"message\":\"Document translation is not done\"}") {
            // If the message is present, wait for 1 second and retry the POST request
            sleep(2);
            $response = $this->get_document($document_id, $document_key);
        }

        return $response;
    }
}
