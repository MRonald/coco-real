<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>


    <link rel="stylesheet" href="css/simplebar.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
        <div class="container-fluid">
            <a class="navbar-brand mx-lg-1 mr-0" href="#">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 120 120">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                    </g>
                </svg>
            </a>
            <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <div class="navbar-slide bg-white ml-lg-4">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="#" id="dashboardDropdown" class="dropdown-toggle nav-link" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-lg-2">Dashboard</span><span class="sr-only">(current)</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                            <a class="nav-link pl-lg-2" href="#"><span class="ml-1">Default</span></a>
                            <a class="nav-link pl-lg-2" href="#"><span class="ml-1">Analytics</span></a>
                            <a class="nav-link pl-lg-2" href="#"><span class="ml-1">E-commerce</span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="ui-elementsDropdown" class="dropdown-toggle nav-link" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-lg-2">UI elements</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="ui-elementsDropdown">
                            <a class="nav-link pl-lg-2" href="#"><span class="ml-1">Colors</span></a>
                            <a class="nav-link pl-lg-2" href="#"><span class="ml-1">Icons</span></a>
                            <a class="nav-link pl-lg-2" href="#"><span class="ml-1">Buttons</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="ml-lg-2">Widgets</span>
                            <span class="badge badge-pill badge-primary">New</span>
                        </a>
                    </li>
                </ul>
            </div>
            <form class="form-inline ml-md-auto d-none d-lg-flex searchform text-muted">
                <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"
                    placeholder="Type something..." aria-label="Search">
            </form>
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" data-toggle="modal"
                        data-target=".modal-shortcut">
                        <i class="fe fe-grid fe-16"></i>
                    </a>
                </li>
                <li class="nav-item nav-notif">
                    <a class="nav-link text-muted my-2" href="#" data-toggle="modal"
                        data-target=".modal-notif">
                        <i class="fe fe-bell fe-16"></i>
                        <span class="dot dot-md bg-success"></span>
                    </a>
                </li>
                <li class="nav-item dropdown ml-lg-0">
                    <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Activities</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid p-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h1 class="mb-0">Dashboard</h1>
                    </div>
                    <div class="col-auto">
                        <form class="form-inline">
                            <div class="form-group d-none d-lg-inline">
                                <label for="reportrange" class="sr-only">Date Ranges</label>
                                <div id="reportrange" class="px-2 py-2 text-muted">
                                    <span class="small"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm"><span
                                        class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                                <button type="button" class="btn btn-sm mr-2"><span
                                        class="fe fe-filter fe-16 text-muted"></span></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Cartões de Métricas Aprimorados -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row mt-1 align-items-center">
                            <div class="col-12 col-lg-4 text-left pl-4">
                                <p class="mb-1 small text-muted">Total</p>
                                <span class="h3">1,024</span>
                                <span class="small text-muted">+12%</span>
                                <span class="fe fe-arrow-up text-success fe-12"></span>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="col-6 col-lg-2 text-center py-4">
                                <p class="mb-1 small text-muted">Receita</p>
                                <span class="h3">R$ 8,540</span><br />
                                <span class="small text-muted">+8%</span>
                                <span class="fe fe-arrow-up text-success fe-12"></span>
                            </div>
                            <div class="col-6 col-lg-2 text-center py-4 mb-2">
                                <p class="mb-1 small text-muted">Conversão</p>
                                <span class="h3">4.6%</span><br />
                                <span class="small text-muted">-1.2%</span>
                                <span class="fe fe-arrow-down text-danger fe-12"></span>
                            </div>
                            <div class="col-6 col-lg-2 text-center py-4">
                                <p class="mb-1 small text-muted">Meta</p>
                                <span class="h3">78%</span><br />
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar bg-success" style="width: 78%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráficos Adicionais -->
                <div class="row items-align-baseline">
                    <div class="col-md-12 col-lg-4">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-body mb-n3">
                                <div class="row items-align-baseline h-100">
                                    <div class="col-md-6 my-3">
                                        <p class="mb-0"><strong
                                                class="mb-0 text-uppercase text-muted">Earning</strong></p>
                                        <h3>$2,562</h3>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                    </div>
                                    <div class="col-md-6 my-4 text-center">
                                        <div lass="chart-box mx-4">
                                            <div id="radialbarWidget"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-body">
                                <div class="chart-widget mb-2">
                                    <div id="radialbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-body">
                                <div class="d-flex mt-3 mb-4">
                                    <div class="flex-fill pt-2">
                                        <p class="mb-0 text-muted">Total</p>
                                        <h4 class="mb-0">108</h4>
                                        <span class="small text-muted">+37.7%</span>
                                    </div>
                                    <div class="flex-fill chart-box mt-n2">
                                        <div id="barChartWidget"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico Principal -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div id="areaChart" style="height: 300px;"></div>
                    </div>
                </div>

                <!-- Tabela Aprimorada -->
                <div class="row">
                    <div class="col-md-12 col-lg-4 mb-4">
                        <!-- Timeline Aprimorada -->
                        <div class="card timeline shadow">
                            <div class="card-header">
                                <strong class="card-title">Atividade Recente</strong>
                                <a class="float-right small text-muted" href="#!">Ver tudo</a>
                            </div>
                            <div class="card-body" data-simplebar
                                style="height:355px; overflow-y: auto; overflow-x: hidden;">
                                <h6 class="text-uppercase text-muted mb-4">Hoje</h6>
                                <div class="pb-3 timeline-item item-primary">
                                    <div class="pl-5">
                                        <div class="mb-1"><strong>@João Silva</strong><span
                                                class="text-muted small mx-2">criou novo
                                                layout</span><strong>Dashboard</strong></div>
                                        <p class="small text-muted">Design <span class="badge badge-light">1h
                                                atrás</span></p>
                                    </div>
                                </div>
                                <div class="pb-3 timeline-item item-warning">
                                    <div class="pl-5">
                                        <div class="mb-3"><strong>@Maria Souza</strong><span
                                                class="text-muted small mx-2">enviou novos arquivos</span></div>
                                        <div class="row mb-3">
                                            <div class="col"><img src="./assets/products/p1.jpg" alt="..."
                                                    class="img-fluid rounded"></div>
                                            <div class="col"><img src="./assets/products/p2.jpg" alt="..."
                                                    class="img-fluid rounded"></div>
                                        </div>
                                        <p class="small text-muted">Upload <span class="badge badge-light">2h
                                                atrás</span></p>
                                    </div>
                                </div>
                                <h6 class="text-uppercase text-muted mb-4">Ontem</h6>
                                <div class="pb-3 timeline-item item-success">
                                    <div class="pl-5">
                                        <div class="mb-3"><strong>@Carlos Oliveira</strong><span
                                                class="text-muted small mx-2">comentou
                                                em</span><strong>Relatório</strong></div>
                                        <div class="card d-inline-flex mb-2">
                                            <div class="card-body bg-light py-2 px-3"> Ótimo trabalho no dashboard,
                                                vamos revisar os números amanhã. </div>
                                        </div>
                                        <p class="small text-muted">Comentário <span class="badge badge-light">1d
                                                atrás</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-8">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">Dados Recentes</strong>
                                <a class="float-right small text-muted" href="#!">Ver tudo</a>
                            </div>
                            <div class="card-body my-n2">
                                <table class="table table-striped table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Endereço</th>
                                            <th>Telefone</th>
                                            <th>Data</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2474</td>
                                            <th scope="col">João Silva</th>
                                            <td>Av. Paulista, 1000</td>
                                            <td>(11) 9999-9999</td>
                                            <td>20/05/2023</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle more-vertical"
                                                        type="button" id="dr1" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Ação</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dr1">
                                                        <a class="dropdown-item" href="#">Editar</a>
                                                        <a class="dropdown-item" href="#">Remover</a>
                                                        <a class="dropdown-item" href="#">Atribuir</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2786</td>
                                            <th scope="col">Maria Souza</th>
                                            <td>R. Augusta, 200</td>
                                            <td>(11) 8888-8888</td>
                                            <td>19/05/2023</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle more-vertical"
                                                        type="button" id="dr2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Ação</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dr2">
                                                        <a class="dropdown-item" href="#">Editar</a>
                                                        <a class="dropdown-item" href="#">Remover</a>
                                                        <a class="dropdown-item" href="#">Atribuir</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog"
        aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Notificações</h5>
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
                                    <small><strong>Novo relatório gerado</strong></small>
                                    <div class="my-0 text-muted small">Relatório mensal disponível</div>
                                    <small class="badge badge-pill badge-light text-muted">15m atrás</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="fe fe-download fe-24"></span>
                                </div>
                                <div class="col">
                                    <small><strong>Atualização concluída</strong></small>
                                    <div class="my-0 text-muted small">Versão 2.0 instalada</div>
                                    <small class="badge badge-pill badge-light text-muted">1h atrás</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Limpar
                        Tudo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Shortcuts -->
    <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog"
        aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Atalhos</h5>
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
                            <p>Controle</p>
                        </div>
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Atividade</p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-users fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Usuários</p>
                        </div>
                        <div class="col-6 text-center">
                            <div class="squircle bg-primary justify-content-center">
                                <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                            </div>
                            <p>Configurações</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Essenciais -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/daterangepicker.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hoje': [moment(), moment()],
                    'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este mês': [moment().startOf('month'), moment().endOf('month')]
                }
            }, cb);

            cb(start, end);

            var options = {
                chart: {
                    type: 'area',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#5e72e4'],
                series: [{
                    name: 'Visitas',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                }],
                xaxis: {
                    categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set']
                }
            };
            var chart = new ApexCharts(document.querySelector("#areaChart"), options);
            chart.render();

            var radialOptions = {
                chart: {
                    height: 200,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '65%',
                        }
                    },
                },
                colors: ['#5e72e4'],
                series: [78],
                labels: ['Meta'],
            };
            var radialChart = new ApexCharts(document.querySelector("#radialbarWidget"), radialOptions);
            radialChart.render();

            $('#modeSwitcher').click(function() {
                $('body').toggleClass('light dark');
                return false;
            });

            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
</body>

</html>
