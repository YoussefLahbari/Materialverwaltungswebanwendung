@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-2">
            <div class="card lh-lg">
                <h5 class="card-header text-center fw-bolder p-3">{{ __("Step 3: Request Details") }}</h5>
                <div class="card-body">
                    <!-- Form for adding request details -->
                    <form method="post" action="{{ route('besoin.store') }}">
                        @csrf
                        @method('put')
                        <!-- Request Type -->
                        <div class="mb-3">
                            <label for="request_type" class="form-label">{{ __('Request Type') }}</label>
                            <select id="type" class="form-select @error('type') is-invalid @enderror" name="request_type" required >
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
                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">{{ __('Quantity') }}</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" onclick="handelClickConfirm()" class="btn btn-success m-1">Ajouter la demande</button>
                        </div>
                    </form>
                </div>
                    @if(session('requests_count') > 0)
                <div class="card-footer  text-center">
                    Totale des Demandes saisie : 
                    <span class="badge bg-primary rounded-pill">{{ session('requests_count') }}</span><br>
                        <a href="{{ route('home') }}" class="btn btn-danger m-3">{{ __('Terminer') }}</a>
                  </div>
                 @endif
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
</div>
@endsection
