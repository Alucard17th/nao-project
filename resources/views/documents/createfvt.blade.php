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
                            <h4 class="text-primary">Formulare visite technique Part. 1</h4>
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
                @include('includes.alert_messages')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header client-lists_header_two">
                                <form action="{{route('fichevt.create')}}" method="POST" class=''  id=''>
                                    @csrf
                                    <div class="container">
                                        <div class="row mb-5">
                                            <h3>Fiche client:</h3>
                                            <div class="mb-3 col-3">
                                                <input name="fname" value="{{$client->firstname}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nom">
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="lname" value="{{$client->lastname}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Prénom">
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="phone" value="{{$client->phone}}" type="phone" class="form-control" id="exampleFormControlInput1" placeholder="Téléphone">
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="email" value="{{$client->email}}" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
                                            </div>
                                            
                                            <div class="mb-3 col-3">
                                                <input name="address" value="{{$client->address}}" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Adresse">
                                            </div>
                                            <div class="mb-3 col-3">
                                                <input name="npa" type="text" class="form-control" id="exampleFormControlInput1" placeholder="NPA">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <input name="date_construction" type="date" class="form-control" id="exampleFormControlInput1" placeholder="Date de construction">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <h3>Projet:</h3>
                                            <div class="mb-3 col-4">
                                                <input name="nbre_panneaux" type="number" class="form-control input-sm" id="exampleFormControlInput1" placeholder="Nombre de panneaux">
                                            </div>
                                            <div class="mb-3 col-4">
                                            <select name="puissance" class="form-select" aria-label="Default select example">
                                                <option selected>Puissance</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            </div>
                                            <div class="mb-3 col-4">
                                            <select name="marque" class="form-select" aria-label="Default select example">
                                                <option selected>Marque</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            </div>

                                            <div class="mb-3 col-6">
                                            <select name="type_onduleur" class="form-select" aria-label="Default select example">
                                                <option selected>Type d'onduleur</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            </div>
                                            <div class="mb-3 col-6">
                                            <select name="batteries" class="form-select" aria-label="Default select example">
                                                <option selected>Batteries</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <textarea name="commentaires" class="form-control" id="exampleFormControlTextarea1" rows="3">Commentaires</textarea>
                                            </div>
                                        </div>    
                                        <div class="row mb-5">
                                            <h3>Délais:</h3>
                                            <div class="mb-3 col-6">
                                                <input name="date_vt" placeholder="Type Date" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <input name="date_rbe" type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                            </div>
                                        </div>
                                        <input name="client_id" value="{{$client->id}}" type="hidden" class="form-control">
                                        <input name="project_id" value="{{request()->project_id}}" type="hidden" class="form-control">
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

@push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#dropzone", {
            maxFilesize: 50, // 50 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;
                console.log(name)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    type: 'POST',
                    url: '{{ route('deleteFile') }}',
                    data: {filename: name},
                    success: function (data) {

                        console.log(data);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;

            },
            init: function () {
                myDropzone = this;

                $.ajax({
                    url: '{{ route("readFiles") }}',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {

                        $.each(response, function (key, value) {
                            const mockFile = {name: value.name, size: value.size};

                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, value.path);
                            myDropzone.emit("complete", mockFile);

                        });
                    }
                });
            }
        });

        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });

        myDropzone.on("success", function (file, response) {

            if (response.success == 0) { // Error
                alert(response.error);
            }
        });


        var myDropzone2 = new Dropzone("#dropzone2", {
            maxFilesize: 50, // 50 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    type: 'POST',
                    url: '{{ route('deleteFile') }}',
                    data: {filename: name},
                    success: function (data) {

                        console.log(data);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;

            },
            init: function () {
                myDropzone2 = this;

                $.ajax({
                    url: '{{ route("readFiles") }}',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {

                        $.each(response, function (key, value) {
                            const mockFile = {name: value.name, size: value.size};

                            myDropzone2.emit("addedfile", mockFile);
                            myDropzone2.emit("thumbnail", mockFile, value.path);
                            myDropzone2.emit("complete", mockFile);

                        });
                    }
                });
            }
        });

        myDropzone2.on("sending", function (file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });

        myDropzone2.on("success", function (file, response) {

            if (response.success == 0) { // Error
                alert(response.error);
            }
        });



        var myDropzone3 = new Dropzone("#dropzone3", {
            maxFilesize: 50, // 50 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;
                console.log(name)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    type: 'POST',
                    url: '{{ route('deleteFile') }}',
                    data: {filename: name},
                    success: function (data) {

                        console.log(data);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;

            },
            init: function () {
                myDropzone3 = this;

                $.ajax({
                    url: '{{ route("readFiles") }}',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {

                        $.each(response, function (key, value) {
                            const mockFile = {name: value.name, size: value.size};

                            myDropzone3.emit("addedfile", mockFile);
                            myDropzone3.emit("thumbnail", mockFile, value.path);
                            myDropzone3.emit("complete", mockFile);

                        });
                    }
                });
            }
        });

        myDropzone3.on("sending", function (file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });

        myDropzone3.on("success", function (file, response) {

            if (response.success == 0) { // Error
                alert(response.error);
            }
        });

        var myDropzone4 = new Dropzone("#dropzone4", {
            maxFilesize: 50, // 50 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;
                console.log(name)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    type: 'POST',
                    url: '{{ route('deleteFile') }}',
                    data: {filename: name},
                    success: function (data) {

                        console.log(data);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;

            },
            init: function () {
                myDropzone4 = this;

                $.ajax({
                    url: '{{ route("readFiles") }}',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {

                        $.each(response, function (key, value) {
                            const mockFile = {name: value.name, size: value.size};

                            myDropzone4.emit("addedfile", mockFile);
                            myDropzone4.emit("thumbnail", mockFile, value.path);
                            myDropzone4.emit("complete", mockFile);

                        });
                    }
                });
            }
        });

        myDropzone4.on("sending", function (file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });

        myDropzone4.on("success", function (file, response) {

            if (response.success == 0) { // Error
                alert(response.error);
            }
        });
    </script>
@endpush
