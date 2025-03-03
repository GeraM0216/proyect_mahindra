<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Http\Requests\StoreCurriculumRequest;
use App\Http\Requests\UpdateCurriculumRequest;
use GuzzleHttp\Psr7\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculums = Curriculum::with(['applicant', 'skills', 'predictions', 'jobMatches'])->get();

        return view('curriculums.index', compact('curriculums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurriculumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $curriculum = Curriculum::with(['applicant', 'skills', 'predictions', 'jobMatches'])->findOrFail($id);

        return view('curriculums.show', compact('curriculum')); //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curriculum $curriculums)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurriculumRequest $request, Curriculum $curriculums)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculums)
    {
        //
    }
}
