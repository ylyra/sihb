<!doctype html>
<html lang="pt-br">

<head>
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

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.6/css/all.css'>
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/main.min.css">
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/responsive.min.css">

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script> -->
    <!-- <script src="<?php echo BASE; ?>assets/js/jquery.mask.js"></script> -->

    <script>
        const BASE = '<?php echo BASE; ?>';
        const c = el => document.querySelector(el);
        const cs = el => document.querySelectorAll(el);
    </script>
</head>

<body>

    <div id="clones-itens" style="display: none;">
        <div class="post d-flex">
            <div class="avatar">
                <img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=sihb&action=std&direction=4&head_direction=3&img_format=png&gesture=std&headonly=1&size=b" alt="Cabeça do habbo">
            </div>

            <div class="ml-10">
                <p><a href=""><span></span></a></p>
                <div class="mt-5 d-flex infos ">
                    <span class="info" id="clone-por">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;
                    </span>

                    <span class="info" id="clone-hora">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                    </span>

                    <span class="info2" id="clone-total">
                        <span>0</span>
                        <img src="https://i.imgur.com/qRRpLOQ.png" alt="Mensagens">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section class="top">
        <div>
            <a href="<?php echo BASE; ?>" class="d-flex align-center">
                <img src="https://www.habbo.com.br/habbo-imaging/badge/b23124s36147s01144s09134s961149df9f8fa6483a18a3951f28e2e3bb9dc.gif" alt="SIHB Emblema" />

                <!-- <p id="sihb">SIHB</p> -->
                <img src="https://i.imgur.com/51FSDeY.png" alt="SIHB" />
            </a>
        </div>

        <div id="funcionamento">
            <span class="fac">
                <img src="https://i.imgur.com/FJvP5XO.png" alt="Habbo" />

                <div style="margin:-10px;">
                    <p>Horário de Funcionamento:</p>
                    <p class="text-beige">Todos os dias • 10h às 22h</p><br />

                    <p>
                        <span class="text-green">• Aberto agora:</span>
                        Trabalhe conosco!
                    </p>
                </div>
            </span>

            <div>
                <a href="https://www.habbo.com.br/room/146870645" target="_blank" id="visite">
                    Visite nossa sede
                </a>
            </div>
        </div>

    </section>

    <section class="container d-flex space-between mt-10 nl">
        <div id="novidades" class="d-flex">
            <div id="buttons">
                <button class="btn btn-block"><i class="fa fa-arrow-right"></i></button>
                <button class="btn btn-block"><i class="fa fa-arrow-left"></i></button>
            </div>

            <div id="novidades-conteudo" class="ml-10 fac">
                <?php foreach ($viewData['destacadas'] as $destacadaKey => $destacada): ?>
                    <a href="<?php echo BASE; ?>noticias/abrir/<?php echo $destacada['id']; ?>/<?php echo $destacada['slug']; ?>" data-banner="<?php echo $destacada['banner']; ?>" class="novidade <?php echo($destacadaKey == 0)?'show':''; ?>">
                        <h2><?php echo $destacada['titulo']; ?></h2>
                        <p><?php echo $destacada['subtitulo']; ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="login" class="fac d-column justify-center">            
            <?php if (!$viewData['acesso']->isLogged()): ?>
                <a href="javascript:;" id="logar" data-tipo="logar" class="login-buttons">
                    <span style="margin-left: -70px;">Logar usuário</span>
                </a>
                <a href="javascript:;" id="cadastrar" data-tipo="cadastrar" class="login-buttons">
                    <strong>Cadastre-se</strong> agora mesmo!
                </a>
                <div id="logar-se">
                    <div class="logar-se-head">
                        <a href="<?php echo BASE; ?>login/recuperar">
                            <img src="https://i.imgur.com/AQsDQmT.png" alt="user" />
                            <span>Recuperação de conta</span>
                        </a>

                        <div class="info">
                            <span>LOGAR USUARIO</span>
                            <img src="https://i.imgur.com/eW1t01X.png" alt="Key user" />
                        </div>
                    </div>

                    <div class="logar-se-body">
                        <div>
                            <form action="<?php echo BASE; ?>login/logar_form" method="POST">
                                <div class="form-group">
                                    <input type="text" name="nickname" id="nickname_login" placeholder="Usuário" />
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                    </svg>
                                </div>


                                <div class="form-group">
                                    <input type="password" name="senha" id="senha_login" placeholder="Senha" />
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path>
                                    </svg>
                                </div>

                                <div class="buttons">
                                    <button type="button" class="btn return">
                                        <img src="https://i.imgur.com/b8KGy1B.png" alt="Go back">
                                    </button>
                                    <button type="submit" class="btn submit">
                                        <img src="https://i.imgur.com/idYgY4b.png" alt="Enter">
                                        <span>ENTRAR</span>
                                    </button>
                                </div>


                            </form>
                        </div>
                        <div class="avatar_hb">
                            <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=sihb&action=std&direction=4&head_direction=4&gesture=sml&size=m" alt="Avatar login" id="avatar_login">
                        </div>
                    </div>
                </div>

                <div id="cadastre-se">
                    <div class="cadastre-se-head">
                        <a href="javascript:;" class="return">
                            <img src="https://i.imgur.com/b8KGy1B.png" alt="Go back">
                            <span>Voltar</span>
                        </a>

                        <div class="info">
                            <span>REGISTRAR USUÁRIO</span>
                            <img src="https://i.imgur.com/eW1t01X.png" alt="Key user" />
                        </div>
                    </div>

                    <div class="cadastre-se-body">
                        <div>
                            <form action="<?php echo BASE; ?>login/registrar_form" method="POST">
                                <div class="form-group">
                                    <input type="text" name="nickname" id="nickname_cadastro" placeholder="Usuário" />
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                    </svg>
                                </div>


                                <div class="form-group">
                                    <input type="password" name="senha" id="senha_cadastro" placeholder="Digite uma Senha" />
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path>
                                    </svg>
                                </div>

                                <div class="buttons">
                                    <button type="submit" class="btn submit">
                                        <img src="https://i.imgur.com/idYgY4b.png" alt="Enter">
                                        <span>REGISTRAR</span>
                                    </button>
                                </div>


                            </form>
                        </div>
                        <div class="avatar_hb">
                            <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=sihb&action=std&direction=4&head_direction=4&gesture=sml&size=m" alt="Avatar login" id="avatar_cadastro">
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($viewData['acesso']->isLogged()): ?>
                <div id="perfil" style="height: 192px;">
                    <div class="perfil-head">
                        <a href="javascript:;" class="return <?php echo($viewData['acesso']->naoLidaNoti($viewData['acesso']->getInfo('id_registro')))?'nao-lida':''; ?>">
                            <i class="fa fa-bell"></i>
                        </a>

                        <div class="info">
                            <a href="<?php echo BASE; ?>painel" target="_blank">
                                <span>Painel</span>
                            </a>
                            <span>
                                <?php echo $viewData['acesso']->getInfo('nickname'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="perfil-body">
                        <div>
                            <p class="moedas">
                                <?php echo number_format($viewData['acesso']->getInfo('moedas'), 0, ',', '.'); ?> SIHBCoins
                            </p>
                            <a href="<?php echo BASE; ?>perfil/configuracoes" class="configuraco">Configurações</a>
                            <a href="<?php echo BASE; ?>profile/<?php echo $viewData['acesso']->getInfo('nickname'); ?>" class="perfil">Meu perfil</a>
                            <a href="<?php echo BASE; ?>perfil/sair" class="sair">Sair</a>
                        </div>
                        <div class="avatar_hb">
                            <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $viewData['acesso']->getInfo('nickname'); ?>&action=std&direction=4&head_direction=4&gesture=sml&size=m" alt="Avatar Perfil" id="avatar_perfil">
                        </div>
                    </div>
                </div>

                <div id="notificacoes">
                    <div class="notificacoes-head">
                        <a href="javascript:;" class="return">
                            <img src="https://i.imgur.com/b8KGy1B.png" alt="Go back">
                            <span>Voltar</span>
                        </a>

                        <div class="info">
                            <span>NOTIFICAÇÕES</span>
                            <img src="https://i.imgur.com/eW1t01X.png" alt="Key user" />
                        </div>
                    </div>

                    <div class="notificacoes-body">
                        <?php 
                            // ! 1 = Mensagem
                            // ! 2 = Favoritos
                            // ! 3 = Melhores amigos
                            // ! 4 = Moedas
                            // ! 5 = Presente
                            $notificacoes_tipos = [
                                1 => 'mensagem',
                                2 => 'favoritos',
                                3 => 'amigos',
                                4 => 'moedas',
                                5 => 'presente'
                            ]; 
                        ?>
                        <?php foreach ($viewData['acesso']->getNotificacoes($viewData['acesso']->getInfo('id_registro')) as $notificacao): ?>
                            <div class="notificacao <?php echo $notificacoes_tipos[$notificacao['tipo']]; ?>"><?php echo $notificacao['texto']; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <div class="mobile-menu">
        <ul class="nav-bar">
            <li class="nav-item <?php echo ($viewData['page_active'] == 'home') ? 'active' : ''; ?> ml-20">
                <a href="<?php echo BASE; ?>" class="nav-link">Início</a>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'sobre') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Sobre</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>sobre/historia">História</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/posicionamento">Posicionamento</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/hierarquia">Hierarquia</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/estatuto">Estatuto</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/atos-normativos">Atos normativos</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'servicos_externos') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Serviços Externos</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>servicos-externos/operacoes">Operações</a></li>
                    <li><a href="<?php echo BASE; ?>servicos-externos/atendimento-de-ocorrencias">Atendimento de Ocorrências</a></li>
                    <li><a href="<?php echo BASE; ?>servicos-externos/conquistas">Conquistas</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'departamentos') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Departamentos</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>departamentos/educacao-e-civismo">Educação e Civismo</a></li>
                    <li><a href="<?php echo BASE; ?>departamentos/juridico">Jurídico</a></li>
                    <li><a href="<?php echo BASE; ?>departamentos/comunicacao">Comunicação</a></li>
                    <li><a href="<?php echo BASE; ?>departamentos/logistica-e-rh">Logística e RH</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'apostilas') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Apostilas</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>apostilas/como-ser-promovido">Como ser promovido?</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/como-ser-um-bom-funcionario">Como ser um bom funcionário?</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/discord">Discord</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/uniformes">Uniformes</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/pele-e-cabelo">Pele e Cabelo</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/areas-da-sede">Áreas da Sede</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'financeiro') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Financeiro</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>financeiro/cargos-pagos">Cargos Pagos</a></li>
                    <li><a href="<?php echo BASE; ?>financeiro/salarios">Salários</a></li>
                    <li><a href="<?php echo BASE; ?>financeiro/sistema-de-indicacao">Sistema de Indicações</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'grupos') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Grupos</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>grupos/professores">Professores</a></li>
                    <li><a href="<?php echo BASE; ?>grupos/ajudantes">Ajudantes</a></li>
                    <li><a href="<?php echo BASE; ?>grupos/divulgadores">Divulgadores</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <nav class="container">
        <button class="mobile">
            <div class="menu-btn__burger"></div>
        </button>
        <ul class="nav-bar">
            <li class="nav-item <?php echo ($viewData['page_active'] == 'home') ? 'active' : ''; ?> ml-20">
                <a href="<?php echo BASE; ?>" class="nav-link">Início</a>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'sobre') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Sobre</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>sobre/historia">História</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/posicionamento">Posicionamento</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/hierarquia">Hierarquia</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/estatuto">Estatuto</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/atos-normativos">Atos normativos</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'servicos_externos') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Serviços Externos</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>servicos-externos/operacoes">Operações</a></li>
                    <li><a href="<?php echo BASE; ?>servicos-externos/atendimento-de-ocorrencias">Atendimento de Ocorrências</a></li>
                    <li><a href="<?php echo BASE; ?>servicos-externos/conquistas">Conquistas</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'departamentos') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Departamentos</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>departamentos/educacao-e-civismo">Educação e Civismo</a></li>
                    <li><a href="<?php echo BASE; ?>departamentos/juridico">Jurídico</a></li>
                    <li><a href="<?php echo BASE; ?>departamentos/comunicacao">Comunicação</a></li>
                    <li><a href="<?php echo BASE; ?>departamentos/logistica-e-rh">Logística e RH</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'apostilas') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Apostilas</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>apostilas/como-ser-promovido">Como ser promovido?</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/como-ser-um-bom-funcionario">Como ser um bom funcionário?</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/discord">Discord</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/uniformes">Uniformes</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/pele-e-cabelo">Pele e Cabelo</a></li>
                    <li><a href="<?php echo BASE; ?>apostilas/areas-da-sede">Áreas da Sede</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'financeiro') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Financeiro</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>financeiro/cargos-pagos">Cargos Pagos</a></li>
                    <li><a href="<?php echo BASE; ?>financeiro/salarios">Salários</a></li>
                    <li><a href="<?php echo BASE; ?>financeiro/sistema-de-indicacao">Sistema de Indicações</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo ($viewData['page_active'] == 'grupos') ? 'active' : ''; ?> dropdown">
                <a href="javascript:;" class="nav-link">Grupos</a>
                <ul>
                    <li><a href="<?php echo BASE; ?>grupos/professores">Professores</a></li>
                    <li><a href="<?php echo BASE; ?>grupos/ajudantes">Ajudantes</a></li>
                    <li><a href="<?php echo BASE; ?>grupos/divulgadores">Divulgadores</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <article>
        <!-- main -->
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        <!-- /main -->
    </article>

    <section style="background:#fff;">
        <div class="container d-flex at" style="position:relative;">
            <div>
                <img src="https://i.imgur.com/HlNxAr3.png" alt="Divisor" style="width:100%;height:26px;" />
                <div class="anuncio mb-10">
                    <img src="https://i.imgur.com/6xYUsFV.png" alt="anuncio" class="mt-10">
                </div>
            </div>

            <div class="ml-10 twitter-social">
                <div class="tt-head">
                    <img src="https://i.imgur.com/RSwmMtw.png" alt="Tweets" />

                    <span>
                        <h3>SOCIAL SIHB</h3>
                        <small>@sihboficial</small>
                    </span>
                </div>

                <div class="tt-body"></div>

                <a href="https://twitter.com/sihboficial" id='siga-a-sihb'>Siga o SIHB!</a>
            </div>

        </div>
    </section>

    <footer>
        <div class="footer-head">
            <div class="container">
                <div style="width:730px;" class="d-flex space-between align-center">
                    <img src="https://i.imgur.com/nOfwuL2.png" alt="SIHB" />

                    <ul>
                        <li>
                            <a href="<?php echo BASE; ?>">Início</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>apostilas/vip">Assine VIP</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container footer-body">
            <div style="width:840px;height:195px;">
                <h3>SERVIÇO DE INTELIGÊNCIA HABBIANO</h3>

                <ul>
                    <li><a href="<?php echo BASE; ?>sobre/historia">Sobre nós</a></li>
                </ul>

                <p style="font-size:13px;font-weight:bold;margin-top:30px;">Copyright (c) <?php echo date('Y') ?>. Todos os direitos reservados.</p>
                <p style="font-size:12px;width: 550px;">
                    Este site da web não possui vínculo com nenhuma organização de inteligência da vida real e não é marca de nenhuma das afiliadas da Sulake Corporation Oy.<br /> Este é um jogo de simulação e nenhum acontecimento deve ser levado em consideração!<br /> Este site foi desenvolvido por
                    <a href="http://habbo.com.br/profile/GeorgeSiilva" class="desenvolvedor">George Silva (GeorgeSiilva)</a> e <a href="http://habbo.com.br/profile/majoryanzinho" class="desenvolvedor" id="yan">Yan Lyra (majoryanzinho)</a>
                </p>

            </div>
            <div class="d-flex socials align-center">
                <a href="https://facebook.com/sihboficial">
                    <img src="https://i.imgur.com/ATpfVkX.png" alt="Facebook" /> <strong>/sihboficial</strong>
                </a>

                <a href="https://instagram.com/sihboficial">
                    <img src="https://i.imgur.com/Qpgbe9A.png" alt="Instagram" /> <strong>/sihboficial</strong>
                </a>
            </div>
        </div>
    </footer>

    <audio id="radio_player" src="http://sonic.dedicado.stream/8040/stream" autoplay="">Seu navegador não tem suporte a HTML5</audio>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>assets/js/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="<?php echo BASE; ?>assets/js/script.js?<?php echo rand(0,99); ?>"></script>
    <script src="<?php echo BASE; ?>assets/js/fuckadblock.min.js" integrity="sha256-xjwKUY/NgkPjZZBOtOxRYtK20GaqTwUCf7WYCJ1z69w="></script>
    <script>
        <?php if (isset($_SESSION['aviso_registro']) && !empty($_SESSION['aviso_registro'])): ?>
            M.toast({html: '<?php echo $_SESSION['aviso_registro'] ?>'})

            <?php unset($_SESSION['aviso_registro']); ?>
        <?php endif; ?> 
        
        const noticias = {
            primeira: 1,
            status: 1,
            destaque: 1,
            total: cs('.novidade').length,
            async atualizar(de) {

                if (this.status === 1) {
                    if (this.destaque > this.total) {
                        this.destaque = 1
                    }

                    if (this.destaque == 0) {
                        this.destaque = this.total
                    }

                    if (this.primeira != 1) {
                        c(`.novidade.show`).classList.remove('show');
                        await sleep(1000)
                        
                        let banner = c(`.novidade:nth-child(${this.destaque})`).getAttribute('data-banner')
                        c('.nl #novidades').style.background = `linear-gradient(-40deg, #000000, #00000080), url(${banner})`
                        c('.nl #novidades').style.backgroundRepeat = 'no-repeat'
                        c('.nl #novidades').style.backgroundSize = '100% 100%'
                        c(`.novidade:nth-child(${this.destaque})`).classList.add('show');
                    }

                    if (this.primeira === 1) {
                        this.primeira = 0
                    }
                    this.destaque++
                }

                if (de === 1) {
                    setTimeout(() => {
                        this.atualizar(1);
                    }, 5000);
                }
            }
        }

        window.addEventListener('load', () => {
            noticias.atualizar(1)
        })

        <?php if (!$viewData['acesso']->isLogged()): ?>
            c(`#logar`).addEventListener('click', async function (event) {
                cs('#login a.login-buttons').forEach((item2) => {
                    item2.classList.add('ativar')
                })
                await sleep(1000)
                c('#login #logar-se').style.height = "192px";
            })

            c(`#cadastrar`).addEventListener('click', async function (event) {
                cs('#login a.login-buttons').forEach((item2) => {
                    item2.classList.add('ativar')
                })
                await sleep(1000)
                c('#login #cadastre-se').style.height = "192px";
            })

            c('#logar-se .return').addEventListener('click', async function () {
                c('#login #logar-se').style.height = ""
                await sleep(1000)
                cs('#login .ativar').forEach((item) => {
                    item.classList.remove('ativar')
                })
            })

            c('#cadastre-se .return').addEventListener('click', async function () {
                c('#login #cadastre-se').style.height = ""
                await sleep(1000)
                cs('#login .ativar').forEach((item) => {
                    item.classList.remove('ativar')
                })
            })
            
            c('div#login #logar-se .logar-se-body form input#nickname_login').addEventListener('change', () => {
                let nickname = c('div#login #logar-se .logar-se-body form input#nickname_login').value

                if(nickname.length > 0) {
                    c('div#login #logar-se .logar-se-body .avatar_hb #avatar_login').src = `https://www.habbo.com.br/habbo-imaging/avatarimage?user=${nickname}&action=std&direction=4&head_direction=4&gesture=sml&size=m`
                }    
            })

            c('div#login #cadastre-se .cadastre-se-body form input#nickname_cadastro').addEventListener('change', () => {
                let nickname = c('div#login #cadastre-se .cadastre-se-body form input#nickname_cadastro').value

                if(nickname.length > 0) {
                    c('div#login #cadastre-se .cadastre-se-body .avatar_hb #avatar_cadastro').src = `https://www.habbo.com.br/habbo-imaging/avatarimage?user=${nickname}&action=std&direction=4&head_direction=4&gesture=sml&size=m`
                }    
            })
        <?php endif; ?>

        <?php if ($viewData['acesso']->isLogged()): ?>
            c(`#perfil .perfil-head a.return`).addEventListener('click', async function (event) {

                c('#login #perfil').style.height = "";
                await sleep(1000)
                c('#login #notificacoes').style.height = "192px";
                if (c(`#perfil .perfil-head a.return`).classList.contains('nao-lida')) {
                    let url = `${BASE}ajax/marcaLidaNotificacoes`
                    let params = {
                        method: 'POST',
                        body: JSON.stringify({pesquisa:1})

                    }
                    fetch(url, params)
                        .then((r) => {
                            c(`#perfil .perfil-head a.return.nao-lida`).classList.remove('nao-lida')
                        })
                        .catch((erro) => {
                            // erro em falhas
                        })
                }
            })

            c('#login #notificacoes .return').addEventListener('click', async function () {
                c('#login #notificacoes').style.height = ""
                await sleep(1000)
                c('#login #perfil').style.height = "192px";
                
            })
        <?php endif; ?>

        c('#novidades-conteudo').addEventListener('mouseover', () => {
            if (noticias.status === 1) {
                noticias.status = 2;
            }
        })

        c('#novidades-conteudo').addEventListener('mouseout', () => {
            if (noticias.status === 2) {
                noticias.status = 1;
            }
        })

        c('#novidades #buttons button:nth-child(1)').addEventListener('click', () => {
            noticias.atualizar(2)
        })

        c('#novidades #buttons button:nth-child(2)').addEventListener('click', () => {
            noticias.destaque = noticias.destaque - 2
            noticias.atualizar(2)
        })

        c('.mobile-menu').addEventListener('click', (obj) => {
            if(obj.target.classList[0] === 'mobile-menu') {
                c('.mobile-menu').classList.remove('ativo')
                c('.mobile').classList.toggle("open");
            }
        })

        c('.mobile').addEventListener('click', () => {
            c('.mobile').classList.toggle("open");
            c('.mobile-menu').classList.toggle('ativo')
        })

        cs('.mobile-menu .dropdown').forEach((d)=>{
            d.addEventListener('click', async function(obj) {
                if(c('.mobile-menu .dropdown.open')) {
                    c('.mobile-menu .dropdown.open').classList.remove('open')
                }
                await sleep(500)
                obj.path[1].classList.add('open')
            })
        })
    </script>
</body>

</html>