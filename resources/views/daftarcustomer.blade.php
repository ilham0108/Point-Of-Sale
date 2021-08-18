@extends('adminlte::page')

@section('title', 'Daftar Customer')

@section('content_header')
<h1>Daftar Customer</h1>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.css"
    integrity="sha512-kEkve2B9btIr1vYGIyspUcR/b1TC9xIx0iM7xjBJF6OiLT7dmEj+mpKkVGfgIT7FtxO4Go6yJQSBztvn5MUowA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if (auth()->user()->jabatan == 'Administrator')
                    <button onclick="tambah_data()" class="btn btn-primary btn-sm" id="tombol-tambah"><i
                            class="fas fa-plus-square"></i> Tambah Data </button><br>
                    <br>
                @elseif(auth()->user()->jabatan == "Staff IT")
                    <button onclick="tambah_data()" class="btn btn-primary btn-sm" id="tombol-tambah"><i
                            class="fas fa-plus-square"></i> Tambah Data </button><br>
                    <br>
                @else

                @endif
                <table id="tabelcustomer" class="table table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Institusi</th>
                            <th>Departemen</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>No. Hp</th>
                            <th>Email</th>
                            <th>Note</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
                                        <input type="hidden" name="id_user" id="id_user" value="{{ $user->id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Nama Customer</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nama" name="nama" value=""
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Institusi</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="institution" name="institution"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Departemen</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="department" name="department"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Sub Departemen</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="subdepartment"
                                                name="subdepartment" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Alamat</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Kota</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="city" name="city" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Kode Pos</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="postcode" name="postcode"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Telephone</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="phone" name="phone" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Fax</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="fax" name="fax" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Handphone</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="contactperson"
                                                name="contactperson" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="title" name="title" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="email" name="email" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Note</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="note" name="note" value="">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-offset-2 col-sm-12">
                                    <button type="button" onclick="save_data()" class="btn btn-primary btn-block"
                                        id="tombol-simpan">Simpan
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
            <!-- AKHIR MODAL -->
        </div>
    </div>
</section>

@stop

@section('footer')
<strong>Copyright © <a href="http://Impellink.net" style="text-decoration: none">Biozatix.Net</a></strong>.
All rights reserved.
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.min.js"
integrity="sha512-PECs0FDgx6coAK87ta7MM+8nQfT8jl21gfsXBegEWFqQzCyNtAilGNyyWM0Y8FXNpycZQU3A4QM6ZN0r3KXs5g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var table;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });



    table = $('#tabelcustomer').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
        ],
        ajax: {
            url: "{{ route('customer.index') }}",
            type: 'GET',
            data: function(data) {
                data.filter = $('').val();
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
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'institution',
                name: 'institution'
            },
            {
                data: 'department',
                name: 'department'
            },
            {
                data: 'address',
                name: 'address'
            },
            {
                data: 'city',
                name: 'city'
            },
            {
                data: 'contactperson',
                name: 'contactperson'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'note',
                name: 'note'
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
            url: "{{ route('customer.store') }}",
            type: "POST",
            data: $('#form-tambah-edit').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    console.log(data);
                    $('#tambah-edit-modal').modal('hide');
                    reload_table();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 2000
                    })
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
            url: "customer/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#kode_customer').val(data.kode_customer);
                $('#nama').val(data.nama);
                $('#institution').val(data.institution);
                $('#department').val(data.department);
                $('#subdepartment').val(data.subdepartment);
                $('#address').val(data.address);
                $('#city').val(data.city);
                $('#postcode').val(data.postcode);
                $('#phone').val(data.phone);
                $('#fax').val(data.fax);
                $('#contactperson').val(data.contactperson);
                $('#title').val(data.title);
                $('#email').val(data.email);
                $('#note').val(data.note);
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
        window.$('#tambah-edit-modal').modal('show');
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
            if (result.isConfirmed) {
                $.ajax({
                    url: "/customer/" + id,
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
@stop
