<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="nosnippet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cdn/fontawesome-free/css/all.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cdn/css/adminlte.min.css') }}" />
    @yield('css-tambahan')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('vote') }}" class="nav-link">Vote System</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">Setting</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Profile</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Profile</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-key mr-2"></i>Change Password</a>
                            <div class="dropdown-item"><input type="checkbox" name="mode" class="mr-1"><span>Dark
                                    Mode</span></div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-unlock mr-2"></i>Log
                                Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('cdn/img/logo.png') }}" alt="Dashboard"
                    class="brand-image elevation-2 bg-white p-1 rounded" />
                <span class="brand-text font-weight-light">Pemira ITTP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                @include('layouts.dashboard.menu')
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer text-center">
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021
                <a href="#">AdminLTE.io</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting QuickCount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="post-form">
                        <div class="form-group">
                            <label for="datetime">Setting Waktu QuickCount</label>
                            <input type="date" name="tanggal" class="form-control" id="datetime"
                                aria-describedby="emailHelp">
                        </div>
                        <button type="button" class="btn btn-primary setting">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('cdn/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cdn/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cdn/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('cdn/js/script.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".setting").click(function () {
                event.preventDefault();
        
                let tanggal = $("input[name=tanggal]").val();
                let _token = $('meta[name="csrf-token"]').attr("content");
        
                $.ajax({
                    url: "/admin/setting",
                    type: "POST",
                    data: {
                        tanggal: tanggal,
                        _token: _token
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Selamat",
                                text: response.success,
                                confirmButtonText: 'Tutup'
                            });
                            document.getElementById("post-form").reset();
                            $('#exampleModal').modal('hide')
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Mohon Maaf !",
                                text: response.error,
                                confirmButtonText: 'Tutup'
                            });
                            document.getElementById("post-form").reset();
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            confirmButtonText: 'Cancel'
                        });
                    }
                });
            });
        });
    </script>
    {{-- tambahan --}}
    @yield('js-tambahan')
</body>

</html>
