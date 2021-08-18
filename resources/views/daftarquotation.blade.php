@extends('adminlte::page')

@section('title', 'Quotation')



@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.css"
    integrity="sha512-kEkve2B9btIr1vYGIyspUcR/b1TC9xIx0iM7xjBJF6OiLT7dmEj+mpKkVGfgIT7FtxO4Go6yJQSBztvn5MUowA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content')

<div class="row p-3">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabeldaftarquotation" class="table table-sm" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Quotation</th>
                            <th>Id Customer</th>
                            <th>Nama Customer</th>
                            <th>Institusi</th>
                            <th>No Telp</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Payment</th>
                            <th>Validity Quotation</th>
                            <th>Delivery Time</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



@stop

@section('footer')
<strong>Copyright © <a href="http://Impellink.net" style="text-decoration: none">Biozatix.Net</a></strong>.
All rights reserved.
@endsection

@section('css')

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.17/sweetalert2.min.js"
integrity="sha512-PECs0FDgx6coAK87ta7MM+8nQfT8jl21gfsXBegEWFqQzCyNtAilGNyyWM0Y8FXNpycZQU3A4QM6ZN0r3KXs5g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var table, tabeldaftarquotation;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    table = $('#tabeldaftarquotation').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [
            [5, 10, 15, 50, -1],
            [5, 10, 15, 50, "All"]
        ],
        ajax: {
            url: "{{ route('daftarquotation.index') }}",
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
                data: 'kode_quotation',
                name: 'kode_quotation'
            },
            {
                data: 'customer[0].id',
                name: 'customer[0].id'
            },
            {
                data: 'customer[0].nama',
                name: 'customer[0].nama'
            },
            {
                data: 'customer[0].institution',
                name: 'customer[0].institution'
            },
            {
                data: 'customer[0].phone',
                name: 'customer[0].phone'
            },
            {
                data: 'customer[0].city',
                name: 'customer[0].city'
            },
            {
                data: 'customer[0].address',
                name: 'customer[0].address'
            },
            {
                data: 'customer[0].email',
                name: 'customer[0].email'
            },
            {
                data: 'payment',
                name: 'payment'
            },
            {
                data: 'validity_qtt',
                name: 'validity_qtt'
            },
            {
                data: 'delivert_time',
                name: 'delivert_time'
            },
            {
                data: 'redirect',
                name: 'redirect'
            },
        ],
        order: [
            [0, 'asc']
        ]
    });

    function add_filter() {
        var filter = $("").val();
        table.draw();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function cetak(id) {
        $.ajax({
            url: "daftarquotation/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#id').text(data.id);
                $('kode_quotation').text(data.kode_quotation);
                // $('nama_sales').val(data.nama_sales);
                // $('#nama_produk').val(data.nama_produk);
                // $('#host').val(data.host);
                // $('#reactivity').val(data.reactivity);
                // $('#clone_type').val(data.clone_type);
                // $('#application').val(data.application);
                // $('#pack_size').val(data.pack_size);
                // $('#type_product').val(data.type_product);
                // $('#price').val(data.price);
                // $('#disc').val(data.disc);
                // $('#tambah-edit-modal').modal('show'); // show bootstrap modal when complete loaded
                // $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                console.log(data);
            }
        });
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
                    url: "/daftarquotation/" + id,
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
