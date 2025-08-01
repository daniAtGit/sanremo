<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight px-3">Canzoni</h2>

<table class="table table-hover table-striped table-bordered border" style="width:96%;margin:10px auto;">
    @foreach($canzoni as $canzone)
        <tr>
            <td class="small">
                <b>{{$canzone->titolo}}</b>
                <br>
                @foreach($canzone->artisti as $i => $artista)
                    @if($i !=0) - @endif
                    <a href="{{route('welcome.artista.show',$artista)}}">{{$artista->nome}}</a>
                @endforeach
            </td>
            <td class="text-center" style="width:30px;">
                <form method="post" action="{{route('changeEdizione')}}">
                    @csrf
                    <input type="hidden" name="edizione" value="{{$canzone->edizione->id}}">
                    <span class="text-info" style="font-size:10px;">{{$canzone->edizione->anno}}</span>
                    <input type="submit" class="btn btn-sm btn-outline-info" value="{{$canzone->edizione->numero}}">
                </form>
            </td>
            <td class="text-center" style="width:30px;">
                <span style="font-size:10px;">Pos.</span>
                @if($canzone->posizione == 1)
                    <i class="fa-solid fa-trophy" title="{{$canzone->posizione}}"></i>
                @else
                    {{$canzone->posizione == 99 ? 'NC' : $canzone->posizione}}
                @endif
            </td>

            @if(!isMobile())
                @if($canzone->spotify)
                    <td style="width:30px;">
                        <span style="font-size:10px;">Sp.</span>
                        <a href="{{$canzone->spotify}}" target="_blank">
                            <i class="fa-brands fa-sm fa-spotify text-success"></i>
                        </a>
                    </td>
                @endif
                <td style="width:30px;">
                    <span style="font-size:10px;">Esib.</span>
                    <a href="{{$canzone->esibizione}}" target="_blank">
                        <i class="fa fa-sm fa-video text-info"></i>
                    </a>
                </td>
                <td style="width:30px;">
                    <span style="font-size:10px;">Video</span>
                    <a href="{{$canzone->videoclip}}" target="_blank">
                        <i class="fa fa-sm fa-video text-warning"></i>
                    </a>
                </td>
                @if($canzone->posizione_eurovision)
                    <td style="width:30px;">
                        <span style="font-size:10px;">EuroV</span>
                        <a href="{{$canzone->eurovision}}" target="_blank">
                            <i class="fa fa-sm fa-video text-primary"></i>
                        </a>
                    </td>
                    <td class="text-center" style="background:url({{asset('images/eurovision.png')}}) no-repeat center calc(100% - 5px);width:45px;">
                        <br>
                        <a href="https://it.wikipedia.org/wiki/Eurovision_Song_Contest_{{$canzone->edizione->anno}}" target="_blank" title="Pos. Eurovision">
                            {{$canzone->posizione_eurovision}}
                        </a>
                    </td>
                @endif
            @endif
        </tr>
    @endforeach
</table>
