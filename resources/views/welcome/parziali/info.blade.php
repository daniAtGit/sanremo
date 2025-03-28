@if($edizione->note)
    <div class="row m-1">
        <div class="col-12">
            <span class="p-1 small text-secondary border border-secondary rounded-top-4 rounded-start-0">Note</span>
            <br>
            {!! $edizione->note !!}
        </div>
    </div>

    <br>
@endif

<div class="row m-1">

    <div class="">
        <span class="p-1 small text-secondary border border-primary rounded-top-4 rounded-start-0">Conduttori</span>
        <div class="m-2 row">
            @foreach($edizione->conduttori() as $c => $artista)
                <div class="row m-1 p-1 border" style="border-left:5px solid #2563eb !important;">
                    <div class="col-7">
                        @auth
                            <a href="{{route('artisti.show', $artista->id)}}">
                        @endauth
                            {{\Illuminate\Support\Str::ucfirst($artista->nome)}}
                        @auth
                            </a>
                        @endauth
                    </div>

                    <div class="col-5 text-end">
                        <a href="https://www.google.com/search?q={{$artista->nome}}+sanremo+{{$edizione->anno}}&tbm=isch" target="_blank">
                            <i class="fa fa-sm fa-camera" title="Foto"></i>
                        </a>
                        @if($artista->wikipedia)
                            <a href="{{$artista->wikipedia}}" target="_blank" title="Wikipedia"><i class="fa-brands fa-sm fa-wikipedia-w px-1"></i></a>
                        @else
                            <i class="fa-brands fa-sm fa-wikipedia-w text-secondary px-1" title="No Wikipedia"></i>
                        @endif

                        @foreach($artista->socials as $social)
                            <a href="{{$social->link}}" target="_blank" title="{{$social->social->value}}">
                                {!! \App\Enums\Social::from($social->social->value)->icon() !!}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-3">
        <span class="p-1 small text-secondary border border-warning rounded-top-4 rounded-start-0">Coconduttori</span>
        <div class="m-2 row">
            @foreach($edizione->coconduttori() as $c => $artista)
                <div class="row m-1 p-1 border" style="border-left:5px solid #ffc107 !important;">
                    <div class="col-7">
                        @auth
                            <a href="{{route('artisti.show', $artista->id)}}">
                                @endauth
                                {{\Illuminate\Support\Str::ucfirst($artista->nome)}}
                                @auth
                            </a>
                        @endauth
                    </div>

                    <div class="col-5 text-end">
                        <a href="https://www.google.com/search?q={{$artista->nome}}+sanremo+{{$edizione->anno}}&tbm=isch" target="_blank">
                            <i class="fa fa-sm fa-camera" title="Foto"></i>
                        </a>
                        @if($artista->wikipedia)
                            <a href="{{$artista->wikipedia}}" target="_blank" title="Wikipedia"><i class="fa-brands fa-sm fa-wikipedia-w px-1"></i></a>
                        @else
                            <i class="fa-brands fa-sm fa-wikipedia-w text-secondary px-1" title="No Wikipedia"></i>
                        @endif

                        @foreach($artista->socials as $social)
                            <a href="{{$social->link}}" target="_blank" title="{{$social->social->value}}">
                                {!! \App\Enums\Social::from($social->social->value)->icon() !!}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-3">
        <span class="p-1 small text-secondary border border-danger rounded-top-4 rounded-start-0">Ospiti</span>
        <div class="m-2 row">
            @foreach($edizione->ospiti() as $c => $artista)
                <div class="row m-1 p-1 border" style="border-left:5px solid #dc3545 !important;">
                    <div class="col-7">
                        @auth
                            <a href="{{route('artisti.show', $artista->id)}}">
                                @endauth
                                {{\Illuminate\Support\Str::ucfirst($artista->nome)}}
                                @auth
                            </a>
                        @endauth
                    </div>

                    <div class="col-5 text-end">
                        <a href="https://www.google.com/search?q={{$artista->nome}}+sanremo+{{$edizione->anno}}&tbm=isch" target="_blank">
                            <i class="fa fa-sm fa-camera" title="Foto"></i>
                        </a>
                        @if($artista->wikipedia)
                            <a href="{{$artista->wikipedia}}" target="_blank" title="Wikipedia"><i class="fa-brands fa-sm fa-wikipedia-w px-1"></i></a>
                        @else
                            <i class="fa-brands fa-sm fa-wikipedia-w text-secondary px-1" title="No Wikipedia"></i>
                        @endif

                        @foreach($artista->socials as $social)
                            <a href="{{$social->link}}" target="_blank" title="{{$social->social->value}}">
                                {!! \App\Enums\Social::from($social->social->value)->icon() !!}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
