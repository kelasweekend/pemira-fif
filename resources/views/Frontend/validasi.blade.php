@extends('layouts.Frontend.master')
@section('title')
    Validasi Data Pemilih
@endsection

@section('content')
    <!-- section one -->
    <section class="one">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/img/validasi.svg') }}" alt="" class="img-fluid" width="430px">
                </div>
                <div class="col-md-6 col-12">
                    <h4 class="text-center judul">Validasi</h4>
                    <div class="lebar_1"></div>
                    <div class="sub_judul ml-2">
                        <h5 class="text-center text-muted">Check data anda apakah sudah terdaftar pada Pemira FIF dan Apakah Sudah Melakukan Vote.</h5>
                    </div>
                    <div class="text-center">
                        <form id="post-form">
                            <div class="form-group">
                                <input type="number" class="form-control" id="exampleInputEmail1"
                                    placeholder="Masukan NIM Anda" name="nim" required autocomplete="off">
                            </div>
                            <button type="button" class="btn btn-secondary cari"><i class="fas fa-paper-plane mr-1"></i>Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- modal panduan -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-11 text-center p-0 mt-3 mb-2">
                            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                <form id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Account</strong></li>
                                        <li id="personal"><strong>Vote</strong></li>
                                        <li id="payment"><strong>Print Bukti</strong></li>
                                        <li id="confirm"><strong>Quick Qount</strong></li>
                                    </ul>
                                    <!-- <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> <br> -->
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="text-center atas">
                                                        <h5 class="login">Login Pemilih</h5>
                                                        <p class="text-muted h5 mt-4">
                                                            Pada tahap ini silahkan kamu login pada halaman website ini
                                                            dengan menggunakan akun kampus yang sudah didaftarkan
                                                            panitia
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="assets/img/login.svg" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="text-center atas">
                                                        <h5 class="login">Pemilihan</h5>
                                                        <p class="text-muted h5 mt-4">
                                                            System pemilihan ini dilakukan dengan satu akun satu vote
                                                            dimana pemilih bisa melakukan pemilihan paslon hingga waktu
                                                            yang sudah ditetapkan
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="assets/img/ilustrator_pemira.png" alt="" class="img-fluid"
                                                        width="400px">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="text-center atas">
                                                        <h5 class="login">Cetak Bukti</h5>
                                                        <p class="text-muted h5 mt-4">
                                                            Silahkan Anda mencetak bukti pemira sebagai tanda bahwa anda
                                                            sudah melakukan proses pemira secara virtual
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="assets/img/bukti.svg" alt="" class="img-fluid ml-5"
                                                        width="300px">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Submit" />
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="text-center atas">
                                                        <h5 class="login">Quick Qount</h5>
                                                        <p class="text-muted h5 mt-4">
                                                            Pantau Suara Paslon kamu secara realtime untuk mengetahui
                                                            hasil dari pemira ini secara langsung
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="assets/img/quickcount.svg" alt="" class="img-fluid"
                                                        width="400px">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
