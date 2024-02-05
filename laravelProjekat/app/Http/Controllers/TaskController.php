<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()  //prepravljena metoda tako da umesto svih vraca samo tastkove ulogovanog korisnika, pa ne moramo da radimo filtiranje na frontu
    {
        // Provera da li je korisnik autentifikovan
        if (Auth::check()) {
            // Dohvati trenutno ulogovanog korisnika
            $user = Auth::user(); 
            
            // Dohvati sve zadatke povezane sa trenutno ulogovanim korisnikom
            $userTasks = Task::where('zaposleni_id', $user->id)
            ->select('id', 'naziv', 'opis', 'rok', 'status')
            ->get();
    
            // Vrati zadatke kao TaskResource kolekciju
            return TaskResource::collection($userTasks);
        } else {
            // Ako korisnik nije autentifikovan, možete vratiti odgovarajući odgovor ili poruku
            return response()->json(['message' => 'Niste autentifikovani.'], 401);
        }
    }

    public function store(Request $request)  
    {
        $validator = Validator::make($request->all(), [
            'zaposleni_id' => 'required|exists:users,id',
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'rok' => 'required|date',
            'status' => 'required|in:zavrseno,otkazano,u izradi',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $task = Task::create($request->all());
        return response()->json(['message' => 'Task uspešno kreiran', 'task' => new TaskResource($task)], 201);
    }

    public function show($id) //GET
    {
        $task = Task::find($id);
        if ($task) {
            return response()->json($task);
        }
        return response()->json(['error' => 'Task nije pronađen'], 404);
    }

    public function update(Request $request, $id) //PUT
    {
        $task = Task::find($id);
        if ($task) {
            $validator = Validator::make($request->all(), [
                'zaposleni_id' => 'required|exists:users,id',
                'naziv' => 'required|string|max:255',
                'opis' => 'nullable|string',
                'rok' => 'required|date',
                'status' => 'required|in:zavrseno,otkazano,u izradi',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $task->update($request->all());
            return response()->json(['message' => 'Task uspešno ažuriran', 'task' => new TaskResource($task)], 200);
        } else {
            return response()->json(['error' => 'Task nije pronađen'], 404);
        }
    }

    public function destroy($id) //DELETE
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return response()->json(['message' => 'Task obrisan'], 200);
        } else {
            return response()->json(['error' => 'Task nije pronađen'], 404);
        }
    }
}
