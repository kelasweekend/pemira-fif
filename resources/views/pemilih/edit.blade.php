@extends('layouts.dashboard.master')
@section('title')
    Edit Pemilih
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- breadcumb -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 float-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">@yield('title')</h3>
                                </div>
                                <div class="card-body p-0">
                                        <div class="bs-stepper-content">
                                            <!-- your steps content here -->
                                            <form action="{{ route('pemilih.update',$pemilih->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('patch')
                                                @csrf
                                                <div id="intro" class="content active dstepper-block" role="tabpanel"
                                                    aria-labelledby="intro-trigger">
                                                    <div class="form-group">
                                                        <label for="nim">NIM</label>
                                                        <input type="number" class="form-control" id="nim"
                                                            name="nim" placeholder="Masukan NIM" value="{{$pemilih->nim}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Nama Mahasiswa</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="Masukan Nama Mahasiswa" value="{{$pemilih->name}}">
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Asal Jurusan</label>
                                                        <select class="form-control" name="jurusan"
                                                            id="exampleFormControlSelect1">
                                                            <option value="{{$pemilih->jurusan}}">{{$pemilih->jurusan}}</option>
                                                            <option>D3 Teknik Telekomunikasi</option>
                                                            <option>S1 Teknik Telekomunikasi</option>
                                                            <option>S1 Teknik Desain Komunikasi Visual</option>
                                                            <option>S1 Teknik Infomatika</option>
                                                            <option>S1 Software Engginer</option>
                                                            <option>S1 Sistem Informasi</option>
                                                            <option>S1 Teknik Elektro</option>
                                                            <option>S1 Data Sains</option>
                                                            <option>S1 Logistik</option>
                                                            <option>S1 Teknik Industri</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    Silahkan Hiraukan Bagian Nama Wakil Jika Calon Tersebut Independent
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-header -->
    </div>
@endsection

@section('css-tambahan')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('cdn/summernote/summernote-bs4.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('cdn/bs-stepper/css/bs-stepper.min.css') }}">
@endsection

@section('js-tambahan')
    <!-- BS-Stepper -->
    <script src="{{ asset('cdn/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('cdn/summernote/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript">
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        $(function() {
            // Summernote
            $('#summernote').summernote()
            $('#visi').summernote()
            $('#misi').summernote()
        })

    </script>
@endsection
