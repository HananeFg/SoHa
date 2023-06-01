<?php

namespace App\Http\Controllers;

use App\Models\Serveurs;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServeursRequest;
use App\Http\Requests\UpdateServeursRequest;

class ServeursController extends Controller
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
        //
        return view("managements.serveurs.index")->with([
            "serveurs" => Serveurs::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("managements.serveurs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Serveurs $serveurs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serveurs $serveurs)
    {
        //
        return view("managements.serveurs.edit")->with([
            "serveur" => $serveurs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServeursRequest $request, Serveurs $serveurs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serveurs $serveurs)
    {
        //
    }
}
