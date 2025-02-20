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

                <a href="{{route('edizioni.edit',$edizione)}}" class="btn btn-sm btn-outline-warning">
                    <i class="fa-solid fa-edit"></i> Modifica
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid border">

        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-6">
                        <span class="small text-secondary">Luogo</span>
                        <br>
                        <div class="card p-1 my-1" style="width:100px;">
                            <a href="https://www.google.com/search?q=scenografia+sanremo+{{$edizione->anno}}&tbm=isch" target="_blank">
                                <img src="{{$edizione->getScenografiaFromGoogle($edizione->anno)}}" style="width:100px;">
                            </a>
                        </div>
                        {{\App\Enums\Luogo::from($edizione->luogo->value)->description() ?? ''}}
                    </div>
                    <div class="col-6 text-end">
                        <span class="small text-secondary">Dal-al</span>
                        <br>
                        {{$edizione->data_da?->format('d M')}} - {{$edizione->data_a?->format('d M')}}
                        <br>
                        <br>
                        @if($edizione->wikipedia)
                            <a href="{{$edizione->wikipedia}}" target="_blank"><i class="fa-brands fa-wikipedia-w"></i>ikipedia</a>
                        @else
                            <i class="fa-brands fa-wikipedia-w text-secondary" title="No Wikipedia"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 py-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="home" aria-selected="true">Info</button>
                </li>
                @if($edizione->ospiti()->count())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="home" aria-selected="true">Video</button>
                    </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#classifica" type="button" role="tab" aria-controls="profile" aria-selected="false">Classifica</button>
                </li>
                @if($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::COVER)->count())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cover" type="button" role="tab" aria-controls="contact" aria-selected="false">Cover</button>
                    </li>
                @endif
                @if($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::GIOVANI)->count())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#giovani" type="button" role="tab" aria-controls="contact" aria-selected="false">Giovani</button>
                    </li>
                @endif
            </ul>

            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="home-tab">
                    @include('pages.edizioni.parziali.info')
                </div>

                <div class="tab-pane fade show" id="video" role="tabpanel" aria-labelledby="home-tab">
                    @include('pages.edizioni.parziali.video')
                </div>

                <div class="tab-pane fade" id="classifica" role="tabpanel" aria-labelledby="profile-tab">
                    @include('pages.edizioni.parziali.classifica')
                </div>

                @if($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::COVER)->count())
                    <div class="tab-pane fade" id="cover" role="tabpanel" aria-labelledby="contact-tab">
                        @include('pages.edizioni.parziali.cover')
                    </div>
                @endif

                @if($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::GIOVANI)->count())
                    <div class="tab-pane fade" id="giovani" role="tabpanel" aria-labelledby="contact-tab">
                        @include('pages.edizioni.parziali.giovani')
                    </div>
                @endif


            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {

            });
        </script>
    @stop
</x-app-layout>
