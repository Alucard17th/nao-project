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
                            <h4 class="text-primary text-uppercase">Profile</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="/client.html">Profile</a>
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
                                        <button class="nav-link active" id="tous-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="nonlu-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                            Paramètres</button>
                                    </li>
                                </ul>
                               
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="tous-tab">
                                        <div class="col-md-12 mt-2">
                                            @if(session()->has('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif
                                            @if(session()->has('user'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session()->get('user') }}
                                                </div>
                                            @endif
                                        </div> 
                                        <form class="mt-5" method="post" autocomplete="off" action="{{route('user.updateProfile',$user->id)}}" enctype="multipart/form-data">
                                            @csrf    
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nom d'utilisateur</label>
                                                <input name="name" value="{{$user->name}}" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="email" value="{{$user->email}}" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mot de passe</label>
                                                <input name="password" type="password" class="form-control" id="password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatar" class="form-label">Mot de passe</label>
                                                <input name="avatar" type="file" class="form-control" id="avatar">
                                            </div>
                                            <div class="mb-3">
                                                <img src="{{asset('storage/'.$user->avatar)}}" class="w-50" alt="profile Image">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="nonlu-tab">
                                        <div class="col-md-12 mt-2">
                                            @if(session()->has('calendar-success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session()->get('calendar-success') }}
                                                </div>
                                            @endif
                                        </div> 
                                        <form action="{{route('user.updateCalendar',$user->id)}}" method="post" class="mt-5" autocomplete="off">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="calendar_id" class="form-label">ID de votre agenda</label>
                                                <input name="calendar" type="text" class="form-control" id="calendar_id" aria-describedby="emailHelp">
                                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </form>
                                        
                                        <div class="my-3 d-grid">
                                            <p>
                                                <button class="btn btn-outline-secondary" id="collapse-tuto" type="button" >
                                                    Comment récuperer mon identifiant d'agenda ?
                                                </button>
                                            </p>
                                            <div class="collapse" id="calendar-tutorial">
                                                <div class="card card-body">
                                                    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                                </div>
                                            </div>
                                        </div>
                                        
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
    
    var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
    
    document.getElementById('collapse-tuto').addEventListener("click", function() {
        var collapseList = collapseElementList.map(function (collapseEl) {
            return new bootstrap.Collapse(collapseEl)
        })
    });
</script>
@endpush


