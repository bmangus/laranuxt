<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Adapter\Local;
use Exception;


class ExperienceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Experience::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        try {
            Experience::firstOrCreate($validated);
        } catch (Exception $e) {
            Log::info('Experience model updated failed: ' . $e->getMessage());
            return response('failed', 500);
        }
        return response('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $record = Experience::find($id);
        } catch (Exception $e) {
            Log::info('Experience model not found by id:  '  .  $e->getMessage());
            return response('failed', 500);
        }
        return response($record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        return response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'description' => 'required'
        ]);

        try {
            Experience::updateOrCreate(['id' => $id], $validated);
        } catch (Exception $e) {
            Log::info('Experience model updated failed: ' . $e->getMessage());
            return response('failed', 500);
        }
        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Experience::destroy($id);
        } catch (ModelNotFoundException $e) {
            Log::info('Experience model delete attempt failed: ' . $e->getMessage());
            return response('failed', 500);
        }
        return response('success', 200);
    }
}
