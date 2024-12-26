<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Mentor;
use Illuminate\Http\Request;
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
        $project = Project::where('isActive', 1)->get();
        return Inertia::render('Admin/Project/Index', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $project = Project::all();
        return Inertia::render('Admin/Project/Create', [
            'mentor' => Mentor::all(),
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

            'client_name'           => 'required',
            'team_name'             => 'required',
            'project_number'        => 'required',
            'description'           => 'required|min:5',
        ]);


        // Saving To Database
        $bannerPath = $request->file('banner')->store('project/banner', 'public');

        $project = new Project();

        $project->title                 =   $request->title;

        $project->banner_img            =   $bannerPath;
        $project->client_name           =   $request->client_name;
        $project->team_name             =   $request->team_name;
        $project->slug                  =   Str::slug($request->title).'-'.Str::random(6);
        $project->project_number        =   $request->project_number;

        $project->description           =   $request->description;

        $project->save();


        return redirect()->route('project.index')->with('success','Sukses, anda telah menambahkan data');

        // Project::create([
        //     'title' => $request->title,
        //     'type' => $request->type,
        //     'banner_img' => $fileName,
        //     'start_date' => $request->start_date,
        //     'slug' => Str::slug($request->title).'-'.Str::random(6),
        //     'price' => $request->price,
        //     'description' => $request->description,
        // ]);
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
        $project = Project::with('mentor')->find($id);
        $mentors = Mentor::all();
        return Inertia::render('Admin/Project/Edit', [
            'project' => $project,
            'mentors' => $mentors
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
            'client_name'            => 'required',
            'team_name'              => 'required',
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

        $project->title                  =   $request->title;
        $project->client_name            =   $request->client_name;
        $project->team_name              =   $request->team_name;
        $project->project_number         =   $request->project_number;
        $project->description            =   $request->description;

        if ($request->new_banner !== null) {
            $bannerPath = $request->file('new_banner')->store('project/banner', 'public');
            $project->banner_img             = $bannerPath;
        } else {
            $project->banner_img             = $request->banner;
        }
        $project->save();
        return redirect()->route('project.index')->with('success','Sukses, anda telah mengubah data');
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

            return redirect()->route('project.index')->with('success','Berhasil menghapus kelas');
        } catch (\Throwable $th) {
            return redirect()->route('project.index')->with('error','Terjadi kesalahan');
        }
    }
}
