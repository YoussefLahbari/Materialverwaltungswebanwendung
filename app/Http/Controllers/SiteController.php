<?php

namespace App\Http\Controllers;
use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch existing type_poste values from the parameters table
        $existingTypePostes = Parameter::where('name', 'site')->get();

        // Fetch existing nom_bureau values from the parameters table
        $existingNomBureaus = Parameter::where('name', 'bureau')->get();
        if(session('material_count'))
        {session()->forget('material_count');}
        if(session('requests_count'))
        {session()->forget('requests_count');}
        if(session('inserted_materials'))
        {session()->forget('inserted_materials');}
        if(session('passedsite'))
        {session()->forget('passedsite');}
        if(session('submitted_materials'))
        {session()->forget('submitted_materials');}
        return view('admin.stepzero', compact('existingTypePostes', 'existingNomBureaus'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'type_poste' => 'required|string', // Adjusted validation syntax
        'nom_bureau' => 'required|string',
        'num_bureau' => 'required|string',
    ]);

    // Modify the values if they are 'other'
    if ($data['type_poste'] === 'other') {
        $data['type_poste'] = $request->input('new_type_poste');
    }
    if ($data['nom_bureau'] === 'other') {
        $data['nom_bureau'] = $request->input('new_nom_bureau');
    }

    // Check if a similar site already exists
    $existingSite = Site::where('type_poste', $data['type_poste'])
        ->where('nom_bureau', $data['nom_bureau'])
        ->first();

    if ($existingSite) {
        // If a similar site exists, update its attributes
        $existingSite->update($data);
        session(['passedsite' => $existingSite->id]);
    } else {
        // If no similar site is found, create a new site
        $site = Site::create($data);
        session(['passedsite' => $site->id]);
    }

    return view('steps.stepone');
}
public function userinterface() {
    
    // Fetch existing type_poste values from the parameters table
    $existingTypePostes = Parameter::where('name', 'site')->get();

    // Fetch existing nom_bureau values from the parameters table
    $existingNomBureaus = Parameter::where('name', 'bureau')->get();
    
    return view('admin.ajoutercompte', compact('existingTypePostes', 'existingNomBureaus'));
}
public function createuser(Request $request){
    $data = $request->validate( [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'type_poste' => ['required', 'string'], // Add validation for site fields
        'nom_bureau' => ['required', 'string'],
        'num_bureau' => ['required', 'string'],
    ]);
    if ($data['type_poste']==='other'){
        $data['type_poste']=$data['new_type_poste'];
    }
    if ($data['nom_bureau']==='other'){
        $data['nom_bureau']=$data['new_nom_bureau'];
    }
     // Check if a similar site already exists
     $existingSite = Site::where('type_poste', $data['type_poste'])
         ->where('nom_bureau', $data['nom_bureau'])
         ->where('num_bureau', $data['num_bureau'])
         ->first();
 
     if ($existingSite) {
         // If a similar site exists, associate the user with the existing site
         $existingSite->update($data);
         $site = $existingSite;
     } else {
         // If no similar site is found, create a new site
         $site = Site::create([
             'type_poste' => $data['type_poste'],
             'nom_bureau' => $data['nom_bureau'],
             'num_bureau' => $data['num_bureau'],
            //  'telephone' => $data['telephone'],
             // Add other site fields here
         ]);
     }
 
     // Create a new user associated with the site
     $user = User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password']),
         'site_id' => $site->id, 
         // Associate the user with the existing or new site
     ]);
     session(['user' => $user]);
     return redirect()->route('home');
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
}
