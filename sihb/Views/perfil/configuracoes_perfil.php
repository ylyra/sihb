<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes">Configurações</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes-perfil" class="last">Configurações do Perfil</a>
            </div>

            <h2 class="titulo">CONFIGURAÇÕES PERFIL</h2>

            <div style="padding:13px;font-size:13px;display: flex;flex-wrap: wrap;">
                <a href="<?php echo BASE; ?>perfil/alterar-foto" class="config-button" id="alterar-foto">
                    Alterar foto
                </a>

                <?php if($acesso->getInfo('vip') == 1): ?>
                    <a href="<?php echo BASE; ?>perfil/alterar-amigos" class="config-button" id="alterar-amigos">
                        Alterar melhores amigos
                    </a>
                <?php endif; ?>

                <a href="<?php echo BASE; ?>perfil/remover-mensagens" class="config-button" id="remover-mensagens">
                    Remover mensagens
                </a>

                <a href="<?php echo BASE; ?>perfil/alterar-nascimento" class="config-button" id="alterar-real">
                    Alterar nascimento
                </a>
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
                    <li><a href="<?php echo BASE; ?>perfil/configuracoes" class="active">Configurações</a></li>
                    <li><a href="<?php echo BASE; ?>perfil/configuracoes-forum">Fórum</a></li>
                    <li class="active"><a href="<?php echo BASE; ?>perfil/configuracoes-perfil">Configurações do Perfil</a></li>
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

        <a href="" id="etiqueta">
            <strong>HABBO</strong>
            ETIQUETA
        </a>

        <a href="" id="sihb">
            <strong>SIHB</strong>
            <span>NOTÍCIAS</span>
        </a>

        <a href="" id="discord">
            <strong>DISCORD</strong>
            TUTORIAL
        </a>

    </div>

</div>