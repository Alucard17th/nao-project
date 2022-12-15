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
                            <h4 class="text-primary">Mes Documents</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="/client.html">Mes Documents</a>
                            </li>
                        </ol>
                    </div>
                </div>

                @include('includes.alert_messages')

                @if(is_null(request()->isfvtcreated))
                    <div class="row">
                        <div class="col-4">
                            <a href="{{ url('/dashboard/createfvt/'.request()->client_id) }}" class="btn btn-primary">Créer Fiche VT</a>
                        </div>
                    </div>
                @else
                <div class="row">
                        <div class="col-4">
                            <a href="{{ url('/dashboard/editfvt/'.request()->isfvtcreated) }}" class="btn btn-primary">Modifier Fiche VT</a>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header client-lists_header_two">

                                <ul>
                                    <li class="dropdown">
                                        <input type="checkbox">
                                        <a href="#" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/menu/list.svg')}}" alt="">TECHNIQUE
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#">PHOTOS VT</a>
                                                <div class='content'>
                                                    <!-- Dropzone -->
                                                    <form action="{{route('uploadFile')}}" class='dropzone'  id='dropzone'></form>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#">DOC VT</a>
                                                <div class='content'>
                                                    <!-- Dropzone -->
                                                    <form action="{{route('uploadFile')}}" class='dropzone' id='dropzone2'></form>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#">PHOTOS INSTALLATIONS</a>
                                                <div class='content'>
                                                    <!-- Dropzone -->
                                                    <form action="{{route('uploadFile')}}" class='dropzone' id='dropzone3'></form>
                                                </div>
                                            </li>
                                            <li><a href="#">RAPPORT DE DEFAUTS</a></li>
                                            <li><a href="#">REPRISE DES DEFAUTS</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <input type="checkbox">
                                        <a href="#" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/menu/list.svg')}}" alt="">COMMERCIAL
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <input type="checkbox">
                                        <a href="#" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/menu/list.svg')}}" alt="">COMMUNE
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <input type="checkbox">
                                        <a href="#" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/menu/list.svg')}}" alt="">
                                            FOURNISSEURS</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <input type="checkbox">
                                        <a href="#" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/menu/list.svg')}}" alt="">
                                            PRONOVO</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <input type="checkbox">
                                        <a href="#" data-toggle="dropdown">
                                            <img src="{{asset('assets/images/menu/list.svg')}}" alt="">
                                            RBE</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </li>
                                </ul>
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
