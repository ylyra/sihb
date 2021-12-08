<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes-perfil">Configurações Perfil</a>
                <a href="<?php echo BASE; ?>perfil/alterar-amigos" class="last">Alterar Amigos</a>
            </div>

            <h2 class="titulo">Alterar Amigos</h2>

            <div style="padding:13px;font-size:13px;display: flex;justify-content: center;align-items: center;flex-direction: column;">

                <form action="<?php echo BASE; ?>form/alterarAmigos" method="POST" style="width:100%;" />
                <div class="form-group" style="display:flex;flex-direction:column-reverse;">
                    <input type="text" name="coracao" id="coracao" class="form-control" placeholder="Digite o nickname aqui..." value="<?php echo $amigos['coracao']; ?>" required >
                    <label for="coracao">
                        <img src="https://i.imgur.com/ybCH8Wc.png" alt="">
                    </label>
                </div>

                <div class="form-group" style="display:flex;flex-direction:column-reverse;">
                    <input type="text" name="feliz" id="feliz" class="form-control" placeholder="Digite o nickname aqui..." value="<?php echo $amigos['feliz']; ?>" required >
                    <label for="feliz">
                        <img src="https://i.imgur.com/vYz5zXj.png" alt="">
                    </label>
                </div>

                <div class="form-group" style="display:flex;flex-direction:column-reverse;">
                    <input type="text" name="money" id="money" class="form-control" placeholder="Digite o nickname aqui..." value="<?php echo $amigos['money']; ?>" required >
                    <label for="money">
                        <img src="https://i.imgur.com/ngINhiJ.png" alt="">
                    </label>
                </div>

                <button class="btn btn-block mt-15" style="font-weight:bold;background:#1d9200;outline:0;">
                    Atualizar amigos
                </button>
                </form>

                <style>
                    .form-group {
                        position: relative;
                    }

                    input.form-control {
                        padding-left: 45px;
                    }

                    label {
                        position: absolute;
                        left: 10px;
                    }
                </style>
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