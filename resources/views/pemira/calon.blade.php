@extends('layouts.dashboard.master')
@section('title')
    Calon dan Wakil Calon
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">@yield('title')</h2>
                                    @can('calon-create')
                                        <a href="{{ route('pemira.create')}}"
                                            class="btn btn-outline-primary btn-sm waves-effect waves-light float-right">Create Paslon</a>
                                    @endcan
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nomor</th>
                                                <th>Nama Ketua</th>
                                                <th>Jurusan</th>
                                                <th>Rekam Jejak</th>
                                                <th>Visi</th>
                                                <th>Misi</th>
                                                <th>
                                                    action
                                              
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($calon as $ca)
                                        <tr>
                                            <th><img src="{{asset('images/'.$ca->image)}}" alt="" width="30"></th>
                                            <th>{{$ca->nomor_urut}}</th>
                                            <th>{{$ca->nama_ketua}}</th>
                                            <th>{{$ca->jurusan}}</th>
                                            <th>{!!Str::of($ca->rekam_jejak)->limit(5)!!}</th>
                                            <th>{!!Str::of($ca->visi)->limit(5)!!}</th>
                                            <th>{!!Str::of($ca->misi)->limit(5)!!}</th>
                                            <th>
                                                <a href="{{route('pemira.edit',$ca->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('pemira.destroy', $ca->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </th>
                                          
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nomor</th>
                                                <th>Nama Ketua</th>
                                                <th>Jurusan</th>
                                                <th>Rekam Jejak</th>
                                                <th>Visi</th>
                                                <th>Misi</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-header -->
    </div>
    @can('permission-store')
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="ItemForm" name="ItemForm" class="form-horizontal">
                            <input type="hidden" name="Item_id" id="Item_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nama Permissions</label>
                                            {!! Form::text('name', null, ['placeholder' => 'Nama Permission', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Guard Name</label>
                                            {!! Form::text('guard_name', null, ['placeholder' => 'Guard Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary tombol" id="saveBtn" value="create"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection


@section('css-tambahan')
    <link rel="stylesheet" href="{{ asset('cdn/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('js-tambahan')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('cdn/datatables/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permissions.index') }}",
                pageLength: 5,
                lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                esponsive: true,
                lengthChange: false,
                autoWidth: false,
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'guard_name',
                        name: 'guard_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#createNewItem').click(function() {
                $('#saveBtn').val("create-Item");
                $('#Item_id').val('');
                $('#ItemForm').trigger("reset");
                $('#modelHeading').html("Create User");
                $('.tombol').html("Submit");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editItem', function() {
                var Item_id = $(this).data('id');
                $('.tombol').html("Save Change");
                $.get("{{ url('dashboard/permissions') }}" + '/' + Item_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Item");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#Item_id').val(data.id);
                    $('input[name=name]').val(data.name);
                    $('input[name=guard_name]').val(data.guard_name);
                })
            });

            @can('permission-store')
                $('#saveBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                data: $('#ItemForm').serialize(),
                url: "{{ route('permissions.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(response) {
                if (response.success) {
                Swal.fire({
                icon: "success",
                title: "Selamat",
                text: response.success
                });
                $('#ItemForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                } else {
                Swal.fire({
                icon: "error",
                title: "Mohon Maaf !",
                text: response.error
                });
                }
                },
                error: function() {
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
                });
                }
                });
                });
            @endcan

            @can('permission-delete')
                $('body').on('click', '.deleteItem', function() {
                var Item_id = $(this).data("id");
                var url = $(this).data("url");
                Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda Akan Menghapus Pengguna Ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                type: "DELETE",
                url: url,
                success: function(response) {
                if (response.success) {
                Swal.fire({
                icon: "success",
                title: "Selamat",
                text: response.success
                });
                $('#ItemForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                } else {
                Swal.fire({
                icon: "error",
                title: "Mohon Maaf !",
                text: response.error
                });
                }
                },
                error: function() {
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
                });
                }
                });
                }
                })
                });
            @endcan
        });

    </script> --}}
@endsection
