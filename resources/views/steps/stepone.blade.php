@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-2">
            <div class="card lh-lg">
                <h5 class="card-header text-center fw-bolder p-3">{{ __("Gestionnaire d'Inventaire des Bureaux Administratifs de Marrakech") }}</h5>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h6 class="card-title text-center fw-bold mb-4">Premiere etape: remplissez le formulaire suivant !</h6>
                    <form method="POST" action="{{route('materiel.store')}}" class="form" id="MaterialCreator">
                        @csrf
                        @method('put')
                        <div class="row md-3 mb-4 justify-content-center">
                            <label for="type" class="col-1 col-form-label text-md-end">{{ __('Type') }}</label>

                            <div class="col-4">
                                <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required >
                                    <option class="text-center" value="" selected disabled>{{ __('Sélectionnez un type') }}</option>
                                    <option value="ordinateur de bureau">Ordinateur de bureau</option>
                                    <option value="ecran ordinateur de bureau">Écran Ordinateur de bureau</option>
                                    <option value="imprimante monochrome">Imprimante monochrome</option>
                                    <option value="imprimante multifonction monochrome">Imprimante multifonction monochrome</option>
                                    <option value="scanner document">Scanner de document</option>
                                    <option value="scanner plat">Scanner plat</option>
                                    <option value="ecran pour ordinateur">Écran pour ordinateur</option>
                                    <option value="imprimante couleur">Imprimante couleur</option>
                                    <option value="onduleur">Onduleur</option>
                                    <option value="ligne adsl">Ligne ADSL</option>
                                    <option value="modem adsl">Modem ADSL</option>
                                    <option value="client leger">Client léger</option>
                                    <option value="photocopieur">Photocopieur</option>
                                    <option value="fax">Fax</option>
                                    <option value="appareil telephonique">Appareil téléphonique</option>
                                    <option value="reseau">Réseau</option>
                                    <option value="appareil file attente gestion presence">Appareil (file d'attente/gestion de présence)</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <label for="model" class="col-2 col-form-label text-md-end">{{ __('Model') }}</label>

                            <div class="col-3">
                                <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" required />

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                        </div>
                        {{-- duplicated for the code  --}}
                        <div class="row md-3 mb-3 justify-content-start ">
                            <label for="marque" class="col-2 col-form-label text-md-end">{{ __('Marque') }}</label>

                            <div class="col-4">
                                <select id="marque" class="form-select @error('marque') is-invalid @enderror" name="marque" required>
                                    <option value="">Select Marque</option>
                                    <option value="Apple">Apple</option>
                                    <option value="Samsung">Samsung</option>
                                    <option value="Dell">Dell</option>
                                    <option value="HP">HP</option>
                                    <option value="Lenovo">Lenovo</option>
                                    <option value="Microsoft">Microsoft</option>
                                    <option value="Sony">Sony</option>
                                    <option value="Acer">Acer</option>
                                    <option value="Asus">Asus</option>
                                    <option value="Toshiba">Toshiba</option>
                                    <option value="LG">LG</option>
                                    <option value="Intel">Intel</option>
                                    <option value="Nvidia">Nvidia</option>
                                    <option value="AMD">AMD</option>
                                    <option value="Google">Google</option>
                                    <option value="IBM">IBM</option>
                                    <option value="Canon">Canon</option>
                                    <option value="Epson">Epson</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Xerox">Xerox</option>
                                </select>
                                @error('marque')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <span class="col-1"></span> --}}
                            <label for="model" class="col-2 col-form-label text-md-end">{{ __('Model') }}</label>

                            <div class="col-3">
                                <input id="numero_inventaire" type="text" class="form-control @error('model') is-invalid @enderror" name="model" required />

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                
                        <div class="row md-3 mb-3 justify-content-start ">
                            <label for="numero_serie" class="col-2 col-form-label text-md-end">{{ __('N° Serie') }}</label>

                            <div class="col-4">
                                <input id="numero_serie" type="text" class="form-control @error('numero_serie') is-invalid @enderror" name="numero_serie" required />

                                @error('numero_serie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <span class="col-1"></span> --}}
                            <label for="numero_inventaire" class="col-2 col-form-label text-md-end">{{ __('N° Inventaire') }}</label>

                            <div class="col-3">
                                <input id="numero_inventaire" type="text" class="form-control @error('numero_inventaire') is-invalid @enderror" name="numero_inventaire" required />

                                @error('numero_inventaire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row md-3 mb-3 justify-content-start ">
                            <label for="etat" class="col-2 col-form-label text-md-end">{{ __('Etat') }}</label>

                            <div class="col-4">
                                {{-- <input id="etat" type="text" class="form-control @error('etat') is-invalid @enderror" name="etat" value="{{ old('etat') }}" required autocomplete="etat" autofocus> --}}

                                <select id="etat" class="form-select @error('etat') is-invalid @enderror" name="etat"  required>
                                    <option class="text-center" value="" selected disabled>{{ __("Sélectionnez l'etat") }}</option>
                                    <option value="bonne">Bonne</option>
                                    <option value="moyenne">Moyenne</option>
                                    <option value="mauvaise">Mauvaise</option>
                                    <option value="réforme">Reforme</option>
                                </select>
                                @error('etat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-5">
                                <input id="description" type="text" placeholder="Description (optionnelle)" class="form-control @error('description') is-invalid @enderror" name="description" />

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" onclick="handelClickConfirm()" class="btn btn-success m-1">Ajouter le matériel</button>
                        </div>
                    </form>
                </div>
                @if(session('material_count') > 0)
                <div class="card-footer text-center">
                    Totale des Matériaux saisie : 
                    <span class="badge bg-primary rounded-pill">{{ session('material_count') }}</span>
                    <form action="{{route('request.create')}}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" onclick="handelClickConfirm()" class="btn btn-danger m-1">Etape suivante</button>
                    </form>
                  </div>
                @endif

            </div>
        </div>
    </div>
    <script>
        function handelClickConfirm(){
            if (confirm('Voulez vous confirmer ?')) {
                event.submit()
            }
            else{
                event.preventDefault()
            }
        }
    </script>
    
</div>
@endsection

