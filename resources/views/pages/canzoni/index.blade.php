<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Canzoni
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
                        <a href="{{route('canzoni.create')}}">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-circle-plus"></i> Nuova
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

                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>


    @section('modal')
{{--        <!-- Modal Delete -->--}}
{{--        @foreach($edizioni as $i => $edizione)--}}
{{--            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">--}}
{{--                <div class="modal-dialog">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella edizione</h1>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                        <form action="{{route('edizioni.destroy',$edizione)}}" method="post">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <div class="modal-body">--}}
{{--                                Vuoi davvero eliminare l'edizione {{$edizione->numero}} del {{$edizione->anno}}?--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>--}}
{{--                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Elimina</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    @stop

    @section('scripts')

    @stop
</x-app-layout>
