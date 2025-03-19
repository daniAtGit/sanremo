<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica {{$artista->tipoArtista->tipo}} : {{$artista->nome}}
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
                                @foreach($tipiArtisti as $tipo)
                                    <option value="{{$tipo->id}}" @selected($tipo->id == $artista->tipo_id)>{{$tipo->tipo}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="form-label">Wikipedia</label>
                            <input type="text" name="wiki" class="form-control" value="{{$artista->wikipedia}}">
                        </div>

                        <div class="mb-3">

                            @foreach(\App\Enums\Social::cases() as $social)
                                <div class="input-group mt-3">
                                    <span class="input-group-text" id="basic-addon1" title="{{$social->description()}}">{!! $social->icon() !!}</span>
                                    <input type="text" name="socials[{{$social}}]" class="form-control" value="{{$artista->socials->where('social',$social->value)->first()->link ?? ''}}">
                                </div>
                            @endforeach
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
                //
            });
        </script>
    @stop
</x-app-layout>
