@extends('layouts.backend')

@push('styles')
<style>
* {
  box-sizing: border-box;
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
@endpush

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new-patients main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary text-uppercase">{{$client[0]->step}}</h4>
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
                @foreach($client[0]->projects as $project)
                    <?php $projectsNames[] = $project->name ?>
                @endforeach
                <!-- start section filter -->
                <div class="row head_todolist mb-4">
                    <div class="col-md-4">
                        <h4>
                            <strong>
                            {{$client[0]->firstname}} {{$client[0]->lastname}}
                            </strong>
                        </h4>
                    </div>
                   
                    <div class="col-md-8">
                        <div class="list_visit">
                            <ul>
                                <li><a href="#">Projet</a></li>
                                <li class="{{ in_array('PHOTOVOLTAÏQUES', $projectsNames) ? 'active' : '' }}"><a href="#">PV</a></li>
                                <li class="{{ in_array('POMPES A CHALEUR', $projectsNames) ? 'active' : '' }}"><a href="#">PAC</a></li>
                                <li class="{{ in_array('BOILERS', $projectsNames) ? 'active' : '' }}"><a href="#">BOILER</a></li>
                                <li class="{{ in_array('BORNES DE RECHARGE', $projectsNames) ? 'active' : '' }}"><a href="#">BORNE</a></li>
                            </ul>
                        </div>
                        <div class="list_visit">
                            <ul>
                                <li><a href="#">Projet signé</a></li>
                                <li class="{{ ($client[0]->signe == '1') ? 'active' : '' }}"><a href="#">Oui</a></li>
                                <li class="{{ ($client[0]->signe == '0') ? 'active' : '' }}"><a href="#">Non</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- End section filter -->
                <div class="row">
                    <div class="col-12">
                        <div class="fvt-panel alert alert-success justify-content-between d-flex align-items-center" role="alert">
                            <div class="fvt-panel-title">
                                Formulaire Visite Technique Part. 1
                            </div>
                            @if(is_null($fichevtc))
                                <div class="fvt-panel-actions d-flex">
                                    <a href="{{ url('/dashboard/createfvt/'.$client[0]->id) }}" class="btn btn-success">Créer Fiche VT</a>
                                </div>
                            @else
                            <div class="fvt-panel-actions d-flex">
                                <a href="{{ url('/dashboard/editfvt/'.$fichevtc) }}" type="button" class="btn fvt-panel-actions-btn d-flex flex-column align-items-center me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    Compléter/Modifier
                                </a>
                                <a href="{{ url('/dashboard/pdf/'.$fichevtc) }}" type="button" class="btn fvt-panel-actions-btn d-flex flex-column align-items-center me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                    </svg>
                                    Visualiser
                                </a>
                                <a href="{{ url('/dashboard/createfvt/edit/') }}" type="button" class="btn fvt-panel-actions-btn d-flex flex-column align-items-center me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
                                    </svg>
                                    Partager
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header client-lists_header_two">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Délais</th>
                                    <th scope="col">Notifications</th>
                                    <th scope="col">Documents</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <th scope="row">{{$task->id}}</th>
                                            <td>{{$task->description}}</td>
                                            <td class="d-flex">
                                                @if($task->status === 'Fait')
                                                    <span class="badge bg-success">{{$task->status}}</span>
                                                @elseif($task->status === 'En cours')
                                                    <span class="badge bg-warning text-dark">{{$task->status}}</span>
                                                @elseif($task->status === 'Bloqué')
                                                    <span class="badge bg-danger">{{$task->status}}</span>
                                                @endif
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        
                                                    </span>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="task-statut dropdown-item bg-success" href="#" data-tid="{{$task->id}}" data-client="{{$client[0]->firstname}} {{$client[0]->lastname}}">Fait</a></li>
                                                        <li><a class="task-statut dropdown-item bg-warning text-dark" href="#" data-tid="{{$task->id}}" data-client="{{$client[0]->firstname}} {{$client[0]->lastname}}">En cours</a></li>
                                                        <li><a class="task-statut dropdown-item bg-danger" href="#" data-tid="{{$task->id}}" data-client="{{$client[0]->firstname}} {{$client[0]->lastname}}">Bloqué</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                            <div class="d-flex date-column">
                                                @if(!is_null($task->delais))
                                                    @if(!is_null($task->delais[0]['start']))
                                                        <?php $delai_start = json_encode($task->delais[0]['start']); ?>
                                                        <?php 
                                                            $start_date = explode('-', $delai_start);
                                                            $start_year = $start_date[0];
                                                            $start_month = $start_date[1];
                                                            $start_day = $start_date[2];
                                                            $st = DateTime::createFromFormat('!m', $start_month);
                                                        ?>
                                                        <p class="start-date-display">{{str_replace('"', '', $start_day).' '.substr($st->format('F'), 0, 3)}}</p>
                                                    @endif
                                                    @if(!is_null($task->delais[0]['end']))
                                                        <?php $delai_end = json_encode($task->delais[0]['end']); ?>
                                                        <?php    
                                                            $end_date = explode('-', $delai_end);
                                                            $end_year = $end_date[0];
                                                            $end_month = $end_date[1];
                                                            $end_day = $end_date[2];
                                                            $end = DateTime::createFromFormat('!m', $end_month);
                                                        ?>
                                                        <p class="end-date-display">&nbsp;- {{str_replace('"', '', $end_day).' '.substr($end->format('F'), 0, 3)}}</p>
                                                    @endif
                                                    <button id="edit-delais" class="btn modal-delais" data-tid="{{$task->id}}" data-stdate="{{$task->delais[0]['start']}}" data-enddate="{{$task->delais[0]['end']}}">
                                                        <img src="{{asset('assets/images/calendar-plus.svg')}}" data-tid="{{$task->id}}" data-stdate="{{$task->delais[0]['start']}}" data-enddate="{{$task->delais[0]['end']}}">
                                                    </button>
                                                @else
                                                    <p class="start-date-display"></p>
                                                    <p class="end-date-display"></p>
                                                    <button id="edit-delais" class="btn modal-delais" data-tid="{{$task->id}}">
                                                        <img src="{{asset('assets/images/calendar-plus.svg')}}" data-tid="{{$task->id}}">
                                                    </button>
                                                @endif
                                                </div>
                                            </td>
                                            <td>
                                            @if(!is_null($task->notifiables))
                                                @foreach ($task->notifiables as $notifiable)
                                                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="notifiables-avatar">
                                                    <!-- <li>{{$notifiable['name']}}</li> -->
                                                @endforeach
                                            @endif
                                                <button id="add-notifiable" class="btn modal-notifiables" data-taskid="{{$task->id}}" data-notifiables="{{json_encode($task->notifiables)}}">+</button>
                                            </td>
                                            <td>
                                                @if(!is_null($task->attachements))
                                                <div class="dropdown">
                                                    <a href="#" class="btn dropdown-toggle" 
                                                    role="button" data-tid="{{$task->id}}" target="_blank" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset('assets/images/file-pdf.svg')}}" data-tid="{{$task->id}}">
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuLink">
                                                        <li><a class="dropdown-item" href="{{asset('file/'.$task->attachements)}}" target="_blank">Ouvrir</a></li>
                                                        <li><a class="dropdown-item modal-files" href="#">Modifier</a></li>
                                                    </ul>
                                                </div>
                                                @else
                                                <div class="dropdown">
                                                    <a href="#" class="btn dropdown-toggle" 
                                                    role="button" data-tid="{{$task->id}}" target="_blank" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset('assets/images/file-plus.svg')}}" data-tid="{{$task->id}}">
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuLink">
                                                        <li class="d-flex"><img class="todos-upload-actions" src="{{asset('assets/images/half-circle.png')}}"><a class="dropdown-item" href="#" target="_blank">Documents plateforme</a></li>
                                                        <li class="d-flex" data-tid="{{$task->id}}"><img class="todos-upload-actions" src="{{asset('assets/images/laptop.svg')}}" data-tid="{{$task->id}}"><a class="dropdown-item modal-files" href="#" data-tid="{{$task->id}}">Depuis l'ordinateur</a></li>
                                                        <li class="d-flex"><img class="todos-upload-actions" src="{{asset('assets/images/google-drive.svg')}}"><a class="dropdown-item" href="#">Depuis Google Drive</a></li>
                                                    </ul>
                                                </div>
                                                    <!-- <button class="btn modal-files ms-2" data-tid="{{$task->id}}"><img src="{{asset('assets/images/file-plus.svg')}}" data-tid="{{$task->id}}"></button> -->
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifiables Modal Start-->
                <div class="modal fade" id="notifiablesModal" tabindex="-1" aria-labelledby="notifiablesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form id="notif-form" autocomplete="off">
                                    <select name="users-to-notify" class="form-select" id="multiple-select-field" data-placeholder="Choose anything" multiple>
                                        @foreach ($notifiablesUsers as $notifiable)
                                            <option value="{{$notifiable->id}}">
                                                {{$notifiable->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="btn" type="button" id="addNotifiable" value="+ Ajouter">
                                </form>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Notifiables Modal End -->

                <!-- Delais Modal Start-->
                <div class="modal fade" id="delaisModal" tabindex="-1" aria-labelledby="delaisModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form id="delais-form" autocomplete="off">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Début (de)</label>
                                    <input id="start-delai-input" name="startdelai" type="date" class="form-control">
                                    <small id="start-delai" class="invalid-feedback">
                                        Veuillez choisir une date valide
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Fin (à)</label>
                                    <input id="end-delai-input" name="enddelai" type="date" class="form-control">
                                    <small id="end-delai" class="invalid-feedback">
                                        Your email must be a valid email
                                    </small>
                                </div>
                                    <input class="btn" type="submit" id="addDelais" value="+ Enregister les Délais">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delais Modal End -->

                <!-- Files Modal Start-->
                <div class="modal fade" id="filesModal" tabindex="-1" aria-labelledby="filesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form id="files-form" autocomplete="off">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Fichier</label>
                                    <input id="file-input" name="file" type="file" class="form-control h-100">
                                    <small id="file-error" class="invalid-feedback">
                                        Veuillez choisir une date valide
                                    </small>
                                </div>
                                <input class="btn" type="submit" id="addFiles" value="+ Enregister les Fichiers">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Files Modal End -->
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

@push('scripts')
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var modalToggle = document.getElementById('modalTrigger') // relatedTarget
    var notifiablesSelect = document.getElementById('multiple-select-field')

    const userSelection = Object.values(document.getElementsByClassName('modal-notifiables'))
    const dateSelection = Object.values(document.getElementsByClassName('modal-delais'))
    const filesSelection = Object.values(document.getElementsByClassName('modal-files'))
    const statusSelection = Object.values(document.getElementsByClassName('task-statut'))
    
    var notifiables = []
    var addNotifiableToList = document.getElementById('addNotifiable')
    var addDelaisToList = document.getElementById('addDelais')
    var addFilesToList = document.getElementById('addFiles')
    let taskID = null

    let editDateButtonNode = null
    let editNotifiablesButtonNode = null
    let editFilesButtonNode = null
    let editStatusButtonNode = null

    

    userSelection.forEach(link => {
        link.addEventListener("click", function(e) {
            event.preventDefault();
            $('#notifiablesModal').modal('show');
           
            notifiablesList = $(e.target).data('notifiables')
            taskID = $(e.target).data('taskid')
            
            let defaultNotifiables = []
            for (const property in notifiablesList) {
                defaultNotifiables.push(notifiablesList[property]['id'])
            }

            $('#multiple-select-field').val(null).trigger('change');
            $('#multiple-select-field').val(defaultNotifiables);
            $('#multiple-select-field').trigger('change'); // Notify any JS components that the value changed

            editNotifiablesButtonNode = $(e.target).parent().closest('td')
        });
    });

    dateSelection.forEach(link => {
        link.addEventListener("click", function(e) {
            event.preventDefault();
            $('#delaisModal').modal('show');
            taskID = $(e.target).data('tid')

            $('#start-delai-input').val($(e.target).data('stdate'));
            $('#end-delai-input').val($(e.target).data('enddate'));
            
            editDateButtonNode = $(e.target).parent().closest('td')
        });
    });

    filesSelection.forEach(link => {
        link.addEventListener("click", function(e) {
            event.preventDefault();
            $('#filesModal').modal('show');
            taskID = $(e.target).data('tid')
            console.log('FILE MODAL TASK ID')
            console.log(taskID)

            editFilesButtonNode = $(e.target).parent().closest('td')
        });
    });

    $( '#multiple-select-field' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
    } );

    statusSelection.forEach(link => {
        link.addEventListener("click", function(e) {
            event.preventDefault();
            console.log(e.target.innerHTML)
            let statut = e.target.innerHTML
            taskID = $(e.target).data('tid')
            clientName = $(e.target).data('client')
           
            editStatusButtonNode = $(e.target).parent().closest('td')
            // $(editStatusButtonNode).children('span').removeClass('bg-success');
            
            console.log()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '{{ route('updatetaskstatut') }}',
                data: {statut: statut, taskId: taskID},
                success: function (data) {
                    toastr.success('Tâche modifiée ajouté avec succès')

                    if(statut === 'Fait'){
                        $(editStatusButtonNode).children('span').removeClass('bg-success')
                        $(editStatusButtonNode).children('span').removeClass('bg-warning')
                        $(editStatusButtonNode).children('span').removeClass('bg-danger')
                        $(editStatusButtonNode).children('span').addClass('bg-success');
                        $(editStatusButtonNode).children('span').text('Fait');
                    }else if(statut === 'En cours'){
                        $(editStatusButtonNode).children('span').removeClass('bg-success')
                        $(editStatusButtonNode).children('span').removeClass('bg-warning')
                        $(editStatusButtonNode).children('span').removeClass('bg-danger')
                        $(editStatusButtonNode).children('span').addClass('bg-warning');
                        $(editStatusButtonNode).children('span').text('En cours');
                    }else{
                        $(editStatusButtonNode).children('span').removeClass('bg-success')
                        $(editStatusButtonNode).children('span').removeClass('bg-warning')
                        $(editStatusButtonNode).children('span').removeClass('bg-danger')
                        $(editStatusButtonNode).children('span').addClass('bg-danger');
                        $(editStatusButtonNode).children('span').text('Bloqué');
                    }

                },
                error: function (e) {
                    toastr.error('Error')
                }
            });
        });
    });

    addNotifiableToList.addEventListener("click", function(e) {
        let data = $("#multiple-select-field").val()
        console.log("Selected value is: "+data)

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            type: 'POST',
            url: '{{ route('updatenotifiables') }}',
            data: {notifiables: data, taskId: taskID},
            success: function (data) {
                toastr.success('Utilisateur ajouté avec succès')
                console.log(data)
                $(editNotifiablesButtonNode).prepend('<img class="notifiables-avatar" src="https://www.w3schools.com/howto/img_avatar.png" />')
            },
            error: function (e) {
                toastr.error('Error')
            }
        });
    })

    addDelaisToList.addEventListener("click", function(e) {
        event.preventDefault();
        // const { startdelai, enddelai } = Object.fromEntries(new FormData(e.target))
        
        var form_data = new FormData(document.getElementById("delais-form"));
        const { startdelai, enddelai } = Object.fromEntries(form_data)

        const data = {'from': startdelai, 'to': enddelai}
        if (startdelai.length == "") {
            $("#start-delai").show();
            $("#end-delai").hide();
        }
        // else if(enddelai.length == ""){
        //     $("#start-delai").hide();
        //     $("#end-delai").show();
        // }
        else{
            $("#start-delai").hide();
            $("#end-delai").hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '{{ route('updatedelais') }}',
                data: {delais: {'from': startdelai, 'to': enddelai}, taskId: taskID},
                success: function (data) {
                    toastr.success('Succès')

                    let date = new Date(startdelai); 
                    let month = date.toLocaleString('en-US', { month: 'short' });
                    let day = date.getUTCDate() ;
                    let fullDate = day + " " + month
                    $(editDateButtonNode).children('div').children('p.start-date-display').text(fullDate)
                   
                    if(enddelai !== '')
                    {
                        date = new Date(enddelai); 
                        month = date.toLocaleString('en-US', { month: 'short' });
                        day = date.getUTCDate() ;
                        fullDate = "\xa0- " + day + " " + month
                        $(editDateButtonNode).children('div').children('p.end-date-display').text(fullDate)
                    }
                },
                error: function (e) {
                    toastr.error('Error')
                    console.log(e);
                }
            });
        }
    })

    addFilesToList.addEventListener("click", function(e) {
        e.preventDefault();
        var form_data = new FormData(document.getElementById("files-form"));
        const { file } = Object.fromEntries(form_data)

        var fd = new FormData();
        fd.append('file',file);
        fd.append('task_id', taskID);
       
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            contentType: false,
            processData: false,
            dataType: 'json',
            type: 'POST',
            url: '{{ route('updatefiles') }}',
            data: fd,
            success: function (data) {
                toastr.success('Fichier attaché avec succès!')
                let fileName = data['attachements']
                let fileLink ="<a class='dropdown-item' href='" + window.location.origin + "/file/" + fileName + "'>Welcome to </a>"
                let fileHTML = "<div class='dropdown'>"+
                                    "<a href='#' class='btn dropdown-toggle' "+
                                    "role='button' data-tid='' target='_blank' data-bs-toggle='dropdown' aria-expanded='false'>"+
                                    "<img src='{{asset('assets/images/file-pdf.svg')}}' data-tid=''>"+
                                    "</a>"+
                                    "<ul class='dropdown-menu dropdown-menu-end dropdown-menu-lg-start' aria-labelledby='dropdownMenuLink'>"+
                                        "<li><a class='dropdown-item' href='" + window.location.origin + "/file/" + fileName + "' target='_blank'>Ouvrir</a></li>"+
                                        "<li><a class='dropdown-item modal-files' href='#'>Modifier</a></li>"+
                                    "</ul>"+
                                "</div>";
                $(editFilesButtonNode).html(fileHTML)
            //    console.log(window.location.href)
            //    console.log(window.location.host)
            //    console.log(window.location.hostname)
            //    console.log(window.location.origin)
               console.log(fileLink)
            },
            error: function (e) {
                toastr.error('Error')
            }
        });
    })
</script>
   
@endpush



