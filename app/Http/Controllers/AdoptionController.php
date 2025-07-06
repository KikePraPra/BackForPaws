<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Animal;
use App\Models\Account;
use Illuminate\Support\Facades\Storage;
use App\Models\Adoption;
class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $adoptions = Adoption::with('account', 'animal')->get();
    return view('adoption.index', compact('adoptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $animals = Animal::all();
        $accounts = Account::all();
        return view('adoption.create', compact('animals', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'animal_id' => 'required|exists:animals,id',
            'pet_name' => 'nullable|string|max:100',
            'pet_age' => 'nullable|integer|min:0',
            'meeting_place' => 'required|string|max:255',
            'pet_image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'pet_state' => 'required|string|max:50',
        ]);

        $data = $request->only([
            'account_id', 'animal_id', 'pet_name', 'pet_age', 'meeting_place', 'description', 'pet_state'
        ]);

        if ($request->hasFile('pet_image')) {
            $data['pet_image'] = $request->file('pet_image')->store('pets', 'public');
        }

        Adoption::create($data);

        return redirect()->route('adoption.index')->with('success', 'Adopción creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $adoption = Adoption::with('account', 'animal')->findOrFail($id);
        return view('adoption.show', compact('adoption'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adoption = Adoption::findOrFail($id);
        $animals = Animal::all();
        $accounts = Account::all();
        return view('adoption.edit', compact('adoption', 'animals', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adoption = Adoption::findOrFail($id);

        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'animal_id' => 'required|exists:animals,id',
            'pet_name' => 'required|string|max:100',
            'pet_age' => 'nullable|integer|min:0',
            'meeting_place' => 'required|string|max:255',
            'pet_image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'pet_state' => 'required|string|max:50',
        ]);

        $data = $request->only([
            'account_id', 'animal_id', 'pet_name', 'pet_age', 'meeting_place', 'description', 'pet_state'
        ]);

        if ($request->hasFile('pet_image')) {
            // Borra la imagen anterior si existe
            if ($adoption->pet_image && \Storage::disk('public')->exists($adoption->pet_image)) {
                \Storage::disk('public')->delete($adoption->pet_image);
            }
            $data['pet_image'] = $request->file('pet_image')->store('pets', 'public');
        }

        $adoption->update($data);

        return redirect()->route('adoption.index')->with('success', 'Adopción actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $adoption = Adoption::findOrFail($id);

    try {
        if ($adoption->pet_image) {
            try {
                if (\Storage::disk('public')->exists($adoption->pet_image)) {
                    \Storage::disk('public')->delete($adoption->pet_image);
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to delete adoption pet image: ' . $e->getMessage(), [
                    'adoption_id' => $adoption->id,
                    'image_path' => $adoption->pet_image
                ]);
            }
        }

        $adoption->delete();

        return redirect()
            ->route('adoption.index')
            ->with('success', 'Adopción eliminada correctamente!');
    } catch (\Exception $e) {
        return redirect()
            ->route('adoption.index')
            ->with('error', 'Error deleting adoption. Please try again.');
    }
    }


    public function all()
    {
        $adoptions = Adoption::all(); 
         return response()->json($adoptions);
    }

}
