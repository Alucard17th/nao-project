@extends('layouts.backend')

@push('styles')
<style>

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
                            <h4 class="text-primary text-uppercase">Toutes vos notifications</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="/client.html">Notifications</a>
                            </li>
                        </ol>
                    </div>
                </div>
            
                <div class="row">
                 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header inline-block item-notification">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tous-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tous</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="nonlu-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Non
                                            lu</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="archiver-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Archives</button>
                                    </li>
                                </ul>
                                
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="tous-tab">
                                        <ul class="list-group list_notification_item">
                                            @foreach($user->notifications as $notif)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="media d-flex">
                                                        <img class="mr-3" src="{{$notif->data['message']['sender_image']}}" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="mt-0"> <strong>{{$notif->data['message']['sender']}}</strong> 
                                                            <!-- <span class="min">50mn</span> -->
                                                            </h5>
                                                            <span class="name_user">@vous a mentionné</span> à l’élément <span class="font-italic">
                                                                "&nbsp;{{$notif->data['message']['task']}}&nbsp;"</span>
                                                            <span class="name_taged">Client &nbsp;{{$notif->data['message']['client']}}</span>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-notification badge-pill">
                                                        <img src="assets/images/menu/archive-solid.svg" alt="">
                                                        Archiver
                                                    </span>
                                                </li>
                                            @endforeach     
                                        </ul>
                                    </div>

                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="nonlu-tab">
                                        <div class="row my-3">
                                            <div class="col">
                                                <a href="#" id="read-all-notifications" class="link-primary">Marquer comme lues</a>
                                            </div>
                                        </div>
                                        <ul class="list-group list_notification_item" id="unread-notifications">
                                            @foreach($user->unreadNotifications as $notif)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="media d-flex">
                                                        <img class="mr-3" src="{{$notif->data['message']['sender_image']}}" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="mt-0"> <strong>{{$notif->data['message']['sender']}}</strong>
                                                             <!-- <span class="min">50mn</span> -->
                                                            </h5>
                                                            <span class="name_user">@vous a mentionné</span> à l’élément <span class="font-italic">
                                                                "&nbsp;{{$notif->data['message']['task']}}&nbsp;"</span>
                                                            <span class="name_taged">Client &nbsp;{{$notif->data['message']['client']}}</span>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-notification badge-pill">
                                                        <img src="assets/images/menu/archive-solid.svg" alt="">
                                                        Archiver
                                                    </span>
                                                </li>
                                            @endforeach     
                                        </ul>
                                    </div>

                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="archiver-tab">3
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

@push('scripts')
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    document.getElementById('read-all-notifications').addEventListener("click", function(e) {
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '{{ route('notificationsmarkasread') }}',
                // data: {statut: statut, taskId: taskID},
                success: function (data) {
                    toastr.success('Notifications marquées comme lues')
                    $("#notif-list").empty()
                    $("#unread-notifications").empty()
                    document.getElementById('notif-count').innerHTML = 0
                },
                error: function (e) {
                    toastr.error('Error')
                }
            });
    })

</script>
   
@endpush



