<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes-perfil">Configurações Perfil</a>
                <a href="<?php echo BASE; ?>perfil/alterar-nascimento" class="last">Alterar nascimento</a>
            </div>

            <h2 class="titulo">Alterar nascimento</h2>

            <div style="padding:13px;font-size:13px;display: flex;justify-content: center;align-items: center;flex-direction: column;">
                <p class="text-center mb-10">Altere a data do seu nascimento aqui, caso queira retirar a mesma envie o formulário em branco.</strong></p>

                <form action="<?php echo BASE; ?>form/alterarNascimento" method="POST" style="width:100%;" />
                    <div class="form-group" style="display:flex;flex-direction:column-reverse;">
                        <input type="text" name="data" id="data" class="form-control data_nascimento" placeholder="Exemplo: 11/05/2020" value="<?php echo(!empty($registro['nascimento']) && $registro['nascimento'] != '0000-00-00')?date('d/m/Y', strtotime($registro['nascimento'])):''; ?>">
                        <label for="data" class="form-control">Data Nascimento</label>
                    </div>

                    <button class="btn btn-block" style="font-weight:bold;background:#1d9200;outline:0;">
                        Atualizar nascimento
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
                    <li><a href="<?php echo BASE; ?>perfil/configuracoes">Configurações</a></li>
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