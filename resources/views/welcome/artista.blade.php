<x-guest-layout>
    @section('content')
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <a href="{{url('/')}}">
                                <div id="divLogo">Caricamento...</div>
                            </a>
                        </div>

                        @include('layouts.guest-header')
                    </header>

                    <main class="mt-6">
                        <div class="card-body text-end mb-2">
                            <a href="{{url()->previous()}}">
                                <button class="btn btn-sm btn-outline-secondary">< Indietro</button>
                            </a>
                        </div>

                        <div class="card mt-2">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{$artista->getImgArtistaFromGoogle($artista->tipoArtista->tipo)}}" class="my-2">
                                </div>
                                <div class="col-9">
                                    <p class="h2 pt-2">{{$artista->nome}}</p>

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

                                    @if($artista->isCantante())
                                        <div class="border-top mt-2 pt-2">
                                            <i class="fa fa-calendar-days" title="Edizioni"></i> {{$artista->getPartecipazioni()}}
                                            | <i class="fa fa-trophy text-warning" title="Vincite"></i> {{$artista->getVittorie()}}
                                            | <i class="fa fa-2"></i> {{$artista->getSecondiPosto()}}
                                            | <i class="fa fa-3"></i> {{$artista->getTerziPosto()}}
                                            | <i class="fa fa-award text-info" title="Premi"></i> {{$artista->getPremi()}}
                                            | <i class="fa fa-heart text-primary" title="Eurovision"></i> {{$artista->getEurovision()}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card mt-2">
                            <table class="table table-hover table-striped table-bordered border" style="width:96%;margin:10px auto;">
                                <thead>
                                    <tr>
                                        <th>Anno</th>
                                        <th>Ed.</th>
                                        <th>Ruolo</th>
                                        <th>Pos.</th>
                                        <th class="bg-light" style="width:40px;"><i class="fa-brands fa-spotify text-success" title="Spotify"></i></th>
                                        <th class="bg-light" style="width:40px;"><i class="fa fa-video text-info" title="Esibizione"></i></th>
                                        <th class="bg-light" style="width:40px;"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
                                        <th class="bg-light" style="width:40px;"><i class="fa fa-video text-primary" title="Eurovision"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($eventi as $evento)
                                        <tr>
                                            <td>{{$evento['anno']}}</td>
                                            <td>
                                                <form method="post" action="{{route('changeEdizione')}}">
                                                    @csrf
                                                    <input type="hidden" name="edizione" value="{{$evento['edizione_id']}}">
                                                    <input type="submit" class="btn btn-sm btn-outline-info" value="{{$evento['edizione']}}">
                                                </form>
                                            </td>
                                            <td>{{$evento['ruolo']}}</td>
                                            <td>
                                                @if($evento['pos'] == 1)
                                                    <i class="fa-solid fa-trophy text-warning" title="{{$evento['pos']}}"></i>
                                                @else
                                                    {{$evento['pos'] == 99 ? 'NC' : $evento['pos']}}
                                                @endif
                                            <td>
                                                @if($evento['spotify'])
                                                    <a href="{{$evento['spotify']}}" target="_blank">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($evento['esibizione'])
                                                    <a href="{{$evento['esibizione']}}" target="_blank">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
                                            </td><td>
                                                @if($evento['videoclip'])
                                                    <a href="{{$evento['videoclip']}}" target="_blank">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($evento['eurovision'])
                                                    <a href="{{$evento['eurovision']}}" target="_blank">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            });
        </script>
    @endsection
</x-guest-layout>
