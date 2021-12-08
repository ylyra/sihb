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
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/cursos.min.css">
    <link rel="stylesheet" href="<?php echo BASE ?>assets/css/responsive.min.css">

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"> </script>
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
            <img src="https://i.imgur.com/xvDKpmK.png" alt="sihb" />
        </div>

        <div id="funcionamento">
            <ul>
                <li><a href="<?php echo BASE; ?>cursos">Página Inicial</a></li>
                <li><a href="<?php echo BASE; ?>cursos/regras">Regras dos Cursos</a</li>
                <li><a href="<?php echo BASE; ?>">Voltar ao site</a></li>
            </ul>


            <div class="usuario">
                <div class="info">
                    <p class="nickname"><?php echo $acesso->getInfo('nickname'); ?></p>
                    <p class="moedas">
                        <strong><?php echo $totalCursos; ?></strong> Cursos
                    </p>
                </div>

                <div class="avatar_hb">
                    <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $acesso->getInfo('nickname'); ?>&action=std&direction=4&head_direction=4&gesture=sml&size=m" alt="Avatar Perfil" id="avatar_perfil">
                </div>
            </div>
        </div>

    </section>

    <div class="user-info ">
        <div class="container d-flex align-center">
            <div class="avatar">
                <img src="<?php echo $acesso->getInfo('avatar'); ?>" alt="Foto de perfil user" />
            </div>

            <p>
                Olá, <strong><?php echo $acesso->getInfo('nickname'); ?></strong>. Bem-vindo(a) novamente, que bom ter você por aqui. <?php echo ($pendentes > 0) ? 'Você ainda possui cursos pendentes, aproveita pra concluir!' : ''; ?>
            </p>
        </div>
    </div>

    <section style="background: #fff;color: #000;padding-bottom: 50px;">
        <div class="container">
            <div class="d-flex space-between mt-10 loj">
                <div class="loja" style="width:530px;">
                    <h1 style="font-size: 2.5em;margin-top: 0px;margin-bottom: 15px;font-weight: 900;margin-top: 30px;">
                        CENTRAL DE CURSOS
                        <span style="font-weight: 100;"><br />DO SIHB</span>
                    </h1>

                    <p>Seja bem-vindo a Central de Cursos do Serviço de Inteligência Habbiano! Através dessa área você terá a oportunidade de aperfeiçoar seus conhecimentos acessando os nossos cursos disponíveis para todos os Membros da Empresa. Desenvolva novas habilidades e conheça mais o SIHB! Bons estudos.</p>

                    <div class="d-flex mt-10" id="cursoooos">
                        <div class='mr-10'>
                            <img src="https://i.imgur.com/M4sYSN6.png" alt="minhas-info">
                        </div>
                        <div class="chart-total tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="Cursos Adquiridos" style="max-width: 150px;" data-percentage="<?php echo $totalCursos; ?>" data-bg="#4D4DFF" data-max="<?php echo $totalCursosG - 1; ?>">
                            <canvas height="150" width="150"></canvas>
                            <div class="chart-total-legend">
                                <span class="legend-val" value="10" style="font-size: 50px;"><?php echo $totalCursos; ?></span>
                            </div>
                            <div class='legenda'>Cursos adquiridos</div>
                        </div>

                        <div class="chart-total tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="Concluidos" style="max-width: 150px;" data-percentage="<?php echo $completos; ?>" data-bg="#36D900" data-max="<?php echo $totalCursos - 1; ?>">
                            <canvas height="150" width="150"></canvas>
                            <div class="chart-total-legend">
                                <span class="legend-val" value="10" style="font-size: 50px;"><?php echo $completos; ?></span>
                            </div>
                            <div class='legenda'>Concluidos</div>
                        </div>

                        <div class="chart-total tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="Em andamento" style="max-width: 150px;" data-percentage="<?php echo $pendentes; ?>" data-bg="#ff4000" data-max="<?php echo $totalCursos - 1; ?>">
                            <canvas height="150" width="150"></canvas>
                            <div class="chart-total-legend">
                                <span class="legend-val" value="10" style="font-size: 50px;"><?php echo $pendentes; ?></span>
                            </div>
                            <div class='legenda'>Em andamento</div>
                        </div>
                    </div>

                </div>

                <div class="ultimas-vistos">
                    <h3>
                        Últimas vistos
                    </h3>

                    <div class="cursos-h">
                        <?php foreach ($historicos as $curso): ?>
                            <div class="curso">
                                <div class="imagem">
                                    <img src="<?php echo $curso['imagem']; ?>" alt="<?php echo $curso['nome']; ?>">
                                    <button class="overlay" onclick="openCourse(<?php echo $curso['id_curso']; ?>)" style="background: rgb(<?php echo $curso['cor']; ?>, 0.65);">
                                        <i class="fa fa-2x fa-play"></i>
                                    </button>
                                </div>
                                
                                <div class="info">
                                    <?php
                                        $tipo = 'incompleto';
                                        if (ceil($curso['porcentagem']) >= 51 && ceil($curso['porcentagem']) <= 99) {
                                            $tipo = 'metade';
                                        } elseif (ceil($curso['porcentagem']) == 100) {
                                            $tipo = 'completo';
                                        }

                                    ?>
                                    <h5>
                                        <?php echo $curso['nome']; ?>
                                        <small><?php echo $curso['modulo_nome']; ?></small>
                                    </h5>

                                    <p class="status-info <?php echo $tipo; ?>">
                                        <span class="status-number">
                                            <?php echo ceil($curso['porcentagem']); ?></span>% concluido
                                    </p>
                                    <div style="padding:2px;background: #fff;border-radius: 10px;margin-top: 4px;">
                                        <div class="status-bar <?php echo $tipo; ?>" data-porcentagem='<?php echo ceil($curso['porcentagem']); ?>'></div>
                                    </div>
                                </div>
                            </div>                        
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="meus-cursos mt-40">
                <h3>Todos os meus cursos adquiridos (<?php echo ($totalCursos >= 10) ? $totalCursos : "0$totalCursos"; ?>)</h3>

                <div class="cursos">
                    <?php foreach ($meusCursos as $curso) : ?>
                        <div class="curso">
                            <div class="imagem">
                                <img src="<?php echo $curso['imagem']; ?>" alt="<?php echo $curso['nome']; ?>">
                                <button class="overlay" onclick="openCourse(<?php echo $curso['id_curso']; ?>)" style="background: rgb(<?php echo $curso['cor']; ?>, 0.65);">
                                    <i class="fa fa-2x fa-play"></i>
                                </button>
                            </div>
                            <?php
                            $tipo = 'incompleto';
                            if (ceil($curso['porcentagem']) >= 51 && ceil($curso['porcentagem']) <= 99) {
                                $tipo = 'metade';
                            } elseif (ceil($curso['porcentagem']) == 100) {
                                $tipo = 'completo';
                            }

                            ?>
                            <h4 style="background: rgb(<?php echo $curso['cor']; ?>);"><?php echo $curso['modulo_nome']; ?></h4>
                            <p class='descricao'><?php echo $curso['descricao']; ?></p>
                            <p class="status-info <?php echo $tipo; ?>">
                                <span class="status-number">
                                    <?php echo ceil($curso['porcentagem']); ?></span>% concluido
                            </p>
                            <div class="status-bar <?php echo $tipo; ?>" data-porcentagem='<?php echo ceil($curso['porcentagem']); ?>'></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="botoes">
                    <button onclick="cursosProximos()"><i class="fa fa-arrow-left"></i></button>
                    <button onclick="cursosAnteriores()"><i class="fa fa-arrow-right"></i></button>
                </div>

            </div>

            <?php foreach ($cursosArea as $cursoArea) : ?>
                <?php if (count($cursoArea['cursos']) > 0): ?>
                    <div class="cursos-area mt-40">
                        <h3>CURSOS <?php echo mb_strtoupper($cursoArea['nome'], 'UTF-8'); ?></h3>
                        <div class="cursos">
                            <?php foreach ($cursoArea['cursos'] as $curso) : ?>
                                <div class="curso<?php echo ($curso['vip'] == 1) ? ' vip' : ''; ?><?php echo ($curso['vip'] == 1 && $acesso->getInfo('vip') == 0) ? ' nao-vip' : ''; ?>">
                                    <div class="imagem">
                                        <img src="<?php echo $curso['imagem']; ?>" alt="<?php echo $curso['nome']; ?>">
                                        <div class="overlay" style="background: rgb(<?php echo $curso['cor']; ?>, 0.65);"></div>
                                    </div>
                                    <div class="content">
                                        <h4><?php echo $curso['nome']; ?></h4>                                   

                                        <?php if (($curso['vip'] == 0 && $curso['tenho'] == 0) || ($curso['vip'] == 1 && $curso['tenho'] == 0 && $acesso->getInfo('vip') == 1)) : ?>
                                            <button class="adquirir-curso" onclick='adquirirCurso(<?php echo json_encode($curso); ?>)' >Adquirir curso</button>
                                        <?php elseif ($curso['vip'] == 1 && $acesso->getInfo('vip') == 0 && $curso['tenho'] == 0) : ?>
                                            <button class="curso-vip"><i class="fa fa-times"></i> Você não é VIP</button>
                                        <?php elseif ($curso['tenho'] == 1) : ?>
                                            <button class="curso-adquirido"><i class="fa fa-check"></i> Adquirido!</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>                
                <?php endif; ?>
            <?php endforeach; ?>

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

    <div class="modal">
        <div class="modal-card">
            <div class="modal-header"></div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="<?php echo BASE; ?>assets/js/countUp.js"></script>
    <script src="<?php echo BASE; ?>assets/js/script.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        let contou = false
        <?php if (isset($_SESSION['aviso_registro']) && !empty($_SESSION['aviso_registro'])) : ?>
            M.toast({
                html: '<?php echo $_SESSION['aviso_registro'] ?>'
            })

            <?php unset($_SESSION['aviso_registro']); ?>
        <?php endif; ?>

        $(function() {

            $('[data-toggle="tooltip"]').tooltip()

            $(".chart-total").each(function(idx, element) {
                _render({
                    idx: idx,
                    element: element,
                    value: $(element).attr('data-percentage'),
                    maxValue: $(element).attr('data-max'),
                    color: $(element).attr('data-bg'),
                    canvasColor: "#cccccc",
                    startingPoint: -0.5,
                    fontSizee: 50,
                    width: 10,
                    dimens: 150
                });
            });

            $('.curso h4').each(function() {
                var me = $(this);
                me.html(me.text().replace(/(^\w+)/, '<normal>$1</normal>'));
            });

        })
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

        let _render = function({
            idx,
            element,
            value,
            maxValue,
            color,
            canvasColor,
            startingPoint,
            fontSizee,
            width,
            dimens
        }) {

            //input
            // let dimens = (dimenss != undefined)?150:dimenss;
            // console.log(dimens)
            let padding = 12;
            let countFontRatio = 0.25; //ratio in relation to the dimens value
            let pointValue = startingPoint;
            let currentPoint = startingPoint;
            let timer;
            let _ctx;

            let $canvas = $(element).find("canvas");
            let canvas = $canvas.get(0);

            pointValue = (value / (maxValue / 20) * 0.1) - 0.5;

            canvas.height = dimens;
            canvas.width = dimens;

            if (!countFontRatio)
                $canvas.parent().find(".legend-val").css("font-size", dimens / value.toString().length);
            else
                $canvas.parent().find(".legend-val").css("font-size", fontSizee);

            _ctx = canvas.getContext("2d");

            let _draw = function() {

                _ctx.clearRect(0, 0, dimens, dimens);
                _ctx.beginPath();
                _ctx.arc(dimens / 2, dimens / 2, (dimens / 2) - padding, startingPoint * Math.PI, 1.5 * Math.PI);
                _ctx.strokeStyle = canvasColor;
                _ctx.lineWidth = 9;
                _ctx.lineCap = "square";
                _ctx.stroke();

                _ctx.beginPath();
                _ctx.arc(dimens / 2, dimens / 2, (dimens / 2) - padding, startingPoint * Math.PI, currentPoint * Math.PI);
                _ctx.strokeStyle = color;
                _ctx.lineWidth = width;
                _ctx.lineCap = "round";
                _ctx.stroke();

                currentPoint += 0.1;

                if (currentPoint > pointValue) {
                    clearInterval(timer)
                }
            };

            timer = setInterval(_draw, 100);
        };

        window.addEventListener('scroll', () => {
            let wh = window.pageYOffset
            let mcw = c('.meus-cursos').offsetTop - c('.meus-cursos').offsetHeight

            if (wh >= mcw && !contou) {
                contou = true
                cs('.meus-cursos .status-number').forEach(curso => {
                    let start = 0
                    let number = curso.innerHTML
                    let decimal = 0
                    let seconds = number / 10

                    let options = {
                        useEasing: true,
                        useGrouping: true,
                        separator: ',',
                        decimal: '.',
                    };
                    let demo = new CountUp(curso, start, number, decimal, seconds, options);
                    if (!demo.error) {
                        demo.start();
                    } else {
                        console.error(demo.error);
                    }
                })
            }
        })

        window.addEventListener('load', () => {
            let cursos = cs('.meus-cursos .curso')
            let cursosh = cs('.cursos-h .curso')

            cursos = [...cursos, ...cursosh]

            cursos.forEach(curso => {
                let statusBar = curso.querySelector('.status-bar')
                let porcentagem = statusBar.getAttribute('data-porcentagem')
                statusBar.style.backgroundSize = `${porcentagem}%`
            })
        })

        c('.modal').addEventListener('click', async (event) => {
            if (event.target.classList[0] === 'modal') {
                event.target.classList.remove('show')
                await sleep(150)
                c('.modal').style.display = ''
                c('.modal-header').innerHTML = ''
                c('.modal-body').innerHTML = ''
                c('.modal-footer').innerHTML = ''
            }
        })
        
        c('.modal').show = async () => {
            c('.modal').classList.add('show')
            await sleep(150)
            c('.modal').style.display = 'grid'
        }

        c('.modal').close = async () => {
            c('.modal').classList.remove('show')
            await sleep(150)
            c('.modal').style.display = ''
            c('.modal-header').innerHTML = ''
            c('.modal-body').innerHTML = ''
            c('.modal-footer').innerHTML = ''
        }

        function adquirirCurso(curso) {
            let modalHeader = c('.modal-header')
            let modalBody = c('.modal-body')
            let modalFooter = c('.modal-footer')

            let h1 = document.createElement('h1');
            let h1Text = document.createTextNode('Efetuar compra')
            h1.appendChild(h1Text)
            modalHeader.appendChild(h1)

            let table = `<table>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                </tr>

                <tr>
                    <td>
                        <p>${curso.nome}</p>
                        <small>${curso.descricao}</small>
                    </td>
                    <td>
                        <strong>${curso.valor}</strong> SIHBCoins
                    </td>
                </tr>

                <tr>
                    <td align='right'>
                        <strong>Valor total:</strong>
                    </td>
                    <td>
                        <strong>${curso.valor}</strong> SIHBCoins
                    </td>
                </tr>
            </table>`
            modalBody.innerHTML = table

            let cancelar = document.createElement('button');
            cancelar.setAttribute('onclick',  `c('.modal').close()`)
            cancelar.classList.add('cancelar-compra')
            let cancelarText = document.createTextNode('Cancelar')
            cancelar.appendChild(cancelarText)

            let comprar = document.createElement('a');
            comprar.setAttribute('href',  `${BASE}cursos/comprar/${curso.id}`)
            comprar.classList.add('comprar-curso')
            let comprarText = document.createTextNode('Comprar')
            comprar.appendChild(comprarText)

            modalFooter.appendChild(cancelar)
            modalFooter.appendChild(comprar)

            
            c('.modal').show()
        }

        var player;

        function setarPlayer(videoID) {
            if (videoID) {
                player = new YT.Player('player', {
                    height: '290',
                    width: '440',
                    videoId: videoID,
                    playerVars: {
                        modestbranding:1,
                        rel:0
                    },
                    events: {
                    'onStateChange': onPlayerStateChange
                    }
                });
            }
        }


        async function openCourse(course) {
            let modalBody = c('.modal-body')

            let url = `${BASE}cursos/getCurso`
            let params = {
                method: 'POST',
                body: JSON.stringify({
                    course
                })

            }            
            const response = await fetch(url, params)

            if (response.ok) {
                let infos = await response.text();
                
                if (infos.length) {
                    modalBody.innerHTML = infos
                    // 3. This function creates an <iframe> (and YouTube player)
                    //    after the API code downloads.
                    let videoID = c('.modal-body .curso #player').getAttribute('data-videoId');
                    
                    await sleep(1000)
                    setarPlayer(videoID)
                    c('.modal').show()
                }
			}
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        async function onPlayerStateChange({data}) {
            if(data === 0) {
                let curso = parseInt(c('.modal-body .curso').getAttribute('data-cursoid'))
                let aula = parseInt(c('.modal-body .curso').getAttribute('data-cursoAulaId'))
                let url = `${BASE}cursos/marcarVisto`
                let params = {
                    method: 'POST',
                    body: JSON.stringify({
                        curso,
                        aula
                    })
                }            
                const response = await fetch(url, params)

                if (response.ok) {
                    c('.modal-body .curso .infos .proximos ul li.atual').classList.add('assistida');
                }
            };
        }

        function cursosProximos(params) {
            let width = (c('.meus-cursos .curso').offsetWidth + 10)
            let widthCursos = c('.meus-cursos .cursos').scrollWidth;

            let atual = parseInt(c('.meus-cursos .curso').style.marginLeft) || 0
            let total = atual + (width)

            if (total <= 0) {
                c('.meus-cursos .curso').style.marginLeft = `${total}px`
            } else {
                let number = cs('.meus-cursos .cursos .curso').length * 231 - 241;
                c('.meus-cursos .curso').style.marginLeft = `-${number}px`
            }
            
        }

        function cursosAnteriores(params) {
            let width = (c('.meus-cursos .curso').offsetWidth + 10) * -1
            let widthCursos = cs('.meus-cursos .cursos .curso').length * (235 + 10) - 235;

            let atual = parseInt(c('.meus-cursos .curso').style.marginLeft) || 0
            let total = atual + width

            if (total >= (widthCursos * -1)) {
                c('.meus-cursos .curso').style.marginLeft = `${total}px`                
            } else {
                c('.meus-cursos .curso').style.marginLeft = `0px`    
            }

        }

        async function proximaAula (aulaId) {
            c('.modal-body .curso .infos .proximos ul li.atual').classList.remove('atual');
            c(`.modal-body .curso .infos .proximos ul li#aula${aulaId}`).classList.add('atual');
            let videoID = c(`.modal-body .curso .infos .proximos ul li#aula${aulaId}`).getAttribute('data-videoId')

            c('.modal-body .curso .video').innerHTML = '<div id="player"></div>'

            await sleep(1000)
            setarPlayer(videoID)
            await sleep(1000)
        }

    </script>
    <script src="<?php echo BASE; ?>assets/js/fuckadblock.min.js" integrity="sha256-xjwKUY/NgkPjZZBOtOxRYtK20GaqTwUCf7WYCJ1z69w="></script>

</body>

</html>