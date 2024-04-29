    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <td colspan="12">
        @php
            $repairedMaterialsCount = 0;
            $repairRequestsCount = 0;
            foreach ($repairDetails as $repmat) {
                foreach ($repmat as $rep) {
                    if ($rep['materiel_id'] === $materielId) {
                        if (isset($rep['date_reparation'])) {
                            $repairedMaterialsCount++;
                        } 
                        else{
                            $repairRequestsCount++;
                        }
                    }
                }
            }
        @endphp
        @if ($repairRequestsCount > 0)
            <details class="mt-1 mb-1">
                <summary class="d-flex justify-content-between align-items-center">
                    <span class="ms-2">Demande de Reparation</span>
                    <span class="badge bg-primary rounded-pill me-2">{{$repairRequestsCount}}</span>   
                </summary>
                <table class="table">
                    <tr>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($repairDetails as $repmat)
                        @foreach ($repmat as $rep)
                            @if ($rep['materiel_id'] === $materielId && !isset($rep['intervention']))
                                <tr>
                                    <td>{{ $rep['created_at'] }}</td>
                                    <td class="d-flex justify-content-around align-items-center">
                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Réparer
                                        </button>
                                        <a href="{{ route('request.destroy', ['id' => $rep['id'], 'search' => $search, 'key' =>  $key ]) }}" class="btn btn-danger col-4">Anuller</a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">details de réparation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{route('request.update', $rep['id'])}}">
                                                        @csrf
                                                        <div class="mb-3">
                                                          <label for="Technicien" class="col-form-label">Technicien:</label>
                                                          <input type="text" class="form-control" id="Technicien" name="Technicien">
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="Intervention" class="col-form-label">Intervention:</label>
                                                          <textarea class="form-control" id="Intervention" name="Intervention"></textarea>
                                                        </div>
                                                      
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Réparer</button>
                                            </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
            </table>
        </details>
    @endif
    @if ($repairedMaterialsCount > 0)
            <details>
                <summary class="d-flex justify-content-between align-items-center">
                    <span class="ms-2">Historique de Reparation</span>
                    <span class="badge bg-primary rounded-pill me-2">{{$repairedMaterialsCount}}</span>   
                </summary>
                <table class="table">
                    <tr>
                        <th>Numero d'intervention</th>
                        <th>Date</th>
                        <th>Intervention</th>
                    </tr>
                    @foreach ($repairDetails as $repmat)
                        @foreach ($repmat as $rep)
                            @if ($rep['materiel_id'] === $materielId && isset($rep['intervention']))
                                <tr>
                                    <td>Num int</td>
                                    <td>{{$rep['date_reparation']}}</td>
                                    <td>{{$rep['intervention']}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </table>
            </details>
        @endif
</td>
