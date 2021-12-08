<div style="background:linear-gradient(to bottom, transparent 0px, transparent 380px, #FFF 380px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;padding:10px;" class="comum">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />
            <div class="breadcrumb">
                <a href="<?php echo BASE; ?>">Início</a>
                <a href="<?php echo BASE; ?>">Login</a>
                <a href="<?php echo BASE; ?>perfil/configuracoes">Configurações</a>
                <a href="<?php echo BASE; ?>forum/criar-topico" class="last">Criar Tópico</a>
            </div>

            <h2 class="titulo">Criar Tópico</h2>

            <div style="padding:13px;font-size:13px;display: flex;justify-content: center;align-items: center;flex-direction: column;">

                <form action="<?php echo BASE; ?>forum/publicarTopico" method="POST" enctype="multipart/form-data" style="width:100%;" />

                <div class="form-group mt-10" style="display:flex;flex-direction:column-reverse;">
                    <input type="text" name="topico_titulo" id="topico_titulo" placeholder="Digite o titulo do tópico" class="form-control" required />
                    <label for="topico_titulo" class="form-control">Escolha uma foto</label>
                </div>

                <div class="form-group mt-10" style="display:flex;flex-direction:column-reverse;">
                    <select name="topico_categoria" id="topico_categoria" class="form-control" required>
                        <option value="">Escolha uma categoria</option>
                        <option value="Regras">Regras</option>
                        <option value="Boletins">Boletins</option>
                        <option value="Dúvidas">Dúvidas</option>
                        <option value="Sugestões">Sugestões</option>
                        <option value="Outros">Outros</option>
                    </select>
                    <label for="topico_categoria" class="form-control">Categoria</label>
                </div>

                <div class="form-group mt-10">
                    <label for="texto">Tópico:</label>
                    <textarea name="texto" id="texto" class="texto"></textarea>
                </div>

                <button class="btn btn-block mt-15" style="width:185px;font-weight:bold;background:#1d9200;outline:0;">
                    Publicar tópico
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

<script src="https://cdn.tiny.cloud/1/wggjs4bncq8sk6p5rgbgk9bf31nvq758smbao3lv2kff4ds1/tinymce/5/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: ".texto",
        height: 400,
        menubar: false,
        plugins: [
            'textcolor image media lists code link'
        ],
        toolbar: 'undo redo | formatselect fontselect | bold italic forecolor backcolor link | media image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'
    });
</script>