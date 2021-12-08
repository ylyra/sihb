<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes">Configurações</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes-forum" class="last">Configurações do Fórum</a>
            </div>

            <h2 class="titulo">CONFIGURAÇÕES</h2>

            <div style="padding:13px;font-size:13px;display: flex;flex-wrap: wrap;">
                <?php if ($acesso->getInfo('confirmado') == 1) : ?>
                    <a href="<?php echo BASE; ?>perfil/alterar-avatar" class="config-button" id="alterar-avatar">
                        Alterar avatar
                    </a>

                    <?php if (1 != 1) : ?>
                        <a href="<?php echo BASE; ?>perfil/alterar-missao" class="config-button" id="alterar-missao">
                            Alterar missao
                        </a>

                        <a href="<?php echo BASE; ?>perfil/alterar-facebook" class="config-button" id="alterar-facebook">
                            Alterar Facebook
                        </a>

                        <a href="<?php echo BASE; ?>perfil/alterar-instagram" class="config-button" id="alterar-instagram">
                            Alterar Instagram
                        </a>

                        <a href="<?php echo BASE; ?>perfil/meus-topicos" class="config-button" id="editar-topico">
                            Editar tópico
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo BASE; ?>forum/criar-topico" class="config-button" id="criar-topico">
                        Criar tópico
                    </a>

                    <a href="<?php echo BASE; ?>perfil/meus-topicos" class="config-button" id="deletar-topico">
                        Deletar tópico
                    </a>

                    <?php if ($acesso->getInfo('vip') == 1) : ?>
                        <a href="<?php echo BASE; ?>perfil/editar-descricao" class="config-button" id="criacao-perfil">
                            Adicionar<br /> descrição de perfil
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
                    <li><a href="<?php echo BASE; ?>perfil/configuracoes" class="active">Configurações</a></li>
                    <li class="active"><a href="<?php echo BASE; ?>perfil/configuracoes-forum">Fórum</a></li>
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