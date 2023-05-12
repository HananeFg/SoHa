<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTablesRequest;
use App\Http\Requests\UpdateTablesRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    
    
    public function index(Request $request)

    {   
         $role = $request->input('role');
        $users = User::where('role', $role)->get(['name']);
        return view('users', ['users' => $users]);
        

    }
    public function login(Request $request){
       $name = $request->input('name');
       $users = User::where('name', $name)->get(['name']);;
       return view('login', ['users' => $users]);
      
      
   }
   public function username()
{
    return 'name';
}
   

   public function authenticate(LoginRequest $request): RedirectResponse
{
    
     $credentials = $request->validated();
    // $credentials = $request->validated([
    //     'name' => ['required', 'name'],
    //     'password' => ['required'],
    // ]);
    // if 
    

    if(Auth::attempt($credentials))
     {
        // Authentication successful
        $request->session()->regenerate();
        return redirect()->route('home');
        
    } else {
        // Authentication failed
        return redirect()->route('users.login')->withErrors([
            'message' => 'Invalid credentials.',
            
        ]);
    }
 }
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTablesRequest $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
   
}
