<div id="radio-pesquisa" class="container">
    <!-- DESTAQUE SEMANAL E PESQUISA -->
    <div class="destaque-semana-pesquisa">
        <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width:100%;" />
        <div id="marquee">
            <img src="https://i.imgur.com/9K7gohg.png" alt="alerta" />
            <marquee width="690" onmouseover="this.stop();" onmouseout="this.start()">
                <strong>SIHB INFO: </strong>
                Bem-vindos ao site oficial do SIHB!
            </marquee>
        </div>

        <div class="d-flex mt-10 dd1">
            <div>
                <div id="destaque">
                    <div class="p-10 d-flex space-between d-column h-65">
                        <h3 style="font-family:'Poppins', sans-serif;color:#661900;">DESTAQUE SEMANAL</h3>

                        <p class="text-end">
                            <?php echo $destaque['nickname']; ?>
                            <?php if ($destaque['vip'] == 1) : ?>
                                <img src="https://i.imgur.com/1DBSVgG.png" alt="vip" style="margin-bottom:-5px;" />
                            <?php endif; ?>
                        </p>
                    </div>
                    <div style="background:url(https://i.imgur.com/3Z0QKsN.png);line-height: 25px;" class="pr-10 h-25">
                        <p style="font-size:12px;font-weight:bold;color:#FFDC73;" class="text-end"><?php echo $destaque['patente']; ?></p>
                    </div>

                    <div class="d-flex h-70" style="position:relative;align-items:flex-end;">
                        <div style="margin-bottom:-3px;">
                            <img src="https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $destaque['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=m" alt="avatar habbo" style="position:absolute;bottom:15px;left: -5px;" />
                            <img src="https://i.imgur.com/DJeU6zT.png" alt="palanque habbo" />
                        </div>

                        <div class="d-flex align-center h-70 pr-10" style="flex-wrap:wrap;position:absolute;right:0;width:200px;justify-content:flex-end;">
                            <?php foreach (explode(';', $destaque['qualidades']) as $qualidade) : ?>
                                <caracteristica>• <?php echo ucfirst($qualidade); ?></caracteristica>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <a href="<?php echo BASE; ?>melhores-da-semana" class="btn-block mt-10 h-91 melhores-semana"></a>
            </div>
            <div id="busca-registro" class="ml-10">
                <div class="mt-10 d-flex space-between pl-10 pr-20">
                    <div class="pesquise"><i class="fa fa-search"></i> PESQUISAR MEMBRO</div>
                    <div class="d-flex align-center">
                        <img src="https://i.imgur.com/U4xwz8a.png" alt="Registro desatualizado?" class="mr-5" />
                        <p>
                            <strong>Registro desatualizado?</strong><br />
                            Clique <a href="#" style="color:#FAE094;text-decoration: none;">aqui</a>!
                        </p>
                    </div>
                </div>
                <div class="mt-10 d-flex space-between pl-10 pr-20">
                    <form action="#" onsubmit="return getRegistro()">
                        <div style="display:inline-block;border: 2px solid #464132;border-radius:25px;padding: 5px;">
                            <input type="text" name="nickname" id="nickname" placeholder="Digite o nickname do membro aqui!" required />
                        </div>
                        <button type="submit" class="btn">
                            <i class="fa fa-search"></i> OK
                        </button>
                    </form>
                </div>

                <img src="https://i.imgur.com/vW3lHYN.png" alt="divisor" style="width:100%;" />

                <div class="resultado ml-10 mt-1">
                    <div class="mb-10 pesquise">
                        RESULTADO DA PESQUISA
                    </div>

                    <div class="d-flex space-between" style="position:relative;">
                        <div class="info ml-20">
                            Digite o nome do membro no campo acima e obetenha as <span style="font-weight: 600;color: rgb(250, 224, 148);">informações </span> aqui!
                        </div>

                        <div class="avatar">
                            <img src="https://i.imgur.com/kCshzpr.png" alt="avatar habbo" style="position:absolute;bottom:15px;right:30px;" />
                            <img src="https://i.imgur.com/JVngWt4.png" alt="palanque habbo" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ./DESTAQUE SEMANAL E PESQUISA -->

    <!-- RÁDIO, NAVEGAÇÃO RÁPIDA E LINKS -->
    <div class="radio-buttons">
        <div class="radio">
            <div class="locucao">
                <p>BOTSIHB <span>com</span> EletroSIHB</p>
                <status>NO AR</status>
            </div>
            <div class="botoes">
                <button class="btn"><i class="fa fa-play"></i></button>
                <button class="btn"><i class="fa fa-pause"></i></button>
                <div class="volume">
                    <i class="fa fa-volume-up"></i>
                    <div class="range">
                        <input type="range" min="0" max="100" value="1">
                    </div>
                </div>
            </div>
        </div>

        <div class="navegacao-rapida mt-10 pt-10 pb-10 text-end">
            <h4>Navegação Rápida</h4>

            <ul>
                <li>
                    <a href="<?php echo BASE; ?>apostilas/requisitos-da-sede">Apostila I: Requisitos da Sede</a>
                </li>

                <li>
                    <a href="<?php echo BASE; ?>sobre/estatuto">Regimento Institucional</a>
                </li>

                <li>
                    <a href="<?php echo BASE; ?>apostilas/combate-de-fraudes-ideologicas">Combate de Fraudes Ideológicas</a>
                </li>

                <li>
                    <a href="<?php echo BASE; ?>apostilas/instrucoes-etica-conduta">Instruções de Ética e Conduta</a>
                </li>
            </ul>
        </div>

        <a href="<?php echo BASE; ?>cursos" class="btn-block" id="cursos-adicionais"></a>

    </div>
    <!-- ./RÁDIO, NAVEGAÇÃO RÁPIDA E LINKS -->
