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
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/noticias.min.css">
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

    <div style="display: none;" id="exemplos">
        <a href="" class="noticia">
            <div style="width:100%;height:-webkit-fill-available;padding-top: 20px;background:rgba(0,0,0,0.75);">
                <h4></h4>
                <p></p>

                <clock><i class="fas fa-history"></i>&nbsp;</clock>
            </div>
        </a>
    </div>

    <section class="top h-80">
        <div>
            <img src="https://i.imgur.com/ZqFtpIG.png" alt="sihb" />
        </div>

        <div id="funcionamento">
            <ul>
                <li><a href="<?php echo BASE; ?>">Página Inicial</a></li>
                <li><a href="<?php echo BASE; ?>noticias/equipe">Equipe</a></li>
                <li><a href="<?php echo BASE; ?>noticias/colunas">Colunas</a></li>
            </ul>

            <a href="<?php echo BASE; ?>noticias/faca-parte" id="faca-parte">FAÇA PARTE DA EQUIPE</a>
        </div>

    </section>

    <section style="background: url(https://i.imgur.com/dEs0tqd.png) no-repeat, linear-gradient(to bottom, transparent 0px, transparent 650px, #FFF 650px, #fff 100%);padding-bottom: 50px;">
        <div class="container">
            <div class="destaques">
                <h1>
                    <span>ÚLTIMAS 24H</span>
                    <span><strong>NOTÍCIAS</strong> DESTAQUE</span>
                </h1>

                <div class="noticias">
                    <?php foreach ($destacadas as $destaqueId => $destaque) : ?>
                        <?php if ($destaqueId == 0) : ?>
                            <a href="<?php echo BASE; ?>noticias/abrir/<?php echo $destaque['id']; ?>/<?php echo $destaque['slug']; ?>" class="noticia" style="background: url('<?php echo $destaque['banner']; ?>') 0% 0% / cover no-repeat;background-size: 100% 100%;padding-top: 0;">
                                <div style="width:100%;height:-webkit-fill-available;padding-top: 20px;background:rgba(0,0,0,0.75);">
                                    <h4><?php echo $destaque['titulo']; ?></h4>
                                    <p><?php echo $destaque['subtitulo']; ?></p>

                                    <div id="infos">
                                        <div class="destacada">Destaque</div>
                                        <div class="categoria"><?php echo $destaque['categoria_nome']; ?></div>
                                        <clock><i class="fas fa-history"></i>&nbsp;<?php echo $u->diferenca($destaque['data']); ?> atrás</clock>
                                    </div>
                                </div>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo BASE; ?>noticias/abrir/<?php echo $destaque['id']; ?>/<?php echo $destaque['slug']; ?>" class="noticia" style="background: url('<?php echo $destaque['banner']; ?>') 0% 0% / cover no-repeat;background-size: 100% 100%;padding-top: 0;">
                                <div style="width:100%;height:-webkit-fill-available;padding-top: 20px;background:rgba(0,0,0,0.75);">
                                    <h4><?php echo $destaque['titulo']; ?></h4>
                                    <clock><i class="fas fa-history"></i>&nbsp;<?php echo $u->diferenca($destaque['data']); ?></clock>
                                </div>
                            </a>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            </div>

            <div class="todas-noticias">
                <div class="infos">
                    <div class="pesquise">
                        <form action="" method="GET" id="form-geral">
                            <input type="text" name="pesquise_por" placeholder="Pesquisar..." value="<?php echo $filtros['pesquise_por']; ?>" />
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>

                    </div>

                    <div class="categorias">
                        <h1>CATEGORIAS</h1>
                        <ul>
                            <input type="hidden" name="categoria" value="<?php echo $filtros['categoria']; ?>">
                            <?php $cat = $filtros['categoria']; ?>
                            <?php foreach ($categorias as $categoria) : ?>
                                <?php $filtros['categoria'] = $categoria['id']; ?>
                                <li><a href="<?php echo BASE; ?>noticias/?<?php echo http_build_query($filtros); ?>"><?php echo $categoria['nome']; ?></a></li>
                                <?php $filtros['categoria'] = $cat; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="filtro">
                        <input type="hidden" name="ordem" id="ordem" value="<?php echo $filtros['ordem']; ?>">
                        <h1>FILTRAR POR DATA</h1>
                        <label for="data_de">De</label>
                        <input type="text" name="data_de" id="data_de" placeholder="<?php echo date('d/m/Y'); ?>" value="<?php echo $filtros['data_de']; ?>" />

                        <label for="data_ate">até</label>
                        <input type="text" name="data_ate" id="data_ate" placeholder="<?php echo date('d/m/Y', strtotime('+2 days')); ?>" value="<?php echo $filtros['data_ate']; ?>" />

                        <div class="buttons">
                            <a href="<?php echo BASE; ?>noticias">Limpar</a>
                            <input type="submit" value="Aplicar filtro" />
                        </div>
                        </form>
                    </div>


                </div>

                <div style="background:#000;flex: 1;">
                    <div id="news-info">
                        <h2>TODAS AS NOTÍCIAS</h2>

                        <form action="">
                            <label>Ordenar por</label>
                            <div class="custom-select" style="width:125px;height:37px;">
                                <select name="tipo" id="tipo_ordem">
                                    <option value="desc">Mais recente</option>
                                    <option value="desc">Mais recente</option>
                                    <option value="asc">Mais antigas</option>
                                    <option value="views">Qtde de views</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="noticias">
                        <?php foreach ($noticias as $noticia) : ?>
                            <a href="<?php echo BASE; ?>noticias/abrir/<?php echo $noticia['id']; ?>/<?php echo $noticia['slug']; ?>" class="noticia" style="background: url('<?php echo $noticia['banner']; ?>') 0% 0% / cover no-repeat;background-size: 100% 100%;padding-top: 0;">
                                <div style="width:100%;height:-webkit-fill-available;padding-top: 20px;background:rgba(0,0,0,0.75);">
                                    <h4><?php echo $noticia['titulo']; ?></h4>
                                    <p><?php echo $noticia['subtitulo']; ?></p>

                                    <clock><i class="fas fa-history"></i>&nbsp;<?php echo $noticia['postado_a']; ?> atrás</clock>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="botoes">
                        <div class="voltar-botoes">
                            <a href="<?php echo BASE; ?>noticias/?page=1&<?php echo http_build_query($filtros); ?>" id="primeira">
                                <i class="fa fa-arrow-left"></i>
                                <i class="fa fa-arrow-left"></i>
                            </a>

                            <a href="<?php echo BASE; ?>noticias/?page=<?php echo (($currentPage - 1) >= 1) ? ($currentPage - 1) : '1'; ?>&<?php echo http_build_query($filtros); ?>" id="voltar">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                        <div class="pagina-atual">
                            Página <span id="pag-atual"><?php echo $currentPage; ?></span>
                        </div>
                        <div class="proximas-botoes">
                            <a href="<?php echo BASE; ?>noticias/?page=<?php echo (($currentPage + 1) <= $numeroDePaginas) ? ($currentPage + 1) : $numeroDePaginas; ?>&<?php echo http_build_query($filtros); ?>" id="voltar">
                                <i class="fa fa-arrow-right"></i>
                            </a>

                            <a href="<?php echo BASE; ?>noticias/?page=<?php echo $numeroDePaginas; ?>&<?php echo http_build_query($filtros); ?>" id="ultima">
                                <i class="fa fa-arrow-right"></i>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
    <script>
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
                            c('.filtro #ordem').value = c('#tipo_ordem').value
                            c('#form-geral').submit()
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