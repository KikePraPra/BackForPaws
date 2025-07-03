<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $accounts = Account::all();
        return view('account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:accounts,email',
            'phone_number' => 'required|numeric',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // $imagePath = $request->file('profile_picture')->store('account', 'public');
        
        if ($request->hasFile('profile_picture')) {
         $imagePath = $request->file('profile_picture')->store('account', 'public');
        } else {
            $imagePath = null;
        }
       
        $account = Account::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'profile_picture' => $imagePath
        ]);

        

        return redirect()->route('account.create')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function all(){
        $accounts = Account::all()->get();
        return response()->json($accounts);
    }
}
