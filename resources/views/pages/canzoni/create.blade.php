<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuova canzone
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
                        <a href="{{route('canzoni.index')}}">
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
                    <form method="post" action="{{route('canzoni.store')}}">
                        @csrf

                        <div class="mb-3">
                            <label for="edizione" class="form-label">Edizione<span class="text-danger">*</span></label>
                            <select name="edizione" id="edizione" class="form-control" required>
                                <option></option>
                                @foreach($edizioni as $edizione)
                                    <option value="{{$edizione->id}}">{{$edizione->numero}} del {{$edizione->anno}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo<span class="text-danger">*</span></label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                @foreach(\App\Enums\TipoCanzone::cases() as $tipo)
                                    <option value="{{$tipo->value}}">{{$tipo->description()}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="titolo" class="form-label">Titolo<span class="text-danger">*</span></label>
                            <input type="text" name="titolo" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="artisti" class="form-label">Artista<span class="text-danger">*</span></label>
                            <select name="artisti[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                <option></option>
                                @foreach($artisti as $artista)
                                    <option value="{{$artista->id}}">{{$artista->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="autori" class="form-label">Autori</label>
                            <input type="text" name="autori" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="posizione" class="form-label">Posizione<span class="text-danger" id="simboloRequired">*</span></label>
                            <select name="posizione" id="posizione" class="form-control" required>
                                <option></option>
                                @for($i = 1; $i <= env('POSIZIONI'); $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="posizione_euro" class="form-label">Posizione EuroVision</label>
                            <select name="posizione_euro" class="form-control">
                                <option></option>
                                @for($i = 1; $i <= env('POSIZIONI_EUROVISION'); $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="premi" class="form-label">Premi</label>
                            <select name="premi[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                <option></option>
                                @foreach($premi as $premio)
                                    <option value="{{$premio->id}}">{{$premio->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="esibizione" class="form-label">Link esibizione</label>
                            <input type="url" name="sanremo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="videoclip" class="form-label">Link videoclip</label>
                            <input type="url" name="videoclip" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="videoclip" class="form-label">Link EuroVision</label>
                            <input type="url" name="eurovision" class="form-control">
                        </div>

                        <div class="mb-3">
                            <input type="button" class="btn btn-sm btn-primary" id="addInput" value="+">
                        </div>

                        <div class="altri"></div>

                        <div class="mb-3 text-end">
                            <input type="submit" class="btn btn-sm btn-outline-primary" value="Registra">
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
                $('#addInput').click(function() {
                    //$('.interfacesIx:first').clone().insertAfter('.interfacesIx:last');
                    $("<div class='mb-3'><label for='altri' class='form-label'>Altro</label><input type='url' name='altri[]' class='form-control' /></div>").appendTo('.altri');
                });

                $('#tipo').on('change', function(){
                   if($('#tipo').val() == 'cover'){
                        $('#posizione').prop('required', false);
                        $('#simboloRequired').hide();
                     }else{
                        $('#posizione').prop('required', true);
                       $('#simboloRequired').show();
                   }
                });
            });
        </script>
    @stop
</x-app-layout>
