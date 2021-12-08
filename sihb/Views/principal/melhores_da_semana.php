<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano</title>
    <meta name="description" content="<?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:site_name" content="Diário Brasileiro - Anonimo">
    <meta property="og:title" content="<?php echo $viewData['pageName'] ?> | Serviço de Inteligência Habbiano">
    <meta property="og:description" content="<?php echo $viewData['description']; ?>">
    <meta property="og:url" content="<?php echo BASE; ?>">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:image" content="https://i.imgur.com/VCYRVsP.png">
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
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/melhores.min.css">
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

    <section class="top h-80">
        <div>
            <img src="https://i.imgur.com/WYmSCeI.png" alt="sihb" />
        </div>

        <div id="funcionamento" style="width:calc(90% - 425px);">
            <ul>
                <li><a href="<?php echo BASE; ?>">Página Inicial</a></li>
                <li><a href="<?php echo BASE; ?>estastiticas-gerais">Estatísticas Gerais</a></li>
                <li><a href="javascript:;">Pesquisar Registro</a></li>
            </ul>
        </div>

    </section>

    <section class="melhores">
        <div class="container d-flex">
            <div class="rankings">
                <h3>RANKING</h3>

                <p class="mt-10 melhor">
                    <strong>MELHORES</strong><br />
                    DA SEMANA
                </p>

                <p>
                    "Os melhores da semana" representam os funcionários que mais se destacaram nos processos funcionais do Serviço de Inteligência Habbiano. São anunciados na Assembleia Geral como ato de reconhecimento. Honra, dedicação e lealdade!
                </p>

                <div class="ranking treinadores">
                    <div class="ranking-left">
                        <h4 class="ranking-tipo">RANKING <strong>TREINOS</strong></h4>

                        <div class="ranking-info" style="background: url('https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $treinos[0]['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=m') no-repeat 10px 20px,  url(https://i.imgur.com/RNjuX6l.png) no-repeat left bottom;">
                            <p class="nickname"><?php echo $treinos[0]['nickname']; ?></p>
                            <p class="cargo"><?php echo $treinos[0]['patente']; ?></p>
                            <p class="total_acoes"><?php echo $treinos[0]['total']; ?> treinos</p>

                            <div class="posicao">1°</div>
                        </div>
                    </div>
                    <div class="ranking-right">
                        <?php foreach ($treinos as $treino) : ?>

                            <div class="ranking-user">
                                <div class="place"><?php echo $treino['posicao']; ?></div>
                                <div class="avatar"><img src="https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $treino['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=s" alt="avatar"></div>
                                <div class="nickname"><?php echo $treino['nickname']; ?></div>
                                <div class="qt"><?php echo $treino['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ranking DEs">
                    <div class="ranking-left">
                        <h4 class="ranking-tipo">RANKING <strong>DEs</strong></h4>

                        <div class="ranking-info" style="background: url('https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $des[0]['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=m') no-repeat 10px 20px,  url(https://i.imgur.com/RNjuX6l.png) no-repeat left bottom;">
                            <p class="nickname"><?php echo $des[0]['nickname']; ?></p>
                            <p class="cargo"><?php echo $des[0]['patente']; ?></p>
                            <p class="total_acoes"><?php echo $des[0]['total']; ?> DEs</p>

                            <div class="posicao">1°</div>
                        </div>
                    </div>
                    <div class="ranking-right">
                        <?php foreach ($des as $treino) : ?>

                            <div class="ranking-user">
                                <div class="place"><?php echo $treino['posicao']; ?></div>
                                <div class="avatar"><img src="https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $treino['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=s" alt="avatar"></div>
                                <div class="nickname"><?php echo $treino['nickname']; ?></div>
                                <div class="qt"><?php echo $treino['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ranking atendimento">
                    <div class="ranking-left">
                        <h4 class="ranking-tipo">RANKING <strong style="font-size:14px;">AJUDANTE</strong></h4>

                        <div class="ranking-info" style="background: url('https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $atendimentos[0]['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=m') no-repeat 10px 20px,  url(https://i.imgur.com/RNjuX6l.png) no-repeat left bottom;">
                            <p class="nickname"><?php echo $atendimentos[0]['nickname']; ?></p>
                            <p class="cargo"><?php echo $atendimentos[0]['patente']; ?></p>
                            <p class="total_acoes"><?php echo $atendimentos[0]['total']; ?> atendimentos</p>

                            <div class="posicao">1°</div>
                        </div>
                    </div>
                    <div class="ranking-right">
                        <?php foreach ($atendimentos as $treino) : ?>

                            <div class="ranking-user">
                                <div class="place"><?php echo $treino['posicao']; ?></div>
                                <div class="avatar"><img src="https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $treino['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=s" alt="avatar"></div>
                                <div class="nickname"><?php echo $treino['nickname']; ?></div>
                                <div class="qt"><?php echo $treino['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ranking executivo">
                    <div class="ranking-left">
                        <h4 class="ranking-tipo">RANKING <strong>PROF.</strong></h4>

                        <div class="ranking-info" style="background: url('https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $executivos[0]['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=m') no-repeat 10px 20px,  url(https://i.imgur.com/RNjuX6l.png) no-repeat left bottom;">
                            <p class="nickname"><?php echo $executivos[0]['nickname']; ?></p>
                            <p class="cargo"><?php echo $executivos[0]['patente']; ?></p>
                            <p class="total_acoes"><?php echo $executivos[0]['total']; ?> ações</p>

                            <div class="posicao">1°</div>
                        </div>
                    </div>
                    <div class="ranking-right">
                        <?php foreach ($executivos as $treino): ?>
                            
                            <div class="ranking-user">
                                <div class="place"><?php echo $treino['posicao']; ?></div>
                                <div class="avatar"><img src="https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $treino['nickname']; ?>&action=std&direction=2&head_direction=3&gesture=sml&size=s" alt="avatar"></div>
                                <div class="nickname"><?php echo $treino['nickname']; ?></div>
                                <div class="qt"><?php echo $treino['total']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="ranking-geral">
                <div class="rg">
                    <h2>RANKING <strong>GERAL</strong> </h2>

                    <table>
                        <tbody>
                            <tr>
                                <th>Pos</th>
                                <th>•</th>
                                <th>Membro</th>
                                <th>Pts</th>
                            </tr>
                            <?php foreach ($gerais as $geral): ?>
                                <tr>
                                    
                                    <td><?php echo $geral['posicao']; ?></td>
                                    <td style="background-image:url('http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $geral['nickname']; ?>&action=std&direction=3&head_direction=2&img_format=gif&gesture=std&headonly=1&size=m');"></td>
                                    <td><?php echo $geral['nickname']; ?></td>
                                    <td><?php echo $geral['total']; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                    <div class="minha-posicao">
                        <p>Sua posição</p>
                        <form action="" onsubmit="return procurarPosicaoRanking()">
                            <input type="text" name="procurar_nickname" id="procurar_nickname" placeholder="Pesquisar membro" required />

                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <table id="busca-posicao">
                        <tbody>
                            <?php if ($acesso->isLogged() && count($meugeral) > 0): ?>
                                <tr>
                                    <td><?php echo $meugeral['posicao']; ?></td>
                                    <td style="background-image:url('http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $meugeral['nickname']; ?>&action=std&direction=3&head_direction=2&img_format=gif&gesture=std&headonly=1&size=m');"></td>
                                    <td class="text-white"><?php echo $meugeral['nickname']; ?></td>
                                    <td><?php echo $meugeral['total']; ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="bug">
                    <p>SEUS NÚMEROS ESTÃO <strong>ERRADOS</strong>?</p>

                    <p>Solicite uma correção agora mesmo</p>

                    <form action="<?php echo BASE; ?>form/bug_ranking" method="POST" enctype="multipart/form-data">
                        <input type="text" name="nickname" placeholder="Nick" id="nickname" required>

                        <div class="custom-select" style="width:125px;height:37px;">
                            <select name="tipo" required>
                                <option value="">Tipo de ranking</option>
                                <option value="Treinador">Treinador</option>
                                <option value="DEs">DE</option>
                                <option value="Atendimentos">Atendimentos</option>
                                <option value="Executivos">Executivos</option>
                            </select>
                        </div>

                        <input type="text" name="qt" placeholder="Qtde correta" id="qt" required>

                        <input type="file" name="prova" id="prova" class="custom-file-input" required accept="image/png, image/jpeg, image/jpg">

                        <input type="reset" value="Limpar">

                        <button type="submit">Enviar solcitação</button>
                    </form>
                </div>
            </div>

            
        </div>

        <div class="mt-30 container pb-30 veja-tambem">
            <h3>
                <strong>VEJA</strong>
                TAMBÉM
            </h3>

            <a href="<?php echo BASE; ?>apostilas/hb-etiqueta" id="etiqueta">
                <strong>HABBO</strong>
                ETIQUETA
            </a>

            <a href="<?php echo BASE; ?>noticias" id="sihb">
                <strong>SIHB</strong>
                <span>NOTÍCIAS</span>
            </a>

            <a href="<?php echo BASE; ?>apostilas/discord" id="discord">
                <strong>DISCORD</strong>
                TUTORIAL
            </a>

        </div>
    </section>



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
                    Este site da web não possui vínculo com nenhuma organização de inteligência da vira real e não é marca de nenhuma das afiliadas da Sulake Corporation Oy.<br /> Este é um jogo de simulação e nenhum acontecimento deve ser levado em consideração!<br /> Este site foi desenvolvido por
                    <a href="" class="desenvolvedor">George Silva (GeorgeSiilva)</a> e <a href="" class="desenvolvedor" id="yan">Yan Lyra (majoryanzinho)</a>
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


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="<?php echo BASE; ?>assets/js/script.js?<?php echo rand(0,99); ?>"></script>
    <script src="<?php echo BASE; ?>assets/js/fuckadblock.min.js" integrity="sha256-xjwKUY/NgkPjZZBOtOxRYtK20GaqTwUCf7WYCJ1z69w="></script>
    <script>
        <?php if (isset($_SESSION['aviso_registro']) && !empty($_SESSION['aviso_registro'])): ?>
            M.toast({html: '<?php echo $_SESSION['aviso_registro'] ?>'})

            <?php unset($_SESSION['aviso_registro']); ?>
        <?php endif; ?>
        var x, i, j, selElmnt, a, b, dee;
        /* Look for any elements with the class "custom-select": */
        x = document.getElementsByClassName("custom-select");
        for (i = 0; i < x.length; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            /* For each element, create a new DIV that will act as the selected item: */
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /* For each element, create a new DIV that will contain the option list: */
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < selElmnt.length; j++) {
                /* For each option in the original select element,
                create a new DIV that will act as an option item: */
                dee = document.createElement("DIV");
                dee.innerHTML = selElmnt.options[j].innerHTML;
                dee.addEventListener("click", function(e) {
                    /* When an item is clicked, update the original select box,
                    and the selected item: */
                    var y, i, k, s, h;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < s.length; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            for (k = 0; k < y.length; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(dee);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /* When the select box is clicked, close any other select boxes,
                and open/close the current select box: */
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /* A function that will close all select boxes in the document,
            except the current select box: */
            var x, y, i, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            for (i = 0; i < y.length; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < x.length; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }

        /* If the user clicks anywhere outside the select box,
        then close all select boxes: */
        document.addEventListener("click", closeAllSelect);
    </script>
    <script src="<?php echo BASE; ?>assets/js/script.js"></script>
    <script src="<?php echo BASE; ?>assets/js/fuckadblock.min.js" integrity="sha256-xjwKUY/NgkPjZZBOtOxRYtK20GaqTwUCf7WYCJ1z69w="></script>
</body>

</html>