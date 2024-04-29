@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Ajouter un compte d'utilisateur") }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ajouteruser') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Addresse email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        {{-- Site data --}}
                       <!-- Dropdown for type_poste with option to enter a new value -->
                            <div class="row mb-3">
                                <label for="type_poste" class="col-md-4 col-form-label text-md-end">{{ __('Post de commandement') }}</label>
                                <div class="col-md-6">
                                    <div class="custom-select">
                                        <select data-post="{{$existingTypePostes}}" id="type_poste" name="type_poste" class="form-select @error('type_poste') is-invalid @enderror" required>
                                            <option value="" disabled selected>Choisir ou ajouter votre poste</option>
                                            @foreach($existingTypePostes as $typePoste)
                                                <option value="{{ $typePoste->value }}">{{ $typePoste->value }}</option>
                                            @endforeach
                                            <option value="other">Other</option>
                                        </select>
                                        @error('type_poste')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                                            <option value="" disabled selected>Choisir ou ajouter votre division</option>
                                            @foreach($existingNomBureaus as $bureau)
                                                <option value="{{ $bureau->value }}">{{ $bureau->value }}</option>
                                            @endforeach
                                            <option value="other">Other</option>
                                        </select>
                                        @error('nom_bureau')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- Input field for new nom_bureau -->
                                    <input type="text" id="new_nom_bureau" name="new_nom_bureau" class="form-control mt-2" placeholder="Saisir Le nouvelle division" style="display: none;">
                                </div>
                            </div>

<script>
    // JavaScript to show/hide input fields based on the selected option
    document.getElementById('type_poste').addEventListener('change', function() {
        var newTypePosteInput = document.getElementById('new_type_poste');
        newTypePosteInput.style.display = (this.value === 'other') ? 'block' : 'none';

    })

    document.getElementById('nom_bureau').addEventListener('change', function() {
        var newNomBureauInput = document.getElementById('new_nom_bureau');
        newNomBureauInput.style.display = (this.value === 'other') ? 'block' : 'none';
    });
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
            <div class="row mb-3">
                    <label for="num_bureau" class="col-md-4 col-form-label text-md-end">{{ __('N° de Bureau') }}</label>

                    <div class="col-md-6">
                            <input id="num_bureau" type="text" class="form-control @error('num_bureau') is-invalid @enderror" name="num_bureau" required autocomplete="num_bureau" >
                    </div>
                    </div>
                        @error('num_bureau')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Crée un compte") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
