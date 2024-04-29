@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-2">
            <div class="card lh-lg">
                <h5 class="card-header text-center fw-bolder p-3">{{ __("Gestionnaire d'Inventaire des Bureaux Administratifs de Marrakech") }}</h5>
                @if(session('inserted_materials'))
                {{session()->forget('inserted_materials');}}
                @endif
                <div class="card-body ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h6 class="card-title text-center fw-bold">Bienvenue dans votre tableau de bord !</h6>
                    <h6 class="text-center">Prêt à commencer ? Suivez ces 3 étapes simples :</h6>
                    <ol class='list-group list-group-numbered m-3'>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Saisie des Matériaux</div>
                                Remplissage des données concernant les matériaux présents dans votre bureau
                              </div>
                              <span class="badge bg-success rounded-pill">Première étape</span>
                            </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Demandes de Réparations</div>
                                Ajout des détails liés aux demandes de réparation pour les matériaux saisies.
                              </div>
                              <span class="badge bg-success rounded-pill">Deuxième étape</span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Ajout des Besoins</div>
                                Saisie des informations relatives aux requêtes\besoins de votre bureau.
                              </div>
                              <span class="badge bg-success rounded-pill">Troisième étape</span>
                        </li>
                    </ol>
                    {{-- <p class="card-text text-center">en clicant sur le boutton suivant, vous commçerait la premier etape, faite attention que vous ne pouvez pas retournez en arriére.</p> --}}
                    <div class="text-center">
                        <form method="POST" action="{{route('materiel.create')}}" >
                            @csrf
                            <button type="submit" class="btn btn-danger m-2">Commencez le process !</button>
                        </form></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
