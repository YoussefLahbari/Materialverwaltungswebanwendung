@extends('layouts.app')

@section('content')
<div class="container">
    <style>
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
            white-space: nowrap; /* Prevent text wrapping */
        }
    
        .table td {
            font-size: 14px; /* Adjust the font size as needed */
            font-family: 'Arial', sans-serif; /* Specify the desired font family */
            vertical-align: middle; /* Center text vertically */
            height: fit-content;
        }
        form{
            margin: 0px;
            padding: 0px;
        }
        /* Override custom styles that affect the hover effect */
        .dropdown-menu .dropdown-item:hover {
        background-color: #3c4146cb; /* Lighter background color on hover */
        color: #f8f9fa; /* Darker text color on hover */
        }

        /* Custom CSS */
.truncate {
    max-width: 150px; /* Example width */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; /* Adds ellipsis (...) to indicate text overflow */
}

    /* Hide everything except the table and its contents */
    
    

    </style>

    {{-- Pilot Bar --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card lh-lg">
                <div class="card-header text-center fw-bolder d-flex print-hide">
                   <form method="POST" action="{{ route('search') }}" class="d-flex row col-12 justify-content-between align-items-center">
                    @csrf
                    <label class="col me-2" for="">Rechercher: </label>
                    <select class="col me-2 form-select" name="searchtype" id="selected" value="">
                        <option value="" >Choisir sur quoi filter</option>
                        <option value="Materiel" @php if (@$search === "Materiel") echo 'selected' @endphp>Gestion Materiel</option>
                        <option value="Maintenance" @php if (@$search === "Maintenance") echo 'selected' @endphp>Maintenance</option>
                        <option value="Site" @php if (@$search === "Site") echo 'selected' @endphp>Gestion Besoin</option>
                    </select>
                    <input type="text" name="searchkey" class="form-control col me-2" id="searchkey" placeholder="<-- choisir un type" value="{{@$key}}">
                    {{-- <input type="text" name="searchkey" class="form-control col me-2" id="searchkey" placeholder="<-- choisir un type" value="{{@$key}}">
                    <input type="text" name="searchkey" class="form-control col me-2" id="searchkey" placeholder="<-- choisir un type" value="{{@$key}}"> --}}
                    <button type="submit" class="btn btn-primary m-1 col me-2 ">Rechercher</button>
                    <button id="exporterBtn" type="button" class="btn btn-success m-1 col ">Exporter Excel</button>
                    <button id="imprimerBtn" type="button" class="btn btn-danger m-1 col " onclick="printTable()">Imprimer PDF</button>
                   </form>
                   
                   {{-- <button id="imprimerBtn" class="btn btn-danger m-1 col ms-3">Imprimer PDF</button> --}}
                </div>
                <div class="card-body ">

                 {{-- Resultat de Maintenance --}}
    @if ( @$hasMaintenance )

    {{-- Maintenance Table --}}
    
    <table class="table" id="showntable">
        <x-alert />
    <tr>
        <th class="hide"></th>
        <x-materieltableheader />
    </tr>
    @foreach ($repMat as $res)
        <tr>
            <td class="p-1 hide">
                @php
                $materielId = $res['id'];
                $hasRepairs = false;
                $hasIntervention = false;
                foreach ($repairDetails as $repmat) {
                    foreach ($repmat as $rep) {
                        if ($rep['materiel_id'] === $materielId) {
                        $hasRepairs = true;
                        if (isset($rep['intervention'])) {
                            $hasIntervention = true;
                        }
                        break 2;
                    }
                    }
                }
            @endphp
                <button class="show-repairs-btn btn btn-dark" data-materiel-id="{{ $res['id'] }}">+</button>
            </td>
            @foreach ($site as $st)
                @if ($res['site_id'] === $st['id'])
                    <td>{{ $st['type_poste']}}</td>
                    <td>{{ $st['nom_bureau']}}</td>
                    <td>{{ $st['num_bureau']}}</td>
                @endif
            @endforeach
            <td>{{ $res['type'] }}</td>
            <td>{{ $res['marque'] }}</td>
            <td>{{ $res['model'] }}</td>
            <td>{{ $res['numero_serie'] }}</td>
            <td>{{ $res['numero_inventaire'] }}</td>
            <td>{{ $res['etat'] }}</td>
            <td class="truncate">{{ $res['description'] }}</td>
            {{-- <td>{{ $res['id'] }}</td> --}}
        </tr>
        <tr class="repair-details-row" id="repair-details-{{ $res['id'] }}" style="display: none;">
            <x-repair-sub-table :repairDetails='$repairDetails' :materielId='$materielId' :search='$search' :key='$key' />
        </tr> 
    @endforeach                   
    </table>

    @elseif( @$hasSite )
    {{-- Resultat de Site --}}
    <table class="table" id="showntable">
        <x-alert />
                    <tr>
                        <th class="hide"></th>
                        <th>Préfecture</th>
                        <th>Commandement</th>
                        <th>Division</th>
                        <th>N° Bureau</th>
                        <th>Date Ajout</th>
                    </tr>
                    @foreach ($result as $site)
                    <tr>
                            <td class="hide">
                                <button class="btn btn-dark show-besoins-btn" data-site-id="{{ $site['id'] }}">+</button>
                            </td>
                            <td>{{ $site['prefecture']}}</td>
                            <td>{{ $site['type_poste']}}</td>
                            <td>{{ $site['nom_bureau'] }}</td>
                            <td>{{ $site['num_bureau'] }}</td>
                            <td>{{ $site['created_at'] }}</td>
                            @php $siteId = $site['id'] @endphp
                        </tr>
                        <tr  id="besoin-details-{{ $site['id'] }}" style="display: none;">
                            <x-besoinsubtable :besoinsDetails='$besoinsDetails' :siteId='$siteId' :search='$search' :key='$key' />
                        </tr> 
                    @endforeach

    </table>

    @elseif (isset($result) && isset($site) && isset($repairDetails) && isset($search))
    {{-- Resultat de Materiels --}}
    <table class="table" id="showntable">
        <x-alert />
                    <tr>
                        {{-- <th></th> --}}
                        <x-materieltableheader />
                        <th class="hide">Action</th>
                    </tr>
                    @foreach ($result as $res)
                    <tr>
                        @php
                        $materielId = $res['id'];
                        $hasRepairs = false;
                        $hasIntervention = false;
                        
                        // Initialize a flag to track if all repair records have intervention
                        $allRepairsHaveIntervention = true;
                    
                        foreach ($repairDetails as $repmat) {
                            foreach ($repmat as $rep) {
                                if ($rep['materiel_id'] === $materielId) {
                                    $hasRepairs = true;
                                    if (!isset($rep['intervention'])) {
                                        // If any repair record doesn't have intervention, set the flag to false
                                        $allRepairsHaveIntervention = false;
                                    }
                                }
                            }
                        }
                    
                        // If all repair records have intervention, set $hasIntervention to true
                        if ($allRepairsHaveIntervention) {
                            $hasIntervention = true;
                        }
                    @endphp
                        @foreach ($site as $st)
                        @if($res['site_id']===$st['id'])
                        <td>{{ $st['type_poste']}}</td>
                        <td>{{ $st['nom_bureau']}}</td>
                        <td>{{ $st['num_bureau']}}</td>
                        @endif
                        @endforeach
                        <td>{{ $res['type'] }}</td>
                        <td>{{ $res['marque'] }}</td>
                        <td>{{ $res['model'] }}</td>
                        <td>{{ $res['numero_serie'] }}</td>
                        <td>{{ $res['numero_inventaire'] }}</td>
                        <td>{{ $res['etat'] }}</td>
                        <td class="truncate">{{ $res['description'] }}</td>
                        <td class="hide">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                      Options
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        @if($res['description'])
                                      <li>
                                        <button class="dropdown-item" onclick="showDescription('{{ $res['description'] }}')">Voir description</button>
                                      </li>
                                      @endif
                                        @if ($hasIntervention)
                                        <a class="dropdown-item" href="{{ route('demanderrep', ['id' => $materielId, 'search' => $search, 'key' => $key] ) }}">Demander réparation</a>
                                        @else
                                        <button class="dropdown-item" disabled >Réparation en-cours</button>
                                        @endif
                                      </li>
                                      <li><a class="dropdown-item" href="{{ route('supprimerMat', ['id' => $materielId, 'search' => $search, 'key' => $key] ) }}">Supprimer</a></li>
                                      <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateModal">Modifier</button></li>
                                     <li>
                                    </ul>
                                  </div>
                            </td>
                    </tr>
                    
                {{-- <tr class="repair-details-row" id="repair-details-{{ $res['id'] }}" style="display: none;">
                    <x-repair-sub-table :repairDetails='$repairDetails' :materielId='$materielId' :search='$search' :key='$key' />
                </tr>                    --}}
                @endforeach
         
    </table>
                 
    

    @else
    {{-- Necessaire pour le premier render, coming from RegisterController --}}

    <table class="table" id="showntable">
        <x-alert />
                    <thead>
                        <tr>
                            <x-materieltableheader />
                        </tr>
                    </thead>
                        @foreach ($materiel as $mat)
                        <tr>
                            @foreach ($site as $st)
                            @if($mat['site_id']===$st['id'])
                            <td>{{ $st['type_poste']}}</td>
                            <td>{{ $st['nom_bureau']}}</td>
                            <td>{{ $st['num_bureau']}}</td>
                            @endif
                            @endforeach
                            <td>{{ $mat['type'] }}</td>
                            <td>{{ $mat['marque'] }}</td>
                            <td>{{ $mat['model'] }}</td>
                            <td>{{ $mat['numero_serie'] }}</td>
                            <td>{{ $mat['numero_inventaire'] }}</td>
                            <td>{{ $mat['etat'] }}</td>
                            <td>{{ $mat['description'] }}</td>
                        </tr> 
                    @endforeach
    </table>

    
    @endif
                        </div>
                    <div class="card-footer  text-center">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/dashboardscripts.js')}}"></script>
@endsection


