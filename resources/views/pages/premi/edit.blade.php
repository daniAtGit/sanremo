<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica Premio
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
                        <a href="{{route('premi.index')}}">
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
                    <form method="post" action="{{route('premi.update', $premio)}}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="etichetta" class="form-label">Etichetta<span class="text-danger">*</span></label>
                            <input type="text" name="etichetta" class="form-control" value="{{$premio->etichetta}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="colore" class="form-label">Colore</label>
                            <input type="color" name="colore" class="form-control" value="{{$premio->colore}}">
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
                            <input type="text" name="nome" class="form-control" required value="{{$premio->nome}}">
                        </div>

                        <div class="mb-3">
                            <label for="wikipedia" class="form-label">Wikipedia</label>
                            <input type="text" name="wikipedia" class="form-control" value="{{$premio->wikipedia}}">
                        </div>

                        <div class="mb-3">
                            <label for="anno" class="form-label">Anno istituzione</label>
                            <input type="number" name="anno" class="form-control" min="1900" max="{{today()->format('Y')}}" step="1" value="{{$premio->anno_istituzione}}">
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
</x-app-layout>
