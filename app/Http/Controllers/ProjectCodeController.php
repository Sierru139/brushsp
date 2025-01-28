<?php

namespace App\Http\Controllers;

use App\Models\ProjectCode;
use App\Http\Requests\StoreProjectCodeRequest;
use App\Http\Requests\UpdateProjectCodeRequest;
use Inertia\Inertia;

class ProjectCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectCode = ProjectCode::latest()->paginate(10);
        return Inertia::render('Admin/ProjectCode/Index', [
            'teams' => $projectCode
        ]);
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
    public function store(StoreProjectCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectCode $projectCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectCode $projectCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectCodeRequest $request, ProjectCode $projectCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectCode $projectCode)
    {
        //
    }
}
