<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\materiel;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
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
        return view('steps/stepone');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
                    // 1. Retrieve the Input Data
            $data = $request->validate([
                'type' => 'required',
                'marque' => 'required',
                'model' => 'required',
                'numero_serie' => 'required',
                'numero_inventaire' => 'required',
                'etat' => 'required',
                // Note: 'site_id' is not part of the form inputs; it will be retrieved from the authenticated user
            ]);

            // 2. Get the 'site_id' from the authenticated user
            if(Auth::user()->usertype === 'user'){
                $siteId = Auth::user()->site_id;
            }
            else{
                $siteId = session('passedsite');
            }
            

            // Joker - Add description if set
            $description = $request -> input('description');
            if(!empty($description)){
                $data['description'] = $description;
            }

            // 3. Add 'site_id' to the data array
            $data['site_id'] = $siteId;
            

            // 4. Create a New Material Instance
            $material = materiel::create($data);

            //JOKER -- Incrément du compteur de matériel dans la variable de session
            $count = session('material_count', 0) + 1;
            session(['material_count' => $count]);

            // 5. Save the Material in the session list
            $insertedMaterials = session('inserted_materials', []);
            $insertedMaterials[] = $material;
            session(['inserted_materials' => $insertedMaterials]);


            // Redirect or return a response as needed
            return view('steps.stepone');
            // return redirect()->route('materiel.create');
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
    $material = Materiel::findOrFail($id);
    return view('steps.steptwo-sub', compact('material'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $material = Materiel::findOrFail($id);
        $material->update($request->all());
    
        $insertedMaterials = session('inserted_materials', []);
        foreach ($insertedMaterials as &$mat) {
            if ($mat['id'] === $material['id']) {
                $mat = $material->toArray(); // Replace with updated material
                break;
            }
        }
    
        session(['inserted_materials' => $insertedMaterials]);
    
        return redirect()->route('request.create')->with('success', 'Material updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $search=null, $key=null)
{
    $materiel = Materiel::findOrFail($id);
    session(['deletedMat' => $materiel] );
    Materiel::destroy($id);
    if($search===null){

    // Update the UI by updating the inserted_materials session variable
    // You can do this by removing the deleted material from the session array
    $insertedMaterials = session('inserted_materials', []);
    $insertedMaterials = array_filter($insertedMaterials, function ($material) use ($id) {
        return $material['id'] != $id;
    });
    session(['inserted_materials' => $insertedMaterials]);

    return redirect()->route('request.create')->with('success', 'Material deleted successfully');
    }
    else{
        // $materiel = Materiel::findOrFail($id);
        session(['deletedMat' => $materiel] );
        return redirect()->route('updateview', [ 'search' => $search, 'key' => $key ]);
    }
    
}


}
