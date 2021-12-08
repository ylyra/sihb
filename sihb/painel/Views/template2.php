<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano</title>
    <meta name="description" content="<?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:site_name" content="<?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano">
    <meta property="og:title" content="<?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano">
    <meta property="og:description" content="<?php echo $viewData['description']; ?>">
    <meta property="og:url" content="<?php echo BASE; ?>">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:image" content="">
    <!-- <meta property="og:image:width" content="620"> 
	<meta property="og:image:height" content="316">  -->
    <meta name="twitter:site" content="@sihboficial" />
    <meta name="twitter:title" content="<?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@sihboficial" />
    <meta name="twitter:creator" content="@sihboficial" />
    <meta name="theme-color" content="#1E1E1F">

    <link rel="apple-touch-icon" href="https://www.habbo.com.br/habbo-imaging/badge/b23124s36147s01144s09134s961149df9f8fa6483a18a3951f28e2e3bb9dc.gif">
    <link rel="shortcut icon" href="https://www.habbo.com.br/habbo-imaging/badge/b23124s36147s01144s09134s961149df9f8fa6483a18a3951f28e2e3bb9dc.gif">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo BASE; ?>assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/inputmask/css/inputmask.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">
    <!-- jquery 3.3.1 -->
    <script src="<?php echo BASE; ?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>

    <script>
        const BASE = '<?php echo BASE; ?>';
        const c = el => document.querySelector(el);
        const cs = el => document.querySelectorAll(el);
    </script>

    <style>
        @media only screen and (max-width: 768px) {
            .nav-left-sidebar {
                position: relative !important;
            }
        }

        

        .badge-pill {
            padding-right: .6em !important;
            padding-left: .6em !important;
            border-radius: 10rem !important;
        }
    </style>
</head>

