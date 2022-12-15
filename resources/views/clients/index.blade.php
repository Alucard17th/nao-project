@extends('layouts.backend')

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new-patients main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Mes clients</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="/client.html">Mes clients</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <form action="{{route('client.search')}}" method="POST">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="card-header inline-block mes-clients_listes">
                                            <div class="years_select select_style">
                                                <div class="radio">
                                                    <ul class="d-flex flex-wrap">
                                                        <li>
                                                            <label for="anne_1">
                                                                <input id="anne_1" type="checkbox" name="dates[]"
                                                                       value="tout"
                                                                    {{ isset($dates) &&in_array('tout', $dates) ? 'checked' : '' }}/>
                                                                Tout
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label for="anne_2">
                                                                <input id="anne_2" type="checkbox" name="dates[]"
                                                                       value="2021" {{ isset($dates) && in_array('2021', $dates) ? 'checked' : '' }}/>
                                                                2021
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label for="anne_3">
                                                                <input id="anne_3" type="checkbox" name="dates[]"
                                                                       value="2022" {{ isset($dates) && in_array('2022', $dates) ? 'checked' : '' }}/>
                                                                2022
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label for="anne_4">
                                                                <input id="anne_4" type="checkbox" name="dates[]"
                                                                       value="2023" {{ isset($dates) && in_array('2023', $dates) ? 'checked' : '' }}/>
                                                                2023
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="categories_select select_style">
                                                <div class="radio">
                                                    <ul class="d-flex flex-wrap">
                                                        @foreach($all_projects as $project)
                                                            <li>
                                                                <label for="cat_{{$loop->iteration}}">
                                                                    <input id="cat_{{$loop->iteration}}" type="checkbox"
                                                                           name="projects[]"
                                                                           {{(isset($projects) and in_array($project->id,$projects)) ? 'checked' : ''}}
                                                                           value="{{$project->id}}">{{$project->name}}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search"
                                                   aria-label="search" name="search_text"
                                                   aria-describedby="button-addon2" value="{{$search_text ?? ""}}">
                                            <button class="btn btn-primary" type="submit" id="button-addon2">Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header client-lists_header d-block">
                                <div class="client-lists">
                                    <ul>
                                        @forelse($clients as $result)
                                            <li>
                                                <a href="{{route('clients.show',$result['id'])}}">
                                                    <strong>{{$result['firstname'].' '.$result['lastname']}}</strong>
                                                </a>
                                            </li>
                                        @empty
                                            <h3 class="w-100 text-center">Il n'y a aucun client à afficher</h3>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="row">
                                    
                                        @foreach($clients as $client)
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a href="{{route('clients.show',$client['id'])}}">
                                                            {{$client['firstname'].' '.$client['lastname']}}
                                                        </a>
                                                    </h5>
                                                    <p class="card-text">{{$client['email']}}</br>{{$client['phone']}}</p>
                                                    <a href="{{route('clients.show',$client['id'])}}" class="btn btn-primary">Voir</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
