<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight px-3">Edizioni</h2>

<table class="table table-hover table-striped table-bordered border" style="width:96%;margin:10px auto;">
    @foreach($edizioniS as $edizione)
        <tr>
            <td class="text-center" style="width:30px;">
                <a href="{{route('edizioni.show', $edizione)}}" class="btn btn-sm btn-outline-info">
                    {{$edizione->numero}}
                </a>
                <p class="text-info" style="font-size:10px;">{{$edizione->anno}}</p>
            </td>
            <td class="small" style="width:150px;">
                <span style="font-size:10px;">Luogo</span>
                <br>
                <b>{{\App\Enums\Luogo::from($edizione->luogo->value)->description()}}</b>
            </td>
            <td class="small">
                <span style="font-size:10px;">Conduttore</span>
                <br>
                <b>{{$edizione->conduttori()->pluck('nome')->implode(', ')}}</b>
            </td>
            <td style="font-size:10px;">
                <i class="fa-solid fa-trophy text-warning"></i>
                <b>{{$edizione->getTitoloCanzoneVincente()}}</b> - {{$edizione->canzoni->where('posizione',1)->first()?->artisti->pluck('nome')->implode(', ')}}
                <br>
                <span class="px-1 text-info"><b>2</b></span>
                <b>{{$edizione->getTitoloCanzoneSeconda()}}</b> - {{$edizione->canzoni->where('posizione',2)->first()?->artisti->pluck('nome')->implode(', ')}}
                <br>
                <span class="px-1 text-info"><b>3</b></span>
                <b>{{$edizione->getTitoloCanzoneTerza()}}</b> - {{$edizione->canzoni->where('posizione',3)->first()?->artisti->pluck('nome')->implode(', ')}}
            </td>
        </tr>
    @endforeach
</table>
