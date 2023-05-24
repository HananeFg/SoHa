<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Support\Str;
use App\Http\Requests\StoreTablesRequest;
use App\Http\Requests\UpdateTablesRequest;


class TablesController extends Controller
{
    public function __constract()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
        return view("managements.tables.index")->with([
            "tables" => Tables::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("managements.tables.index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTablesRequest $request)
    {
        //validation
        $this->validate($request , [
            "name" => "required|unique:tables,name",
            "name" => "required|boolean"
        ]);
        //store data
        $name = $request->name;
        Tables::create([
            "name" => $name,
            "slug" => Str::slug($name),
            "status" => $request->status
        ]);
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "Table added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tables $tables)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tables $tables)
    {
        //
        return view("managements.tables.index")->with([
            "tables" => $tables
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTablesRequest $request, Tables $tables)
    {
        //
         //validation
         $this->validate($request , [
            "name" => "required|unique:tables,name,".$table->id,
            "name" => "required|boolean"
        ]);
        //update data
        $name = $request->name;
        $tables->update([
            "name" => $name,
            "slug" => Str::slug($name)
        ]);
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "Table modified successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tables $tables)
    {
        //delete table
        $name = $request->name;
        $tables->delete();
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "Table deleted successfully"
        ]);
    }
    
}
