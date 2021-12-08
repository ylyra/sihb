<div style="background:linear-gradient(to bottom, transparent 0px, transparent 500px, #FFF 500px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>sobre">Sobre</a>
                <a href="<?php echo BASE; ?>sobre/estatuto" class="last">Estatuto</a>
            </div>

            <h2 class="titulo">Estatuto da SIHB</h2>

            <div style="padding:13px;font-size:13px;"><?php echo $texto['texto']; ?></div>
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

            <div class="relacionadas mt-10">
                <h4>PÁGINAS RELACIONADAS</h4>

                <ul>
                    <li><a href="<?php echo BASE; ?>sobre/historia">História</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/posicionamento">Posicionamento</a></li>
                    <li><a href="<?php echo BASE; ?>sobre/hierarquia">Hierarquia</a></li>
                    <!-- <li><a href="<?php echo BASE; ?>sobre/estatuto">Estatuto</a></li> -->
                    <li><a href="<?php echo BASE; ?>sobre/atos-normativos">Atos normativos</a></li>
                </ul>
            </div>

            <a href="<?php echo BASE; ?>cursos" class="btn-block" id="adicionais">
                <span>Consulte também</span>
                <strong>CURSOS</strong>
                <span>ADICIONAIS </span>
            </a>

            <a href="<?php echo BASE; ?>apostilas/blacklist" class="btn-block" id="blist">
                <span>Consulte também</span>
                <strong>
                    BLACK <span>LIST</span>
                </strong>

            </a>

        </div>
        <!-- ./RÁDIO, NAVEGAÇÃO RÁPIDA E LINKS -->
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

</div>