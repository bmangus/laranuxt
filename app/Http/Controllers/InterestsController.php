<?php

namespace App\Http\Controllers;

use App\Models\Interests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class InterestsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Interests::all());
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
            'description' => 'required',
            'user_id' => 'required',
        ]);

        try {
            Interests::firstOrCreate($validated);
        } catch (Exception $e) {
            Log::info('Interests model updated failed: ' . $e->getMessage());
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
            $record = Interests::find($id);
        } catch (Exception $e) {
            Log::info('Interests model not found by id:  '  .  $e->getMessage());
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
    public function edit(Interests $interests)
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
            'description' => 'required',
        ]);

        try {
            Interests::updateOrCreate(['id' => $id], $validated);
        } catch (Exception $e) {
            Log::info('Interests model updated failed: ' . $e->getMessage());
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
            Interests::destroy($id);
        } catch (ModelNotFoundException $e) {
            Log::info('Interests model delete attempt failed: ' . $e->getMessage());
            return response('failed', 500);
        }
        return response('success', 200);
    }
}
