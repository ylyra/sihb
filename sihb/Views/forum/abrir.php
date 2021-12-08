

<div style="background:linear-gradient(to bottom, transparent 0px, transparent 55px, #FFF 55px, #fff 100%);margin-top:10px;">
    <div id="radio-forum" class="container">
        <!-- DESTAQUE SEMANAL E PESQUISA -->
        <div>
            <img src="https://i.imgur.com/5uHdpPr.png" alt="separador" style="margin-top:13px;" />
            
            <div class="infos">
                <?php if ($acesso->isLogged()): ?>
                    <div id="user">                        
                        <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $acesso->getInfo('nickname'); ?>&action=std&direction=2&head_direction=2&gesture=sml&size=m" alt="Avatar habbo">
            
                        <p>
                            Bem-vindo de volta,<br/>
                            <strong><?php echo strtoupper($acesso->getInfo('nickname')); ?></strong>
                        </p>
                    </div>

                    <div id="infos">
                        <div id="topicos">
                            <p class="numeros"><?php echo $totalMeusTopicos; ?></p>
                            <p class="tipo">tópicos</p>
                        </div>
                        <div id="respostas">
                            <p class="numeros"><?php echo $totalMinhasRespostas; ?></p>
                            <p class="tipo">respostas</p>
                        </div>
                        <div id="excluidos">
                            <p class="numeros"><?php echo $totalMeusExcluidos; ?></p>
                            <p class="tipo">excluídos</p>
                        </div>
                        <a href="<?php echo BASE; ?>forum/criar-topico" id="criar-topico">
                            <img src="https://i.imgur.com/hc3lXeR.png" alt="Pencil">
                            Criar tópico
                        </a>
                        <a href="<?php echo BASE; ?>perfil/configuracoes-forum" id="configuracoes-forum">
                            <img src="https://i.imgur.com/zvsy2u3.png" alt="Engrenagem">

                            Configurações do Fórum
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!$acesso->isLogged()): ?>
                    <div id="user">                        
                        <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=sihb&action=std&direction=2&head_direction=2&gesture=sml&size=m" alt="Avatar habbo">
            
                        <p>
                            Bem-vindo,<br/>
                            <strong>VISITANTE</strong>
                        </p>
                    </div>
                    <div id="alert">Faça login ou cadastre-se para comentar e ver suas informações no Fórum SIHB! =)</div>
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
        </div>
        <!-- ./RÁDIO, NAVEGAÇÃO RÁPIDA E LINKS -->
    </div>
    <div class="container" id="forum-content">
        <?php if ($topico['status'] == 1 || $topico['status'] == 2): ?>
            <div class="verificado">
                <p>Este tópico já <strong>foi verificado pela nossa moderação</strong> e pode ser apreciado por vocês. Aproveite!</p>
            </div>
        <?php endif; ?>
        <?php if ($topico['status'] == 0): ?>
            <div class="nao-verificado">
                <p>Este tópico ainda <strong>não foi verificado pela nossa moderação.</strong> Se houver algo ilegal, denuncie!</p>
            </div>
        <?php endif; ?>
        
        <?php if ($topico['status'] == 3): ?>
            <div class="fechado">
                <p>Este tópico <strong>foi fechado pela nossa moderação.</strong> Não é mais possível comentar nele!</p>
            </div>
        <?php endif; ?>

        <div class="forum-message">
            <div class="user">
                <p class="nickname"><?php echo $topico['autor']; ?></p>
                <p class="total-message"><?php echo intval($topico['total_msgsT'])+intval($topico['total_msgsF']); ?> mensagens</p>

                <div class="avatar" style="background:url('<?php echo $topico['avatar_forum']; ?>');">
                    <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $topico['autor']; ?>&action=std&direction=2&head_direction=2&gesture=sml&size=m" alt="Avatar no habbo" style="margin-bottom:5px;">

                    <a href="<?php echo BASE; ?>profile/<?php echo $topico['autor']; ?>">
                        <img src="https://i.imgur.com/E5veMJ5.png" alt="User">
                        Perfil
                    </a>
                </div>

                <div class="cargo">
                    <?php echo strtoupper($topico['cargo']); ?>
                </div>
                
                <div class="emblemas">
                    <?php foreach ($loja->getEmblemas($topico['autor_id'], 8) as $emblema): ?>
                        <div class="emblema tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="<?php echo $emblema['msg']; ?>"><img src="<?php echo $emblema['img']; ?>" alt="<?php echo $emblema['msg']; ?>"></div>
                    <?php endforeach; ?>               
                </div>
            </div>
            <div class="message">
                <div class="message-info">
                    <div class="img">
                        <img src="https://i.imgur.com/arHYU33.png" alt="Balão">
                    </div>
                    <div class="info">
                        <p class="por">
                            Criado por <strong><?php echo $topico['autor']; ?></strong> em <strong><?php echo date('d/m/Y', strtotime($topico['data'])); ?></strong> às <strong><?php echo date('H:i', strtotime($topico['data'])); ?></strong>
                        </p>
                        
                        <p class="titulo">
                            <?php echo strtoupper($topico['titulo']); ?>
                        </p>
                    </div>
                </div>
                <div class="area">                    
                    <?php echo $topico['texto']; ?>
                </div>   

                <div class="assinatura">
                    <img src="https://i.imgur.com/7BASbc4.png" alt="Assinatura" />

                    <div class="mt-5"><?php echo $topico['descricao_forum']; ?></div>
                </div>

                <?php if ($acesso->isLogged()): ?>
                    <button class="denuncie">
                        <img src="https://i.imgur.com/jGSj8bi.png" alt="Denuncie" />
                        Denunciar
                    </button>                
                <?php endif; ?>
                
            </div>
        </div>

        <?php foreach ($comentarios as $comentario): ?>
            <div class="forum-message">
                <div class="user">
                    <p class="nickname"><?php echo $comentario['nickname']; ?></p>
                    <p class="total-message"><?php echo intval($comentario['total_msgsT'])+intval($comentario['total_msgsF']); ?> mensagens</p>

                    <div class="avatar" style="background:url('<?php echo $comentario['avatar_forum']; ?>');">
                        <img src="https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $comentario['nickname']; ?>&action=std&direction=2&head_direction=2&gesture=sml&size=m" alt="Avatar no habbo" style="margin-bottom:5px;">

                        <a href="<?php echo BASE; ?>profile/<?php echo $comentario['nickname']; ?>">
                            <img src="https://i.imgur.com/E5veMJ5.png" alt="User">
                            Perfil
                        </a>
                    </div>

                    <div class="cargo">
                        <?php echo strtoupper($comentario['cargo']); ?>
                    </div>
                    
                    <div class="emblemas">
                        <?php foreach ($loja->getEmblemas($comentario['id_registro'], 8) as $emblema): ?>
                            <div class="emblema tooltipped" data-toggle="tooltip" data-position="bottom" data-tooltip="<?php echo $emblema['msg']; ?>"><img src="<?php echo $emblema['img']; ?>" alt="<?php echo $emblema['msg']; ?>"></div>
                        <?php endforeach; ?>                  
                    </div>
                </div>
                <div class="message">
                    <div class="message-info">
                        <div class="img">
                            <img src="https://i.imgur.com/arHYU33.png" alt="Balão">
                        </div>
                        <div class="info">
                            <p class="por">
                                Respondido por <strong><?php echo $comentario['nickname']; ?></strong> em <strong><?php echo date('d/m/Y', strtotime($comentario['data'])); ?></strong> às <strong><?php echo date('H:i', strtotime($comentario['data'])); ?></strong>
                            </p>
                            
                            <p class="titulo">
                                RE: <?php echo strtoupper($topico['titulo']); ?>
                            </p>
                        </div>
                        <?php if (!$uteis->temCitacao($comentario['comentario']) && $acesso->isLogged()): ?>
                            <button class="citar" data-citacao="[citar][nickname]CITAR <?php echo $comentario['nickname']; ?>[/nickname][msg]<?php echo $comentario['comentario']; ?>[/msg][/citar]" onclick="citarComentario(this)">
                                <img src="https://i.imgur.com/Xve44Gu.png" alt="Quote">
                                Citar
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="area">
                        <?php echo nl2br($uteis->replaceBBcodes($comentario['comentario'])); ?></p>
                    </div>   

                    <div class="assinatura">
                        <img src="https://i.imgur.com/7BASbc4.png" alt="Assinatura" />

                        <div class="mt-5"><?php echo $comentario['descricao_forum']; ?></div>
                    </div> 
                    
                    <?php if ($acesso->isLogged()): ?>
                        <button class="denuncie">
                            <img src="https://i.imgur.com/jGSj8bi.png" alt="Denuncie" />
                            Denunciar
                        </button>                
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="enviar-msg">
            <?php if ($topico['status'] != 3 && $acesso->isLogged()): ?>
                <form action="<?php echo BASE; ?>form/comentarTopico" method="POST" >
                    <input type="hidden" name="id_topico" value="<?php echo $topico['id']; ?>">
                    <input type="hidden" name="slug_topico" value="<?php echo $topico['slug']; ?>">
                    <textarea name="envie_msg" id="envie_msg" placeholder="Deixe o seu comentário neste tópico..."></textarea>
                    <input type="reset" value="Limpar" />
                    <input type="submit" value="Enviar resposta" />
                </form>
            <?php endif; ?>

            <div class="paginas">
                <?php $pagAnterior = $currentPage-1; ?>
                <?php $pagProxima = $currentPage+1; ?>
                <?php if ($currentPage > 1): ?>
                    <a href="<?php echo BASE; ?>forum/abrir/<?php echo $topico['id']; ?>/<?php echo $topico['slug']; ?>/?p=<?php echo $pagAnterior; ?>" id="anterior"><i class="fa fa-arrow-left"></i></a>
                <?php else: ?>
                    <a href="javascript:;" id="anterior"><i class="fa fa-arrow-left"></i></a> 
                <?php endif; ?>
                
                <p>Página <?php echo $currentPage; ?> de <?php echo( $numeroDePaginas == 0)?'1':$numeroDePaginas; ?></p>

                <?php if ($numeroDePaginas > 1 && $currentPage != $numeroDePaginas): ?>
                    <a href="<?php echo BASE; ?>forum/abrir/<?php echo $topico['id']; ?>/<?php echo $topico['slug']; ?>/?p=<?php echo $pagProxima; ?>" id="proxima"><i class="fa fa-arrow-right"></i></a>
                <?php else: ?>
                    <a href="javascript:;" id="anterior"><i class="fa fa-arrow-right"></i></a> 
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>