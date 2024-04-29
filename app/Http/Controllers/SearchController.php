<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Materiel;
use App\Models\Repair;
use App\Models\requete;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function indexredirector( $search='', $key = "")
    {
        $site = Site::all();
        $repairDetails = [];
        $repMat = [];
        $hasMaintenance = false;
        $result = [];
        if($search =="Maintenance"){
            $searchResults = $this->searchMaintenance($key);
            $repairDetails = $searchResults['repairDetails'];
            $repMat = $searchResults['repMat'];
            $hasMaintenance = $searchResults['hasMaintenance'];
        }
        else{
            $results = $this->searchMateriel($key);
            $result = $results['result'];
            $repairDetails = $results['repairDetails'];
        }
        
        

        return view('admin.dashboard', compact('site', 'result', 'repairDetails', 'repMat', 'hasMaintenance', 'search', 'key'));
    }

    public function searchMateriel($key)
    {
        $repairDetails=[];
        $repMat=[];
        if ($key !== '') {
            $result = Materiel::where(function ($query) use ($key) {
                $query->where('model', 'like', '%' . $key . '%')
                    ->orWhere('type', 'like', '%' . $key . '%')
                    ->orWhere('marque', 'like', '%' . $key . '%')
                    ->orWhere('etat', 'like', '%' . $key . '%')
                    ->orWhere('numero_inventaire', 'like', '%' . $key . '%')
                    ->orWhere('numero_serie', 'like', '%' . $key . '%');
            })
            ->orWhereHas('site', function ($query) use ($key) {
                $query->where('type_poste', 'like', '%' . $key . '%')
                    ->orWhere('nom_bureau', 'like', '%' . $key . '%')
                    ->orWhere('num_bureau', 'like', '%' . $key . '%');
            })
            ->get();            

            foreach ($result as $materiel) {
                $repairs = Repair::where('materiel_id', $materiel->id)->get();
                // $repairs = Repair::where('materiel_id', $materiel->id)->paginate();
                if (count($repairs) > 0) {
                    $repairDetails[$materiel->id] = $repairs;
                    $repMat[] = $materiel;
                }
            }
        } else {
            $result = Materiel::all();
            foreach ($result as $materiel) {
                $repairs = Repair::where('materiel_id', $materiel->id)->get();
                if (count($repairs) > 0) {
                    $repairDetails[$materiel->id] = $repairs;
                    $repMat[] = $materiel;
                }
            }
        }

        return compact('result', 'repairDetails', 'repMat');
    }

    public function searchMaintenance($key)
    {
        $results = $this->searchMateriel($key);
        $materiels = $results['result'];
        $repairDetails = $results['repairDetails'];
        $repMat = $results['repMat'];
        $hasMaintenance = true;

        return compact('repairDetails', 'repMat', 'hasMaintenance');
    }



    public function search(Request $request)
    {
        $search = $request->input("searchtype");
        $key = $request->input("searchkey");
        $repairDetails = [];
        $result = [];
        $repMat = [];
        $materiel = [];
        $besoinsDetails = [];
        $hasMaintenance = false;
        $hasSite = false;
        $reqsite = [];
        $site = Site::all();

        if ($search === 'Materiel') {
            $results = $this->searchMateriel($key);
            $result = $results['result'];
            $repairDetails = $results['repairDetails'];
        }
         elseif ($search === 'Maintenance') {
            $searchResults = $this->searchMaintenance($key);
            $repairDetails = $searchResults['repairDetails'];
            $repMat = $searchResults['repMat'];
            $hasMaintenance = $searchResults['hasMaintenance'];
        }
         elseif ($search === 'Site') {
            $result = Site::where('type_poste', 'like', '%' . $key . '%')
                ->orWhere('nom_bureau', 'like', '%' . $key . '%')
                ->orWhere('num_bureau', 'like', '%' . $key . '%')
                ->get()->sortBy('type_poste');
                foreach ($result as $site) {
                    $besoins = requete::where('site_id', $site->id)->get();
                    if (count($besoins) > 0) {
                        $besoinsDetails[$site->id] = $besoins;
                        $reqsite[] = $site;
                    }
                }
                
            $hasSite = true;
        }
         else {
            $materiel = Materiel::all();
        }

        return view('admin.dashboard', compact('result','reqsite', 'besoinsDetails', 'materiel', 'site', 'repairDetails', 'hasMaintenance','hasSite', 'repMat', 'search', 'key'));
    }
}

