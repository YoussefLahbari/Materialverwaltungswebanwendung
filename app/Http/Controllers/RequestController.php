<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\requete;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
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
        return view('steps.stepthree');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Retrieve the Input Data
        $data = $request->validate([
            'request_type' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);
        
    
       // 2. Get the 'site_id' from the authenticated user
       if(Auth::user()->usertype === 'user'){
           $siteId = Auth::user()->site_id;
       }
       else{
           $siteId = session('passedsite');
       }
                    
    
        // 3. Add 'site_id' to the data array
        $data['site_id'] = $siteId;

        $requete = requete::create($data);
    
        // Increment the count of requests in the session
        $count = session('requests_count', 0) + 1;
        session(['requests_count' => $count]);
    
        // Redirect or return a response as needed
        return view('steps.stepthree'); // Assuming the view for step three is named 'stepthree.blade.php'
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
