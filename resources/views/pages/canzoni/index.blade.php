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
                    <table class="table table-hover table-bordered border" id="tabella">
                        <thead>
                        <tr>
                            <th class="bg-light">Edizione</th>
                            <th class="bg-light">Anno</th>
                            <th class="bg-light">Titolo</th>
                            <th class="bg-light">Artista</th>
                            <th class="bg-light">Autori</th>
                            <th class="bg-light">Pos.</th>
                            <th class="bg-light">EuroV</th>
                            <th class="bg-light"><i class="fa fa-video text-primary" title="Esibizione"></i></th>
                            <th class="bg-light"><i class="fa fa-video text-warning" title="Videoclip"></i></th>
                            <th class="bg-light"><i class="fa fa-video text-danger" title="Eurovision"></i></th>
                            <th class="bg-light"><i class="fa fa-video" title="Altro"></i></th>
                            <th class="bg-light"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($canzoni as $i => $canzone)
                                <tr>
                                    <td>{{$canzone->edizione->numero}}</td>
                                    <td>{{$canzone->edizione->anno}}</td>
                                    <td>
                                        <span style="display:none;">{{$canzone->titolo}}</span>
                                        {!! \App\Enums\TipoCanzone::from($canzone->tipo->value)->icon() !!} {{$canzone->titolo}}
                                    </td>
                                    <td>{{$canzone->artisti->pluck('nome')->implode(', ')}}</td>
                                    <td>{{$canzone->scrittori}}</td>
                                    <td>{{$canzone->posizione}}</td>
                                    <td>{{$canzone->posizione_eurovision}}</td>
                                    <td>
                                        @if($canzone->esibizione)
                                            <a href="{{$canzone->esibizione}}" target="_blank">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($canzone->videoclip)
                                            <a href="{{$canzone->videoclip}}" target="_blank">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($canzone->eurovision)
                                            <a href="{{$canzone->eurovision}}" target="_blank">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$canzone->socials->where('social',\App\Enums\Social::ALTRO)->count()}}</td>
                                    <td>
                                        <a href="{{route('canzoni.edit',$canzone)}}" class="btn btn-sm btn-outline-primary">
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
        @foreach($canzoni as $i => $canzone)
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella edizione</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('canzoni.destroy',$canzone)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare la canzone {{$canzone->titolo}} di {{$canzone->artisti->pluck('nome')->implode(', ')}}?
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
                            "targets": [0,1],
                            "width": "40px",
                            "className": 'dt-center',
                        },
                        {
                            "targets": [5,6,7,8,9,10],
                            "width": "30px",
                            "className": 'dt-center',
                        },
                        {
                            "targets": -1,
                            "width": "60px",
                            "className": 'dt-center',
                            'orderable': false
                        },
                    ],
                    "order": [[0, 'desc']]
                });
            });
        </script>
    @stop
</x-app-layout>