<body>
    <div id="exemplos" style="display: none;">
        <div class="row" style="align-items:flex-end;" id="add_register">
            <div class="form-group col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                <label for="" class="col-form-label">Nickname</label>
                <input id="" type="text" class="form-control" name="nicksnames[]" placeholder="Nickname do membro..." required />
            </div>

            <div class="form-group col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                <button class="btn btn-outline-danger btn-block" type="button" onclick="removeInput(this)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?php echo BASE; ?>">SIHB</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Procurar..">
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $viewData['acesso']->getInfo('nickname'); ?>&action=std&direction=3&head_direction=3&img_format=png&gesture=std&headonly=1&size=b" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $viewData['acesso']->getInfo('nickname'); ?> </h5>
                                    <span class="status"></span><span class="ml-2">Disponível</span>
                                </div>

                                <a class="dropdown-item" href="<?php echo BASE; ?>home/cartao"><i class="fas fa-address-card mr-2"></i>Bater cartão - <?php echo ($viewData['acesso']->deuEntrada($viewData['acesso']->getInfo('id_registro'))) ? 'saída' : 'entrada'; ?></a>

                                <a class="dropdown-item" href="<?php echo BASE_PAI; ?>perfil/sair"><i class="fas fa-power-off mr-2"></i>Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark" style="position: absolute;">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($viewData['page_active'] == 'home') ? 'active' : ''; ?>" href="<?php echo BASE; ?>"><i class="fas fa-home"></i>Início</a>
                            </li>

                            <?php if ($viewData['acesso']->getInfo('patente') <= 10) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'registros') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-address-card"></i>Registros</a>
                                    <div id="submenu-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>registros">Lista</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>registros/promover">Adicionar/Promover</a>
                                            </li>
                                            <?php if ($viewData['acesso']->getInfo('patente') <= 6) : ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo BASE; ?>registros/confiancas">Confianças</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo BASE; ?>registros/cartao">Entrada/Saída</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo BASE; ?>registros/destaque">Editar destaque</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo BASE; ?>registros/logs">Logs</a>
                                                </li>
                                            <?php endif; ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>registros/advs">Advertências</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->getInfo('patente') <= 6) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'site') ? 'active' : ''; ?>" href="<?php echo BASE; ?>site"><i class="fas fa-fw fa-file"></i>Páginas do site</a>
                                </li>
                            <?php endif; ?>

                            <li class="nav-item">
                                <a class="nav-link <?php echo ($viewData['page_active'] == 'relatorios') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-book"></i>Relatorios</a>
                                <div id="submenu-3" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo BASE; ?>relatorios/meus">Meus relatórios</a>
                                        </li>
                                        <?php if ($viewData['acesso']->getInfo('patente') <= 7) : ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>relatorios/todos">Todos relatórios</a>
                                            </li>
                                        <?php endif; ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo BASE; ?>relatorios/criar">Criar relatório</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-divider">
                                Externos
                            </li>
                            <?php if ($viewData['acesso']->isExterno(1, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'ajudantes') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#ajudantes-2" aria-controls="ajudantes-2"><i class="fab fa-adn"></i>Ajudantes</a>
                                    <div id="ajudantes-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>externo/lista/1">Membros</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->isExterno(2, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'jornal') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#jornal-2" aria-controls="jornal-2"><i class="fas fa-newspaper"></i>Jornal</a>
                                    <div id="jornal-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>jornal">Notícias</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>jornal/equipe">Equipe</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>jornal/comentarios">Comentários</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>jornal/categorias">Categorias</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->isExterno(3, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'forum') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#forum-2" aria-controls="forum-2"><i class="fab fa-foursquare"></i>Fórum</a>
                                    <div id="forum-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>forum">Postagens</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>forum/comentarios">Comentarios</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>forum/equipe">Moderadores</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->isExterno(4, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'professores') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#professores-2" aria-controls="professores-2"><i class="fas fa-rss"></i>Professores</a>
                                    <div id="professores-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>externo/lista/4">Membros</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->isExterno(5, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'entretenimento') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#entretenimento-2" aria-controls="entretenimento-2"><i class="fab fa-grav"></i>Entretenimento</a>
                                    <div id="entretenimento-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>externo/lista/5">Membros</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->isExterno(6, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'ouvidoria') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#ouvidoria-2" aria-controls="ouvidoria-2"><i class="fas fa-assistive-listening-systems"></i>Ouvidoria</a>
                                    <div id="ouvidoria-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>externo/lista/6">Membros</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->isExterno(7, $viewData['acesso']->getInfo('id_registro'))) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'cursos') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#cursos-2" aria-controls="cursos-2"><i class="fas fa-file-video"></i>Cursos</a>
                                    <div id="cursos-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>cursos">Cursos</a>
                                                <a class="nav-link" href="<?php echo BASE; ?>cursos/novo">Novo Curso</a>
                                                <a class="nav-link" href="<?php echo BASE; ?>cursos/dar_curso">Dar curso</a>
                                                <a class="nav-link" href="<?php echo BASE; ?>cursos/areas">
                                                    Curso área
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($viewData['acesso']->getInfo('patente') <= 6) : ?>
                                <li class="nav-divider">
                                    Loja
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($viewData['page_active'] == 'loja') ? 'active' : ''; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#loja-2" aria-controls="loja-2"><i class="fas fa-shopping-cart"></i>Loja</a>
                                    <div id="loja-2" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>loja/emblemas">Emblemas</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>loja/beneficios">Benefícios</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>loja/compras/2">Benefícios compras</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>loja/codigos">Códigos de moedas</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>loja/vip">Vip</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE; ?>loja/moedas">Dar moedas</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content ">
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright © 2020 - <?php echo date('Y'); ?> SIHB.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="<?php echo BASE_PAI; ?>sobre/historia">Sobre nós</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- bootstap bundle js -->
    <script src="<?php echo BASE; ?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="<?php echo BASE; ?>assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- chart chartist js -->
    <!-- <script src="<?php echo BASE; ?>assets/vendor/charts/chartist-bundle/chartist.min.js"></script> -->
    <!-- sparkline js -->
    <script src="<?php echo BASE; ?>assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="<?php echo BASE; ?>assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <!-- <script src="<?php echo BASE; ?>assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/charts/c3charts/C3chartjs.js"></script> -->
    <script src="<?php echo BASE; ?>assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo BASE; ?>assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <!-- main js -->
    <script src="<?php echo BASE; ?>assets/libs/js/main-js.js"></script>
    <script src="<?php echo BASE; ?>assets/js/script.js"></script>
</body>

</html>