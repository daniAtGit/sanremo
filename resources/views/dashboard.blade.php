<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container">
                        <div class="row">

                            <div class="col-sm card text-center p-2 m-1">
                                <a href="{{route('edizioni.index')}}">
                                    <i class="fa fa-2x fa-calendar-days" title="Edizioni"></i>
                                    <p class="h1 mt-4">{{$edizioni}}</p>
                                </a>
                            </div>

                            <div class="col-sm card text-center p-2 m-1">
                                <a href="{{route('canzoni.index')}}">
                                    <i class="fa fa-2x fa-guitar" title="Canzoni"></i>
                                    <p class="h1 mt-4">{{$canzoni}}</p>
                                </a>
                            </div>

                            <div class="col-sm card text-center p-2 m-1">
                                <a href="{{route('artisti.index')}}">
                                    <i class="fa fa-2x fa-microphone-lines" title="Artisti"></i>
                                    <p class="h1 mt-4">{{$artisti}}</p>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="small py-1">Ultima edizione</p>
                    <table class="table table-hover table-striped table-bordered border">
                        <thead>
                            <tr>
                                <th class="bg-light">N°</th>
                                <th class="bg-light">Wiki</th>
                                <th class="bg-light">Date</th>
                                <th class="bg-light">Luogo</th>
                                <th class="bg-light">Presentatore</th>
                                <th class="bg-light">Co-conduttori</th>
                                <th class="bg-light">Ospiti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{route('edizioni.show', $lastEdition)}}" class="btn btn-sm btn-outline-info">
                                        {{$lastEdition->numero}}
                                    </a>
                                </td>
                                <td>
                                    @if($lastEdition->wikipedia)
                                        <a href="{{$lastEdition->wikipedia}}" target="_blank" title="Wikipedia"><i class="fa-brands fa-wikipedia-w px-1"></i></a>
                                    @else
                                        <i class="fa-brands fa-wikipedia-w text-secondary px-1" title="No Wikipedia"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($lastEdition->data_da)
                                        {{$lastEdition->data_da?->format('d/m/Y')}} - {{$lastEdition->data_a?->format('d/m/Y')}}
                                    @else
                                        {{$lastEdition->anno}}
                                    @endif
                                </td>
                                <td>{{\App\Enums\Luogo::from($lastEdition->luogo->value)->description()}}</td>
                                <td>
                                    @foreach($lastEdition->conduttori() as $i => $artista)
                                        @if($i !=0) - @endif
                                        <a href="{{route('artisti.show',$artista->id)}}">{{$artista->nome}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($lastEdition->coconduttori() as $i => $artista)
                                        @if($i !=0) - @endif
                                        <a href="{{route('artisti.show',$artista->id)}}">{{$artista->nome}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($lastEdition->ospiti() as $i => $artista)
                                        @if($i !=0) - @endif
                                        <a href="{{route('artisti.show',$artista->id)}}">{{$artista->nome}}</a>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="small py-1">Gara</p>
                    <table class="table table-hover table-striped table-bordered border">
                        <thead>
                            <tr>
                                <th class="bg-light text-center" style="width:1%;">Pos</th>
                                <th class="bg-light text-center" style="width:1%;"><i class="fa fa-heart text-primary" title="Pos. Eurovision"></i></th>
                                <th class="bg-light">Canzone</th>
                                <th class="bg-light">Artisti</th>
                                <th class="bg-light">Premi</th>
                                <th class="bg-light" style="width:40px;"><i class="fa-brands fa-spotify text-success" title="Spotify"></i></th>
                                <th class="bg-light" style="width:40px;"><i class="fa fa-video text-info" title="Esibizione"></i></th>
                                <th class="bg-light" style="width:40px;"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
                                <th class="bg-light" style="width:40px;"><i class="fa fa-video text-primary" title="Eurovision"></i></th>
                                <th class="bg-light" style="min-width:40px;"><i class="fa fa-video" title="Altro"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($garaTop5 as $canzone)
                                <tr>
                                    <td class="text-center" @if($canzone->posizione == 1) style="background:#ffff00;" @endif>
                                        @if($canzone->posizione == 1)
                                            <i class="fa-solid fa-trophy" title="{{$canzone->posizione}}"></i>
                                        @else
                                            {{$canzone->posizione == 99 ? 'NC' : $canzone->posizione}}
                                        @endif
                                    </td>
                                    <td>{{$canzone->posizione_eurovision}}</td>
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

                    <p class="small py-1">Cover</p>
                    <table class="table table-hover table-striped table-bordered border">
                        <thead>
                            <tr>
                                <th class="bg-light text-center" style="width:3%;">Pos</th>
                                <th class="bg-light" style="width:39%">Canzone</th>
                                <th class="bg-light" style="width:58%">Artisti</th>
                                <th class="bg-light" style="width:40px;"><i class="fa-brands fa-spotify text-success" title="Spotify"></i></th>
                                <th class="bg-light" style="width:40px;"><i class="fa fa-video text-info" title="Esibizione"></i></th>
                                <th class="bg-light" style="width:40px;"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coverTop5 as $canzone)
                                <tr>
                                    <td class="text-center" @if($canzone->posizione == 1) style="background:#ffff00;" @endif>
                                        @if($canzone->posizione == 1)
                                            <i class="fa-solid fa-crown" title="{{$canzone->posizione}}"></i>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
