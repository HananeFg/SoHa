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
    // public function __construct()
    // {
    //     $this->middleware("auth");
    // }
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
            return redirect()->route('commandList');
            
        } else {
            // Authentication failed
            return redirect()->route('users.login')->withErrors([
                'message' => 'Invalid credentials.',
                
            ]);
        }
    }

    public function indexi()
    {
        //
        return view("managements.user.index")->with([
            "user" => User::paginate(5)
        ]);
    }

    public function create()
    {
        return view("managements.user.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validData = $request->validate([
            'name' => 'required|unique:tables,name',
            'email' => 'required|unique',
            'login' => 'required|',
            'role' => 'required|',
        ]);
        // Create a new table instance
        $user = new User();
        $user->name = $validData['name'];
        $user->email = $validData['email'];
        $user->login = $validData['login'];
        $user->role = $validData['role'];
        // save instance
        $user->save();
        // Clear the form input fields
        $request->session()->flash('success', 'added successfully');
        // Redirect back to the form with an empty form
        return redirect()->route('user.index');
             
    }

    /**
     * Display the specified resource.
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {
        //
        return view("managements.user.edit")->with([
            "users" => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user;
    
        //delete table
        $users = User::find($user);
        $users->delete();
    
        //redirect user
        return redirect()->route("user.index")->with([
            "success" => "deleted successfully"
        ]);
    }
}
