<div style="background:linear-gradient(to bottom, transparent 0px, transparent 430px, #FFF 430px, #fff 100%);margin-top:10px;">
    <div id="radio-pesquisa" class="container pags">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div style="width: 730px;margin-right: 20px;" class="noticia">
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="width: 100%;" />

            <h2 class="titulo_noticia"><?php echo $noticia['titulo']; ?></h2>

            <div style="padding:13px;font-size:13px;">
                <?php echo $noticia['texto']; ?>
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

            <div class="detalhes_noticia">
                <h3>DETALHES</h3>

                <p>
                    Postado por: <br />
                    <span><?php echo $noticia['autor']; ?></span>
                </p>

                <p>
                    Categoria: <br />
                    <span><?php echo $noticia['categoria_nome']; ?></span>
                </p>

                <p>
                    Data e horário: <br />
                    <span><?php echo date('H:i \•\ d/m/Y', strtotime($noticia['data'])); ?></span>
                </p>

                <p>
                    <span><?php echo $noticia['total_comentarios']; ?> comentários</span>
                </p>
            </div>

            <div class="feedback_noticia">
                <h3>FEEDBACK</h3>

                <p>
                    <img src="https://i.imgur.com/W00XN28.png" alt="Star" />

                    <span class="nota"><?php echo number_format($noticia['media'], 1, ',', '.'); ?></span>

                    <span class="total"><?php echo $noticia['total_votos']; ?> avaliações</span>
                </p>
            </div>

        </div>
        <!-- ./RÁDIO, NAVEGAÇÃO RÁPIDA E LINKS -->
    </div>

    <div class="pt-30 pb-30 container comentarios-votacao">
        <div <?php echo ($acesso->isLogged() && $acesso->getInfo('confirmado') == 1) ? 'id="logado-comentarios"' : ''; ?>>
            <div class="comentarios">
                <div class="ordenacao">
                    <h3>COMENTÁRIOS (<?php echo $noticia['total_comentarios']; ?>)</h3>

                    <!-- <div class="ordenar">
                        <p>Ordenar por</p>
                        <button>
                            <img src="https://i.imgur.com/OfOfPmF.png" alt="Pessoa">
                        </button>

                        <button>
                            <img src="https://i.imgur.com/tp1zh3q.png" alt="Tempo">
                        </button>
                    </div> -->
                </div>

                <?php foreach ($noticia_comentarios as $comentario) : ?>
                    <div class="comentario" id="comentario-<?php echo $comentario['id']; ?>">
                        <div class="avatar">
                            <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $comentario['nickname']; ?>&action=std&direction=2&head_direction=2&gesture=sml&size=m" alt="" />
                            <a href="<?php echo BASE; ?>profile/<?php echo $comentario['nickname']; ?>" target="_blank">Perfil</a>
                        </div>
                        <div class="comentario-info">
                            <p><?php echo $comentario['comentario']; ?></p>

                            <div class="info">
                                <div>
                                    <a href="javascript:;">
                                        <i class="fa fa-user"></i>
                                        <?php echo $comentario['nickname']; ?>
                                    </a>

                                    <a href="javascript:;">
                                        <i class="fa fa-calendar"></i>
                                        <?php echo date('d/m/Y H:i\h', strtotime($comentario['data'])); ?>
                                    </a>
                                </div>

                                <?php if ($acesso->isLogged()) : ?>
                                    <?php if ($comentario['id_registro'] != $acesso->getInfo('id_registro')) : ?>
                                        <div class="botoes">
                                            <button <?php echo $noticias->verificarComentario($comentario['id'], $acesso->getInfo('id_registro'), $noticia['id'], 1); ?>>
                                                <i class="fa fa-thumbs-up"></i> <span><?php echo $comentario['likes']; ?></span>
                                            </button>
                                            <button <?php echo $noticias->verificarComentario($comentario['id'], $acesso->getInfo('id_registro'), $noticia['id'], 2); ?>>
                                                <i class="fa fa-thumbs-down"></i> <span><?php echo $comentario['deslikes']; ?></span>
                                            </button>
                                        </div>
                                    <?php else : ?>
                                        <div class="botoes">
                                            <button class="active">
                                                <i class="fa fa-thumbs-up"></i> <span><?php echo $comentario['likes']; ?></span>
                                            </button>
                                            <button class="active">
                                                <i class="fa fa-thumbs-down"></i> <span><?php echo $comentario['deslikes']; ?></span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="botoes">
                                        <button><i class="fa fa-thumbs-up"></i> <?php echo $comentario['likes']; ?></button>
                                        <button><i class="fa fa-thumbs-down"></i> <?php echo $comentario['deslikes']; ?></button>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (!$acesso->isLogged()) : ?>
                <div class="alerta-login">
                    <img src="https://i.imgur.com/Bc8Ny1h.png" alt="Alerta" />
                    <p>Você precisa <strong>logar em sua conta</strong> para comentar. Ainda não possui uma conta? <strong>Cadastre-se</strong> agora mesmo!</p>
                </div>
            <?php endif; ?>

            <?php if ($acesso->isLogged() && $acesso->getInfo('confirmado') == 0) : ?>
                <div class="alerta-verificacao">
                    <img src="https://i.imgur.com/PMzV7aZ.png" alt="Alerta" />
                    <p>Você precisa <strong>verificar sua conta</strong> para comentar nessa notícia. <a href="<?php echo BASE; ?>perfil/confirmar-conta" style="color:unset;text-decoration:none;"><strong>Clique aqui</strong></a> para prosseguir nesta etapa!</p>
                </div>
            <?php endif; ?>

            <?php if ($acesso->isLogged() && $acesso->getInfo('confirmado') == 1) : ?>
                <hr>
                <div class="comentar">
                    <form action="<?php echo BASE; ?>form/enviarComentario" method="POST">
                        <input type="hidden" name="noticia_id" value="<?php echo $noticia['id']; ?>" />
                        <input type="hidden" name="noticia_slug" value="<?php echo $noticia['slug']; ?>" />
                        <textarea name="comentar" id="comentar" placeholder="Deixei o seu comentário nesta notícia..."></textarea>
                        <?php echo $acesso->getInfo('confirmado'); ?>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <div class="ml-10 av">
            <?php if ($acesso->isLogged()) : ?>
                <div class="avalie">
                    <div class="avalie-body">
                        <h2>AVALIE ESSA NOTÍCIA</h2>

                        <p>Esta informação foi <br /> relevante para você? <br /> <strong>Avalie-nos!</strong></p>

                        <p style="position:absolute;bottom:20px;">Clique na sua nota</p>
                    </div>
                    <div class="avalie-footer">
                        <div class="avaliar-nota" <?php echo ($votei == 0) ? 'onmouseout="removerEstrelas()"' : ''; ?>>
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <button <?php echo ($votei == 0) ? 'onclick="votarNoticia(' . $noticia['id'] . ', ' . $i . ')" onmouseover="estrela(' . $i . ')"' : ''; ?>>
                                    <img src="<?php echo ($i <= $votei) ? 'https://i.imgur.com/W00XN28.png' : 'https://i.imgur.com/hHOja9j.png'; ?>" alt="Estrela">
                                </button>
                            <?php endfor; ?>
                        </div>

                        <p id="seu-voto"><?php echo $votei; ?>.0</p>
                    </div>
                </div>
            <?php endif; ?>


            <?php if (!$acesso->isLogged()) : ?>
                <div class="avalie-logue">
                    <img src="https://i.imgur.com/Bc8Ny1h.png" alt="Aviso" />

                    <p>
                        <span>Ainda não...</span><br />
                        Logue para avaliar
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>


<?php if ($acesso->isLogged() && $acesso->getInfo('confirmado') == 1) : ?>
    <style>
        #logado-comentarios {
            box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.6);
        }

        #logado-comentarios .comentarios,
        #logado-comentarios .comentar {
            box-shadow: unset !important;
        }
    </style>
<?php endif; ?>