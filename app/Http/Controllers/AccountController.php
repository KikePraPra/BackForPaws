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
            'username' => 'required|min:5|max:30',
            'password' => 'required|min:8|max:100',
            'email' => 'required|email|unique:accounts,email',
            'phone_number' => 'required|numeric|',
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
        $account = Account::findOrFail($id);
        return view('account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $accountUsers = Account::all();
        $account = Account::findOrFail($id);
        return view('account.edit', compact('accountUsers', 'account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);
        $request->validate([
            'username' => 'required|min:5|max:30',
            'password' => 'nullable|min:8|max:100',
            'email' => 'required|email|unique:accounts,email,' . $account->id,
            'phone_number' => 'required|numeric|',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $data = [
        'username' => $request->username,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        ];

         if ($request->filled('password')) {
        $data['password'] = $request->password;
        }

        // Si se sube una nueva imagen, borra la anterior y guarda la nueva
        if ($request->hasFile('profile_picture')) {
        // Borra la imagen anterior si existe
        if ($account->profile_picture && \Storage::disk('public')->exists($account->profile_picture)) {
            \Storage::disk('public')->delete($account->profile_picture);
        }
        $imagePath = $request->file('profile_picture')->store('account', 'public');
        $data['profile_picture'] = $imagePath;
    }


       $account->update($data);

        return redirect()->route('account.index')->with('success', 'account update created sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();
        return redirect()->route('account.index')->with('success', 'account deleted successfully');
    }

    public function all(){
        $accounts = Account::all()->get();
        return response()->json($accounts);
    }
}
