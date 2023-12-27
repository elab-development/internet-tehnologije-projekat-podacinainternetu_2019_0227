<?php

namespace App\Services;

use Spatie\Dropbox\Client;
use Illuminate\Support\Facades\Log;

class DropBoxService
{
    protected $client;

    public function __construct()
    {
        $token = config('services.dropbox.token');
        Log::info("Dropbox token: " . $token);
        $this->client = new Client($token);
    }

    public function listFiles($path = 'public/files')
    {
        return $this->client->listFolder($path);
    }

    public function downloadFile($path)
    {
        $putanja = 'public/files/'.$path;
        $response = $this->client->download($putanja);
        return [
            'name' => basename($path),
            'contents' => $response
        ];
    }
    

    public function uploadFile($path, $contents)
    {
        return $this->client->upload($path, $contents);
    }

    public function updateFile($path, $newContents)
    {
        $this->deleteFile($path);
        return $this->uploadFile($path, $newContents);
    }

    public function deleteFile($path)
    {
        return $this->client->delete($path);
    }
}
