<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Premi
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
                        <a href="{{route('premi.create')}}">
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
                    <table class="table table-hover table-bordered border" id="tabella">
                        <thead>
                            <tr>
                                <th class="bg-light">Anno</th>
                                <th class="bg-light">Nome</th>
                                <th class="bg-light">Descrizione</th>
                                <th class="bg-light text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($premi as $i => $premio)
                                <tr>
                                    <td class="text-center">{{$premio->anno_istituzione}}</td>
                                    <td class="text-center">{{$premio->nome}}</td>
                                    <td class="text-center">{{$premio->descrizione}}</td>
                                    <td class="text-center">
                                        <a href="{{route('premi.edit',$premio)}}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalElimina{{$i}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
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
        @foreach($premi as $i => $premio)
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella edizione</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('edizioni.destroy',$edizione)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi eliminare il premio {{$premio->nome}} del {{$premio->anno_istituzione}}?
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
                        {
                            "targets": 0,
                            "width": "60px",
                            "className": 'dt-center'
                        },
                        {
                            "targets": 1,
                            "width": "300px",
                        },
                        {
                            "targets": 3,
                            "width": "100px",
                            "className": 'dt-center',
                            'orderable': false
                        },
                        //{ "orderable": false, "targets": 5 }
                    ],
                    "order": [[0, 'desc']]
                });
            });
        </script>
    @stop
</x-app-layout>
