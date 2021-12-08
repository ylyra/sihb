<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes">Configurações</a>
                <a href="<?php echo BASE; ?>perfil/alterar-email" class="last">Alterar E-mail</a>
            </div>

            <h2 class="titulo">Alterar E-mail</h2>

            <div style="padding:13px;font-size:13px;display: flex;justify-content: center;align-items: center;flex-direction: column;">
                <p class="text-center mb-10">Caso decida usar o seu e-mail o mesmo só será usado como uma facilitação caso você esqueça sua senha. Caso não queira que ele fique salvo mais basta atualizar esta página deixando o campo de e-mail em branco</p>

                <form action="<?php echo BASE; ?>form/alterarEmail" method="POST" style="width:100%;" />
                <div class="form-group" style="display:flex;flex-direction:column-reverse;">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Digite seu e-mail aqui..." value="<?php echo $registro['email']; ?>">
                    <label for="email" class="form-control">E-mail</label>
                </div>

                <button class="btn btn-block" style="width:185px;font-weight:bold;background:#1d9200;outline:0;">
                    Atualizar e-mail
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