<x-guest-layout>
    @section('content')
        @php
            function isMobile() {
                return preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $_SERVER['HTTP_USER_AGENT']);
            }
        @endphp

        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <div id="divLogo">Caricamento...</div>
                        </div>

                        @include('layouts.guest-header')
                    </header>

                    <main class="mt-6">

                        <div class="container text-center">
                            <div class="row">
                                <div class="col">
                                    <form method="post" action="{{route('cerca')}}">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="stringa" class="form-control" minlength="3" aria-describedby="button-addon2" required>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary fa fa-search"></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col text-end">
                                    <form method="post" action="{{route('changeEdizione')}}" id="frm">
                                        @csrf
                                        <div class="text-right px-3">
                                            <select name="edizione" id="edizione">
                                                <option value=""></option>
                                                @foreach($edizioni->sortByDesc('anno') as $ediz)
                                                    <option value="{{$ediz->id}}">{{$ediz->numero}} del {{$ediz->anno}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4 py-2">
                            <div class="tab-content mt-3" id="myTabContent">

                                @if($canzoni->count())
                                    @include('welcome.parziali.cerca-canzoni')
                                @endif

                                @if($artisti->count())
                                    @include('welcome.parziali.cerca-artisti')
                                @endif

                                @if($edizioniS->count())
                                    @include('welcome.parziali.cerca-edizioni')
                                @endif
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
            });
        </script>
    @endsection
</x-guest-layout>
