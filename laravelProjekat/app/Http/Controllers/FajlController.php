<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DropBoxService; 

class FajlController extends Controller
{
    protected $dropBox;

    public function __construct(DropBoxService $dropBox)
    {
        $this->dropBox = $dropBox;
    }

    public function index()
    {
        $files = $this->dropBox->listFiles();
        return response()->json($files);
    }

    public function download(Request $request)
    {
        $path = $request->get('path');  
    
        if (!$path) {
            return response()->json(['error' => 'Path parameter is required.'], 400);
        }
    
        $fileData = $this->dropBox->downloadFile($path);
    
        return response()->streamDownload(function() use ($fileData) {
            echo $fileData['contents'];
        }, $fileData['name']);
    }
    
    

    public function upload(Request $request)
    {
        $file = $request->file('file');

        if (!$file) {
            return response()->json(['error' => 'Nema fajla za otpremanje.'], 400);
        }

        $path = '/public/files/' . $file->getClientOriginalName();
        $contents = file_get_contents($file->getRealPath());

        $result = $this->dropBox->uploadFile($path, $contents);

        return response()->json($result);
    }

    public function update(Request $request, $fileId)
    {
        $newFile = $request->file('file');
        $result = $this->dropBox->updateFile($fileId, $newFile);

        return response()->json($result);
    }

    public function destroy($fileId)
    {
        $this->dropBox->deleteFile($fileId);
        return response()->json(['message' => 'Fajl obrisan']);
    }
}
