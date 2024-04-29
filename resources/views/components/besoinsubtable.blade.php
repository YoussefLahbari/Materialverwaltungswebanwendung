<!-- He who is contented is rich. - Laozi -->
<td colspan="12">
    @php
    $BesoinsCount = 0;
    foreach ($besoinsDetails as $besoin)  {
        foreach ($besoin as $b)  {
            if ($b['site_id'] == $siteId) {
                $BesoinsCount++;
            }
        }
    }
    @endphp
    @if ($BesoinsCount > 0)
    <details class="mt-1 mb-1">
        <summary class="d-flex justify-content-between align-items-center">
            <span class="ms-2">Historique des besoins</span>
            <span class="badge bg-primary rounded-pill me-2">{{$BesoinsCount}}</span>
        </summary>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Date De Demande</th>
                <th>Type de Besoin</th>
                <th>Quantité</th>
            </tr>
                @foreach ($besoinsDetails as $besoin) 
                    @foreach ($besoin->sortByDesc('created_at') as $b) 
                    @if ($b['site_id'] == $siteId)
                        <tr>
                            <td>{{$b['id']}}</td>
                            <td>{{$b['created_at']}}</td>
                            <td>{{$b['request_type']}}</td>
                            <td>{{$b['quantity']}}</td>
                        </tr>
                    @endif
                    @endforeach  
                @endforeach
            </table>
    </details>
    @else 
    Ce Site n'a jamais Demander de materiaux
    @endif
</td>
