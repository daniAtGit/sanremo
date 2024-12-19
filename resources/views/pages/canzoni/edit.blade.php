<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica canzone
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
                    <form method="post" action="{{route('canzoni.update',$canzone)}}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="edizione" class="form-label">Edizione<span class="text-danger">*</span></label>
                            <select name="edizione" id="edizione" class="form-control" required>
                                <option></option>
                                @foreach($edizioni as $edizione)
                                    <option value="{{$edizione->id}}" @selected($edizione->id == $canzone->edizione_id)>{{$edizione->numero}} del {{$edizione->anno}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="titolo" class="form-label">Titolo<span class="text-danger">*</span></label>
                            <input type="text" name="titolo" class="form-control" required value="{{$canzone->titolo}}">
                        </div>

                        <div class="mb-3">
                            <label for="artisti" class="form-label">Artista<span class="text-danger">*</span></label>
                            <select name="artisti[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                <option></option>
                                @foreach($artisti as $artista)
                                    <option value="{{$artista->id}}" @selected($canzone->artisti->contains($artista->id))>{{$artista->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="autori" class="form-label">Autori</label>
                            <input type="text" name="autori" class="form-control" value="{{$canzone->scrittori}}">
                        </div>

                        <div class="mb-3">
                            <label for="posizione" class="form-label">Posizione<span class="text-danger">*</span></label>
                            <select name="posizione" class="form-control" required>
                                <option></option>
                                @for($i = 1; $i <= env('POSIZIONI'); $i++)
                                    <option value="{{$i}}" @selected($i == $canzone->posizione)>{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="posizione_euro" class="form-label">Posizione EuroVision</label>
                            <select name="posizione_euro" class="form-control">
                                <option></option>
                                @for($i = 1; $i <= env('POSIZIONI_EUROVISION'); $i++)
                                    <option value="{{$i}}" @selected($i == $canzone->posizione_eurovision)>{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="premi" class="form-label">Premi</label>
                            <select name="premi[]" class="form-select multiple-select-field" data-placeholder="Seleziona" multiple>
                                <option></option>
                                @foreach($premi as $premio)
                                    <option value="{{$premio->id}}" @selected($canzone->premi->contains($premio->id))>{{$premio->nome}}</option>
                                @endforeach
                            </select>
                        </div>

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

            });
        </script>
    @stop
</x-app-layout>
