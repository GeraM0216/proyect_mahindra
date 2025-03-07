<?php

namespace App\Http\Controllers;

use App\Models\Job_match;
use App\Http\Requests\StoreJob_matchRequest;
use App\Http\Requests\UpdateJob_matchRequest;

class Job_MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job_matches=Job_match::all();
        return view('job_matches.index',compact('job_matches'));//
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
    public function store(StoreJob_matchRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job_match $job_match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job_match $job_match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJob_matchRequest $request, Job_match $job_match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job_match $job_match)
    {
        //
    }
}
