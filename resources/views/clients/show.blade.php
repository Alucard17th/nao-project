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
                            <div class="card-header client-lists_header d-block">
                                <form action="{{route('clients.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <div>
                                        <h3 class="mb-4">INFORMATION DE CLIENT</h3>
                                        <p><strong>Nom et prénom
                                                : </strong>{{$client->firstname .' '.$client->lastname}}</p>
                                        <p><strong>E-mail : </strong>{{$client->email}}</p>
                                        <p><strong>Ville : </strong>{{$client->city}}</p>
                                        <p><strong>Téléphone : </strong>{{$client->phone}}</p>
                                        <p><strong>Adresse : </strong>{{$client->address}}</p>
                                        <p><strong>state : </strong>{{$client->state}}</p>
                                        <p><strong>Code postal : </strong>{{$client->zip}}</p>
                                        <p><strong>Créé à : </strong>{{$client->created_at}}</p>
                                        <p><strong>Mis à jour à : </strong>{{$client->updated_at}}</p>
                                    </div>

                                    <div class="categories_select select_style">
                                        <h3 class="my-4">PROJET</h3>
                                        <div class="radio">
                                            <ul class="d-flex flex-wrap">
                                                @foreach($projects as $project)
                                                    <li>
                                                        <label for="cat_{{$loop->iteration}}">
                                                            <input id="cat_{{$loop->iteration}}" type="checkbox"
                                                                   name="projects[]"
                                                                   @if($project_ids->contains($project->id)) checked @endif
                                                                   value="{{$project->id}}">{{$project->name}}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="categories_select select_style mb-4">
                                        <h3 class="my-4">SIGNATURE</h3>
                                        <div class="radio">
                                            <ul class="d-flex flex-wrap">
                                                <li>
                                                    <label for="signature_1">
                                                        <input id="signature_1" type="radio" name="signature"
                                                               value="1" {{  $client->signe == 1 ? "checked" : "" }}>Signe
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="signature_2">
                                                        <input id="signature_2" type="radio" name="signature"
                                                               {{  $client->signe == 0 ? "checked" : "" }}
                                                               value="0">Ne
                                                        signe pas
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="signature_non"
                                               style="display: none;"
                                               name="signature_non" value="{{  $client->no_signe_raisons }}"
                                               placeholder="Raisons">
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary float-end"
                                                style="text-transform: none">Valider et déposer documents
                                        </button>
                                    </div>
                                </form>
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

        $(function () {
            const signiture = $("input[name='signature']:checked");

            console.log(signiture.val())

            if (signiture.val() === "0") {
                $('#signature_non').show();
            } else {
                $('#signature_non').hide();
            }

            $("input[name='signature']").on('change', function () {
                if (this.value === "0") {
                    $('#signature_non').show();
                } else {
                    $('#signature_non').hide();
                }
            });
        });
    </script>
@endpush
