@extends('adminlte::page')

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.css" integrity="sha512-kEkve2B9btIr1vYGIyspUcR/b1TC9xIx0iM7xjBJF6OiLT7dmEj+mpKkVGfgIT7FtxO4Go6yJQSBztvn5MUowA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('title', 'Daftar Gudang')
@section('content_header')
<h1>Daftar Gudang</h1>

    <div class="card">
        <div class="card-header">
            <button onclick="tambah_data()" class="btn btn-primary btn-sm" id="tombol-tambah"><i
                    class="fas fa-plus-square"></i> Tambah Data </button>
            <button type="button" class="btn btn-success btn-sm"><i class="fas fa-cloud-upload-alt"></i> Upload File
                Excell </button>
        </div>
        <div class="card-body">
            <table id="tabelgudang" class="table table-sm" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Gudang</th>
                        <th>catalog Number</th>
                        <th>Id PO</th>
                        <th>Tanggal</th>
                        <th>Lot Number</th>
                        <th>ED</th>
                        <th>Stock</th>
                        <th>Note</th>
                        <th>Harga Beli</th>
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
                            <form id="form" method="POST" name="form-tambah-edit" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Kode Gudang</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="kode_gudang" name="kode_gudang"
                                                    value="" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Catalog Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="cat_number"
                                                    name="cat_number" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">ID PO</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="id_po" name="id_po" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Tanggal</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="date" name="date"
                                                    value="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Lot Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="lot_number"
                                                    name="lot_number" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">ED</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="ED" name="ED" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Stock</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="stock" name="stock" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Note</label>
                                            <div class="col-sm-12">
                                                <input type="textarea" class="form-control" id="Note" name="Note" value=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Harga Beli</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control"
                                                    name="harga_beli" value="" required>
                                            </div>
                                            <span class="text-danger">
                                                <strong id="harga_beli"></strong>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button type="button" onclick="save_data()" class="btn btn-primary btn-block"
                                            id="tombolsimpan" value="create">Simpan
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
@push('js');
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.min.js" integrity="sha512-PECs0FDgx6coAK87ta7MM+8nQfT8jl21gfsXBegEWFqQzCyNtAilGNyyWM0Y8FXNpycZQU3A4QM6ZN0r3KXs5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
  var table;
  var aksi;

    $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    table = $('#tabelgudang').DataTable({
                        processing : true,
                        serverSide : true,
                        responsive : true,
                        ajax       : {
                            url: "{{ route('daftargudang.index') }}",
                            type:   'GET'
                        },
                        columns:[
                            {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                            {data:'kode_gudang', name: 'kode_gudang'},
                            {data:'cat_number', name: 'cat_number'},
                            {data:'id_po',name: 'id_po'},
                            {data:'date',name: 'date'},
                            {data:'lot_number',name: 'lot_number'},
                            {data:'ED',name: 'ED'},
                            {data:'stock',name: 'stock'},
                            {data:'Note',name: 'Note'},
                            {data:'harga_beli',name: 'harga_beli'},
                            {data:'aksi',name: 'aksi'},
                        ],
                        order: [[0, 'asc']] 
                    });
                });

                function reload_table(){
                    table.ajax.reload(null,false);
                }

                function save_data(){
                    if(aksi == "update"){
                        url = "{{ route('update_gudang') }}"
                    }else{
                        url = "{{ route('daftargudang.store') }}"
                    }
                    $.ajax({
                        url : url,
                        type: "POST",
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function(data) {
                            if(data.status) {
                                console.log(data);
                                $('#tambah-edit-modal').modal('hide');
                                reload_table();
                            }else if(data.errors){
                                console.log(data.errors);
                                $('#harga_beli').text(data.errors.harga_beli[0]);
                            }
                            
                        },
                        error: function (jqXHR, textStatus , errorThrown){ 
                            alert(errorThrown);
                            console.log(errorThrown);
                        }
                    });
                }

                function edit(id){
                    $('#form')[0].reset();
                    aksi = "update";
                    $.ajax({
                    url : "daftargudang/" + id + "/edit",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $('#kode_gudang').val(data.kode_gudang);
                        $('#cat_number').val(data.cat_number);
                        $('#id_po').val(data.id_po);
                        $('#date').val(data.date);
                        $('#lot_number').val(data.lot_number);
                        $('#ED').val(data.ED);
                        $('#stock').val(data.stock);
                        $('#Note').val(data.Note);
                        $('[name="harga_beli"]').val(data.harga_beli);
                        $('#tambah-edit-modal').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
                    },
                    error: function (jqXHR, textStatus , errorThrown) {
                        alert(errorThrown);
                        console.log(data);
                        }
                    });
                }


                function tambah_data(){
                    $('#form')[0].reset();
                    $('#tambah-edit-modal').modal('show');
                }

                function delete_data(id){
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
                            url : "/daftargudang/" + id,
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
@endpush
@stop

