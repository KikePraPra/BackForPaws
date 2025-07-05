<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Animal;
use App\Models\Account;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $reports = Report::with('account')->get();
    return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $animals = Animal::all();
        $accounts = Account::all();
        return view('report.create', compact('animals', 'accounts'));
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
            'last_place' => 'required|string|max:255',
            'pet_image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'pet_state' => 'required|string|max:50',
        ]);

        $data = $request->only([
            'account_id', 'animal_id', 'pet_name', 'pet_age', 'last_place', 'description', 'pet_state'
        ]);

        if ($request->hasFile('pet_image')) {
            $data['pet_image'] = $request->file('pet_image')->store('pets', 'public');
        }

        Report::create($data);

        return redirect()->route('report.index')->with('success', 'Reporte creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::with('animal', 'account')->findOrFail($id);
        return view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $animals = Animal::all();
        $accounts = Account::all();
        return view('report.edit', compact('report', 'animals', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'animal_id' => 'required|exists:animals,id',
            'pet_name' => 'required|string|max:100',
            'pet_age' => 'nullable|integer|min:0',
            'last_place' => 'required|string|max:255',
            'pet_image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'pet_state' => 'required|string|max:50',
        ]);

        $data = $request->only([
            'account_id', 'animal_id', 'pet_name', 'pet_age', 'last_place', 'description', 'pet_state'
        ]);

        if ($request->hasFile('pet_image')) {
            // Borra la imagen anterior si existe
            if ($report->pet_image && \Storage::disk('public')->exists($report->pet_image)) {
                \Storage::disk('public')->delete($report->pet_image);
            }
            $data['pet_image'] = $request->file('pet_image')->store('pets', 'public');
        }

        $report->update($data);

        return redirect()->route('report.index')->with('success', 'Reporte actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $report = Report::findOrFail($id);

    try {
        if ($report->pet_image) {
            try {
                if (\Storage::disk('public')->exists($report->pet_image)) {
                    \Storage::disk('public')->delete($report->pet_image);
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to delete report pet image: ' . $e->getMessage(), [
                    'report_id' => $report->id,
                    'image_path' => $report->pet_image
                ]);
            }
        }

        $report->delete();

        return redirect()
            ->route('report.index')
            ->with('success', 'Report deleted successfully!');
    } catch (\Exception $e) {
        return redirect()
            ->route('report.index')
            ->with('error', 'Error deleting report. Please try again.');
    }
}

    public function all()
    {
        $reports = Report::all(); 
         return response()->json($reports);
    }
}
