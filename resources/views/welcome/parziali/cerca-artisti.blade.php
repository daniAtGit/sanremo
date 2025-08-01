<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight px-3">Artisti</h2>

<table class="table table-hover table-striped table-bordered border" style="width:96%;margin:10px auto;">
    @foreach($artisti as $artista)
        <tr>
            <td class="small">
                <a href="{{route('welcome.artista.show',$artista)}}"><b>{{$artista->nome}}</b></a>
                <br>
                <span class="small">{{$artista->tipoArtista->tipo}}</span>
            </td>
            <td class="text-center" style="width:30px;">
                <span style="font-size:10px;"><i class="fa-solid fa-trophy text-warning"></i></span>
                {{$artista->getVittorie()}}
            </td>
            <td class="text-center" style="width:30px;">
                <span style="font-size:10px;">Ediz.</span>
                {{$artista->getPartecipazioni()}}
            </td>
            <td class="text-center" style="background:url({{asset('images/eurovision.png')}}) no-repeat center calc(100% - 5px);width:30px;">
                <span style="font-size:10px;">EuroV</span>
                {{$artista->getEurovision()}}
            </td>
            <td class="text-center" style="width:30px;">
                <span style="font-size:10px;">Last</span>
                @if($artista->isCantante())
                    <form method="post" action="{{route('changeEdizione')}}">
                        @csrf
                        <input type="hidden" name="edizione" value="{{$artista->getUltimaEdizione()->id}}">
                        <input type="submit" class="btn btn-sm btn-outline-info" value="{{$artista->getUltimaEdizione()->numero}}" title="{{$artista->getUltimaEdizione()->anno}}">
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</table>
