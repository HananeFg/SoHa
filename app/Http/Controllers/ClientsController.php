<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientsRequest;
use App\Http\Requests\UpdateClientsRequest;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("managements.clients.index")->with([
            "clients" => Clients::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("managements.clients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validData = $request->validate([
            'name' => 'required|unique:clients,name',
            'email' => 'required|unique:clients,email',
            'tel' => 'required|unique:clients,tel',
            'address' => 'required',
        ]);
        
        // Create a new table instance
        $client = new Clients();
        $client->name = $validData['name'];
        $client->email = $validData['email'];
        $client->tel = $validData['tel'];
        $client->address = $validData['address'];
        // save instance
        $client->save();
        // Clear the form input fields
        $request->session()->flash('success', 'added successfully');
        // Redirect back to the form with an empty form
        return redirect()->route('clients.index');
             
    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $client)
    {
        //
        return view("managements.clients.edit")->with([
            "client" => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $client)
    {
        //
        $clients = Clients::find($client);

        $validData = $request->validate([
            'name' => 'required|',
            'email' => 'required|',
            'tel' => 'required|',
            'address' => 'required',
        ]);

        $clients->update([
            "name" => $validData['name'],
            "email" => $validData['email'],
            "tel" => $validData['tel'],
            "address" => $validData['address'],
        ]);
        
        $request->session()->flash('success', 'updated successfully');
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $client = $request->client;
    
        //delete table
        $clients = Clients::find($client);
        $clients->delete();
    
        //redirect user
        return redirect()->route("clients.index")->with([
            "success" => "deleted successfully"
        ]);
    }
}
