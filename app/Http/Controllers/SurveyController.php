<?php

namespace App\Http\Controllers;

use App\Models\survey;
use App\Http\Requests\StoresurveyRequest;
use App\Http\Requests\UpdatesurveyRequest;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresurveyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesurveyRequest $request, survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(survey $survey)
    {
        //
    }
}
