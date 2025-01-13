<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use Illuminate\Http\Request;
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
            'name'                 => 'required|min:3',
        ]);


        // Saving To Database
        // $bannerPath = $request->file('banner')->store('project/banner', 'public');

        $client = new Client();

        $client->name                 =   $request->name;
        $client->related_person       =   $request->related_person;
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
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclientRequest $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        //
    }
}
