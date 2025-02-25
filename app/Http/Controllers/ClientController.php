<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Inertia\Inertia;
use Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->paginate(20);
        return Inertia::render('Admin/Client/Index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $project = Project::all();
        return Inertia::render('Admin/Client/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_jp'                 => 'required',
            'name_en'                 => 'required',
        ]);


        // Saving To Database
        // $bannerPath = $request->file('banner')->store('project/banner', 'public');

        $client = new Client();

        $client->name_jp                 =   $request->name_jp;
        $client->name_en       =   $request->name_en;
        $client->slug                 =   Str::slug($request->name).'-'.Str::random(6);
        $client->save();

        return redirect()->route('clients.index')->with('success','Success, you have added data');
    }

    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return Inertia::render('Admin/Client/Edit', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclientRequest $request, $id)
    {
        $client = Client::find($id);

        $client->name_jp         =   $request->name_jp;
        $client->name_en         =   $request->name_en;
        $client->slug         =   Str::slug($request->name).'-'.Str::random(6);
        return dd($request);
        $client->save();

        return redirect()->route('clients.index')->with('success','Success Updating Teams');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $searchTerm = $request->input('search');

        FacadesDB::enableQueryLog(); // Mengaktifkan query logging

        $client = Client::query()
            ->where('name_jp', 'like', '%' . $searchTerm . '%')
            ->orWhere('name_en', 'like', '%' . $searchTerm . '%')
            ->orderBy('id', 'desc')
            ->latest()
            ->paginate(25);;


        return Inertia::render('Admin/Client/Index', [
            'clients' => $client,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        //
    }
}
