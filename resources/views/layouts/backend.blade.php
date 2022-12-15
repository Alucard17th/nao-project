<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nao Energy Platform</title>
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" href="#" /> -->
    <!-- Base Styling  -->
    <link rel="stylesheet" href="{{asset('assets/main/css/fonts.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/main/css/style.css')}}"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('styles')
</head>

<body>
<div id="main-wrapper" class="show">
    <!-- start logo components -->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{route('home')}}">
                <img class="logo-tabib" src="{{asset('assets/images/Logo_nao.svg')}}" alt=""/></a>
            <a href="{{route('home')}}"><img class="brand-title" src="{{asset('assets/images/Logo_nao.svg')}}" alt=""/></a>
        </div>
    </div>
    <!-- End logo components -->

    <!-- start section sidebar -->
    <aside class="left-panel nicescroll-box">
        <nav class="navigation">
            <ul class="list-unstyled main-menu">
                <li class="has-submenu {{Route::currentRouteName() == 'home' ? 'active' :''}}">
                    <a href="{{route('home')}}">
                        <!-- <i class="fas fa-th-large"></i> -->
                        <img src="{{asset('assets/images/menu/dashboard.svg')}}" alt="">
                        <span class="nav-label">Tableau de bord</span>
                    </a>
                </li>

                @if(isset($user) && $user->hasRole('administrator'))
                    <li class="has-submenu {{Route::currentRouteName() == 'users.index' ? 'active' :''}}">
                        <a href="{{route('users.index')}}">
                            <!-- <i class="fas fa-th-large"></i> -->
                            <img src="{{asset('assets/images/menu/clients.svg')}}" alt="">
                            <span class="nav-label">Utilisateurs</span>
                        </a>
                    </li>
                @endif

                <li class="has-submenu {{Route::currentRouteName() == 'clients.index' ? 'active' :''}}">
                    <a href="{{route('clients.index')}}">
                        <!-- <i class="fas fa-th-large"></i> -->
                        <img src="{{asset('assets/images/menu/clients.svg')}}" alt="">
                        <span class="nav-label">Clients</span>
                    </a>
                </li>

                <li class="has-submenu {{Route::currentRouteName() == 'todos.index' ? 'active' :''}}">
                    <a href="{{route('todos.index')}}">
                        <!-- <i class="fas fa-th-large"></i> -->
                        <img src="{{asset('assets/images/menu/checkbox-outline.svg')}}" alt="">
                        <span class="nav-label">To Do List</span>
                    </a>
                </li>

                <li class="has-submenu {{Route::currentRouteName() == 'user.notifications' ? 'active' :''}}">
                    <a href="{{route('user.notifications')}}">
                        <!-- <i class="fas fa-th-large"></i> -->
                        <img src="{{asset('assets/images/menu/bell.svg')}}" alt="">
                        <span class="nav-label">Notifications</span>
                    </a>
                </li>

                <li class="has-submenu {{Route::currentRouteName() == 'chat.index' ? 'active' :''}}">
                    <a href="/chat">
                        <!-- <i class="fas fa-th-large"></i> -->
                        <img src="{{asset('assets/images/menu/chat-text.svg')}}" alt="">
                        <span class="nav-label">Chat</span>
                    </a>
                </li>

                <li class="has-submenu {{Route::currentRouteName() == 'document.index' ? 'active' :''}}">
                    <a href="/chat">
                        <!-- <i class="fas fa-th-large"></i> -->
                        <img src="{{asset('assets/images/menu/document.svg')}}" alt="">
                        <span class="nav-label">Documents</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <!-- End section sidebar -->

    <!-- start section header -->
    <div class="header">
        <header class="top-head container-fluid">


            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>

            <!-- search bar -->
            <div class="search_bar">
                <form action="https://www.google.com/search" method="get" class="search-bar" traget="_blank">
                    <input type="text" placeholder="Research" name="q">
                    <button type="submit" class="submit_btn"><i class="fas fa-search"></i></button>

                </form>
            </div>
            <!-- search bar -->


            <div class="header-right">
                <div class="fullscreen notification_dropdown">
                    <div class="full">
                        <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                </div>
                <div class="my-account-wrapper">
                    <div class="account-wrapper">
                        <div class="account-control">
                            <a class="login header-profile" href="#" title="Sign in">
                                <div class="header-info">
                                    <span>{{$user->name}}</span>
                                    <small>{{$user->roles[0]->display_name}}</small>
                                </div>
                                <img src="https://via.placeholder.com/150/f8f8f8/2b2b2b" alt="people"/>
                            </a>
                            <div class="account-dropdown-form dropdown-container">
                                <div class="form-content">
                                    <a href="doctor-settings.html">
                                        <i class="far fa-user"></i>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    <a href="#">
                                        <i class="far fa-envelope"></i>
                                        <span class="ml-2">Inbox</span>
                                    </a>

                                    <div>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-in-alt"></i>
                                            <span class="ml-2">Logout </span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown dropstart">
                <button type="button" class="btn position-relative" id="dropdownMenuButtonNotification" data-bs-toggle="dropdown" aria-expanded="false">
                    <img style="width:22px" src="{{asset('assets/images/bell.svg')}}" alt="">
                    <span id="notif-count" class="position-absolute top-0 start-50 ms-1 ps-1 pe-1 rounded {{ $user->unreadNotifications->count() == 0 ? '' : 'text-white bg-danger'  }}">
                        {{$user->unreadNotifications->count()}}
                    </span>
                </button>
                <ul class="dropdown-menu" id="notif-list" aria-labelledby="dropdownMenuButtonNotification">
                    @foreach($user->unreadNotifications as $notif)
                        <li><a class="dropdown-item" href="#">{{$notif->data['message']['sender']}} vous a mentionné à </br> {{$notif->data['message']['task']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn position-relative">
                <img style="width:22px" src="{{asset('assets/images/envelope.svg')}}" alt="">
                <span class="position-absolute top-5 start-50 ms-3 translate-middle p-2 bg-danger border border-light rounded">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>
        </header>
    </div>
    <!-- End section header -->

    @yield('content')
</div>
<!-- JQuery v3.5.1 -->
<script src="{{asset('assets/plugins/jquery/jquery3-2.1.min.js')}}"></script>
<!-- popper js -->
<!-- <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script> -->
<!-- ✅ load popper.js ✅ -->
<script
src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
crossorigin="anonymous"
></script>
<!-- Bootstrap -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>
<!-- Moment -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<!-- Date Range Picker -->
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.min.js')}}"></script>
<!-- Datatable -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/init-tdatatable.js')}}"></script>

<!-- Chart js -->
<!--
<script src="{{asset('assets/plugins/chart/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/apex-custom.js')}}"></script>
-->

<!-- owl -->
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<!-- Main Custom JQuery -->
<script src="{{asset('assets/js/toggleFullScreen.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset('assets/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function(){
        toastr.options = {
            "positionClass": "toast-bottom-right",
            "progressBar":true
        }
    })

   
</script>
<script>

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 3
            }
        }
    })
</script>
<script>
    window.User = {
        id: {{optional (auth()->user())->id}}
    }
</script>
<script src="{{asset('js/app.js')}}"></script>

@stack('scripts')
</body>

</html>
