<?php

namespace App\Http\Controllers;

use App\Models\materiel;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            if( $usertype === 'admin'){
                $materiel = materiel::all()->sortByDesc('site_id');
                $site = Site::all();
                return view('admin.dashboard', compact('materiel', 'site'));
            } 
            else{
                return view('home');
            }
        }
        else{
            return redirect()->back();
        }
    }
}
