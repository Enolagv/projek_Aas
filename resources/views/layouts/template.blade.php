<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <style>
        body{
            background-color: #ecf6ff;
            color: rgb(175, 192, 223);
            width: 80%;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body fixed-top" style="box-shadow: 0 5px 30px 0 rgba(82, 63, 105, 0.2);">
        <div class="container-fluid" >
            <a class="navbar-brand" href="#" style="color: rgb(44, 44, 236)"> <b>Pengelolaan Surat</b></a>
            <div class="offcanvas-header">
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fi fi-sr-users" ></i>
                                @if (Auth::check())
                                {{ Auth::User()->name}}
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                        
                                <li><a class="dropdown-item" href="{{ route('auth-logout')}}">Logout</a></li>
                            </ul>                
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <li class="nav-item">
        <div class="container-fluid" >
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white">
            @if (Auth::check())
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <br><br><br>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <a href="/dashboard" class="nav-link align-middle px-0"> <i class="fi fi-rr-apps"></i>
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link dropdown-toggle px-0 align-middle"><i class="fi fi-sr-users" ></i>
                                <i class="fs-4 bi-"></i> <span class="ms-1 d-none d-sm-inline">Data User</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100"> 
                                    <a href="{{ route('staff.data')}}" class="nav-link px-0"> <i class="fi fi-rr-circle-small"></i> <span class="d-none d-sm-inline">Data Staff Tata Usaha</a>
                                </li>
                                <li>
                                    <a href="{{ route('guru.data')}}" class="nav-link px-0"> <i class="fi fi-rr-circle-small"></i> <span class="d-none d-sm-inline">Data Guru</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link dropdown-toggle px-0 align-middle"><i class="fi fi-rr-envelope"></i>
                                <i class="fs-4 bi-"></i> <span class="ms-1 d-none d-sm-inline">Data Surat</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('letterType.data')}}" class="nav-link px-0"> <i class="fi fi-rr-circle-small"></i> <span class="d-none d-sm-inline">Data klasifikasi Surat</a>
                                </li>
                                <li>
                                    <a href="{{ route('letter.data')}}" class="nav-link px-0"> <i class="fi fi-rr-circle-small"></i> <span class="d-none d-sm-inline">Data Surat</a>
                                </li>
                                @endif
                            </ul>
                      
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container mt-5">
                @yield('content')
            </div>
            <div>
                @yield('content1')
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('script')
</body>
</html>