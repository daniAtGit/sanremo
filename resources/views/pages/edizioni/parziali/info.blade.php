<div class="row m-1">
    <div class="col-12">
        <span class="small text-secondary">Conduttori</span>
        <div class="row">
            @foreach($edizione->conduttori() as $artista)
                <div class="card p-1 m-1" style="width:150px;">
                    <img src="{{$artista->getImgArtistaFromGoogle()}}" style="width:180px;">
                    <div class="card-body">
                        <h5 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<br>

<div class="row m-1">
    <div class="col-12">
        <span class="small text-secondary">Coconduttori</span>
        <br>
        <div class="row">
            @foreach($edizione->coconduttori() as $artista)
                <div class="card p-1 m-1" style="width:150px;">
                    <img src="{{$artista->getImgArtistaFromGoogle()}}" style="width:180px;">
                    <div class="card-body">
                        <h4 class="card-title">{{\Illuminate\Support\Str::ucfirst($artista->nome)}}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<br>

<div class="card-group">
    @foreach($edizione->socials->where('social',\App\Enums\Social::ALTRO) as $i => $altro)
        <div class="flex">
            <div class="card m-2">
                <div class="card-body col">
                    <h5 class="card-title bg-light p-2  ">{{ $altro->getVideoTitle($altro->link) }}</h5>
                    {!! $altro->getVideo($altro->link) !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

<br>

<div class="row m-1">
    <div class="col-12">
        <span class="small text-secondary">Note</span>
        <br>
        {!! $edizione->note !!}hsgdh
    </div>
</div>
