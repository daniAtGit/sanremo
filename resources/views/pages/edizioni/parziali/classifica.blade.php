<table class="table table-hover table-striped table-bordered border" style="width:96%;margin:10px auto;">
    <thead>
        <tr>
            <th class="bg-light text-center" style="width:1%;">Pos</th>
            <th class="bg-light">Canzone</th>
            <th class="bg-light">Artisti</th>
            <th class="bg-light">Premi</th>
            <th class="bg-light" style="width:40px;"><i class="fa fa-video text-primary" title="Esibizione"></i></th>
            <th class="bg-light" style="width:40px;"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
            <th class="bg-light" style="width:40px;"><i class="fa fa-video text-danger" title="Eurovision"></i></th>
            <th class="bg-light" style="min-width:40px;"><i class="fa fa-video" title="Altro"></i></th>
            <th class="bg-light text-center" style="width:1%;"><i class="fa fa-heart text-primary" title="Eurovision"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::GARA)->sortBy('posizione') as $c => $canzone)
            <tr>
                <td class="text-center" @if($canzone->posizione == 1) style="background:#ffff00;" @endif>
                    @if($canzone->posizione == 1)
                        <i class="fa-solid fa-trophy" title="{{$canzone->posizione}}"></i>
                    @else
                        {{$canzone->posizione == 99 ? 'NC' : $canzone->posizione}}
                    @endif
                </td>
                <td>{{$canzone->titolo}}</td>
                <td>
                    @foreach($canzone->artisti as $i => $artista)
                        @if($i !=0) - @endif
                        <a href="{{route('artisti.show',$artista->id)}}">{{$artista->nome}}</a>
                    @endforeach
                </td>
                <td>
                    @foreach($canzone->premi as $premio)
                        <badge class="badge" style="background:{{$premio->colore}}" title="{{$premio->nome}}">{{$premio->etichetta}}</badge>
                    @endforeach
                </td>
                <td>
                    @if($canzone->esibizione)
                        <a href="{{$canzone->esibizione}}" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                    @endif
                </td>
                <td>
                    @if($canzone->videoclip)
                        <a href="{{$canzone->videoclip}}" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                    @endif
                </td>
                <td>
                    @if($canzone->eurovision)
                        <a href="{{$canzone->eurovision}}" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                    @endif
                </td>
                <td>
                    @foreach($canzone->socials->where('social',\App\Enums\Social::ALTRO) as $social)
                        <a href="{{$social->link}}" target="_blank">
                            <i class="fa fa-link"></i>
                        </a>
                    @endforeach
                </td>
                <td>{{$canzone->posizione_eurovision}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
