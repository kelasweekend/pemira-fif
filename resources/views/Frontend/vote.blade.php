@extends('layouts.Frontend.master')
@section('title')
    Pilihlah Calon Sesuai Hati Nurani Anda
@endsection

@section('content')
    <h4 class="text-center judul">Voting System</h4>
    <h5 class="text-center text-muted mt-4">Tegakan Asas Langsung Umum Bebas Rahasia Pada Pemira FIF 2021</h5>
    <!-- mulai tampil calon -->
    <section class="calon">
        <div class="container">
            <div class="row">
                @foreach ($vote as $calon)
                    <!-- paslon -->
                    <div class="col-md-4 col-12">
                        <div class="container_calon">
                            <div class="card_calon">
                                <div class="img-cover"><img src="{{ asset('images/' . $calon->image) }}">
                                    <div class="icon">
                                        <img src="{{ asset('assets/img/ittp.png') }}" alt="">
                                    </div>
                                </div>

                                <div class="desc">
                                    <div class="mb-3">
                                        <p class="text-muted text-isi"><strong class="ketua">Ketua : </strong>
                                            {{ $calon->nama_ketua }}</p>
                                        <p class="text-muted text-isi"><strong class="wakil">Wakil Ketua : 
                                        @if ($calon->nama_wakil === null)
                                            -
                                        @else
                                        {{ $calon->nama_wakil }}</p>
                                        @endif</strong>
                                            
                                        <p class="text-muted text-isi"><strong class="jurusan">Jurusan : </strong>
                                            {{ $calon->jurusan }}</p>
                                    </div>
                                    <div class="row justify-content-center" id="pilihan">
                                        <a class="mb-2 col-8 vote" data-calon="{{ $calon->id }}"
                                            data-url="{{ route('send') }}">Vote Now <svg width="19" height="14"
                                                viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0 9H22M12 1.5L20.9333 8.2C21.4667 8.6 21.4667 9.4 20.9333 9.8L12 16.5"
                                                    stroke="white" stroke-width="3" />
                                            </svg>
                                        </a>
                                        <a data-calon="{{ $calon->id }}" data-url="{{ route('detail', $calon->id) }}"
                                            class="mb-2 col-3 ml-2 detail">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="container">
        <hr class="mb-5">
    </div>
    <!-- partner ittp -->
    <div class="container mb-5">
        <div class="mb-5">
            <h4 class="tahapan">Tahapan Pemira FIF 2021</h4>
            <p class="text-muted text-center h4">Berikut Tahapan Yang Harus Kamu Lakukan</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="card p-3 bayangan_2 tata_cara border-primary">
                    <img src="assets/img/login.svg" class="rounded mx-auto d-block mt-auto" width="150px">
                    <h6 class="text-center mt-auto">Login Dahulu</h6>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card p-3 bayangan_2 tata_cara">
                    <img src="assets/img/ilustrator_pemira.png" class="rounded mx-auto d-block mt-auto" width="150px">
                    <h6 class="text-center mt-auto">Pilih Paslon</h6>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card p-3 bayangan_2 tata_cara">
                    <img src="assets/img/bukti.svg" class="rounded mx-auto d-block mt-auto" width="150px">
                    <h6 class="text-center mt-auto">Cetak Bukti</h6>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card p-3 bayangan_2 tata_cara">
                    <img src="assets/img/quickcount.svg" class="rounded mx-auto d-block mt-auto" width="150px">
                    <h6 class="text-center mt-auto">Pantau Hasil</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- detail --}}
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <img src="" id="foto" width="300px">
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>Informasi Paslon</h5>
                                <p id="ketua"></p>
                                <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <img src="" id="foto" width="300px">
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>Informasi Paslon</h5>
                                <p id="ketua"></p>
                                <p id="(wakil == null ? wakil)"></p>
                                <p id="jurusan"></p>
                                <p id="rekam_jejak"></p>
                                <p id="visi"></p>
                            </div>
                        </div>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
                                <p id="wakil"></p>
                                <p id="jurusan"></p>
                            </div>
                        </div>
                        <hr>
                        <small>Rekam Jejak</small>
                        <div class="rekam_jejak"></div>
                        <hr>
                        <small>Visi</small>
                        <div class="visi"></div>
                        <hr>
                        <small>Misi</small>
                        <div class="misi"></div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $(function () {
    $(".modal").on("hidden.bs.modal", function(){
    $(".modal-body").html().text();
    });
  });
</script>