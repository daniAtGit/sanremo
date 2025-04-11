<x-guest-layout>
    @section('content')
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            {{--<img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />--}}

            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <div id="divLogo">Caricamento...</div>
                        </div>

                        @include('layouts.guest-header')
                    </header>

                    <main class="mt-6">
                        <div class="card-body text-end">
                            <form method="post" action="{{route('changeEdizione')}}" id="frm">
                                @csrf
                                <div class="text-right px-3">
                                    <select name="edizione" id="edizione">
                                        @foreach($edizioni->sortByDesc('anno') as $ediz)
                                            <option value="{{$ediz->id}}" @selected($ediz->id == $edizione->id)>{{$ediz->numero}} del {{$ediz->anno}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        {{\App\Enums\Luogo::from($edizione->luogo->value)->description() ?? ''}}
                                    </div>
                                    <div class="col-6 text-end">
                                        @if($edizione->data_da)
                                            {{$edizione->data_da?->format('Y')}}
                                        @else
                                            {{$edizione->anno}}
                                        @endif
                                    </div>
                                </div>
                                <a href="https://www.google.com/search?q=scenografia+sanremo+{{$edizione->anno}}&tbm=isch" target="_blank">
                                    <div id="divScenografia">Caricamento...</div>
                                </a>

                                <div class="row">
                                    <div class="col-6">
                                        @if($edizione->data_da)
                                            {{$edizione->data_da?->format('d/m')}} - {{$edizione->data_a?->format('d/m')}}
                                        @else
                                            {{$edizione->anno}}
                                        @endif
                                    </div>
                                    <div class="col-6 text-end">
                                        @if($edizione->wikipedia)
                                            <a href="{{$edizione->wikipedia}}" target="_blank"><i class="fa-brands fa-wikipedia-w"></i></a>
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#classifica" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <i class="fa fa-microphone-lines"></i>
                                    </button>
                                </li>
                                @if($cover->count())
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cover" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                            <i class="fa fa-radio"></i>
                                        </button>
                                    </li>
                                @endif
                                @if($giovani->count())
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#giovani" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                            <i class="fa fa-children"></i>
                                        </button>
                                    </li>
                                @endif
                                @if($videos->count())
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="home" aria-selected="true">
                                            <i class="fa fa-youtube"></i>
                                        </button>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    @include('welcome.parziali.info')
                                </div>

                                <div class="tab-pane fade" id="classifica" role="tabpanel" aria-labelledby="classifica-tab">
                                    @include('welcome.parziali.classifica')
                                </div>

                                @if($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::COVER)->count())
                                    <div class="tab-pane fade" id="cover" role="tabpanel" aria-labelledby="cover-tab">
                                        @include('welcome.parziali.cover')
                                    </div>
                                @endif

                                @if($edizione->canzoni->where('tipo',\App\Enums\TipoCanzone::GIOVANI)->count())
                                    <div class="tab-pane fade" id="giovani" role="tabpanel" aria-labelledby="giovani-tab">
                                        @include('welcome.parziali.giovani')
                                    </div>
                                @endif
                                <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                    @include('welcome.parziali.video')
                                </div>
                            </div>
                        </div>
                    </main>

                    @include('layouts.guest-footer')

                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                $('#edizione').on('change', function() {
                    $('#frm').submit();
                });

                $.ajax({
                    type: 'post',
                    url: '{{ route('welcome.getLogo') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (url) {
                        $('#divLogo').empty();

                        var image = document.createElement("img");
                        var imageParent = document.getElementById("divLogo");
                        image.src = url;
                        imageParent.appendChild(image);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '{{ route('welcome.getScenografia') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "anno": {{$edizione->anno}}
                    },
                    success: function (url) {
                        $('#divScenografia').empty();

                        var image = document.createElement("img");
                        var imageParent = document.getElementById("divScenografia");
                        image.src = url;
                        imageParent.appendChild(image);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '{{ route('welcome.getVideos') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "edizione_id": '{{$edizione->id}}'
                    },
                    success: function (data) {
                        $.each(data, function (key, video) {
                            var res = "<div class='flex'>" +
                                "<div class='card m-2'>" +
                                "<div class='card-body col' style='max-width:400px;'>";

                            if(video.tipo === 'video') {
                                res += video.url;
                                res += "<span class='card-title bg-light p-2' style='font-size:12px;'>" + video.title + "</span>";
                            }else{
                                res += "<a href='"+video.url+"' target='_blank'><div style='width:350px;height:197px;'><i class='fa fa-link'></i> "+video.title+"</div></a>";
                                res += "<span class='card-title bg-light p-2' style='font-size:12px;'>Altro...</span>";
                            }

                            res +="</div>" +
                                "</div>" +
                                "</div>";

                            $('#edizioneVideos').append(res);
                        });
                    }
                });
            });
        </script>
    @endsection
</x-guest-layout>
