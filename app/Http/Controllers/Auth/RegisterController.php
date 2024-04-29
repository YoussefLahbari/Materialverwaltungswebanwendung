<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Site;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Parameter;

class RegisterController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

        // Fetch data 
     /**
     * Display the registration form.
     *
     * @return Factory|View
     */
    

public function showRegistrationForm()
{
    // Fetch existing type_poste values from the parameters table
    $existingTypePostes = Parameter::where('name', 'site')->get();

    // Fetch existing nom_bureau values from the parameters table
    $existingNomBureaus = Parameter::where('name', 'bureau')->get();

    return view('auth.register', compact('existingTypePostes', 'existingNomBureaus'));
}


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type_poste' => ['required', 'string'], // Add validation for site fields
            'nom_bureau' => ['required', 'string'],
            'num_bureau' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
     protected function create(array $data)
     {
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
     
         return $user;
     }
     
}
