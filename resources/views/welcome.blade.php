@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <img src="{{ asset('Coat-of-arms-of-Morocco-01.png') }}" alt="Logo" class="img-fluid mb-3" style="width: 10%">
            <h3 class="text-danger">Gestionnaire d'inventaire</h3>
            <h4 class="text-success">
                Vue Global :
            </h4>
            <p>
                Ce site a été développé pendant le stage au centre informatique de la wilaya. <br>
                Il a été développé avec: LARAVEL + React (Laravel UI) + Bootstrap <br>
                Ce site sert aux objectifs principaux suivants:
            </p>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Gérer les Matériaux
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Gérer les matériaux de manière efficace.</strong> Vous pouvez ajouter, modifier et supprimer des matériaux de l'inventaire.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Gérer les Réparations
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Gérer les demandes de réparations des matériaux.</strong> Vous pouvez ajouter, modifier et supprimer des demandes de réparations des matériaux.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Gérer les Besoins 
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            
                            <strong>Gérer les besoins des différents sites.</strong> Vous pouvez ajouter, modifier et supprimer des besoins pour chaque site.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
