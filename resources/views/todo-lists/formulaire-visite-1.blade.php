@extends('layouts.backend')

@section('content')

    <!-- start section content -->

    <div class="content-body">

        <div class="warper container-fluid">

            <div class="new-patients main_container">

                <div class="row page-titles mx-0">

                    <div class="col-sm-6 p-md-0">

                        <div class="welcome-text">

                            <h4 class="text-primary">VISITE TECHNIQUE</h4>

                        </div>

                    </div>

                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                            <li class="breadcrumb-item active">

                                <a href="/ToDoList.html">VISITE TECHNIQUE</a>

                            </li>

                        </ol>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="card">

                            <div class="card-header inline-block item-todolist_details">

                                <!-- start section filter -->

                                <div class="row head_todolist mb-4">

                                    <div class="col-md-6">

                                        <h4>
                                            <strong>
                                                {{$client['firstname'].' '.$client['lastname']}}
                                            </strong>
                                        </h4>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="list_visit">

                                            <ul>

                                                <li><a href="">Projet</a></li>

                                                <li class="active"><a href="">PV</a></li>

                                                <li><a href="">PAC</a></li>

                                                <li><a href="">BOILER</a></li>

                                                <li><a href="">BORNE</a></li>

                                                <li><a href="">Projet signé</a></li>

                                                <li class="active"><a href="">Non</a></li>

                                                <li><a href="">Oui</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>


                                <!-- End section filter -->


                                <!--  -->

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form_visite">

                                            <div class="header_form_visite mb-3">

                                                <div class="header_form_visite_left">

                                                    <h4>Formulaire Visite Technique Part. 1</h4>

                                                </div>


                                                <div class="header_form_visite_right d-flex">

                                                    <span>Éco-conseiller :</span>

                                                    <h5>{{Auth::user()->name}}</h5>

                                                </div>

                                            </div>

                                            <div class="form_input">


                                                <form action="{{route('todo-list.formulaire-visite-1.submit')}}"
                                                      method="POST">
                                                    @csrf

                                                    <input type="hidden" name="client_id" value="{{$client_id}}">

                                                    <div class="row mb-2">

                                                        <div class="col-md-12 mb-2">

                                                            <h5>
                                                                <a href="https://app.hubspot.com/contacts/22135982">
                                                                    <img
                                                                        src="{{asset('assets/images/menu/shar_bg.svg')}}"
                                                                        alt="">
                                                                </a>
                                                                Fiche client :

                                                            </h5>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="btn_toggle_list d-flex" role="group"
                                                                 aria-label="Basic mixed styles example">


                                                                <div class="toggle_input">

                                                                    <input type="button" class="btn btn-toggle"
                                                                           value="Professionnel">

                                                                    <span class="fas fa-check"></span>

                                                                </div>

                                                                <div class="toggle_input">

                                                                    <input type="button" class="btn"
                                                                           value="Particulier">

                                                                    <span class="fas fa-check"></span>

                                                                </div>


                                                            </div>


                                                        </div>

                                                        <div class="col-md-3">

                                                            <div class="form-group">

                                                                <input type="text" class="form-control" name="firstname"
                                                                       value="{{$client['firstname']}}"/>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-3">

                                                            <div class="form-group">

                                                                <input type="text" class="form-control" name="lastname"
                                                                       value="{{$client['lastname']}}"/>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="phone"
                                                                       value="{{$client['phone']}}"/>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">

                                                            <div class="form-group">

                                                                <input type="email" class="form-control" name="email"
                                                                       value="{{$client['email']}}"/>

                                                            </div>

                                                        </div>


                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <textarea class="form-control" rows="3"
                                                                          name="address">{{$client['address']}}</textarea>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-3">

                                                            <div class="form-group">

                                                                <textarea class="form-control" rows="3" name="npa"
                                                                          placeholder="NPA"></textarea>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-3">

                                                            <div class="form-group">

                                                   <textarea class="form-control" rows="3" name="date_de_construction"

                                                             placeholder="Date de construction"></textarea>

                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="row">

                                                        <div class="col-md-12 mb-2">

                                                            <h5>Projet :</h5>

                                                        </div>


                                                        <div class="col-md-4">

                                                            <div class="form-group">

                                                                <input type="text" class="form-control"
                                                                       name="nombre_de_panneaux"
                                                                       placeholder="Nombre de panneaux"/>

                                                            </div>

                                                        </div>


                                                        <div class="col-md-4">

                                                            <div class="form-group">

                                                                <select class="form-control form-select"
                                                                        name="puissance">
                                                                    <option>Puissance</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <select class="form-control form-select" name="marque">
                                                                    <option>Marque</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <select class="form-control form-select"
                                                                        name="type_d_onduleur">
                                                                    <option>Type d’onduleur</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4">

                                                            <div class="form-group">

                                                                <select class="form-control form-select"
                                                                        name="batteries">

                                                                    <option>Batteries</option>

                                                                    <option>1</option>

                                                                    <option>2</option>

                                                                </select>

                                                            </div>

                                                        </div>


                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                   <textarea class="form-control" rows="3"
                                                             placeholder="Date de construction"
                                                             name="date_de_construction"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">

                                                        <div class="col-md-12 mb-2">

                                                            <h5>Délais :</h5>

                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <select class="form-control form-select" name="date_visite_technique">
                                                                    <option>Date et heure de la Visite Technique
                                                                    </option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <select class="form-control form-select" name="date_retour_bureau_detudes">

                                                                    <option>

                                                                        Date et heure du Retour du Bureau d’Etudes

                                                                    </option>

                                                                    <option>1</option>

                                                                    <option>2</option>

                                                                </select>

                                                            </div>

                                                        </div>

                                                        <div class="form-group text-right">

                                                            <button type="submit" class="btn btn-primary float-end">

                                                                VALIDER

                                                            </button>

                                                        </div>

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
