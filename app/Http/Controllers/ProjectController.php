<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\Team;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::where('isActive', 1)->with(['client', 'team'])->latest()->paginate(100);
        return Inertia::render('Admin/Project/Index', [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $project = Project::all();
        return Inertia::render('Admin/Project/Create', [
            'client' => Client::all(),
            'team' => Team::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                 => 'required|min:5',

            'banner'                => 'required|mimes:jpeg,png,jpg,webp|max:10240',
            'project_number_a'      => 'required',
            'project_number_b'      => 'required',

            'client_id'           => 'required',
            'team_id'             => 'required',
            'description'           => 'required|min:5',
        ]);


        // Saving To Database
        $bannerPath = $request->file('banner')->store('project/banner', 'public');

        $project = new Project();

        $project->project_number         =   $request->project_number_a . '-' . $request->project_number_b;
        $project->title                 =   $request->title;


        $project->banner_img            =   $bannerPath;
        $project->client_id             =   $request->client_id;
        $project->team_id               =   $request->team_id;
        $project->isActive              =   1;
        $project->slug                  =   Str::slug($request->title).'-'.Str::random(6);

        $project->description           =   $request->description;

        $project->save();


        return redirect()->route('project.index')->with('success','Success, you have added data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $projectNow = Project::where('slug', $slug)->first();
        return Inertia::render('Admin/Project/Detail', [
            'project' => $projectNow
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('client', 'team')->find($id);
        $clients = Client::all();
        $teams = Team::all();
        return Inertia::render('Admin/Project/Edit', [
            'project' => $project,
            'clients' => Client::all(),
            'teams' => Team::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'                  => 'required|min:5',
            // 'new_banner'            => 'required|mimes:jpeg,png,jpg,webp|max:10240',
            'client_id'            => 'required',
            'team_id'              => 'required',
            'project_number'         => 'required',
            'description'            => 'required|min:5',

        ]);
        $project = Project::find($id);

        if(isset($request->new_banner)){
            if(isset($project->banner)){
                Storage::delete($project->banner);
            }
            $project->banner_img = $request->file('new_banner')->store('project/banner', 'public');
        } else {
            $project->banner_img = $request->banner;
        }

        $project->project_number         =   $request->project_number_a . ' - ' . $request->project_number_b;
        $project->title                  =   $request->title;
        $project->client_id             =   $request->client_id;
        $project->team_id               =   $request->team_id;
        $project->description            =   $request->description;

        if ($request->new_banner !== null) {
            $bannerPath = $request->file('new_banner')->store('project/banner', 'public');
            $project->banner_img             = $bannerPath;
        } else {
            $project->banner_img             = $request->banner;
        }
        $project->save();
        return redirect()->route('project.index')->with('success','Success Update Project');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $projectNow = Project::find($id);
        // return Inertia::render('Admin/Project/Edit', [
        //     'project' => $projectNow
        // ]);
        try {
            $project = Project::find($id);
            $project->isActive = 0;
            $project->save();

            return redirect()->route('project.index')->with('success','Success deleting data');
        } catch (\Throwable $th) {
            return redirect()->route('project.index')->with('error','Something wrong');
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $searchTerm = $request->input('search');

        FacadesDB::enableQueryLog(); // Mengaktifkan query logging

        $project = Project::query()
            ->where('project_number', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('client', function($query) use ($searchTerm)
            {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->orWhere('title', 'like', '%' . $searchTerm . '%')
            ->orderBy('id', 'desc')
            ->with(['client', 'team'])
            ->latest()
            ->paginate(50);;


        return Inertia::render('Admin/Project/Index', [
            'project' => $project,
        ]);
    }
}
