@extends('layouts.backend')

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new-patients main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">Assigner des clients à ce commercial</h4>
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
                                        <a href="{{route('users.index')}}" class="btn btn-primary float-end">
                                            Liste des utilisateurs
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                @include('includes.alert_messages')

                                <div class="basic-form">
                                    <form action="{{route('users.post_set_clients')}}" method="POST">
                                        @csrf

                                        <input type="hidden" name="commercial_id" value="{{$user->id}}">

                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nom du commercial</label>
                                                    <input type="text"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           name="name"
                                                           value="{{old('name',$user->name)}}"
                                                           readonly>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Clients</label>
                                                    <select class="form-select" id="multiple-select-field"
                                                            data-placeholder="Choose anything" multiple
                                                            name="clients[]">

                                                        @foreach($clients as $client)
                                                            <option
                                                                value="{{$client->id}}" {{ in_array($client->id, $client_ids) ? 'selected' : '' }}>
                                                                {{$client->firstname.' '.$client->lastname}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary float-end ">Valider</button>
                                        </div>
                                    </form>
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

@section('scripts')
    <script>
        $('#multiple-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>
@endsection
