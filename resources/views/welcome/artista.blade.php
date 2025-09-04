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

                        <div class="card mb-2">
                            <div class="row">
                                <div class="col-3 ml-3">
                                    <img src="{{$artista->getImgArtistaFromGoogle($artista->tipoArtista->tipo)}}" class="my-2">
                                </div>
                                <div class="col-5">
                                    <p class="h3 pt-2">{{$artista->nome}}</p>
                                </div>
                                <div class="col-3 text-end mt-2">
{{--                                    <a href="{{url()->previous()}}">--}}
{{--                                        <button class="btn btn-sm btn-outline-secondary">--}}
{{--                                            <i class="fa fa-backward"></i>--}}
{{--                                        </button>--}}
{{--                                    </a>--}}
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row">
                                <div class="col-12">
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

                        @if($artista->isCantante())
                            <div class="card mb-2">
                                <div class="row">
                                    <div class="col-12 ml-1">
                                        <div class="border-top mt-2 pt-2">
                                            <i class="fa fa-calendar-days" title="Edizioni"></i> {{$artista->getPartecipazioni()}}
                                            | <i class="fa fa-trophy text-warning" title="Vittorie"></i> {{$artista->getVittorie()}}
                                            | <i class="fa fa-2"></i> {{$artista->getSecondiPosto()}}
                                            | <i class="fa fa-3"></i> {{$artista->getTerziPosto()}}
                                            | <i class="fa fa-award text-info" title="Premi"></i> {{$artista->getPremi()}}
                                            | <i class="fa fa-heart text-primary" title="Eurovision"></i> {{$artista->getEurovision()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="card mt-2">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="bg-light text-center" style="width:30px;">Ed.</th>
                                        <th class="bg-light">Ruolo</th>
                                        @if($artista->isCantante())
                                            <th class="bg-light text-center" style="width:50px;">Pos.</th>
                                            <th class="bg-light text-center" style="width:40px;"><i class="fa-brands fa-spotify text-success" title="Spotify"></i></th>
                                            <th class="bg-light text-center" style="width:40px;"><i class="fa fa-video text-info" title="Esibizione/Eurovision"></i></th>
                                            <th class="bg-light text-center" style="width:40px;"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
                                            <th class="bg-light text-center" style="width:40px;"><i class="fa fa-video" title="Altro"></i></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($eventi as $evento)
                                        <tr>
                                            <td class="text-center">

                                                <form method="post" action="{{route('changeEdizione')}}">
                                                    @csrf
                                                    <input type="hidden" name="edizione" value="{{$evento['edizione_id']}}">
                                                    <input type="submit" class="btn btn-sm btn-outline-info" value="{{$evento['edizione']}}">
                                                </form>

                                            </td>
                                            <td style="font-size:10px;">
                                                {{$evento['ruolo']}} {{$evento['titolo']}}
                                                <p class="text-info">{{$evento['anno']}}</p>
                                            </td>
                                            @if($artista->isCantante())
                                                <td class="text-center" @if($evento['ruolo'] == 'Eurovision') style="background:url({{asset('images/eurovision.png')}}) no-repeat;" @endif>
                                                    @if($evento['ruolo'] == 'Eurovision')
                                                        <a href="https://it.wikipedia.org/wiki/Eurovision_Song_Contest_{{$evento['anno']}}" target="_blank">
                                                    @endif
                                                        @if($evento['pos'] == 1)
                                                            <i class="fa fa-trophy text-warning" title="{{$evento['pos']}}"></i>
                                                        @else
                                                            {{$evento['pos'] == 99 ? 'NC' : $evento['pos']}}
                                                        @endif
                                                    @if($evento['ruolo'] == 'Eurovision')
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($evento['spotify'])
                                                        <a href="{{$evento['spotify']}}" target="_blank">
                                                            <i class="fa fa-sm fa-link"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($evento['esibizione'])
                                                        <a href="{{$evento['esibizione']}}" target="_blank">
                                                            <i class="fa fa-sm fa-link"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($evento['videoclip'])
                                                        <a href="{{$evento['videoclip']}}" target="_blank">
                                                            <i class="fa fa-sm fa-link"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="">
                                                    <div class="flex">
                                                        @foreach($evento['altro'] as $altro)
                                                            <a href="{{$altro->link}}" target="_blank">
                                                                <i class="fa fa-sm fa-link"></i>
                                                            </a>
                                                        @endforeach
                                                    </div>

                                                </td>
                                            @endif
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
