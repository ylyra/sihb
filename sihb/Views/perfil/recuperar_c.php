<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/alterar-senha" class="last">Alterar Senha</a>
            </div>

            <h2 class="titulo">Alterar Senha</h2>

            <div style="padding:13px;font-size:13px;display: flex;justify-content: center;align-items: center;flex-direction: column;">

                <form action="<?php echo BASE; ?>login/alterarSenha" method="POST" style="width:100%;" />
                <div class="form-group" style="display:flex;flex-direction:column-reverse;">
                    <input type="password" name="senha1" id="senha1" class="form-control" placeholder="Digite sua nova senha aqui..." required>
                    <label for="senha1" class="form-control">Nova Senha</label>
                </div>

                <div class="form-group mt-10" style="display:flex;flex-direction:column-reverse;">
                    <input type="password" name="senha2" id="senha2" class="form-control" placeholder="Repita a sua nova senha aqui..." required>
                    <label for="senha2" class="form-control">Repita a Senha</label>
                </div>

                <div style="margin:0 auto;width:fit-content;margin-top:10px;margin-bottom:-10px;">
                    <?php $codigo = 'SIHB-' . rand(1000, 9999); ?>
                    <label onclick="copiarText()" id="codigo-text-label" class="tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="Clique para copiar"><?php echo $codigo; ?></label>

                    <input type="text" name="codigo" value="<?php echo $codigo; ?>" id="codigo_confirmacao" style="opacity: 0;">
                </div>

                <div>
                    <label for="copiei">
                        <input type="checkbox" name="copiei" id="copiei" required />
                        <span>Colei o código na minha missão do Habbo.</span>
                    </label>
                </div>

                <input type="hidden" name="nickname" value="<?php echo $nickname; ?>" />

                <button class="btn btn-block mt-15" style="width:185px;font-weight:bold;background:#1d9200;outline:0;">
                    Atualizar senha
                </button>
                </form>
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