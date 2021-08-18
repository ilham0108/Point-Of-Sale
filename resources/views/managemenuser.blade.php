@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<h1>Management User</h1>
@stop

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.css" integrity="sha512-kEkve2B9btIr1vYGIyspUcR/b1TC9xIx0iM7xjBJF6OiLT7dmEj+mpKkVGfgIT7FtxO4Go6yJQSBztvn5MUowA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <button onclick="tambah_data()" class="btn btn-primary btn-sm" id="tombol-tambah"><i class="fas fa-plus-square"></i> Tambah User </button>
            <br> <br>
            <table id="tabeluser" class="table table-sm" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No Handphone</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>

            <!-- MULAI MODAL FORM TAMBAH/EDIT-->
            <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-judul"></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="id" id="id">

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Nama</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Jabatan</label>
                                            <div class="col-sm-12">
                                                <select name="jabatan" id="jabatan" class="form-control">
                                                    <option value="">- Pilih Jabatan -</option>
                                                    <option value="User">User</option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Staff IT"> Staff IT </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">No Handphone</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="phone" name="phone" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" id="email" name="email" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Password</label>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" id="password" name="password" value="" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button type="button" onclick="save_data()" class="btn btn-primary btn-block" id="tombol-simpan" value="create">Simpan
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <!-- AKHIR MODAL -->
        </div>
    </div>
</div>
@stop

@section('footer')
    <strong>Copyright © <a href="http://Impellink.net" style="text-decoration: none">Biozatix.Net</a></strong>.
    All rights reserved.    
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.min.js" integrity="sha512-PECs0FDgx6coAK87ta7MM+8nQfT8jl21gfsXBegEWFqQzCyNtAilGNyyWM0Y8FXNpycZQU3A4QM6ZN0r3KXs5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var table;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    table = $('#tabeluser').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [
            [5, 10, 15, 50, -1],
            [5, 10, 15, 50, "All"]
        ],
        ajax: {
            url: "{{ route('managemenuser.index') }}",
            type: 'GET',
            data: function(data) {
                data.filter = $('#filter').val();
            }
        },
        columns: [{
                "data": null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1
                }

            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'jabatan',
                name: 'jabatan'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'password',
                name: 'password'
            },
            {
                data: 'aksi',
                name: 'aksi'
            },
        ],

        order: [
            [0, 'asc']
        ]
    });

    function add_filter() {
        var filter = $("#filter").val();
        table.draw();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save_data() {
        $.ajax({
            url: "{{ route('managemenuser.store') }}",
            type: "POST",
            data: $('#form-tambah-edit').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    console.log(data);
                    $('#tambah-edit-modal').modal('hide');
                    reload_table();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                console.log(errorThrown);
            }
        });
    }

    function edit(id) {
        $('#form-tambah-edit')[0].reset();
        $.ajax({
            url: "managemenuser/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#jabatan').val(data.jabatan);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#tambah-edit-modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                console.log(data);
            }
        });
    }

    function tambah_data() {
        $('#form-tambah-edit')[0].reset();
        $('#tambah-edit-modal').modal('show');
    }

    function delete_data(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
        })
        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi !',
            text: "Anda Akan Menghapus Data ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus !',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "/managemenuser/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                })
                reload_table();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Batal',
                    'Data tidak dihapus',
                    'error'
                )
            }
        })
    }

</script>
</section>
@stop