@if($edizione->note)
    <div class="row m-1">
        <div class="col-12">
            <span class="small text-secondary">Note</span>
            <br>
            {!! $edizione->note !!}
        </div>
    </div>

    <br>
@endif

<div class="row m-1">
    <div class="col-3">
        <span class="small text-secondary">Conduttori</span>
        <div class="row">
            @foreach($edizione->conduttori() as $c => $artista)
                <div class="card p-1 m-1" style="width:150px;">
                    <div class="card-body text-center">
                        @auth
                            <a href="{{route('artisti.show', $artista->id)}}">
                        @endauth
                            {{\Illuminate\Support\Str::ucfirst($artista->nome)}}
                        @auth
                            </a>
                        @endauth
                    </div>
                    <div class="card-footer">
                        <i class="fa fa-sm fa-camera fotoFromGoole" role="button" title="Foto" data-bs-toggle="modal" data-bs-target="#modalFoto" alt="{{$artista->id}}"></i>
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
{{--                        <h5 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h5>--}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-9">
        <span class="small text-secondary">Coconduttori</span>
        <br>
        <div class="row">
            @foreach($edizione->coconduttori() as $artista)
                <div class="card p-1 m-1" style="width:150px;">
                    <div class="card-body text-center">
                        @auth
                            <a href="{{route('artisti.show', $artista->id)}}">
                                @endauth
                                {{\Illuminate\Support\Str::ucfirst($artista->nome)}}
                                @auth
                            </a>
                        @endauth
                    </div>
                    <div class="card-footer">
                        <i class="fa fa-sm fa-camera fotoFromGoole" role="button" title="Foto" data-bs-toggle="modal" data-bs-target="#modalFoto" alt="{{$artista->id}}"></i>
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

<br>
<div class="row m-1">
    <div class="col-12">
        <span class="small text-secondary">Ospiti</span>
        <br>
        <div class="row">
            @foreach($edizione->ospiti() as $artista)
                <div class="card p-1 m-1" style="width:150px;">
                    <div class="card-body text-center">
                        @auth
                            <a href="{{route('artisti.show', $artista->id)}}">
                                @endauth
                                {{\Illuminate\Support\Str::ucfirst($artista->nome)}}
                                @auth
                            </a>
                        @endauth
                    </div>
                    <div class="card-footer">
                        <i class="fa fa-sm fa-camera fotoFromGoole" role="button" title="Foto" data-bs-toggle="modal" data-bs-target="#modalFoto" alt="{{$artista->id}}"></i>
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
