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
                    <h6 class="card-title text-center fw-bold mb-4">Bienvenue Admin! Specifier le site pour commencer:</h6>
                    <form method="POST" action="{{route('step.zero-post')}}" class="form" id="MaterialCreator">
                        @csrf
                        @method('put')
                        <div class="row md-3 mb-3 justify-content-center">
                            <div class="row mb-3">
                                <label for="type_poste" class="col-md-4 col-form-label text-md-end">{{ __('Commandement') }}</label>
                                <div class="col-md-6">
                                    <div class="custom-select">
                                        <select data-post="{{$existingTypePostes}}" id="type_poste" name="type_poste" class="form-select @error('type_poste') is-invalid @enderror" required>
                                            <option value="" disabled selected>Choisir ou ajouter le poste</option>
                                            @foreach($existingTypePostes as $typePoste)
                                                <option value="{{ $typePoste->value }}">{{ $typePoste->value }}</option>
                                            @endforeach
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <!-- Input field for new type_poste -->
                                    <input type="text" id="new_type_poste" name="new_type_poste" class="form-control mt-2" placeholder="Saisir Le nouveau post" style="display: none;">
                                </div>
                            </div>
                            
                            <!-- Dropdown for nom_bureau with option to enter a new value -->
                            <div class="row mb-3">
                                <label for="nom_bureau" class="col-md-4 col-form-label text-md-end">{{ __('Division') }}</label>
                                <div class="col-md-6">
                                    <div class="custom-select">
                                        <select data-bureau="{{$existingNomBureaus}}" id="nom_bureau" name="nom_bureau" class="form-select @error('nom_bureau') is-invalid @enderror" required>
                                            <option value="" disabled selected>Choisir ou ajouter la division</option>
                                            @foreach($existingNomBureaus as $bureau)
                                                <option value="{{ $bureau->value }}">{{ $bureau->value }}</option>
                                            @endforeach
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <!-- Input field for new nom_bureau -->
                                    <input type="text" id="new_nom_bureau" name="new_nom_bureau" class="form-control mt-2" placeholder="Saisir Le nouvelle division" style="display: none;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_bureau" class="col-md-4 col-form-label text-md-end">{{ __('N° Bureau') }}</label>
    
                                <div class="col-md-6">
                                    <input id="num_bureau" type="text" class="form-control @error('num_bureau') is-invalid @enderror" name="num_bureau" value="{{ old('num_bureau') }}" required autocomplete="num_bureau">
    
                                    @error('num_bureau')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                </div>    
            </div>
            <div class="card-footer text-center">
                    <button type="submit" onclick="handelClickConfirm()" class="btn btn-danger m-1">Commencer le process</button>
                </form>
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
        // JavaScript to show/hide input fields based on the selected option
    document.getElementById('type_poste').addEventListener('change', function() {
        var newTypePosteInput = document.getElementById('new_type_poste');
        newTypePosteInput.style.display = (this.value === 'other') ? 'block' : 'none';
    });

    document.getElementById('nom_bureau').addEventListener('change', function() {
        var newNomBureauInput = document.getElementById('new_nom_bureau');
        newNomBureauInput.style.display = (this.value === 'other') ? 'block' : 'none';
    });
    // Handel selects
    const siteselect = document.getElementById('type_poste')
    siteselect.addEventListener('change', function (){
        const bureauselect = document.getElementById('nom_bureau')
        const bureaux = JSON.parse(bureauselect.getAttribute('data-bureau'));
        const sitevalue = this.value
        const sites = JSON.parse(this.getAttribute('data-post'));
        let site = sites.find(siteObj => siteObj.value === sitevalue);
        let filteredbreaux = bureaux.filter(bureau=> bureau.site == site.id)

    console.log(filteredbreaux)
    bureauselect.innerHTML = '<option value="" disabled selected>Choisir ou ajouter votre division</option>';
    filteredbreaux.forEach(bureau => {
            const option = document.createElement('option');
            option.value = bureau.value;
            option.textContent = bureau.value;
            bureauselect.appendChild(option);
        });
    bureauselect.innerHTML += '<option value="other">Other</option>'
    })

    </script>
    
</div>
@endsection

