@extends('layouts.backend')

@section('content')

    <!-- End section header -->
    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new-patients main_container ">
                <div class="row page-titles mx-0 progression">
                    <div class="col-sm-6">
                        <div class="welcome-text">
                            <h4 style="color : #7B73CE !important;">VOTRE PROGRESSION</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <ul class="progress_ligne">
                            <li><span>Fait</span></li>
                            <li><span> En cours</span></li>
                            <li><span>Bloqué</span></li>
                        </ul>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <p class="p_progression mb-0">Suivez-vos actions réalisées, en cours ou bloquées.
                                    Cliquez, pour être redirigé !</p>

                            </div>
                            <div class="card-body inline-block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="porgress_client mb-3">
                                            <div class="header_porgress_client fait_item">
                                                <h4>Fait</h4>
                                            </div>

                                            <ul class="notif_porgress_client bg_one">
                                                @foreach($tasks as $task)
                                                    @if($task->status == 'Fait')
                                                        <li>
                                                            <span><strong>Client {{$task->client->firstname}} {{$task->client->lastname}}</strong></span>
                                                            <p>
                                                                {{$task->name}}
                                                            </p>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="porgress_client mb-3">
                                            <div class="header_porgress_client encours_item">
                                                <h4>En cours </h4>
                                            </div>

                                            <ul class="notif_porgress_client  bg_two">
                                                @foreach($tasks as $task)
                                                    @if($task->status == 'En cours')
                                                        <li>
                                                            <span><strong>{{$task->name}}</strong></span>
                                                            <p>
                                                                {{$task->name}}
                                                            </p>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="porgress_client mb-3">
                                            <div class="header_porgress_client bloque_item">
                                                <h4>Bloqué </h4>
                                            </div>

                                            <ul class="notif_porgress_client bg_three">
                                                @foreach($tasks as $task)
                                                    @if($task->status == 'Bloqué')
                                                        <li>
                                                            <span><strong>{{$task->name}}</strong></span>
                                                            <p>
                                                                {{$task->name}}
                                                            </p>
                                                        </li>
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


                <div class="row">

                    <div class="col-md-12">
                        <div class="card notication_client">

                            <div class="card-header">
                                <h4 class="mb-0 title_pages" style="color: #7B73CE !important;">NOTIFICATIONS</h4>
                            </div>
                            <div class="card-body">
                                <div class="owl-carousel owl-theme">
                                    @foreach(auth()->user()->notifications as $notif)
                                        <div class="item">
                                            <div class="media d-flex mb-3">
                                                <img class="mr-3" src="assets/images/téléchargement.svg"
                                                    alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0"><strong>{{$notif->data['message']['sender']}}</strong> <span
                                                            class="min">50mn</span>
                                                    </h5>
                                                    <span class="name_user">@vous a mentionné</span> à l’élément <span class="font-italic">
                                                        "&nbsp;{{$notif->data['message']['task']}}&nbsp;"
                                                    </span>
                                                    <span class="name_taged">Client &nbsp;{{$notif->data['message']['client']}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0 title_pages" style="color: #7B73CE !important;">ÉCHÉANCES</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart6"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0 title_pages" style="color: #7B73CE !important;">DERNIERS CLIENTS</h4>
                            </div>
                            <div class="card-body">
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <div class="list-client">
                                            <ul>
                                                @foreach($clients as $client)
                                                    <li><a href=""> <strong> {{$client->firstname}} {{$client->lastname}}</strong> </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <div class="voir_tt_client">
                                            <a href="#"> <img src="assets/images/menu/user.png" alt=""> Voir Tous les
                                                Clients </a>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <!-- <div class="coffer-fort">
                                           <img class="soustraction-left" src="assets/images/menu/soustraction-left.svg" alt="">

                                           <h4>Coffre-fort <br> des documents</h4>

                                              <img class="soustraction-right" src="assets/images/menu/soustraction-right.svg" alt="">
                                        </div> -->
                                    </div>
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
