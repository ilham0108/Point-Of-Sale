<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body style="font-size: 0.9rem">
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            
          </div>
          <div class="col-sm-4">
            <h4> <img src="/vendor/adminlte/dist/img/biozatix.png" class="rounded" style="width: 30%" align="right"></h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @foreach ($data as $data)

    <section class="content">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <!-- info row -->
                <!-- /.col -->
                    
               
              <div class="row mb-2">
                <div class="col-4 invoice-col">

                  <strong>Customer</strong>
                  <address>
                    {{$data->customer[0]->nama}} <br>
                    {{$data->customer[0]->institution}} <br>
                    {{$data->customer[0]->department}} <br>
                    {{$data->customer[0]->contactperson}} <br>
                    {{$data->customer[0]->address}} <br>
                    {{$data->customer[0]->city}} <br>
                    {{$data->customer[0]->email}} <br>
                  </address>
                </div>

                <!-- /.col -->
                <div class="col-8 invoice-col" >
                  <figure class="text-end">
                    For Further information please contact : <br>
                    Nama  : {{$user->name}}  <br>
                    Telephone  : 021- 2246 8411 <br>
                    Handphone : {{$user->phone}} <br>
                    Email  : {{$user->email}} <br>
                    {{-- <table align="right">
                      <thead>
                        <tr>
                          <td >
                            Nama :
                          </td>
                          <td align="left">
                            {{$user->name}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Telephone :
                          </td>
                          <td align="left">
                            (0271) 5566865
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Handphone :
                          </td>
                          <td align="left">
                            {{$user->phone}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Email :
                          </td>
                          <td align="left">
                            {{$user->email}}
                          </td>
                        </tr>
                      </thead>
                    </table> --}}
                    <br>
                    <b>QUOTATION NO: {{ $data->kode_quotation }}</b><br>
                    <b>Date: {{ date('d F Y') }} </b> <br>
                  </figure>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <strong>We are pleased to quote you the following item:</strong>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table">
                    <thead class="table">
                    <tr>
                      <th>No</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Diskon</th>
                      <th>Price After Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                @foreach ($produk as $x )
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td> <strong> {{ $x->nama_produk }}</strong><br>
                          {{ $x->cat_number }} <br>
                          {{ $x->brand }} <br>
                          {{ $x->clone_type }}
                      </td>
                      <td>
                        @if ($x->markup == 0)

                        Rp. {{ number_format( $subtotal = $x->price) }}
                            
                        @else
                        Rp. {{ number_format( $subtotal = $x->price / $x->markup) }}
                        @endif
                          
                      </td>
                      <td>
                         {{ number_format($data->diskon2 * 100) }} %
                      </td>
                      <td>
                        Rp. {{number_format($subtotal  * (1 - $data->diskon2)) }}
                        
                      </td>
                    </tr>

                @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Term and Condition :</p>
                  <ul class="navbar-nav" padding-left="10">
                    <li class="nav-item">1. Quotation Valid Until {{ date("d F Y", strtotime($data->validity_qtt)) }}</li>
                    <li class="nav-item">2. Price Exclude Shipping and Tax 10%</li>
                    <li class="nav-item">3. {{$data->payment}}</li>
                    <li class="nav-item">4. Indent 5-9 Weeks upon receipt of payment</li>
                  </ul>
                  <strong><p>
                    Thank You for trust in us
                  </p></strong>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-5" >
                  
                </div>
                <div class="col-6" align="right">
                  
                  Regards,<br>
                  PT Biozatix Indonesia <br><br><br><br>
                  {{$user->name}} &nbsp;
                </div>
                <div class="col-1" >
                  
                </div>
              </div>

              <!-- this row will not appear when printing -->
              
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
    window.print();
  </script>
  @endforeach



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    
  
  </body>
</html>