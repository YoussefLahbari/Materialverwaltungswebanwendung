<!-- resources/views/steps/steptwo-sub.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifier le matériel') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('materiel.update', $material->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Type -->
                            <div class="mb-3">
                                <label for="type" class="form-label">{{ __('Type') }}</label>
                                <input type="text" class="form-control" id="type" name="type" value="{{ $material->type }}" required>
                            </div>

                            <!-- Model -->
                            <div class="mb-3">
                                <label for="model" class="form-label">{{ __('Model') }}</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{ $material->model }}" required>
                            </div>

                            <!-- Numero Serie -->
                            <div class="mb-3">
                                <label for="numero_serie" class="form-label">{{ __('N° Serie') }}</label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{ $material->numero_serie }}" required>
                            </div>

                            <!-- Numero Inventaire -->
                            <div class="mb-3">
                                <label for="numero_inventaire" class="form-label">{{ __('N° Inventaire') }}</label>
                                <input type="text" class="form-control" id="numero_inventaire" name="numero_inventaire" value="{{ $material->numero_inventaire }}" required>
                            </div>

                            <!-- Etat -->
                            <div class="mb-3">
                                <label for="etat" class="form-label">{{ __('Etat') }}</label>
                                <input type="text" class="form-control" id="etat" name="etat" value="{{ $material->etat }}" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $material->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
