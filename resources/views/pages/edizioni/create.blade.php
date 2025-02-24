<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuova Edizione
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
                        <a href="{{route('edizioni.index')}}">
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
                    <form method="post" action="{{route('edizioni.store')}}">
                        @csrf

                        <div class="mb-3">
                            <label for="numero" class="form-label">Numero<span class="text-danger">*</span></label>
                            <input type="number" name="numero" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="anno" class="form-label">Anno<span class="text-danger">*</span></label>
                            <input type="number" name="anno" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="data_da" class="form-label">Data da</label>
                            <input type="date" name="data_da" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="data_a" class="form-label">Data a</label>
                            <input type="date" name="data_a" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="luogo" class="form-label">Luogo<span class="text-danger">*</span></label>
                            <select name="luogo" class="form-control" required>
                                <option></option>
                                @foreach(\App\Enums\Luogo::cases() as $luogo)
                                    <option value="{{$luogo->value}}">{{\App\Enums\Luogo::from($luogo->value)->description()}}</option>
                                @endforeach
                            </select>
                        </div>

{{--                        <div class="mb-3">--}}
{{--                            <label for="canzoni" class="form-label">Canzoni</label>--}}
{{--                            <div id="items" class="form-group">--}}
{{--                                <div>--}}
{{--                                    <select name="canzoni[]" class="form-control select" required>--}}
{{--                                        <option>Seleziona...</option>--}}
{{--                                        @foreach($canzoni as $canzone)--}}
{{--                                            <option value="{{$canzone->id}}">{{$canzone->titolo}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <button id="add" class="btn add-more button-yellow uppercase" type="button"><i class="fa fa-plus"></i></button>--}}
{{--                            <button class="delete btn button-white uppercase">- Remove referral</button>--}}
{{--                        </div>--}}

                        <div class="mb-3">
                            <label for="canzoni" class="form-label">Conduttori</label>
                            <div class="border">
                                <select name="conduttori[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                    @foreach($artisti as $artista)
                                        <option value="{{$artista->id}}">{{$artista->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="canzoni" class="form-label">Co-conduttori</label>
                            <div class="border">
                                <select name="coconduttori[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                    @foreach($artisti as $artista)
                                        <option value="{{$artista->id}}">{{$artista->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="canzoni" class="form-label">Ospiti</label>
                            <div class="border">
                                <select name="ospiti[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                    @foreach($artisti as $artista)
                                        <option value="{{$artista->id}}">{{$artista->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="wiki" class="form-label">Wikipedia</label>
                            <input type="text" name="wiki" class="form-control">
                        </div>

                        <div class="mb-3">
                            <input type="button" class="btn btn-sm btn-primary" id="addInput" value="Add video">
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
                    $("<div class='mb-3'><label for='altri' class='form-label'>Link</label><input type='url' name='altri[]' class='form-control' /></div>").appendTo('.altri');
                });
            });
        </script>
    @stop
</x-app-layout>
