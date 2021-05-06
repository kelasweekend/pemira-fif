@extends('layouts.dashboard.master')
@section('title')
    Create Pemilih
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
                            @can('pemilih-delete')
                              <form action="{{ route('pemira.destroy', $id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit"><i class="fas fa-trash"></i></button>
                               </form>
                             @endcan
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
