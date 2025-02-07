<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-6">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edizione {{$edizione->numero}} del {{$edizione->anno}}
                </h2>
            </div>
            <div class="col-6 text-end">
                <a href="{{route('edizioni.index')}}">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Indietro
                    </button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid border">


        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#portlet_edit" data-toggle="tab">Info</a>
            </li>
            <li>
                <a href="#portlet_config" data-toggle="tab">Conduttori</a>
            </li>
        </ul>


        <div class="tab-content">
            <div class="tab-pane active" id="portlet_edit">
                a
            </div>
            <div class="tab-pane" id="portlet_config">
                b
            </div>
        </div>




















        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-6">
                        <span class="small text-secondary">Luogo</span>
                        <br>
                        {{\App\Enums\Luogo::from($edizione->luogo->value)->description() ?? ''}}
                    </div>
                    <div class="col-6 text-end">
                        <span class="small text-secondary">Dal-al</span>
                        <br>
                        {{$edizione->data_da?->format('d M')}} - {{$edizione->data_a?->format('d M')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <span class="small text-secondary">Conduttori</span>
                        <div class="row">
                            @foreach($edizione->conduttori() as $artista)
                                <div class="card p-1 m-1" style="width:180px;">
                                    <img src="{{$artista->getImgArtistaFromGoogle()}}" style="width:180px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h5>
{{--                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
{{--                                        <a href="#" class="btn btn-primary">Go somewhere</a>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <span class="small text-secondary">Coconduttori</span>
                        <br>
                        <div class="row float-end">
                            @foreach($edizione->coconduttori() as $artista)
                                <div class="card p-1 m-1" style="width:180px;">
                                    <img src="{{$artista->getImgArtistaFromGoogle()}}" style="width:180px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
{{--                        {{$edizione->coconduttori()->pluck('nome')->implode(', ')}}--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="row mt-3">
                <div class="col-12">
                    <p style="width:96%;margin:10px auto;font-size:22px;">Classifica</p>
                    <table class="table table-hover table-bordered border" style="width:96%;margin:10px auto;">
                        <thead>
                            <tr>
                                <th class="bg-light text-center" style="width:3%;">Pos</th>
                                <th class="bg-light" style="width:39%">Canzone</th>
                                <th class="bg-light" style="width:38%">Artisti</th>
                                <th class="bg-light" style="width:20%">Premio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::GARA)->sortBy('posizione') as $i => $canzone)
                                <tr>
                                    <td class="text-center" @if($canzone->posizione == 1) style="background:#ffff00;" @endif>
                                        @if($canzone->posizione == 1)
                                            <i class="fa-solid fa-crown" title="{{$canzone->posizione}}"></i>
                                        @else
                                            {{$canzone->posizione}}
                                        @endif
                                    </td>
                                    <td>{{$canzone->titolo}}</td>
                                    <td>{{$canzone->artisti->pluck('nome')->implode(', ')}}</td>
                                    <td>{!! $canzone->premi->pluck('nome')->implode('<br>') !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="row mt-3">
                <div class="col-12">
                    <p style="width:96%;margin:10px auto;font-size:22px;">Cover</p>
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
                                        {{$canzone->posizione}}
                                    @endif
                                </td>
                                <td>{{$canzone->titolo}}</td>
                                <td>{{$canzone->artisti->pluck('nome')->implode(', ')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4 mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="small text-secondary">Note</span>
                        <br>
                        {!! $edizione->note !!}
                    </div>
                </div>
            </div>
        </div>

        @foreach($edizione->socials->where('social',\App\Enums\Social::ALTRO) as $i => $altro)
            <div class="card p-1 m-1">
                <div class="card-body">
                    @php
                        $youtubeUrl =  \JUri::getInstance('https://www.youtube.com/watch?v=ndmXkyohT1M');
                        $videoId = $youtubeUrl->getVar('v'); ?>

    <iframe id="ytplayer" type="text/html" width="640" height="390"  src="http://www.youtube.com/embed/<?php echo $videoId; ?>"  frameborder="0"/>
                    @endphp
                </div>
            </div>
        @endforeach
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {

            });
        </script>
    @stop
</x-app-layout>
