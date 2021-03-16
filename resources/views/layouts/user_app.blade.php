<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config()->get('app.name', 'Pharmacy Management') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Toastr Notification -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link pt-1" data-toggle="dropdown" href="#">
                        <div class="user-panel d-flex">
                            <div class="image">
                                @empty(Auth::user()->profile_pic)
                                    <img class="img-circle elevation-2" src="{{ asset('assets/img/user4-128x128.jpg') }}" alt="User profile picture">
                                @else
                                    <img class="img-circle elevation-2" src="{{ asset('storage/'.Auth::user()->profile_pic) }}" alt="User profile picture">
                                @endempty
                            </div>
                            <div class="info">
                                <span class="d-block">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        {{-- <a href="{{ route('admin.user.profile', Auth::user()->id ) }}" class="dropdown-item">My Profile</a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('user.logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ 'Logout' }}
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"></a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->            
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ Storage::url(config()->get('settings.logo')) }}" alt="Pharmacy Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config()->get('settings.name') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-5">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Categories
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Category
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Brands
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.brands.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Brands
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.brand.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Brand
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Attribute Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.attributes.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Attributes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.attribute.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Attribute
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.attribute_values.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Attribute Values
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Products
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Products
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Product
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Purchase
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchases.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Purchases
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.purchase.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Purchase
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Sales
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.sales.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Sales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.sale.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Sale
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Suppliers --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Suppliers
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.suppliers.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Suppliers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.supplier.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Supplier
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Customers --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Customers
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.customers.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Customers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.customer.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Customer
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Expenses --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Expenses
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.expenses.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Expenses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.expense.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Expense
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Receipt Management --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Receipts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.receipts.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Receipts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.receipt.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New Receipt
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Reports Management --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Report Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.report.stock') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Stocks Management
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.report.expense') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Expenses Management
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.report.sales') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Sales Management
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.report.purchase') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Purchases Management
                                    </a>
                                </li>
                            </ul>
                        </li>


                        {{-- Users --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        All Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add New User
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.profile', Auth::user()->id ) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        My Profile
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.settings.index') }}" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Settings
                                </p>
                            </a>
                        </li>
                    </ul>

                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        {{-- <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer> --}}

        <!-- Control Sidebar -->
        <!-- <aside class="control-sidebar control-sidebar-dark"> -->
        <!-- Control sidebar content goes here -->
        <!-- </aside> -->
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    @stack('script')

    <script>
        
        @if(session()->has('status'))
            var status = "{{ session()->get('status') }}"; // success, error,
            var message = "{{ session()->get('message') }}"; // message value

            switch (status) {
                case 'success':{
                    toastr.success(message)
                    break;
                }
                case 'error':{
                    toastr.error(message)
                    break;
                }
            }
        @endif

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

            // //Date range picker with time picker
            $('#birthdate').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
            
            $('.datepicker').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY'
                }                
            });

            $('.datetimepicker').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY H:i'
                }                
            });
        });
    </script>

</body>

</html>
