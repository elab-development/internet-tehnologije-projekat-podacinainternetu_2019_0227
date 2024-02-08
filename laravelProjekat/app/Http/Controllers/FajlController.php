<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use Illuminate\Http\Request;
use App\Services\DropBoxService; 

class FajlController extends Controller
{
    protected $dropBox;

    public function __construct(DropBoxService $dropBox)
    {
        $this->dropBox = $dropBox;
    }

    public function index(Request $request)
    {
        $firmaId = $request->input('firmaId');
    
        // Formiramo putanju do foldera za odgovarajuću firmu na Dropboxu
        $folderPath = '/public/' . $firmaId;
    
        // Listamo fajlove iz foldera za odgovarajuću firmu na Dropboxu
        $files = $this->dropBox->listFiles($folderPath);
    
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
        $companyId = $request->input('firmaId');  
    
        if (!$file) {
            return response()->json(['error' => 'Nema fajla za otpremanje.'], 400);
        }
    
        // Formiramo putanju do foldera za firmu na Dropboxu
        $folderPath = '/public/' . $companyId . '/' . $file->getClientOriginalName();

    
        // Čitamo sadržaj fajla
        $contents = file_get_contents($file->getRealPath());
    
        // Uploadujemo fajl na Dropbox
        $result = $this->dropBox->uploadFile($folderPath, $contents);
    
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


 
    public function statistics()
    {
        // Ukupan broj firmi
        $totalCompanies = Firma::count();
    
        // Ukupan broj zaposlenih po svakoj firmi
        $companiesWithEmployees = Firma::withCount('zaposleni')->get(['naziv', 'zaposleni_count']);
    
        $results = [];

        // Iteriramo kroz sve firme i dodajemo ih u rezultate
        foreach ($companiesWithEmployees as $company) {
            $results[] = [
                'naziv' => $company->naziv,
                'broj_zaposlenih' => $company->zaposleni_count
            ];
        }



        // Ukupan broj fajlova za svaku firmu
         // Dohvati sve firme iz baze
        $companies = Firma::all();
  
        // Inicijalizujemo prazan niz za čuvanje broja fajlova po firmi
        $filesPerCompany = [];

        // Iteriramo kroz sve firme
        foreach ($companies as $company) {
            try {
                // Formiramo putanju do foldera za odgovarajuću firmu na Dropboxu
                $folderPath = '/public/' . $company->id;
                
                // Listamo fajlove iz foldera za odgovarajuću firmu na Dropboxu
                $files = $this->dropBox->listFiles($folderPath);
                
                // Broj fajlova za firmu
                $numberOfFiles = count($files);
            } catch (\Spatie\Dropbox\Exceptions\BadRequest $exception) {
                // Ako putanja nije pronađena, postavljamo broj fajlova na nulu
                $numberOfFiles = 0;
            }
        
            // Dodajemo broj fajlova u niz
            $filesPerCompany[$company->naziv] = $numberOfFiles;
        }
        
        
    
        return response()->json([
            'total_companies' => $totalCompanies,
            'employees_per_company' => $results,
            'files_per_company' => $filesPerCompany
        ]);
    }
    

    
}