</div>

<div style="background:linear-gradient(to bottom, transparent 0px, transparent 100px, #FFF 100px, #fff 100%);margin-top:10px;">
    <!-- Noticiais sobre a SIHB e Botões auxiliares -->
    <div id="noticias-botoes" class="container">
        <div id="noticias">
            <div id="sihbnews">
                <img src="https://i.imgur.com/wqbbNsj.png" alt="SIHB NEWS">
                <h4>SIHB NEWS</h4>

                <p>Vejas as últimas notícias da organização</p>
            </div>

            <div class="noticias ml-20">
                <?php foreach ($recentes as $recenteId => $recente) : ?>
                    <a href="<?php echo BASE . "noticias/abrir/" . $recente['id'] . "/" . $recente['slug']; ?>" class="noticia" style="background: url('<?php echo $recente['banner']; ?>') 0% 0% / cover no-repeat;background-size: 100% 100%;padding-top: 0;">
                        <div style="width:100%;height:-webkit-fill-available;padding-top: 20px;background:rgba(0,0,0,0.75);"><h4>
                            <?php echo $recente['titulo']; ?>
                        </h4>
                        <?php if ($recenteId == 0) : ?>
                            <p>
                                <?php echo $recente['subtitulo']; ?>
                            </p>
                        <?php endif; ?>
                        <clock>
                            <i class="fas fa-history"></i>&nbsp;
                            <?php echo $u->diferenca($recente['data']); ?>
                        </clock></div>
                    </a>
                <?php endforeach; ?>

                <div id="vermais">
                    <a href="<?php echo BASE; ?>noticias">
                        Veja todas notícias
                        <span>+</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="ml-10">
            <a href="<?php echo BASE; ?>financeiro/sihbcoins" class="blacklist"></a>
            <a href="<?php echo BASE; ?>apostilas/hb-etiqueta" class="hb-etiqueta"></a>
        </div>
    </div>
    <!-- ./Noticiais sobre a SIHB e Botões auxiliares -->

    <!-- Fórum SIHB -->
    <div class="forum d-flex container mt-30">
        <div id="posts">
            <div id="topo">
                <img src="https://i.imgur.com/UcEhk0S.png" alt="Fórum SIHB">

                <form action="<?php echo BASE; ?>" onsubmit="return pesquisarForum()">
                    <input type="text" name="forum_posts" id="forum_posts" required />
                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div id="posts-list-fixa">
                <?php foreach ($f_recentes['destaques'] as $destaque) : ?>
                    <div class="post d-flex">
                        <div class="avatar">
                            <img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $destaque['autor']; ?>&action=std&direction=4&head_direction=3&img_format=png&gesture=std&headonly=1&size=b" alt="Cabeça do habbo <?php echo $destaque['autor']; ?>">
                        </div>

                        <div class="ml-10">
                            <p><a href="<?php echo BASE; ?>forum/abrir/<?php echo $destaque['id']; ?>/<?php echo $destaque['slug']; ?>"><span><?php echo $destaque['titulo']; ?></span></a></p>
                            <div class="mt-5 d-flex infos ">
                                <span class="info"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $destaque['autor']; ?></span>

                                <span class="info">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                                    <?php echo $u->diferenca($destaque['data']); ?> atrás
                                </span>

                                <span class="info2">
                                    <?php echo $destaque['respostas']; ?>
                                    <img src="https://i.imgur.com/qRRpLOQ.png" alt="Mensagens">
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="posts-list" data-cat="all">
                <?php foreach ($f_recentes['outras'] as $destaque) : ?>
                    <div class="post <?php echo ($destaque['status'] == 2) ? 'fixa' : ''; ?> d-flex">
                        <div class="avatar">
                            <img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $destaque['autor']; ?>&action=std&direction=4&head_direction=3&img_format=png&gesture=std&headonly=1&size=b" alt="Cabeça do habbo <?php echo $destaque['autor']; ?>">
                        </div>

                        <div class="ml-10">
                            <p><a href="<?php echo BASE; ?>forum/abrir/<?php echo $destaque['id']; ?>/<?php echo $destaque['slug']; ?>"><span><?php echo $destaque['titulo']; ?></span></a></p>
                            <div class="mt-5 d-flex infos ">
                                <span class="info"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $destaque['autor']; ?></span>

                                <span class="info">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                                    <?php echo $u->diferenca($destaque['data']); ?> atrás
                                </span>

                                <span class="info2">
                                    <?php echo $destaque['respostas']; ?>
                                    <img src="https://i.imgur.com/qRRpLOQ.png" alt="Mensagens">
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="forum-info" class="ml-10">
            <div class="categorias">
                <div class="categorias-head">CATEGORIAS</div>
                <div class="categorias-body">
                    <ul>
                        <li class="active" id="all" onclick="buscarTopico('all')">
                            Todos (<?php echo $total_topicos['total']; ?>)
                        </li>
                        <li onclick="buscarTopico('regras')" id="regras">
                            Regras (<?php echo $total_topicos['regras']; ?>)
                        </li>
                        <li onclick="buscarTopico('boletins')" id="boletins">
                            Boletins (<?php echo $total_topicos['boletins']; ?>)
                        </li>
                        <li onclick="buscarTopico('duvidas')" id="duvidas">
                            Dúvidas (<?php echo $total_topicos['duvidas']; ?>)
                        </li>
                        <li onclick="buscarTopico('sugestoes')" id="sugestoes">
                            Sugestões (<?php echo $total_topicos['sugestoes']; ?>)
                        </li>
                        <li onclick="buscarTopico('outras')" id="outras">
                            Outros (<?php echo $total_topicos['outras']; ?>)
                        </li>
                    </ul>
                </div>
                <div class="categorias-footer">
                    <button class="btn" id="anterior" onclick="ForumMsgs.goBaack()">
                        <i class="fa fa-arrow-left"></i>
                    </button>

                    <span>Página <span id="pag-atual">1</span></span>

                    <button class="btn" id="proxima" onclick="ForumMsgs.goForward()">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <?php if ($acesso->isLogged()) : ?>
                <a href="<?php echo BASE; ?>forum/criar-topico" id="criar-topico"></a>
            <?php endif; ?>

        </div>
    </div>
    <!-- ./Fórum SIHB -->

    <!-- Grupos SIHB -->
    <div class="grupos d-flex container mt-30 text-black">
        <div class="grupo">
            <div class="grupo-head">GRUPOS SIHB</div>
            <div class="grupo-body d-flex">
                <button onclick="moveBadge(+70)" class="btn"><i class="fa fa-arrow-left"></i></button>
                <div id="grupos">
                    <?php foreach ($emblemas as $emblemaKey => $emblema) : ?>
                        <a href="javascript:;" class="<?php echo ($emblemaKey == 0) ? 'active' : ''; ?> tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="<?php echo utf8_decode($emblema['nome']); ?>" <?php echo ($emblemaKey == 0) ? 'style="margin-left:0px;"' : ''; ?> onclick="buscarBadge(<?php echo $emblema['id']; ?>).then()">
                            <img src="<?php echo $emblema['img']; ?>" alt="<?php echo utf8_decode($emblema['nome']); ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
                <button onclick="moveBadge(-70)" class="btn"><i class="fa fa-arrow-right"></i></button>
            </div>
            <div class="grupo-footer">
                <div class="imagem">
                    <img src="https://www.habbo.com.br/habbo-imaging/badge/b23124s36147s01144s09134s961149df9f8fa6483a18a3951f28e2e3bb9dc.gif" alt="Serviço de Inteligência">
                </div>

                <div class="info">
                    <h3>Serviço de Inteligência</h3>
                    <p>Grupo destinado <strong>aos membros e admiradores</strong> do Serviço de Inteligência Habbiano.</p>

                    <div class="botoes">
                        <button class="status aberto btn">
                            <img src="https://i.imgur.com/FrPQ2Sq.png" alt="Cadeado" />
                            Grupo aberto
                        </button>

                        <a href="https://www.habbo.com.br/hotel?room=r-hhbr-37a584ae570c1ec33efd46d40770cfb0" class="quarto btn">
                            <img src="https://i.imgur.com/FvzLNrE.png" alt="Cadeado" />
                            Ir para o quartel do grupo
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="vip">
            <h3>Seja vip</h3>
            <p>Obtenha benefícios exclusivos adquirindo o nosso plano VIP!</p>
            <ul>
                <li>Benefício de cabelos e acessórios</li>
                <li>Acesso livre ao curso avulso</li>
                <li>Acesso exclusivo em eventos</li>
                <li>E muito mais</li>
            </ul>

            <div>
                De <span id="de">25c</span><br />
                Por apenas <span id="por">20c</span>
            </div>

            <a href="<?php echo BASE; ?>extras/vip">ASSINE <strong>AGORA</strong>!</a>
        </div>

        <div class="discord">
            <p id="jogue" class="d-flex align-center">
                <img src="https://i.imgur.com/1TnQC58.png" alt="chat" class="mr-5">
                <span>Jogue interagindo conosco conectado por chat de voz</span>
            </p>

            <div id="info">
                <img src="https://i.imgur.com/sMD7RaS.png" alt="Discord" />

                <p id="entre">
                    Entre no<br> <strong>nosso servidor.</strong><br> É simples<br> e fácil!
                </p>

                <a href="<?php echo BASE; ?>apostilas/discord">COMECE <strong>AGORA</strong>!</a>
            </div>

        </div>
    </div>
    <!-- ./Grupos SIHB -->

</div>