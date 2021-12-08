<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="">Início</a>
                <a href="">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes" class="last">Configurações</a>
            </div>

            <h2 class="titulo">CONFIGURAÇÕES</h2>

            <div style="padding:13px;font-size:13px;display: flex;flex-wrap: wrap;">
                <?php if ($acesso->getInfo('confirmado') != 1) : ?>
                    <a href="<?php echo BASE; ?>perfil/confirmar-conta" class="config-button" id="verificar-conta">
                        Verificar conta
                    </a>
                <?php endif; ?>

                <?php if ($acesso->getInfo('confirmado') == 1) : ?>
                    <a href="<?php echo BASE; ?>perfil/alterar-nome" class="config-button" id="alterar-real">
                        Alterar nome real
                    </a>

                    <a href="<?php echo BASE; ?>perfil/alterar-email" class="config-button" id="alterar-email">
                        Alterar e-mail
                    </a>

                    <a href="<?php echo BASE; ?>perfil/alterar-senha" class="config-button" id="alterar-senha">
                        Alterar senha
                    </a>

                    <a href="<?php echo BASE; ?>perfil/gerar-moedas" class="config-button" id="gerar-moedas">
                        Gerar sihbcoins
                    </a>

                    <a href="<?php echo BASE; ?>loja" class="config-button" id="loja-emblemas">
                        Loja
                    </a>

                    <?php if ($acesso->getInfo('vip') == 1) : ?>
                        <a href="javascript:;" class="config-button" id="vip">
                            <h3>CLUBE VIP</h3>
                            <?php
                            $data1 = date('Y-m-d', strtotime($acesso->getInfo('vip_data')));
                            $data2 = date('Y-m-d');
                            // converte as datas para o formato timestamp
                            $d1 = strtotime($data1);
                            $d2 = strtotime($data2);
                            // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
                            $dataFinal = ($d2 - $d1) / 86400;
                            // caso a data 2 seja menor que a data 1
                            if ($dataFinal < 0)
                                $dataFinal = intval($dataFinal * -1);
                            ?>
                            <p>Dias restantes: <?php echo number_format($dataFinal, 0, ',', '.'); ?></p>

                        </a>
                    <?php endif; ?>
                <?php endif; ?>
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

            <div class="relacionadas mt-10">
                <h4>MEU MENU</h4>

                <ul>
                    <li><a href="<?php echo BASE; ?>profile/<?php echo $acesso->getInfo('nickname'); ?>">Meu Perfil</a></li>
                    <li class="active"><a href="<?php echo BASE; ?>perfil/configuracoes">Configurações</a></li>
                    <li><a href="<?php echo BASE; ?>perfil/configuracoes-forum">Fórum</a></li>
                    <li><a href="<?php echo BASE; ?>perfil/configuracoes-perfil">Configurações do Perfil</a></li>
                </ul>
            </div>
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