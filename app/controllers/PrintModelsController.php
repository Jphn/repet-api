<?php

namespace App\Controllers;

use App\Models\PrintModel;

class PrintModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which retrieves all the data (rows)
        | from our model. You can un-comment it to use this
        | example
        |
        */
        response()->json(PrintModel::all()->where('private', '=', false)->where('approved', '=', true));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which deletes a particular row. 
        | You can un-comment it to use this example
        |
        */
        // $row = new PrintModel;
        // $row->column = request()->get('column');
        // $row->delete();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!auth()->user()) {
            return response()->json(auth()->errors(), 401);
        }

        $printModel = PrintModel::find($id);

        if (!$printModel) {
            return response()->json(["error" => "Model not found!"], 404);
        }

        return response()->json($printModel->get(), 202);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        if (!auth()->user()) {
            return response()->json(auth()->errors(), 401);
        }

        $data = request()->validate([
            'name' => 'string|min:3',
            'description' => 'string|text',
            'credits' => 'string|text',
            'private' => 'boolean',
        ]);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()) {
            return response()->json(auth()->errors(), 401);
        }

        $printModel = PrintModel::find($id);

        if (!$printModel) {
            return response()->json(["error" => "Model not found!"], 404);
        }

        if (PrintModel::find($id)->user->id !== auth()->user()->id) {
            return response()->json(["error" => "You don't have permission to delete this model!"], 403);
        }

        $printModel->delete();

        return response()->json(["message" => "Model successfully deleted!"], 202);

    }
}