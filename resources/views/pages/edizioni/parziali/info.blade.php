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
                    <a href="{{route('artisti.show', $artista->id)}}">
                        <img loading="lazy" src="{{$artista->getImgArtistaFromGoogle('sanremo', $edizione->anno)}}" style="width:180px;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h5>
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
                    <a href="{{route('artisti.show', $artista->id)}}">
                        <img loading="lazy" src="{{$artista->getImgArtistaFromGoogle('sanremo', $edizione->anno)}}" style="width:180px;">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h4>
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
                    <a href="{{route('artisti.show', $artista->id)}}">
                        <img loading="lazy" src="{{$artista->getImgArtistaFromGoogle('sanremo', $edizione->anno)}}" style="width:180px;">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
