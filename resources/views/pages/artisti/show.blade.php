<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-6">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                     {{$artista->nome}}
                </h2>
            </div>
            <div class="col-6 text-end">
                <a href="javascript:history.back();">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Indietro
                    </button>
                </a>

                <a href="{{route('artisti.edit',$artista)}}" class="btn btn-sm btn-outline-warning">
                    <i class="fa-solid fa-edit"></i> Modifica
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid border">

        <div class="row mt-4">
            <div class="col-2"></div>

            <div class="col-8">

                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm card p-2 m-1">
                                    @if($artista->wikipedia)
                                        <img src="{{$artista->getImgArtistaFromWiki()}}" class="my-2">
                                    @else
                                        <img src="{{$artista->getImgArtistaFromGoogle($artista->tipoArtista->tipo)}}" class="my-2">
                                    @endif
                                </div>

                                @if($artista->isCantante())
                                    <div class="col-sm card text-center p-2 m-1">
                                        <i class="fa fa-2x fa-calendar-days" title="Edizioni"></i>
                                        <p class="h1 mt-4">{{$artista->getPartecipazioni()}}</p>
                                    </div>

                                    <div class="col-sm card text-center p-2 m-1">
                                        <i class="fa fa-2x fa-trophy text-warning" title="Vincite"></i>
                                        <p class="h1 mt-4">{{$artista->getVittorie()}}</p>
                                    </div>
                                    <div class="col-sm card text-center p-2 m-1">
                                        <i class="fa fa-2x fa-2"></i>
                                        <p class="h1 mt-4">{{$artista->getSecondiPosto()}}</p>
                                    </div>
                                    <div class="col-sm card text-center p-2 m-1">
                                        <i class="fa fa-2x fa-3"></i>
                                        <p class="h1 mt-4">{{$artista->getTerziPosto()}}</p>
                                    </div>
                                    <div class="col-sm card text-center p-2 m-1">
                                        <i class="fa fa-2x fa-heart text-primary" title="Eurovision"></i>
                                        <p class="h1 mt-4">{{$artista->getEurovision()}}</p>
                                    </div>
                                    <div class="col-sm card text-center p-2 m-1">
                                        <i class="fa fa-2x fa-award text-info" title="Premi"></i>
                                        <p class="h1 mt-4">{{$artista->getPremi()}}</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2"></div>
        </div>

        <div class="row mt-4">
            <div class="col-2"></div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <label for="">Social</label>
                            <br>
                            @if($artista->wikipedia)
                                <a href="{{$artista->wikipedia}}" target="_blank" title="Wikipedia"><i class="fa-brands fa-wikipedia-w px-1"></i></a>
                            @else
                                <i class="fa-brands fa-wikipedia-w text-secondary px-1" title="No Wikipedia"></i>
                            @endif

                            @foreach($artista->socials as $social)
                                <a href="{{$social->link}}" target="_blank" title="{{$social->social->value}}">
                                    {!! \App\Enums\Social::from($social->social->value)->icon() !!}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>

        @if($artista->getConduzione() || $artista->getCoconduzione() || $artista->getOspitate())
            <div class="row mt-4">
                <div class="col-2"></div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm card text-center p-2 m-1">
                                        Conduzioni
                                        <p class="h1 mt-3">{{$artista->getConduzione()}}</p>
                                        <p class="small">
                                            @foreach($artista->edizioni->where('pivot.ruolo', 'conduttore')->sortBy('numero') as $edizione)
                                                <a href="{{route('edizioni.show', $edizione)}}" class="btn btn-sm btn-outline-info" title="{{$edizione->anno}}">
                                                    {{$edizione->numero}}
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div class="col-sm card text-center p-2 m-1">
                                        Coconduzioni
                                        <p class="h1 mt-3">{{$artista->getCoconduzione()}}</p>
                                        <p class="small">
                                            @foreach($artista->edizioni->where('pivot.ruolo', 'coconduttore')->sortBy('numero') as $edizione)
                                                <a href="{{route('edizioni.show', $edizione)}}" class="btn btn-sm btn-outline-info" title="{{$edizione->anno}}">
                                                    {{$edizione->numero}}
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div class="col-sm card text-center p-2 m-1">
                                        Ospitate
                                        <p class="h1 mt-3">{{$artista->getOspitate()}}</p>
                                        <p class="small">
                                            @foreach($artista->edizioni->where('pivot.ruolo', 'ospite')->sortBy('numero') as $edizione)
                                                <a href="{{route('edizioni.show', $edizione)}}" class="btn btn-sm btn-outline-info" title="{{$edizione->anno}}">
                                                    {{$edizione->numero}}
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2"></div>
            </div>
        @endif

        @if($artista->isCantante())
            <div class="row mt-4">
                <div class="col-2"></div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-striped table-bordered border" style="width:96%;margin:10px auto;">
                                <thead>
                                    <tr>
                                        <th class="bg-light text-center" style="width:60px;">Ed.</th>
                                        <th class="bg-light text-center" style="width:60px;">Anno</th>
                                        <th class="bg-light" style="width:60px;">Tipo</th>
                                        <th class="bg-light" style="width:60px;">Pos.</th>
                                        <th class="bg-light text-center" style="width:1%;"><i class="fa fa-heart text-primary" title="Pos. Eurovision"></i></th>
                                        <th class="bg-light">Titolo</th>
                                        <th class="bg-light">Premi</th>
                                        <th class="bg-light" style="width:40px;"><i class="fa-brands fa-spotify text-success" title="Spotify"></i></th>
                                        <th class="bg-light" style="width:40px;"><i class="fa fa-video text-info" title="Esibizione"></i></th>
                                        <th class="bg-light" style="width:40px;"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
                                        <th class="bg-light" style="width:40px;"><i class="fa fa-video text-primary" title="Eurovision"></i></th>
                                        <th class="bg-light" style="min-width:40px;"><i class="fa fa-video" title="Altro"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($artista->canzoni->sortByDesc('tipo')->sortByDesc('edizione.anno') as $canzone)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{route('edizioni.show', $canzone->edizione)}}" class="btn btn-sm btn-outline-info" title="Vedi edizione">
                                                    {{$canzone->edizione->numero}}
                                                </a>
                                            </td>
                                            <td class="text-center">{{$canzone->edizione->anno}}</td>
                                            <td>{{$canzone->tipo->description()}}</td>
                                            <td class="text-center">
                                                @if($canzone->posizione == 1)
                                                    <i class="fa-solid fa-trophy text-warning" title="{{$canzone->posizione}}"></i>
                                                @else
                                                    {{$canzone->posizione == 99 ? 'NC' : $canzone->posizione}}
                                                @endif
                                            </td>
                                            <td>{{$canzone->posizione_eurovision}}</td>
                                            <td>
                                                {{$canzone->titolo}}
                                                @if($canzone->tipo == \App\Enums\TipoCanzone::COVER)
                                                    <span class="small"> ft. {!! $canzone->artisti->pluck('nome')->reject($artista->nome)->implode(', ') !!}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($canzone->premi as $premio)
                                                    <badge class="badge" style="background:{{$premio->colore}}" title="{{$premio->nome}}">{{$premio->etichetta}}</badge>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($canzone->spotify)
                                                    <a href="{{$canzone->spotify}}" target="_blank">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-2"></div>
            </div>
        @endif
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {

            });
        </script>
    @stop
</x-app-layout>
