<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica {{$artista->tipo->value}} : {{$artista->nome}}
        </h2>
    </x-slot>

    <div class="container-fluid border">
        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6 text-end">
                        <a href="{{route('artisti.index')}}">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Indietro
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card mb-4">
            <div class="row mt-3">
                <div class="col-1"></div>

                <div class="col-10">
                    <form method="post" action="{{route('artisti.update',$artista)}}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
                            <input type="text" name="nome" class="form-control" value="{{$artista->nome}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo<span class="text-danger">*</span></label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option></option>
                                @foreach(\App\Enums\TipoArtista::cases() as $tipo)
                                    <option value="{{$tipo->value}}" @selected($tipo === $artista->tipo)>{{\App\Enums\TipoArtista::from($tipo->value)->description()}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="dateCantante" style="display:{{$artista->tipo->value == 'cantante' ? 'block' : 'none'}};">
                            <div class="mb-3">
                                <label for="nascita" class="form-label">Data nascita</label>
                                <input type="date" name="nascita" id="nascita" class="form-control" value="{{$artista->nascita?->format('Y-m-d')}}">
                            </div>
                            <div class="mb-3">
                                <label for="morte" class="form-label">Data morte</label>
                                <input type="date" name="morte" id="morte" class="form-control" value="{{$artista->morte?->format('Y-m-d')}}">
                            </div>
                        </div>

                        <div id="dateGruppo" style="display:{{$artista->tipo->value == 'gruppo' ? 'block' : 'none'}};">
                            <div class="mb-3">
                                <label for="inizio" class="form-label">Data inizio</label>
                                <input type="date" name="inizio" id="inizio" class="form-control" value="{{$artista->inizio?->format('Y-m-d')}}">
                            </div>
                            <div class="mb-3">
                                <label for="fine" class="form-label">Data fine</label>
                                <input type="date" name="fine" id="fine" class="form-control" value="{{$artista->fine?->format('Y-m-d')}}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="form-label">Wikipedia</label>
                            <input type="text" name="wiki" class="form-control" value="{{$artista->wikipedia}}">
                        </div>

                        <div class="mb-3 text-end">
                            <input type="submit" class="btn btn-sm btn-outline-primary" value="Modifica">
                        </div>
                    </form>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#tipo').on('change', function(){
                    $('#dateCantante').hide();
                    $('#dateGruppo').hide();

                    if($('#tipo').val() == ""){
                        $('#nascita').val('');
                        $('#morte').val('');
                        $('#inizio').val('');
                        $('#fine').val('');
                    }
                    if($('#tipo').val() == "cantante") {
                        $('#inizio').val('');
                        $('#fine').val('');
                        $('#dateCantante').show();
                    }
                    if($('#tipo').val() == "gruppo") {
                        $('#nascita').val('');
                        $('#morte').val('');
                        $('#dateGruppo').show();
                    }
                });
            });
        </script>
    @stop
</x-app-layout>
