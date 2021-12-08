<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes-forum">Configurações Fórum</a>
                <a href="<?php echo BASE; ?>perfil/alterar-avatar" class="last">Alterar Avatar</a>
            </div>

            <h2 class="titulo">Alterar Avatar</h2>

            <div style="padding:13px;font-size:13px;display: flex;justify-content: center;align-items: center;flex-direction: column;">
                <p>O tamanho necessário de uma foto para o fórum é de 200x200px caso a sua foto tenha um tamanho superior a esse o sistema estará reduzindo de tamanho podendo perder a qualidade da imagem. A sua foto atual é:</p>
                <img src="<?php echo $registro['avatar_forum']; ?>" alt="">

                <form action="<?php echo BASE; ?>form/alterarAvatarForum" method="POST" enctype="multipart/form-data" style="width:100%;" />

                <div class="form-group mt-10" style="display:flex;flex-direction:column-reverse;">
                    <input type="file" name="avatar" id="avatar" class="custom-file-input" required accept="image/png, image/jpeg, image/jpg">
                    <label for="avatar" class="form-control">Escolha uma foto</label>
                    <style>
                        .custom-file-input {
                            color: transparent;
                            outline: 0;
                            width: -webkit-fill-available;
                            height: 37px;
                            overflow: hidden;
                            background: url(https://i.imgur.com/u3G2Uu9.png);
                            background-repeat: no-repeat;
                            background-position: 10px center;
                            margin-top: 5px;
                        }

                        .custom-file-input::-webkit-file-upload-button {
                            visibility: hidden;
                        }

                        .custom-file-input::before {
                            content: 'Anexar arquivo';
                            color: white;
                            width: -webkit-fill-available;
                            display: inline-block;
                            background: transparent;
                            border: 1px solid #333333;
                            border-radius: 3px;
                            padding: 12px 10px 12px 30px;
                            outline: none;
                            white-space: nowrap;
                            -webkit-user-select: none;
                            cursor: pointer;
                            font-size: 11px;
                        }

                        .custom-file-input:hover::before {
                            border-color: white;
                        }

                        .custom-file-input:hover+label {
                            color: #fff;
                        }

                        .custom-file-input:active {
                            outline: 0;
                            border-color: white;
                        }
                    </style>
                </div>

                <button class="btn btn-block mt-15" style="width:185px;font-weight:bold;background:#1d9200;outline:0;">
                    Atualizar avatar
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