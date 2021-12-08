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
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/loja.min.css">
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/responsive.min.css">

    <script src= "https://code.jquery.com/jquery-3.5.0.min.js"> </script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- <script src="<?php echo BASE; ?>assets/js/jquery.mask.js"></script> -->

    <script>
        const BASE = '<?php echo BASE; ?>';
        const c = el => document.querySelector(el);
        const cs = el => document.querySelectorAll(el);
    </script>
</head>

<body>



    <section class="top h-80">
        <div id="sihb">
            <img src="https://i.imgur.com/SV9MHuL.png" alt="sihb" />
        </div>

        <div id="funcionamento">
            <ul>
                <li><a href="<?php echo BASE; ?>loja">Página Inicial</a></li>
                <li><a href="<?php echo BASE; ?>loja/regras">Regras da Loja</a></li>
                <li><a href="<?php echo BASE; ?>">Voltar ao site</a></li>
            </ul>

            <div class="usuario">
                <div class="info">
                    <p class="nickname"><?php echo $acesso->getInfo('nickname'); ?></p>
                    <p class="moedas">
                        <?php echo ($acesso->getInfo('moedas') > 999) ? '999+' : $acesso->getInfo('moedas'); ?> SIHBCoins
                    </p>
                </div>

                <div class="avatar_hb">
                    <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $acesso->getInfo('nickname'); ?>&action=std&direction=4&head_direction=4&gesture=sml&size=m" alt="Avatar Perfil" id="avatar_perfil">
                </div>
            </div>
        </div>

    </section>

    <marquee id="ultimas-compras">
        <div style="display:flex;">
        <?php foreach ($ultimas_compras as $ultimaCompra): ?>
            <div class="compra">
                <div>                    
                    <img src="<?php echo($ultimaCompra['presente'] == 1)?'https://i.imgur.com/80OPtsi.png':'http://www.habbo.com.br/habbo-imaging/avatarimage?&user='.$ultimaCompra['nickname'].'&action=std&direction=3&head_direction=2&img_format=png&gesture=std&headonly=1&size=s'; ?>" alt="tipo" />
                </div>
                <p>
                    <?php if ($ultimaCompra['presente'] == 1): ?>
                        <span><?php echo $ultimaCompra['nickname_comprador']; ?></span> presentou <span><?php echo $ultimaCompra['nickname']; ?></span> com <span><?php echo $ultimaCompra['msg']; ?></span>
                    <?php else: ?>
                        <span><?php echo $ultimaCompra['nickname']; ?></span> comprou <span><?php echo $ultimaCompra['msg']; ?></span>    
                    <?php endif; ?>
                </p>
            </div>        
        <?php endforeach; ?>
        </div>
    </marquee>

    <section style="background: linear-gradient(to bottom, transparent 0px, transparent 1850px, #FFF 1850px, #fff 100%);padding-bottom: 50px;">
        <div class="container">
            <div class="d-flex space-between mt-10 loj">
                <div class="loja" style="width:530px;">
                    <h1 style="font-size: 3em;margin-top: 0px;margin-bottom: 15px;">
                        LOJA
                    </h1>

                    <p>O Habbo Hotel é um jogo recheado de emblemas bem divertidos para personalizar o perfil. O SIHB, é claro, não poderia ficar fora dessa! Esta é nossa loja de emblemas, onde você poderá comprar os emblemas que mais te agradarem com as sihbcoins que conquistar através de suas tarefas realizadas na empresa. Ao comprar um emblema, ele estará disponível para você no perfil SIHB de vocês aqui no site!</p>
                </div>

                <div class="ultimas-novidades">
                    <h3>
                        Últimas novidades
                    </h3>

                    <?php foreach ($ultimos_itens as $ultimoItem): ?>
                        <div class="novidade <?php echo($ultimoItem['limite'] == 0)?'esgotado':''; ?>">
                            <div class="emblema">                                
                                <img src="<?php echo $ultimoItem['img']; ?>" alt="emblema">
                            </div>

                            <div class="info">
                                <p class="info-nome">
                                    <?php echo($ultimoItem['limite'] == 0)?'Esgotado':'Adicionado'; ?>
                                    <?php if ($ultimoItem['vip'] == 1): ?>
                                        <img src="https://i.imgur.com/1DBSVgG.png" alt="vip" style="margin-bottom:-5px;">
                                    <?php endif; ?>
                                </p>
                                <div class="emblema-nome"><?php echo $ultimoItem['nome']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="shop emblemas">
                <div class="shop-head">
                    <h4>Loja de emblemas</h4>
                </div>
                <div class="shop-body">
                    <?php foreach ($emblemas as $produto): ?>
                        <div class="shop-item <?php echo($produto['limite'] == 0)?'esgotado':''; ?>">
                            <div class="shop-item-body">
                                <h2>
                                    <?php echo $produto['nome']; ?>
                                    <?php if ($produto['vip'] == 1): ?>
                                        <img src="https://i.imgur.com/1DBSVgG.png" alt="vip" style="margin-bottom:-5px;">
                                    <?php endif; ?>
                                </h2>

                                <div class="item">
                                    <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />

                                    <div>
                                        <?php if ($produto['valor_anterior'] != 0): ?>
                                            <p class="de">De <span><?php echo $produto['valor_anterior']; ?>Sc</span></p>                    
                                        <?php endif; ?>
                                        <p class="por">Por <span><?php echo $produto['valor']; ?>Sc</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-item-footer">
                                
                                <?php if ($produto['vip'] == 1 && $acesso->getInfo('vip') == 1): ?>
                                    <button class="presentear" onclick="shopItem(this, 2, <?php echo $produto['id']; ?>)">
                                        <img src="https://i.imgur.com/80OPtsi.png" alt="Presentear" />
                                    </button>
                                    
                                    <?php if (!$loja->compreiProduto($acesso->getInfo('id_registro'), $produto['id'])): ?>
                                        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                                            Comprar 
                                            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                                        </button>                                    
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($produto['vip'] == 0): ?>
                                    <button class="presentear" onclick="shopItem(this, 2, <?php echo $produto['id']; ?>)">
                                        <img src="https://i.imgur.com/80OPtsi.png" alt="Presentear" />
                                    </button>

                                    <?php if (!$loja->compreiProduto($acesso->getInfo('id_registro'), $produto['id'])): ?>
                                        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                                            Comprar 
                                            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                                        </button>                                    
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="shop-footer">
                    <!-- <input type="text" name="pesquisar" id="pesquise_emblema" placeholder="Pesquisar" /> -->
                    <div class="botoes" data-page="1">
                        <button onclick="pegarItens(1, 1)"><i class="fa fa-arrow-left"></i></button>
                        <button onclick="pegarItens(2, 1)"><i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="shop beneficios">
                <div class="shop-head">
                    <h4>Loja de benefícios</h4>
                </div>
                <div class="shop-body">
                    <?php foreach ($beneficios as $produto): ?>
                        <div class="shop-item <?php echo($produto['limite'] == 0)?'esgotado':''; ?>">
                            <div class="shop-item-body">
                                <h2>
                                    <?php echo $produto['nome']; ?>
                                    <?php if ($produto['vip'] == 1): ?>
                                        <img src="https://i.imgur.com/1DBSVgG.png" alt="vip" style="margin-bottom:-5px;">
                                    <?php endif; ?>
                                </h2>

                                <div class="item">
                                    <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />

                                    <div>
                                        <?php if ($produto['valor_anterior'] != 0): ?>
                                            <p class="de">De <span><?php echo $produto['valor_anterior']; ?>Sc</span></p>                    
                                        <?php endif; ?>
                                        <p class="por">Por <span><?php echo $produto['valor']; ?>Sc</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-item-footer">
                                
                                <?php if ($produto['vip'] == 1 && $acesso->getInfo('vip') == 1): ?>
                                    <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                                        Comprar 
                                        <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                                    </button>
                                <?php endif; ?>

                                <?php if ($produto['vip'] == 0): ?>
                                    <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                                        Comprar 
                                        <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                                    </button>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="shop-footer">
                    <!-- <input type="text" name="pesquisar" id="pesquise_beneficio" placeholder="Pesquisar" /> -->
                    <div class="botoes" data-page="1">
                        <button onclick="pegarItens(1, 2)"><i class="fa fa-arrow-left"></i></button>
                        <button onclick="pegarItens(2, 2)"><i class="fa fa-arrow-right"></i></button>
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
        function shopItem(obj, t, i) {
            let nickname = '';
            if (t == 4) {
                nickname = obj.parentElement.parentElement.querySelector('#nickname_user').value
            }
            let url = `${BASE}loja/shopstatus`
            let params = {
                method: 'POST',
                body: JSON.stringify({
                    t:t,
                    i:i,
                    nickname:nickname
                })

            }
            fetch(url, params)
                .then((r) => r.text())
                .then((html) => {
                    if (html.length > 0) {
                        obj.closest('.shop-item').classList.toggle('is-flipped')
                        obj.closest('.shop-item').innerHTML = `<div style="${((obj.closest('.shop-item').classList.contains('is-flipped'))?'transform: rotateY(180deg);':'')}height: 100%;">${html}</div>`                        
                    }
                })
                .catch((erro) => {
                    // erro em falhas
                })
        }

        function pegarItens(tipo, local) {
            let page = 1;
            if (local == 1) {
                page = parseInt(c('.shop.emblemas .shop-footer .botoes').getAttribute('data-page'))
            } else {
                page = parseInt(c('.shop.beneficios .shop-footer .botoes').getAttribute('data-page'))
            }

            let url = `${BASE}loja/getEmblemasP`
            let params = {
                method: 'POST',
                body: JSON.stringify({
                    page:page,
                    tipo:tipo,
                    local:local
                })

            }
            fetch(url, params)
                .then((r) => r.text())
                .then((html) => {
                    if (html.length > 0) {
                        if (local == 1) {
                            c('.shop.emblemas .shop-body').innerHTML = html
                        } else {
                            c('.shop.beneficios .shop-body').innerHTML = html
                        }       

                        if (tipo == 1 && page > 1) {
                            let nextNumber = page - 1
                            
                            if (local == 1) {
                                c('.shop.emblemas .shop-footer .botoes').setAttribute('data-page', nextNumber)
                            } else {
                                c('.shop.beneficios .shop-footer .botoes').setAttribute('data-page', nextNumber)
                            } 
                        } else if(tipo == 2) {
                            let nextNumber = page + 1
                            
                            if (local == 1) {
                                c('.shop.emblemas .shop-footer .botoes').setAttribute('data-page', nextNumber)
                            } else {
                                c('.shop.beneficios .shop-footer .botoes').setAttribute('data-page', nextNumber)
                            } 
                        }                             


                    }
                })
                .catch((erro) => {
                    // erro em falhas
                })
        }

        function cleanInput(obj) {
            obj.parentElement.parentElement.querySelector('#nickname_user').value = '';
        }
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