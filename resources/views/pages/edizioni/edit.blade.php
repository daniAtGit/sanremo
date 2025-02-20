<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica Edizione
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
                    <form method="post" action="{{route('edizioni.update',$edizione)}}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="numero" class="form-label">Numero<span class="text-danger">*</span></label>
                            <input type="number" name="numero" class="form-control" value="{{$edizione->numero}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="anno" class="form-label">Anno<span class="text-danger">*</span></label>
                            <input type="number" name="anno" class="form-control" value="{{$edizione->anno}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="data_da" class="form-label">Data da</label>
                            <input type="date" name="data_da" class="form-control" value="{{$edizione->data_da?->format('Y-m-d')}}">
                        </div>

                        <div class="mb-3">
                            <label for="data_a" class="form-label">Data a</label>
                            <input type="date" name="data_a" class="form-control" value="{{$edizione->data_a?->format('Y-m-d')}}">
                        </div>

                        <div class="mb-3">
                            <label for="luogo" class="form-label">Luogo<span class="text-danger">*</span></label>
                            <select name="luogo" class="form-control" required>
                                <option></option>
                                @foreach(\App\Enums\Luogo::cases() as $luogo)
                                    <option value="{{$luogo->value}}" @selected($luogo == $edizione->luogo)>{{\App\Enums\Luogo::from($luogo->value)->description()}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="canzoni" class="form-label">Conduttori</label>
                            <div class="border">
                                <select name="conduttori[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                    @foreach($artisti as $artista)
                                        <option value="{{$artista->id}}" @selected($edizione->conduttori()->pluck('id')->contains($artista->id))>{{$artista->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="canzoni" class="form-label">Co-conduttori</label>
                            <div class="border">
                                <select name="coconduttori[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                    @foreach($artisti as $artista)
                                        <option value="{{$artista->id}}" @selected($edizione->coconduttori()->pluck('id')->contains($artista->id))>{{$artista->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="canzoni" class="form-label">Ospiti</label>
                            <div class="border">
                                <select name="ospiti[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                    @foreach($artisti as $artista)
                                        <option value="{{$artista->id}}" @selected($edizione->ospiti()->pluck('id')->contains($artista->id))>{{$artista->nome}}</option>
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
                            <input type="text" name="wiki" class="form-control" value="{{$edizione->wikipedia}}">
                        </div>

                        @foreach($edizione->socials->where('social',\App\Enums\Social::ALTRO) as $i => $altro)
                            <label for='altri' class="form-label">Video</label>
                            <div class="input-group mb-3">
                                <input type="url" class="form-control" aria-describedby="basic-addon2" value="{{$altro->link}}">
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" style="height:41px;" data-bs-toggle="modal" data-bs-target="#modalElimina{{$i}}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        @endforeach

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

    @section('modal')
        @foreach($edizione->socials->where('social',\App\Enums\Social::ALTRO) as $i => $altro)
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella Altro</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('edizioni.altro.delete', $altro)}}" method="post">
                            @csrf
                            @method('GET')

                            <div class="modal-body">
                                Vuoi davvero eliminare il link video: {{$altro->link}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Elimina</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @stop

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#addInput').click(function() {
                    $("<div class='mb-3'><label for='altri' class='form-label'>Video</label><input type='url' name='altri[]' class='form-control' /></div>").appendTo('.altri');
                });
            });
        </script>
    @stop
</x-app-layout>
