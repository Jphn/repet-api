<?php

namespace App\Controllers;

use App\Models\PrintModel;

class PrintModelsController extends Controller
{
    public function index()
    {
        response()->json(
            PrintModel::all()
                ->where('private', '=', false)
                ->where('approved', '=', true)
                ->values()
        );
    }

    public function store()
    {
        if (!$data = request()->validate([
            'name' => 'string|min:3',
            'description' => 'string',
            'credits' => 'string',
            'private' => 'optional|boolean'
        ])) return response()->json(request()->errors(), 401);

        $printModel = new PrintModel($data);
        $printModel->generateFolderName();
        $printModel->user_id = auth()->user()->id;

        if (!file_exists(AppPaths('printModels')))
            mkdir(AppPaths('printModels'));

        if (!mkdir(AppPaths('printModels') . "/$printModel->folder"))
            return response()->json(['error' => 'For some reason, folder already exists.'], 501);


        if (!$printModel->save())
            return response()->json(['message' => 'An error occurred while trying to save the model.'], 501);

        return response()->json($printModel->toArray(), 201);
    }

    public function uploadImages($id)
    {
        dd(
            request()->files(),
        );
    }

    // public function uploadFiles($id) {}

    public function show($id)
    {
        $printModel = PrintModel::find($id);

        if (!$printModel || ($printModel->private && $printModel->user->id !== auth()->user()->id)) {
            return response()->json(["error" => "Model not found!"], 404);
        }

        return response()->json($printModel, 200);
    }

    public function update($id)
    {
        if (!$data = request()->validate([
            'name' => 'string|min:3',
            'description' => 'string|text',
            'credits' => 'string|text',
            'private' => 'optional|boolean'
        ])) return response()->json(request()->errors(), 401);

        $printModel = PrintModel::find($id);

        if (!$printModel) {
            return response()->json(["error" => "Model not found!"], 404);
        }

        if ($printModel->user_id !== auth()->user()->id) {
            return response()->json(["error" => "You don't have permission to edit this model!"], 403);
        }

        $printModel->update($data);

        return response()->json($printModel, 202);
    }

    public function destroy($id)
    {
        $printModel = PrintModel::find($id);

        if (!$printModel) {
            return response()->json(["error" => "Model not found!"], 404);
        }

        if (PrintModel::find($id)->user->id !== auth()->user()->id) {
            return response()->json(["error" => "You don't have permission to delete this model!"], 403);
        }

        $printModel->delete();

        return response()->json([], 204);
    }
}
