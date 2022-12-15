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
                            <h4 class="text-primary">Modifier Formulare visite technique Part. 1</h4>
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

                <div class="col-md-12">
                    @if(!empty($successMsg))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $successMsg }} 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header client-lists_header_two">
                           
                                <form action="{{ url('/dashboard/editfvt/'.$fichierVT->id) }}" method="POST" class=''  id=''>
                                    @csrf
                                    <div class="container">
                                        <div class="row mb-5">
                                            <h3>Fiche client:</h3>
                                            <div class="mb-3 col-3">
                                                <input name="fname" value="{{$client->firstname}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nom" disabled>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="lname" value="{{$client->lastname}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Prénom" disabled>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="phone" value="{{$client->phone}}" type="phone" class="form-control" id="exampleFormControlInput1" placeholder="Téléphone" disabled>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="email" value="{{$client->email}}" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email" disabled>
                                            </div>
                                            
                                            <div class="mb-3 col-3">
                                                <input name="address" value="{{$client->address}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Adresse" disabled>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="npa" value="{{$fichierVT->npa}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="NPA">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <input name="date_construction" value="{{$fichierVT->date_construction}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="Date de construction">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <h3>Projet:</h3>
                                            <div class="mb-3 col-4">
                                                <input name="nbre_panneaux" value="{{$fichierVT->nbre_panneaux}}" type="number" class="form-control input-sm" id="exampleFormControlInput1" placeholder="Nombre de panneaux">
                                            </div>
                                            <div class="mb-3 col-4">
                                            <select name="puissance" class="form-select" aria-label="Default select example">
                                                <option value="1" {{ ( $fichierVT->nbre_panneaux == 1) ? 'selected' : '' }}> One </option>
                                                <option value="2" {{ ( $fichierVT->nbre_panneaux == 2) ? 'selected' : '' }}>Two</option>
                                                <option value="3" {{ ( $fichierVT->nbre_panneaux == 3) ? 'selected' : '' }}>Three</option>
                                                <option value="4" {{ ( $fichierVT->nbre_panneaux == 4) ? 'selected' : '' }}>Four</option>
                                            </select>
                                            </div>
                                            <div class="mb-3 col-4">
                                            <select name="marque" class="form-select" aria-label="Default select example">
                                                <option value="1" {{ ( $fichierVT->marque == 1) ? 'selected' : '' }}> One </option>
                                                <option value="2" {{ ( $fichierVT->marque == 2) ? 'selected' : '' }}>Two</option>
                                                <option value="3" {{ ( $fichierVT->marque == 3) ? 'selected' : '' }}>Three</option>
                                                <option value="4" {{ ( $fichierVT->marque == 4) ? 'selected' : '' }}>Four</option>
                                            </select>
                                            </div>

                                            <div class="mb-3 col-6">
                                            <select name="type_onduleur" class="form-select" aria-label="Default select example">
                                                <option value="1" {{ ( $fichierVT->type_onduleur == 1) ? 'selected' : '' }}> One </option>
                                                <option value="2" {{ ( $fichierVT->type_onduleur == 2) ? 'selected' : '' }}>Two</option>
                                                <option value="3" {{ ( $fichierVT->type_onduleur == 3) ? 'selected' : '' }}>Three</option>
                                                <option value="4" {{ ( $fichierVT->type_onduleur == 4) ? 'selected' : '' }}>Four</option>
                                            </select>
                                            </div>
                                            <div class="mb-3 col-6">
                                            <select name="batteries" class="form-select" aria-label="Default select example">
                                                <option value="1" {{ ( $fichierVT->batteries == 1) ? 'selected' : '' }}> One </option>
                                                <option value="2" {{ ( $fichierVT->batteries == 2) ? 'selected' : '' }}>Two</option>
                                                <option value="3" {{ ( $fichierVT->batteries == 3) ? 'selected' : '' }}>Three</option>
                                                <option value="4" {{ ( $fichierVT->batteries == 4) ? 'selected' : '' }}>Four</option>
                                            </select>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <textarea name="commentaires" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$fichierVT->commentaire}}</textarea>
                                            </div>
                                        </div>    
                                        <div class="row mb-5">
                                            <h3>Délais:</h3>
                                            <div class="mb-3 col-6">
                                                <input name="date_vt" value="{{$fichierVT->rdv_vt}}" placeholder="Type Date" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <input name="date_rbe" value="{{$fichierVT->rdv_rbe}}" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                            </div>
                                        </div>
                                        <input name="fiche_id" value="{{$fichierVT->id}}" value="" type="hidden" class="form-control">
                                        <input name="client_id" value="{{$client->id}}" type="hidden" class="form-control">
                                        <button type="submit" class="btn btn-primary float-center"> Valider </button>
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


