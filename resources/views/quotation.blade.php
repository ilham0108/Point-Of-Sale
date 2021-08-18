@extends('adminlte::page')


@section('title', 'Quotation')


@section('content_header')
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.css"
    integrity="sha512-kEkve2B9btIr1vYGIyspUcR/b1TC9xIx0iM7xjBJF6OiLT7dmEj+mpKkVGfgIT7FtxO4Go6yJQSBztvn5MUowA=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection

@section('content')
<section class="content">
    <div class="row p-2">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header sm">
                    <h3 class="card-title">
                        Daftar Barang
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabelcart" class="table table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Catalog Number</th>
                                <th>Brand</th>
                                <th>Nama Produk</th>
                                <th>Price</th>
                                <th>Mark Up</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header sm">
                    <h3 class="card-title">
                        Tambah Produk
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
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
                                            <option value="Concentrate"> Concentrate </option>
                                            <option value="RTU"> RTU </option>
                                            <option value="48 Wells"> 48 Wells </option>
                                            <option value="96 Wells"> 96 Wells </option>
                                            <option value="Others"> Others </option>
                                        </select>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <div class="col-md-3 col-12 mt-1">
                                    <label for="name" class="control-label">Clone Type</label>
                                    <div class="input-group">
                                        <select id="filter1" name="filter1" class="form-control">
                                            <option value="" disabled selected hidden> Clone Type </option>
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


                                <div class="col-md-1 col-12 text-center mt-1">
                                    <br>
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
                    <div class="table-responsive">
                        <table id="tabelproduk" class="table table-sm text-center" style="width:100%">
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
                                    <th>price</th>
                                    <th>Discount</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header sm">
                    <h3 class="card-title">
                        Input Quotation
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                        @csrf
                        <div class="row p-3">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="id_user" id="id_user" value="{{ $user_id }}" readonly>
                            <input type="hidden" name="name" id="name" value="{{ $user }}" readonly>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">Kode Quotation</label>
                                    <input type="text" class="form-control" id="kode_quotation" name="kode_quotation"
                                        value="{{ $kode }}" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">Nama Customer</label>
                                    <select id="customer" onchange="dropdown()" name="customer"
                                        class="js-example-responsive form-select form-select-lg mb-3">
                                        @foreach ($daftarcustomer as $item)
                                            <option value="" disabled selected hidden></option>
                                            <option value="{{ $item->id }}"> {{ $item->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">institusi</label>
                                    <input type="text" class="form-control" id="institution" name="institution" value=""
                                        readonly></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">No. Handphone</label>
                                    <input type="text" class="form-control" id="contactperson" name="contactperson"
                                        value="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">Kota</label>
                                    <input type="text" class="form-control" id="city" name="city" value="" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" value="" readonly cols="1"
                                        rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name" class="control-label">Diskon</label>
                                    <div class="input-group">
                                        <select id="diskon2" name="diskon2" class="form-control">
                                            <option value=""> - Pilih Diskon - </option>
                                            <option value="0.05"> 5% </option>
                                            <option value="0.1"> 10% </option>
                                            <option value="0.15"> 15% </option>
                                            <option value="0.2"> 20% </option>
                                            <option value="0.25"> 25% </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name" class="control-label">Pembayaran</label>
                                    <div class="input-group">
                                        <select id="payment" name="payment" class="form-control">
                                            <option value=""> - Pilih Pembayaran - </option>
                                            <option value="Cash Before Delivery"> Cash Before Delivery </option>
                                            <option value="50% DP : 50% Cash Before Delivery"> 50% DP : 50% Cash
                                                Before
                                                Delivery </option>
                                            <option value="75% DP : 25% Cash Before Delivery"> 75% DP : 25% Cash
                                                Before
                                                Delivery </option>
                                            <option value="Net 30 Days"> Net 30 Days </option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Masa Berlaku Quotation</label>
                                    <input type="date" class="form-control" id="validity_qtt" name="validity_qtt"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name" class="control-label">Pengiriman</label>
                                    <div class="input-group">
                                        <select id="delivert_time" name="delivert_time" class="form-control">
                                            <option value=""> - Pilih Pengiriman - </option>
                                            <option value="Ready Stock"> Ready Stock </option>
                                            <option value="Indent 7 Days"> Indent 7 Days </option>
                                            <option value="Indent 30 Days"> Indent 30 Days </option>
                                            <option value="Indent 5 - 9"> Indent 5 - 9 </option>
                                            <option value="Indent 9 - 12"> Indent 9 - 12 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="button" onclick="save_data()" id="tombol-simpan" value="create"
                                        class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@stop

@section('footer')
<strong>Copyright © <a href="http://Impellink.net" style="text-decoration: none">Biozatix.Net</a></strong>.
All rights reserved.
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.min.js"
integrity="sha512-PECs0FDgx6coAK87ta7MM+8nQfT8jl21gfsXBegEWFqQzCyNtAilGNyyWM0Y8FXNpycZQU3A4QM6ZN0r3KXs5g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var table, table2;

    $(document).ready(function() {

        $(".js-example-responsive").select2({
            width: 'resolve'
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    table2 = $('#tabelcart').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [
            [5, 10, 15, 50, -1],
            [5, 10, 15, 50, "All"]
        ],
        ajax: {
            url: "{{ route('detail_quotation') }}",
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
                data: 'produk.cat_number',
                name: 'produk.cat_number'
            },
            {
                data: 'produk.brand',
                name: 'produk.brand'
            },
            {
                data: 'produk.nama_produk',
                name: 'produk.nama_produk'
            },
            {
                data: 'produk.price',
                name: 'produk.price',
                render: $.fn.dataTable.render.number(',', 'Rp. ')
            },
            {
                data: 'markup',
                name: 'markup'
            },
            {
                data: 'total',
                name: 'total'
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

    table = $('#tabelproduk').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [
            [5, 10, 15, 50, -1],
            [5, 10, 15, 50, "All"]
        ],
        ajax: {
            url: "{{ route('masterquotation.index') }}",
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
        console.log(filter1);
        table.draw();
    }


    function reload_table() {
        table.ajax.reload(null, false);
    }

    function post_markup(id) {
        $.ajax({
            url: "{{ route('add_markup') }}",
            type: "POST",
            data: $('#formmarkup' + id).serialize(),
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                table2.ajax.reload(null, false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }


    function post_diskon(id) {
        $.ajax({
            url: "{{ route('add_diskon') }}",
            type: "POST",
            data: $('#formdiskon' + id).serialize(),
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                table2.ajax.reload(null, false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function dropdown(id) {
        //$('#form-tambah-edit')[0].reset();
        var id = $('select[name=customer] option').filter(':selected').val()
        $.ajax({
            url: "masterquotation/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#nama').val(data.nama);
                $('#institution').val(data.institution);
                $('#contactperson').val(data.contactperson);
                $('#city').val(data.city);
                $('#alamat').val(data.address);
                $('#email').val(data.email);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                console.log(errorThrown);
            }
        });
    }

    //$('#form-tambah-edit')[0].reset();



    function tambah_barang(id) {
        $.ajax({
            url: "get_daftarproduk/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                table2.ajax.reload(null, false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                console.log(data);
            }
        });
    }


    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save_data() {
        $.ajax({
            url: "{{ route('masterquotation.store') }}",
            type: "POST",
            data: $('#form-tambah-edit').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    console.log(data);
                    tambah_data();
                    window.location.reload();
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
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href="">Contact Developer?</a>'
                })
            }
        });
    }


    function tambah_data() {
        $('#form-tambah-edit')[0].reset();
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
                    url: "/masterquotation/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                })
                table2.ajax.reload(null, false);
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
