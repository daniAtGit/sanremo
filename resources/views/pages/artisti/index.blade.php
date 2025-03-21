<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Artisti
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
                        <a href="{{route('artisti.create')}}">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-circle-plus"></i> Nuovo
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
                    <table class="table table-hover table-striped table-bordered border" id="tabella">
                        <thead>
                            <tr>
                                <th class="bg-light">Nome</th>
                                <th class="bg-light">Tipo</th>
                                <th class="bg-light">Socials</th>
                                <th class="bg-light"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artisti as $i => $artista)
                                <tr>
                                    <td>{{$artista->nome}}</td>
                                    <td>{{$artista->tipoArtista->tipo}}</td>
                                    <td>
                                        @if($artista->wikipedia)
                                            <a href="{{$artista->wikipedia}}" target="_blank" title="Wikipedia"><i class="fa-brands fa-wikipedia-w px-1"></i></a>
                                        @else
                                            <i class="fa-brands fa-wikipedia-w text-secondary px-1" title="No Wikipedia"></i>
                                        @endif
                                        <a href="https://www.google.com/search?q={{$artista->nome}}&&sourceid=chrome&ie=UTF-8" target="_blank" title="Google"><i class="fa-brands fa-google px-1"></i></a>
                                        <a href="https://www.youtube.com/results?search_query={{$artista->nome}}" target="_blank" title="YouTube"><i class="fa-brands fa-youtube px-1"></i></a>
                                        |
                                        @foreach($artista->socials as $social)
                                            <a href="{{$social->link}}" target="_blank" title="{{$social->social->value}}">
                                                {!! \App\Enums\Social::from($social->social->value)->icon() !!}
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('artisti.show',$artista)}}" class="btn btn-sm btn-outline-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('artisti.edit',$artista)}}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>

                                        @if($artista->canzoni_count == 0 && $artista->edizioni_count == 0)
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalElimina{{$i}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>


    @section('modal')
        <!-- Modal Delete -->
        @foreach($artisti as $i => $artista)
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella edizione</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('artisti.destroy',$artista)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare l'artista {{$artista->nome}}?
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
                $('#tabella').dataTable({
                    "responsive": true,
                    "bSort":true,
                    "pageLength": 10,
                    "paging": true,
                    "bPaginate":true,
                    "pagingType":"full_numbers",
                    "language": {
                        "lengthMenu": "Mostra _MENU_ record",
                        "zeroRecords": "Nessun risultato",
                        "info": "Pagina _PAGE_ di _PAGES_",
                        "infoEmpty": "Nessun risultato disponibile",
                        "infoFiltered": "(filtro di  _MAX_ record totali)",
                        "search": "",
                        "searchPlaceholder": "Cerca...",
                        "paginate": {
                            first:      '<<',
                            previous:   '‹',
                            next:       '›',
                            last:       '>>'
                        },
                    },
                    "columnDefs": [
                        // {
                        //     "targets": 1,
                        //     "width": "120px",
                        // },
                        // {
                        //     "targets": 2,
                        //     "width": "300px",
                        // },
                        {
                            "targets": -1,
                            "width": "120px",
                            "className": 'dt-center',
                            'orderable': false
                        },
                    ],
                    "order": [[0, 'asc']]
                });
            });
        </script>
    @stop
</x-app-layout>
