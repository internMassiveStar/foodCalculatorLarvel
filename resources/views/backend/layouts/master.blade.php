<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>Food Calculator</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom_css.css') }}" rel="stylesheet" />

    <link href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link href="//cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link href="//cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('backend.layouts.sidebar.sidebar')
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @include('backend.layouts.header.header')
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="row mb-3">
                    @isset($trending)
                    @foreach ($trending as $trend )
                        
                    
                    <div class="col-xl-3 col-md-6 ">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Ontrending #{{ $loop->index + 1 }} @if(Auth::user()->role==0)
                                            at {{ $trend->company_name }} @endif
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $trend->foodName }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-red-800">{{ $trend->food_price }} BDT</div>
                                    </div>
                                    <div class="col-auto">
                                        <img style="width: 50px;height:50px;"
                                                    src="{{ $trend->food_photo ? url('/' . $trend->food_photo) : url('food_image/no-image.png') }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endisset
                   
                </div>
                @yield('content')
                <!---Container Fluid-->
          
            <!-- Footer -->
            @include('backend.layouts.footer.footer')
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script type="text/Javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/Javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/Javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $("#success").show().delay(2000).fadeOut();
        $("#error").show().delay(2000).fadeOut();
    </script>

    <script>
        $(document).ready(function() {
            $('#waiter').select2();
            $('#table').select2();
            $('#foodnam').select2();



        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": [],
                "lengthMenu": [
                    [10, 25, 50, 100, 500, -1],
                    [10, 25, 50, 100, 500, 'All']
                ],
                "pagingType": 'simple',
                "dom": 'lBfrtip',
                "buttons": [
                    'pdf', 'print',
                    // 'copy', 'csv'
                ],
            });

            // ID From dataTable 
            $('#dataTable1').DataTable({
                "order": [],
                "pagingType": 'simple',
                "dom": 'Bfrtip',
                "buttons": [
                    'pdf', 'print',
                    // 'copy', 'csv'
                ],
            }); // ID From dataTable 
            $('#dataTable2').DataTable({
                "order": [],
                "pagingType": 'simple',
                "dom": 'Bfrtip',
                "buttons": [
                    'pdf', 'print',
                    // 'copy', 'csv'
                ],
            }); // ID From dataTable 
            $('#dataTable3').DataTable({
                "order": [],
                "pagingType": 'simple',
                "dom": 'Bfrtip',
                "buttons": [
                    'pdf', 'print',
                    // 'copy', 'csv'
                ],
            }); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
    @yield('main-script')
</body>

</html>
