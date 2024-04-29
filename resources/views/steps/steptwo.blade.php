<style>
    details {
        margin-bottom: 10px;
    }

    summary {
        background-color: #f0f0f0;
        padding: 5px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px; /* Adjust the font size as needed */
        font-family: 'Arial', sans-serif; /* Specify the desired font family */
    }

    summary:hover {
        background-color: #dcdcdc;
    }
    .table th {
        font-size: 16px; /* Adjust the font size as needed */
        font-family: 'Arial', sans-serif; /* Specify the desired font family */
        align-items: center;
    }

    .table td {
        font-size: 14px; /* Adjust the font size as needed */
        font-family: 'Arial', sans-serif; /* Specify the desired font family */
        vertical-align: middle; /* Center text vertically */
        padding: 0;
        margin: 0;
        height: fit-content;
        
    }
    form{
        margin: 0px;
        padding: 0px;
    }
</style>
@extends('layouts.app')
@section('content')
    @if(session('material_count'))
    {{session()->forget('material_count');}}
    @endif
    @if(session('requests_count'))
    {{session()->forget('requests_count');}}
    @endif

    @if(session('inserted_materials'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11 m-2">
                <div class="card lh-lg">
                    <h5 class="card-header text-center fw-bolder p-3">{{ __("Liste des Matériaux Saisis :") }}</h5>
                    <div class="card-body">
                <div class="table-responsive">
                    @php
                    $groupedMaterials = collect(session('inserted_materials'))->groupBy('type');
                   @endphp
                    @foreach($groupedMaterials as $type => $materials)
                    <details >
                        <summary class="d-flex justify-content-between align-items-center">
                            <span class="ms-2">{{ $type }}</span>
                            <span class="badge bg-primary rounded-pill me-2">{{ count($materials) }}</span>
                        </summary>
                        
                        <table class="table">
                            <thead>
                                <tr class="">
                                    <th>Model</th>
                                    <th>N° Serie</th>
                                    <th>N° Inventaire</th>
                                    <th>Etat</th>
                                    <th>Description</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $material)
                                    <tr >
                                        <td>{{ $material['model'] }}</td>
                                        <td>{{ $material['numero_serie'] }}</td>
                                        <td>{{ $material['numero_inventaire'] }}</td>
                                        <td>{{ $material['etat'] }}</td>
                                        <td>{{ $material['description'] }}</td>
                                        <td class="d-flex justify-content-center">
                                            <form method="post" action="{{ route('materiel.edit', $material['id']) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success me-2">Modifier</button>
                                            </form>
                                            
                                            <form method="post" action="{{ route('materiel.delete', $material['id']) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger  me-2" >Supprimer</button>
                                            </form>
                
                                            <form method="post" action="{{ route('request.store', $material['id']) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary" @if(session()->has('submitted_materials') && in_array($material['id'], session('submitted_materials'))) disabled @endif>Demander réparation</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </details>
                @endforeach
                </div>
            </div>
            <form class="text-center" method="post" action="{{ route('besoin.create') }}">
                @csrf
                <button type="submit" class="btn btn-danger m-3">Etape suivante</button>
            </form>
        </div>
    </div>
</div>
</div>
@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11 m-2">
            <div class="card lh-lg">
                <h5 class="card-header text-center fw-bolder p-3">{{ __("Liste des Matériaux Saisis :") }}</h5>
                <div class="card-body">
                    <h4 class="text-center">Vous avez supprimer toutes vos materiaux :|</h4>
                </div>
            </div>
        </div>
    </div>        
</div>

@endif

@endsection