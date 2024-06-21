<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MatecatProvider extends ServiceProvider
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

    const BASE_URL = "https://www.matecat.com/";
    const BASE_API_URL = self::BASE_URL . "api/";

    public function newProject($data, $files)
    {
        $response = Http::withHeaders([
            'x-matecat-key' => config('app.matecat_api_key'),
        ])->asMultipart();

        foreach ($files as $file) {
            $fileName = last(explode('/', $file));
            $readFile = Storage::get($file);
            $response = $response->attach('files[]', $readFile, $fileName);
        }
        $url = self::BASE_API_URL . 'v1/new';
        $response = $response->post(self::BASE_API_URL . 'v1/new', $data);

        return $response->json();
    }

    public function languages()
    {
        $response = Http::get(self::BASE_API_URL . 'v2/languages');
        return $response->json();
    }

    public function projectStatus($idJob, $password)
    {
        $response = Http::get(self::BASE_API_URL . 'status', ['id_project' => $idJob, 'project_pass' => $password]);
        return $response->json();
    }

    public function projectInformation($idJob, $password)
    {
        $response = Http::get(self::BASE_API_URL . 'v2/jobs/' . $idJob . '/' . $password);
        return $response->json();
    }

    public function projectActive($idJob, $password)
    {
        $response = Http::post(self::BASE_API_URL . 'v2/jobs/' . $idJob . '/' . $password . '/active');
        return $response->json();
    }

    public function qualityReport($idJob, $password)
    {
        $response = Http::get(self::BASE_API_URL . 'v2/jobs/' . $idJob . '/' . $password . '/quality-report');
        return $response->json();
    }

    public function translation($idJob, $password)
    {
        $url = self::BASE_URL . 'translation/' . $idJob . '/' . $password;

        sleep(3);

        $response = Http::get($url);

        return $response;
    }
}
