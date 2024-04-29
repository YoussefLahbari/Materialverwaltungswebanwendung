<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\materiel;
use Illuminate\Support\Facades\Session;
class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('steps.steptwo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $materiel_id, $search=null, $key=null)
    {
        
        if(isset($search)){
            Repair::create([
                'materiel_id' => $materiel_id,
                // Fill other fields if necessary
            ]);
            return redirect()->route('updateview', [ 'search' => $search, 'key' => $key ]);
        }else{
        // Get the submitted material IDs from the session
        $submitted_materials = Session::get('submitted_materials', []);

        // If the current material ID is not in the submitted materials array, insert it into the database
        if (!in_array($materiel_id, $submitted_materials)) {
            // Insert the current material ID into the database
            Repair::create([
                'materiel_id' => $materiel_id,
                // Fill other fields if necessary
            ]);

            // Push the current material ID into the submitted materials array in the session
            Session::push('submitted_materials', $materiel_id);
        }
        // Redirect the user to the next step (steptwo)
        return view('steps.steptwo');
    }
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
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reparation = Repair::findOrFail($id);
        $reparation->date_reparation = now();
        $reparation->Technicien = $request->input('Technicien');
        $reparation->intervention = $request->input('Intervention');
        $reparation->save();
        return redirect()->route('updateview', ['search' => 'Maintenance']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $search, $key = "")
{
    Repair::destroy($id);
    $alert='Demande N° '.$id.' supprimé avec succes';
    session(['alert'=>$alert]);
    return redirect()->route('updateview', [ 'search' => $search, 'key' => $key ]);
}
}
