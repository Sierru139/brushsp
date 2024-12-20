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
            'schedule_img'          => 'required|mimes:jpeg,png,jpg,webp|max:10240',
            'photos1'               => 'nullable|mimes:jpeg,png,jpg,webp|max:10240',
            'photos2'               => 'nullable|mimes:jpeg,png,jpg,webp|max:10240',
            'photos3'               => 'nullable|mimes:jpeg,png,jpg,webp|max:10240',
            'photos4'               => 'nullable|mimes:jpeg,png,jpg,webp|max:10240',


            'start_date'            => 'required',
            'times_of_meeting'      => 'required',
            'duration_of_meeting'   => 'required',
            'description'           => 'required|min:5',

            'mentor_id'             =>   'nullable|exists:mentors,id',
            'mentor_name'           => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
            'mentor_profile'        => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
            'mentor_job'            => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
            'mentor_profile_img'    => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
        ]);


        // Saving To Database
        $bannerPath = $request->file('banner')->store('project/banner', 'public');
        $schedulePath = $request->file('schedule_img')->store('project/schedule', 'public');

        // Photos
        $photos1path = '';
        if ($request->hasFile('photos1')) {
            $photos1path = $request->file('photos1')->store('project/photos', 'public');
        }
        $photos2path = '';
        if ($request->hasFile('photos2')) {
            $photos2path = $request->file('photos2')->store('project/photos', 'public');
        }
        $photos3path = '';
        if ($request->hasFile('photos3')) {
            $photos3path = $request->file('photos3')->store('project/photos', 'public');
        }
        $photos4path = '';
        if ($request->hasFile('photos4')) {
            $photos4path = $request->file('photos4')->store('project/photos', 'public');
        }


        $project = new Project();

        if ($request->mentor_name !== '') {
            $mentor = new Mentor();
            $mentorPath = $request->file('mentor_profile_img')->store('mentor/profile-photos', 'public');

            $mentor->name        =   $request->mentor_name;
            $mentor->profile     =   $request->mentor_profile;
            $mentor->job         =   $request->mentor_job;
            $mentor->profile_img =   $mentorPath;
            $mentor->fb_link     =   $request->mentor_fb;
            $mentor->ig_link     =   $request->mentor_ig;
            $mentor->twt_link    =   $request->mentor_twt;
            $mentor->save();
            $request->merge(['mentor_id' => $mentor->id]);
        }

        $project->title                  =   $request->title;

        $project->banner_img             =   $bannerPath;

        $project->start_date             =   $request->start_date;
        $project->end_date               =   $request->start_date;
        $project->times_of_meeting       =   $request->times_of_meeting;
        $project->duration_of_meeting    =   $request->duration_of_meeting;
        $project->schedule_img           =   $schedulePath;

        $project->price                  =   $request->price;
        $project->last_price             =   $request->last_price;

        $project->tools                  =   $request->tools;
        $project->location               =   $request->location;
        $project->facility               =   $request->facility;
        $project->benefit                =   $request->benefit;
        $project->registration_link      =   $request->registration_link;

        $project->photos1                =   $photos1path;
        $project->photos2                =   $photos2path;
        $project->photos3                =   $photos3path;
        $project->photos4                =   $photos4path;

        $project->mentor_id              =   $request->mentor_id;

        $project->slug                   =   Str::slug($request->title).'-'.Str::random(6);

        $project->description            =   $request->description;

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
        $projectNow = Project::with('mentor')->where('slug', $slug)->first();
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
            'title'                 => 'required|min:5',
            // 'new_banner'            => 'required|mimes:jpeg,png,jpg,webp|max:10240',
            'start_date'            => 'required',
            'times_of_meeting'      => 'required',
            'duration_of_meeting'   => 'required',
            'description'           => 'required|min:5',

            'mentor_id'             => 'nullable|exists:mentors,id',
            'new_mentor_name'           => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
            'new_mentor_profile'        => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
            'new_mentor_job'            => Rule::requiredIf(function() use ($request){
                return !$request->has('mentor_id');
            }),
        ]);
        $project = Project::find($id);

        if(isset($request->new_photos1)){
            if(isset($project->photos1)){
                Storage::delete($project->photos1);
            }
            $project->photos1 = $request->file('new_photos1')->store('project/photos', 'public');
        } else {
            $project->photos1 = $request->photos1;
        }

        if(isset($request->new_photos2)){
            if(isset($project->photos2)){
                Storage::delete($project->photos2);
            }
            $project->photos2 = $request->file('new_photos2')->store('project/photos', 'public');
        } else {
            $project->photos2 = $request->photos2;
        }

        if(isset($request->new_photos3)){
            if(isset($project->photos3)){
                Storage::delete($project->photos3);
            }
            $project->photos3 = $request->file('new_photos3')->store('project/photos', 'public');
        } else {
            $project->photos3 = $request->photos3;
        }

        if(isset($request->new_photos4)){
            if(isset($project->photos4)){
                Storage::delete($project->photos4);
            }
            $project->photos4 = $request->file('new_photos4')->store('project/photos', 'public');
        } else {
            $project->photos4 = $request->photos4;
        }

        if(isset($request->new_schedule_img)){
            if(isset($project->schedule_img)){
                Storage::delete($project->schedule_img);
            }
            $project->schedule_img = $request->file('new_schedule_img')->store('project/schedule', 'public');
        } else {
            $project->schedule_img = $request->schedule_img;
        }

        if(isset($request->new_banner)){
            if(isset($project->banner)){
                Storage::delete($project->banner);
            }
            $project->banner_img = $request->file('new_banner')->store('project/banner', 'public');
        } else {
            $project->banner_img = $request->banner;
        }

        $project->title                  =   $request->title;

        $project->start_date             =   $request->start_date;
        $project->end_date               =   $request->start_date;
        $project->times_of_meeting       =   $request->times_of_meeting;
        $project->duration_of_meeting    =   $request->duration_of_meeting;
        $project->price                  =   $request->price;
        $project->last_price             =   $request->last_price;

        $project->tools                  =   $request->tools;
        $project->location               =   $request->location;
        $project->facility               =   $request->facility;
        $project->benefit                =   $request->benefit;
        $project->registration_link      =   $request->registration_link;
        $project->description            =   $request->description;

        if ($request->new_banner !== null) {
            $bannerPath = $request->file('new_banner')->store('project/banner', 'public');
            $project->banner_img             = $bannerPath;
        } else {
            $project->banner_img             = $request->banner;
        }

        // Jika user membuat mentor baru
        if ($request->new_mentor_name !== null && $request->new_mentor_profile !== null && $request->new_mentor_job !== null) {
            $mentor = new Mentor();
            if(isset($mentor->profile_img)){
                Storage::delete($mentor->profile_img);
            }
            $mentorFile = $request->file('photos4')->store('project/photos', 'public');
            $mentor->name                   =   $request->new_mentor_name;
            $mentor->profile                =   $request->new_mentor_profile;
            $mentor->job                    =   $request->new_mentor_job;
            $mentor->profile_img            =   $mentorFile;
            $mentor->fb_link                =   $request->new_mentor_fb;
            $mentor->ig_link                =   $request->new_mentor_ig;
            $mentor->twt_link               =   $request->new_mentor_twt;
            $mentor->save();
            $request->merge(['mentor_id' => $mentor->id]);
            $project->mentor_id              =   $mentor->id;
        } else { // Jika user tidak membuat mentor baru maka akan memasukkan request lama
            $project->mentor_id              =   $request->mentor_id;
            $mentor = Mentor::find($request->mentor_id);
            if ($mentor->id != $project->mentor_id) { // ini jika mentor_id di project tidak sama dengan mentor_id di request
                $mentor->name                   =   $request->mentor_name;
                $mentor->profile                =   $request->mentor_profile;
                $mentor->job                    =   $request->mentor_job;
                $mentor->profile_img            =   $request->mentor_profile_img;
                $mentor->fb_link                =   $request->mentor_fb_link;
                $mentor->ig_link                =   $request->mentor_ig_link;
                $mentor->twt_link               =   $request->mentor_twt_link;
                $mentor->save();
            }
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
