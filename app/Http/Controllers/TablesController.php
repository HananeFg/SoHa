<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTablesRequest;
use App\Http\Requests\UpdateTablesRequest;


class TablesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("auth");
    // }
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
        return view("managements.tables.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validData = $request->validate([
            'name' => 'required|unique:tables,name',
            'status' => 'required|boolean',
        ]);
        // Create a new table instance
        $table = new Tables();
        $table->name = $validData['name'];
        $table->slug = $validData['name'];
        $table->status = $validData['status'];
        // save instance
        $table->save();

        //store data
        // $name = $request->name;
        // Tables::create([
        //     "name" => $name,
        //     "slug" => Str::slug($name),
        //     "status" => $request->status
        // ]);

        //redirect user
        // return redirect()->route("tables.index")->with([
        //     "success" => "Table added successfully"
        // ]);
             // Clear the form input fields
             $request->session()->flash('success', 'Talbe added successfully');
        
             // Redirect back to the form with an empty form
             return redirect()->route('tables.index');
             
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
        return view("managements.tables.edit")->with([
            "tables" => $tables
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Tables $tables)
    // {
    //     //
    //      //validation
    //     //  $this->validate($request , [
    //     //     "name" => "required|unique:tables,name,".$tables->id,
    //     //     "name" => "required|boolean"
    //     // ]);
    //     // //update data
    //     // $name = $request->name;
    //     // $tables->update([
    //     //     "name" => $name,
    //     //     "slug" => Str::slug($name)
    //     // ]);
    //     $validData = $request->validate([
    //         'name' => 'required|unique:tables,name,'.$tables->id,
    //         'status' => 'required|boolean',
    //     ]);
    //     // Create a new table instance
    //     $table = Tables::find($tables->id);
    //     $table->name = $validData['name'];
    //     $table->slug = $validData['name'];
    //     $table->status = $validData['status'];
    //     // save instance
    //     $table->save();
    //     //redirect user
    //     // return redirect()->route("tables.index")->with([
    //     //     "success" => "Table modified successfully"
    //     // ]);
    //       // Clear the form input fields
    //       $request->session()->flash('success', 'Table added successfully');
        
    //       // Redirect back to the form with an empty form
    //       return redirect()->route('tables.index');
    // }
    public function update(Request $request)
    {   
        $table = $request->table;
        $table = Tables::find($request->table);
    
        $validData = $request->validate([
            'name' => 'required|unique:tables,name,'.$table->id,
            'status' => 'required|boolean',
        ]);
    
        $table->name = $validData['name'];
        $table->slug = Str::slug($validData['name']);
        $table->status = $validData['status'];
        $table->save();
    
        $request->session()->flash('success', 'Table updated successfully');
        return redirect()->route('tables.index');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $table = $request->table;
    
        //delete table
        $tables = Tables::find($table);
        $tables->delete();
    
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "Table deleted successfully"
        ]);
    }
    
    
}
