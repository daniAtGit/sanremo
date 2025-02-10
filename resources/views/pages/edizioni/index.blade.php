<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edizioni
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
                        <a href="{{route('edizioni.create')}}">
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
                                <th class="bg-light">N°</th>
                                <th class="bg-light">Anno</th>
                                <th class="bg-light">Date</th>
                                <th class="bg-light">Luogo</th>
                                <th class="bg-light">Presentatore</th>
                                <th class="bg-light">Co-conduttori</th>
                                <th class="bg-light">Vincitore</th>
                                <th class="bg-light">Note</th>
                                <th class="bg-light"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($edizioni as $i => $edizione)
                                <tr>
                                    <td>{{$edizione->numero}}</td>
                                    <td>{{$edizione->anno}}</td>
                                    <td>{{$edizione->data_da?->format('d/m/Y')}} - {{$edizione->data_a?->format('d/m/Y')}}</td>
                                    <td>{{\App\Enums\Luogo::from($edizione->luogo->value)->description()}}</td>
                                    <td>{{$edizione->conduttori()->pluck('nome')->implode(', ')}}</td>
                                    <td>{{$edizione->coconduttori()->pluck('nome')->implode(', ')}}</td>
                                    <td>{{$edizione->canzoni->where('posizione',1)->first()?->artisti->pluck('nome')->implode(', ')}}</td>
                                    <td class="smart">{{$edizione->note}}</td>
                                    <td>
                                        <a href="{{route('edizioni.show',$edizione)}}" class="btn btn-sm btn-outline-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('edizioni.edit',$edizione)}}" class="btn btn-sm btn-outline-primary">
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
        @foreach($edizioni as $i => $edizione)
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
                                Vuoi davvero eliminare l'edizione {{$edizione->numero}} del {{$edizione->anno}}?
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
                            "width": "25px",
                            "className": 'dt-center'
                        },
                        {
                            "targets": 1,
                            "width": "40px",
                        },
                        {
                            "targets": 2,
                            "width": "180px",
                        },
                        {
                            "targets": [3,4,5],
                            "width": "180px",
                        },
                        {
                            "targets": -1,
                            "width": "90px",
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
