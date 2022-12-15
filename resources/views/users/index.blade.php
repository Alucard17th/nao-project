@extends('layouts.backend')

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new-patients main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Liste des utilisateurs</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{(route('users.index'))}}">Liste des utilisateurs</a>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header fix-card">
                                <div class="row">
                                    <div class="col-8"></div>
                                    <div class="col-4">
                                        <a href="{{route('users.create')}}" class="btn btn-primary float-end">
                                            Nouvel utilisateur
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                @include('includes.alert_messages')

                                <div class="table-responsive">

                                    <table id="example1" class="display nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>E-mail</th>
                                            <th>Rôle</th>
                                            <th>Clients</th>
                                            <th>Inscrit à</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->roles[0]->display_name ?? ""}}</td>
                                                <td>
                                                    @if($user->hasRole('commercial'))
                                                        <span class="badge badge-success">
                                                            {{count($user->clients)}}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-dark">
                                                            {{count($user->clients)}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$user->created_at}}</td>
                                                <td>
                                                    <a href="{{route('users.edit',$user->id)}}" class='mr-4'>
                                                        <span class='fas fa-edit'></span>
                                                    </a>

                                                    <form action="{{ route('users.destroy',$user->id) }}" method="post"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-transparent mr-4">
                                                            <span class='fas fa-trash-alt'></span>
                                                        </button>
                                                    </form>

                                                    @if($user->hasRole('commercial'))
                                                        <a href='{{route('users.set_clients',$user->id)}}' class='mr-4'>
                                                            <span class='fa fa-user' aria-hidden='true'></span>
                                                        </a>
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
