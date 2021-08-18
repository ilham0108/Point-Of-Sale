@extends('adminlte::page')

@section('title', 'Daftar Produk')

@section('content_header')
<h1>Daftar Produk</h1>
@stop
@section('content')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.css"
    integrity="sha512-kEkve2B9btIr1vYGIyspUcR/b1TC9xIx0iM7xjBJF6OiLT7dmEj+mpKkVGfgIT7FtxO4Go6yJQSBztvn5MUowA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Dopdown filter -->
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Filter Data</h3>

                <div class="card-tools">
                    <button type="button" accesskey="m" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1 col-12 mt-1">

                    </div>
                    <div class="col-md-3 col-12 mt-1">
                        <label for="name" class="control-label">Clone Type</label>
                        <div class="input-group">
                            <select id="filter1" name="filter1" class="form-control">
                                <option value="" disabled selected hidden>Clone Type</option>
                                <option value="NULL">Empty</option>
                                <option value="Competitive">Competitive</option>
                                <option value="Qualitative">Qualitative</option>
                                <option value="Quantitative">Quantitative</option>
                                <option value="Other ELISA">Other ELISA</option>
                                <option value="Monoclonal">Monoclonal</option>
                                <option value="Polyclonal">Polyclonal</option>
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="col-md-3 col-12 mt-1">
                        <label for="name" class="control-label">Type Product</label>
                        <div class="input-group">
                            <select id="filter2" name="filter2" class="form-control">
                                <option value="" disabled selected hidden> Type Product </option>
                                <option value="NULL">Empty</option>
                                <option value="Antibody">Antibody</option>
                                <option value="ELISA Kit">ELISA Kit</option>
                                <option value="Alat">Alat</option>
                                <option value="Ancillary">Ancillary</option>
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="col-md-3 col-12 mt-1">
                        <label for="name" class="control-label">Pack Category</label>
                        <div class="input-group">
                            <select id="filter3" name="filter3" class="form-control">
                                <option value="" disabled selected hidden> Pack Category </option>
                                <option value="NULL">Empty</option>
                                <option value="Concentrate">Concentrate</option>
                                <option value="RTU">RTU</option>
                                <option value="48 Wells">48 Wells</option>
                                <option value="96 Wells">96 Wells</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="col-md-1 col-12 text-center mt-1">
                        <div class="form-group">
                            <button type="button" onclick="add_filter()" class="btn btn-outline-primary"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-1 col-12 mt-1">

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- akhir dropdown filter -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <button onclick="tambah_data()" class="btn btn-primary btn-sm" id="tombol-tambah"><i
                    class="fas fa-plus-square"></i> Tambah Data </button>
            <button type="file" class="btn btn-success btn-sm"><i class="fas fa-cloud-upload-alt"></i> Upload File
                Excell </button><br>
            <br>
            <table id="tabelproduk" class="table table-sm" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Catalog Number</th>
                        <th>Brand</th>
                        <th>Nama Produk</th>
                        <th>Host</th>
                        <th>Reactivity</th>
                        <th>Clone/Type</th>
                        <th>Application</th>
                        <th>Pack Size</th>
                        <th>Type Of Product</th>
                        <th>Price</th>
                        <th>Max Discount</th>
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
                                            <label for="name" class="col-sm-12 control-label">Catalog Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="cat_number"
                                                    name="cat_number" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Brand</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="brand" name="brand" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Nama Produk</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nama_produk"
                                                    name="nama_produk" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Host</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="host" name="host" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Reactivity</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="reactivity"
                                                    name="reactivity" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Clone/Type</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="clone_type"
                                                    name="clone_type" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Application</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="application"
                                                    name="application" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Pack Size</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="pack_size" name="pack_size"
                                                    value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Type Of Product</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="type_product"
                                                    name="type_product" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Price</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="price" name="price" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Discount</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="disc" name="disc" value=""
                                                    required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button type="button" onclick="save_data()" class="btn btn-primary btn-block"
                                            id="tombol-simpan" value="create">Simpan
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
        $('#tabelproduk tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    });

    table = $('#tabelproduk').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [
            [5, 10, 15, 50, -1],
            [5, 10, 15, 50, "All"]
        ],
        ajax: {
            url: "{{ route('daftarproduk.index') }}",
            type: 'GET',
            data: function(data) {
                data.filter1 = $('#filter1').val();
                data.filter2 = $('#filter2').val();
                data.filter3 = $('#filter3').val();
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
                data: 'cat_number',
                name: 'cat_number'
            },
            {
                data: 'brand',
                name: 'brand'
            },
            {
                data: 'nama_produk',
                name: 'nama_produk'
            },
            {
                data: 'host',
                name: 'host'
            },
            {
                data: 'reactivity',
                name: 'reactivity'
            },
            {
                data: 'clone_type',
                name: 'clone_type'
            },
            {
                data: 'application',
                name: 'application'
            },
            {
                data: 'pack_size',
                name: 'pack_size'
            },
            {
                data: 'type_product',
                name: 'type_product'
            },
            {
                data: 'price',
                name: 'price',
                render: $.fn.dataTable.render.number(',', 'Rp. ')
            },
            {
                data: 'disc',
                name: 'disc',
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
        var filter1 = $("#filter1").val();
        var filter2 = $("#filter2").val();
        var filter3 = $("#filter3").val();
        table.draw();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save_data() {
        $.ajax({
            url: "{{ route('daftarproduk.store') }}",
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
            url: "daftarproduk/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#cat_number').val(data.cat_number);
                $('#brand').val(data.brand);
                $('#nama_produk').val(data.nama_produk);
                $('#host').val(data.host);
                $('#reactivity').val(data.reactivity);
                $('#clone_type').val(data.clone_type);
                $('#application').val(data.application);
                $('#pack_size').val(data.pack_size);
                $('#type_product').val(data.type_product);
                $('#price').val(data.price);
                $('#disc').val(data.disc);
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
                    url: "/daftarproduk/" + id,
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
