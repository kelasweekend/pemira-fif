@extends('layouts.dashboard.master')
@section('title')
    Create Paslon
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
                                    <div class="bs-stepper linear">
                                        <div class="bs-stepper-header" role="tablist">
                                            <!-- your steps here -->
                                            <div class="step active" data-target="#intro">
                                                <button type="button" class="step-trigger" role="tab" aria-controls="intro"
                                                    id="intro-trigger" aria-selected="true">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Pengenalan</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#rekamjejak">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="rekamjejak" id="rekamjejak-trigger" aria-selected="false"
                                                    disabled="disabled">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Rekam Jejak</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#visimisi">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="visimisi" id="visimisi-trigger" aria-selected="false"
                                                    disabled="disabled">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Visi dan Misi</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="information-part" id="information-part-trigger"
                                                    aria-selected="false" disabled="disabled">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Photo Paslon</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <!-- your steps content here -->
                                            <form action="{{ route('pemira.update', $calon->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('patch')
                                                @csrf
                                                <div id="intro" class="content active dstepper-block" role="tabpanel"
                                                    aria-labelledby="intro-trigger">
                                                    <div class="form-group">
                                                        <label for="nomor_urut">Nomor Urut Paslon</label>
                                                        <input type="number" class="form-control" id="nomor_urut"
                                                            name="nomor_urut" placeholder="Masukan Nomor Urut"
                                                            value="{{ $calon->nomor_urut }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_calon">Nama Ketua Calon</label>
                                                        <input type="text" class="form-control" id="nama_calon"
                                                            name="nama_ketua" placeholder="Masukan Nama Ketua"
                                                            value="{{ $calon->nama_ketua }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_calon">Nama Wakil Ketua Calon</label>
                                                        <input type="text" class="form-control" id="nama_calon"
                                                            name="nama_wakil" placeholder="Masukan Nama Wakil Ketua"
                                                            value="{{ $calon->nama_wakil }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Asal Jurusan</label>
                                                        <select class="form-control" name="jurusan"
                                                            id="exampleFormControlSelect1">
                                                            <option value="{{ $calon->jurusan }}">{{ $calon->jurusan }}</option>
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
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">Next</button>
                                                </div>
                                                {{-- rekam jejak --}}
                                                <div id="rekamjejak" class="content" role="tabpanel"
                                                    aria-labelledby="rekamjejak-trigger">
                                                    <div class="form-group">
                                                        <label for="summernote">Rekam Jejak Paslon</label>
                                                        <textarea class="form-control" id="summernote" rows="3"
                                                            name="rekam_jejak">{!! $calon->rekam_jejak !!}</textarea>
                                                    </div>
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="stepper.previous()">Previous</button>
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="stepper.next()">Next</button>
                                                </div>
                                                {{-- visi misi --}}
                                                <div id="visimisi" class="content" role="tabpanel"
                                                    aria-labelledby="visimisi-trigger">
                                                    <div class="form-group">
                                                        <label for="summernote">Visi Paslon</label>
                                                        <textarea class="form-control" id="visi" rows="3"
                                                            name="visi">{!! $calon->visi !!}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="summernote">Misi Paslon</label>
                                                        <textarea class="form-control" id="misi" rows="3"
                                                            name="misi">{!! $calon->misi !!}</textarea>
                                                    </div>
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="stepper.previous()">Previous</button>
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="stepper.next()">Next</button>
                                                </div>
                                                <div id="information-part" class="content" role="tabpanel"
                                                    aria-labelledby="information-part-trigger">
                                                    <div class="form-group">
                                                        <label for="image-source">File input</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="image-source" name="image"
                                                                    onchange="previewImage();">
                                                                <label class="custom-file-label"
                                                                    for="image-source">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                        <img src="{{ asset('images/' . $calon->image) }}" class="img-fluid" id="image-preview">
                                                    </div>
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="stepper.previous()">Previous</button>
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

        function previewImage() {
            document.getElementById("image-preview").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").src = oFREvent.target.result;
            };
        };

    </script>
@endsection
