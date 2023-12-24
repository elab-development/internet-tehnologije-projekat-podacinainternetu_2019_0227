<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index() //GET
    {
        $sviTaskovi = Task::all();
        return TaskResource::collection($sviTaskovi);
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
