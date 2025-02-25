<?php

namespace App\Http\Controllers;

use App\Models\ProjectCode;
use App\Http\Requests\StoreProjectCodeRequest;
use App\Http\Requests\UpdateProjectCodeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDb;
use Inertia\Inertia;

class ProjectCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectCode = ProjectCode::latest()->paginate(25);
        return Inertia::render('Admin/ProjectCode/Index', [
            'projectCode' => $projectCode
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/ProjectCode/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'                 => 'required',
        ]);


        // Saving To Database
        // $bannerPath = $request->file('banner')->store('project/banner', 'public');

        $projectCode = new ProjectCode();

        $projectCode->code                 =   strtoupper($request->code);
        $projectCode->save();

        return redirect()->route('projectCode.index')->with('success','Success, you have added data');
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

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $searchTerm = $request->input('search');

        FacadesDb::enableQueryLog(); // Mengaktifkan query logging

        $projectCode = ProjectCode::query()
            ->where('code', 'like', '%' . $searchTerm . '%')
            ->orderBy('id', 'desc')
            ->latest()
            ->paginate(25);;


        return Inertia::render('Admin/ProjectCode/Index', [
            'projectCode' => $projectCode,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectCode $projectCode)
    {
        //
    }
}
