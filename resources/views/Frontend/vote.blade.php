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
                <!-- paslon 1 -->
                <div class="col-md-4 col-12">
                    <div class="container_calon">
                        <div class="card_calon">
                            <div class="img-cover"><img
                                    src="https://asset.kompas.com/crops/x8aWyfcHQTFX8n15dkblm7cTuqQ=/0x52:1000x719/750x500/data/photo/2019/01/08/3152843810.jpg">
                                <div class="icon">
                                    <img src="assets/img/ittp.png" alt="">
                                </div>
                            </div>

                            <div class="desc">
                                <div class="mb-3">
                                    <p class="text-muted text-isi"><strong class="ketua">Ketua : </strong> Ojan</p>
                                    <p class="text-muted text-isi"><strong class="wakil">Wakil Ketua : </strong> Fauzan
                                    </p>
                                    <p class="text-muted text-isi"><strong class="jurusan">Jurusan : </strong> Teknik
                                        Informatika</p>
                                </div>
                                <div class="row justify-content-center" id="pilihan">
                                    <a class="mb-2 col-8 vote" data-calon="1" data-url="{{ route('send') }}">Vote Now <svg
                                            width="19" height="14" viewBox="0 0 23 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 9H22M12 1.5L20.9333 8.2C21.4667 8.6 21.4667 9.4 20.9333 9.8L12 16.5"
                                                stroke="white" stroke-width="3" />
                                        </svg>
                                    </a>
                                    <a href="" class="mb-2 col-3 ml-2">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- paslon 2 -->
                <div class="col-md-4 col-12">
                    <div class="container_calon">
                        <div class="card_calon">
                            <div class="img-cover"><img
                                    src="https://asset.kompas.com/crops/x8aWyfcHQTFX8n15dkblm7cTuqQ=/0x52:1000x719/750x500/data/photo/2019/01/08/3152843810.jpg">
                                <div class="icon">
                                    <img src="assets/img/ittp.png" alt="">
                                </div>
                            </div>

                            <div class="desc">
                                <div class="mb-3">
                                    <p class="text-muted text-isi"><strong class="ketua">Ketua : </strong> Ojan</p>
                                    <p class="text-muted text-isi"><strong class="wakil">Wakil Ketua : </strong> Fauzan
                                    </p>
                                    <p class="text-muted text-isi"><strong class="jurusan">Jurusan : </strong> Teknik
                                        Informatika</p>
                                </div>
                                <div class="row justify-content-center" id="pilihan">
                                    <a class="mb-2 col-8 vote">Vote Now <svg width="19" height="14" viewBox="0 0 23 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 9H22M12 1.5L20.9333 8.2C21.4667 8.6 21.4667 9.4 20.9333 9.8L12 16.5"
                                                stroke="white" stroke-width="3" />
                                        </svg>
                                    </a>
                                    <a href="" class="mb-2 col-3 ml-2">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- paslon 3 -->
                <div class="col-md-4 col-12">
                    <div class="container_calon">
                        <div class="card_calon">
                            <div class="img-cover"><img
                                    src="https://asset.kompas.com/crops/x8aWyfcHQTFX8n15dkblm7cTuqQ=/0x52:1000x719/750x500/data/photo/2019/01/08/3152843810.jpg">
                                <div class="icon">
                                    <img src="assets/img/ittp.png" alt="">
                                </div>
                            </div>

                            <div class="desc">
                                <div class="mb-3">
                                    <p class="text-muted text-isi"><strong class="ketua">Ketua : </strong> Ojan</p>
                                    <p class="text-muted text-isi"><strong class="wakil">Wakil Ketua : </strong> Fauzan
                                    </p>
                                    <p class="text-muted text-isi"><strong class="jurusan">Jurusan : </strong> Teknik
                                        Informatika</p>
                                </div>
                                <div class="row justify-content-center" id="pilihan">
                                    <a class="mb-2 col-8 vote">Vote Now <svg width="19" height="14" viewBox="0 0 23 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 9H22M12 1.5L20.9333 8.2C21.4667 8.6 21.4667 9.4 20.9333 9.8L12 16.5"
                                                stroke="white" stroke-width="3" />
                                        </svg>
                                    </a>
                                    <a href="" class="mb-2 col-3 ml-2">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
@endsection

