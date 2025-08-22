<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <title>{{ env('APP_NAME') }} | Admin</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ url('admin/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ url('admin/css/feather.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/dataTables.bootstrap4.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ url('admin/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ url('admin/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ url('admin/css/app-dark.css') }}" id="darkTheme" disabled>
    <!-- Libs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="vertical  light  ">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal"
                        data-target=".modal-shortcut">
                        <span class="fe fe-grid fe-16"></span>
                    </a>
                </li>
                <li class="nav-item nav-notif">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                        <span class="fe fe-bell fe-16"></span>
                        <span class="dot dot-md bg-success"></span>
                    </a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="{{ url('admin/assets/user-icon.png') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#" id="btn-logout">Sair</a>

                        <form method="POST" action="{{ route('logout') }}" id="form-logout">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3"
                data-toggle="toggle">
                <i class="fe fe-x" style="color: white;"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light">
                <!-- nav bar -->
                {{-- <div class="w-100 d-flex">
                    <a class="navbar-brand mt-2 flex-fill text-center" href="{{ route('users.index') }}">
                        <img alt="" src="{{ url('admin/assets/logo.png') }}">
                    </a>
                </div> --}}
                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Cadastro</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="fe fe-users fe-16"></i>
                            <span class="ml-3 item-text">Usuários</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="users">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.index') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.create') }}"><span
                                        class="ml-1 item-text">Criar</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#products" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-products fe-16"></i>
                            <span class="ml-3 item-text">Produtos</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="products">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('products.index') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('products.create') }}"><span
                                        class="ml-1 item-text">Criar</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>RH</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#roles" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-roles fe-16"></i>
                            <span class="ml-3 item-text">Cargos</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="roles">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('roles.index') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('roles.create') }}"><span
                                        class="ml-1 item-text">Criar</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#collaborators" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-collaborators fe-16"></i>
                            <span class="ml-3 item-text">Colaboradores</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="collaborators">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.collaborators') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Comercial</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#sales" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-sales fe-16"></i>
                            <span class="ml-3 item-text">Vendas</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="sales">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('sales.index') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('sales.create') }}"><span
                                        class="ml-1 item-text">Criar</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Financeiro</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#bills-out" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-bills-out fe-16"></i>
                            <span class="ml-3 item-text">Contas a Pagar</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="bills-out">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('bills-out.index') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('bills-out.create') }}"><span
                                        class="ml-1 item-text">Criar</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                        <a href="#bills-in" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-bills-in fe-16"></i>
                            <span class="ml-3 item-text">Contas a Receber</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="bills-in">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('bills-in.index') }}"><span
                                        class="ml-1 item-text">Listar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('bills-in.create') }}"><span
                                        class="ml-1 item-text">Criar</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        @yield('content')

        <!-- Modal atalhos laterais -->
        <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog"
            aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5">
                        <div class="row align-items-center">
                            <div class="col-6 text-center">
                                <div class="squircle bg-success justify-content-center">
                                    <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                                </div>
                                <p>Control area</p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="squircle bg-primary justify-content-center">
                                    <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                                </div>
                                <p>Activity</p>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-6 text-center">
                                <div class="squircle bg-primary justify-content-center">
                                    <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                                </div>
                                <p>Droplet</p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="squircle bg-primary justify-content-center">
                                    <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                </div>
                                <p>Upload</p>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-6 text-center">
                                <div class="squircle bg-primary justify-content-center">
                                    <i class="fe fe-users fe-32 align-self-center text-white"></i>
                                </div>
                                <p>Users</p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="squircle bg-primary justify-content-center">
                                    <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                                </div>
                                <p>Settings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Modal atalhos laterais -->

        <!-- Modal notifications -->
        <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog"
            aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group list-group-flush my-n3">
                            <div class="list-group-item bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-box fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong>Package has uploaded successfull</strong></small>
                                        <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                        <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-download fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong>Widgets are updated successfull</strong></small>
                                        <div class="my-0 text-muted small">Just create new layout Index, form, table
                                        </div>
                                        <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-inbox fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong>Notifications have been sent</strong></small>
                                        <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo
                                        </div>
                                        <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-link fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong>Link was attached to menu</strong></small>
                                        <div class="my-0 text-muted small">New layout has been attached to the menu
                                        </div>
                                        <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                    </div>
                                </div>
                            </div> <!-- / .row -->
                        </div> <!-- / .list-group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear
                            All</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Modal notifications -->

    </div> <!-- .wrapper -->
    <script src="{{ url('admin/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ url('admin/js/popper.min.js') }}"></script>
    <script src="{{ url('admin/js/moment.min.js') }}"></script>
    <script src="{{ url('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('admin/js/simplebar.min.js') }}"></script>
    <script src="{{ url('admin/js/daterangepicker.js') }}"></script>
    <script src="{{ url('admin/js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ url('admin/js/tinycolor-min.js') }}"></script>
    <script src="{{ url('admin/js/config.js') }}"></script>
    <script src="{{ url('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('admin/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/plugins/monthSelect/index.js"></script>

    @yield('script')

    <script>
        // Datatable init
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });

        // Datepicker init
        $(document).delegate('input.datepicker', 'focus', function() {
            flatpickr(this, {
                dateFormat: "d/m/Y",
                locale: "pt",
            });
        });
        $(document).delegate('input.month-year-datepicker', 'focus', function() {
            flatpickr(this, {
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, // Exibe "Jan" em vez de "Janeiro"
                        dateFormat: "m/Y", // Formato de saída
                    })
                ],
                locale: "pt"
            });
        });

        // Cleave init
        $(document).delegate('input.currency-input', 'focus', function() {
            new Cleave(this, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                numeralDecimalMark: ',',
                delimiter: '.',
                prefix: 'R$ ',
                noImmediatePrefix: true
            });
        });

        // Logout
        document.addEventListener("DOMContentLoaded", function() {
            var btn = document.getElementById('btn-logout');
            var form = document.getElementById('form-logout');

            btn.addEventListener('click', function(event) {
                event.preventDefault();
                form.submit();
            });
        });
    </script>
    <script src="{{ url('admin/js/apps.js') }}"></script>
    <script src="{{ url('admin/js/form-validation.js') }}"></script>
</body>

</html>
