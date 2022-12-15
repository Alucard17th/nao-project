@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
@endpush

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new-patients main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary"></h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="/client.html">Formulare visite technique Part. 1</a>
                            </li>
                        </ol>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header inline-block item-todolist">
                                <div class="list-todolist">
                                    <h5>VISITE TECHNIQUE</h5>
                                   
                                    @foreach($projects as $project)
                                        {{$project->id}}
                                    @endforeach
                                    <ul>
                                        @foreach($projects as $project)
                                            @if ($project->step == 'visite technique')
                                            <li><a href="{{ url('/dashboard/todo-list/'.$project->id.'/'.$project->clients[0]->id) }}">
                                                <strong>{{$project->clients[0]->firstname}} {{$project->clients[0]->lastname}}</strong>
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="list-todolist">
                                    <h5>RBE</h5>
                                    <ul>
                                        @foreach($projects as $project)
                                            @if ($project->step == 'rbe')
                                            <li><a href="{{ url('/dashboard/todo-list/'.$project->id.'/'.$project->clients[0]->id) }}"><strong>{{$project->clients[0]->firstname}} {{$project->clients[0]->lastname}}</strong></a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="list-todolist">
                                    <h5>Demande des accords</h5>
                                    <ul>
                                        @foreach($projects as $project)
                                            @if ($project->step == 'demande des accords')
                                            <li><a href="{{ url('/dashboard/todo-list/'.$project->id.'/'.$project->clients[0]->id) }}"><strong>{{$project->clients[0]->firstname}} {{$project->clients[0]->lastname}}</strong></a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="list-todolist">
                                    <h5>Début de l’installation</h5>
                                    <ul>
                                        @foreach($projects as $project)
                                            @if ($project->step == 'début installation')
                                            <li><a href="{{ url('/dashboard/todo-list/'.$project->id.'/'.$project->clients[0]->id) }}"><strong>{{$project->clients[0]->firstname}} {{$project->clients[0]->lastname}}</strong></a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="list-todolist">
                                    <h5>Fin de l’installation</h5>
                                    <ul>
                                        @foreach($projects as $project)
                                            @if ($project->step == 'fin installation')
                                            <li><a href="{{ url('/dashboard/todo-list/'.$project->id.'/'.$project->clients[0]->id) }}"><strong>{{$project->clients[0]->firstname}} {{$project->clients[0]->lastname}}</strong></a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End section content -->
    <!-- start section footer -->
    <div class="footer">
        <div class="copyright">
            <p class="mb-0">
                Copyright © Designed &amp; Developed by
                <a href="uxign.com" target="_blank">Naoenergy</a>
                2022
            </p>
        </div>
    </div>
    <!-- End section footer -->
@endsection



