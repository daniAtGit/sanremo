<table class="table table-hover table-bordered border" style="width:96%;margin:10px auto;">
    <thead>
        <tr>
            <th class="bg-light text-center" style="width:3%;">Pos</th>
            <th class="bg-light" style="width:39%">Canzone</th>
            <th class="bg-light" style="width:58%">Artisti</th>
        </tr>
    </thead>
    <tbody>
    @foreach($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::COVER)->sortBy('titolo')->sortBy('posizione') as $i => $canzone)
        <tr>
            <td class="text-center" @if($canzone->posizione == 1) style="background:#ffff00;" @endif>
                @if($canzone->posizione == 1)
                    <i class="fa-solid fa-crown" title="{{$canzone->posizione}}"></i>
                @else
                    {{$canzone->posizione == 99 ? 'NC' : $canzone->posizione}}
                @endif
            </td>
            <td>{{$canzone->titolo}}</td>
            <td>{{$canzone->artisti->pluck('nome')->implode(', ')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
