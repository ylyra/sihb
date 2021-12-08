<?php if (in_array($tipo, [1, 2, 4, 5, 6, 9, 10, 11])) : ?>
    <form method="POST" action="<?php echo BASE; ?>relatorios/addRelatorio">
        <?php if ($tipo == 1) : ?>
            <input type="hidden" name="tipo" value="1" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Pessoa que fez o atendimento</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do atendente..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="responsavel">Executivo que comprova o ato</label>
                <select class="form-control" id="responsavel" name="responsavel" required>
                    <option value="">Escolha um executivo</option>
                    <?php foreach ($executivos as $executivo) : ?>
                        <option value="<?php echo $executivo['nickname']; ?>"><?php echo $executivo['nickname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="novato" class="form-label">Novato que foi atendido</label>
                <input id="novato" type="text" class="form-control" name="novato" placeholder="Nickname do novato..." required />
            </div>
        <?php elseif ($tipo == 2) : ?>
            <input type="hidden" name="tipo" value="2" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Pessoa que está fazendo</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do atendente..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="responsavel">Responsável por Supervisionar a DE</label>
                <select class="form-control" id="responsavel" name="responsavel" required>
                    <option value="">Escolha um executivo</option>
                    <?php foreach ($executivos as $executivo) : ?>
                        <option value="<?php echo $executivo['nickname']; ?>"><?php echo $executivo['nickname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="novato" class="form-label">Novato que foi levado a Sede</label>
                <input id="novato" type="text" class="form-control" name="novato" placeholder="Nickname do novato..." required />
            </div>
        <?php elseif ($tipo == 4) : ?>
            <input type="hidden" name="tipo" value="4" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="treinamento_tipo">Treinamento tipo</label>
                <select class="form-control" id="treinamento_tipo" name="treinamento_tipo" required>
                    <option value="">Escolha um treino</option>
                    <option value="Estagiários">Estagiários</option>
                    <option value="Agentes">Agentes</option>
                    <option value="Agentes Especiais">Agentes Especiais</option>
                    <option value="Agentes Seniores">Agentes Seniores</option>
                </select>
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Pessoa que Treinou</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do atendente..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="responsavel">Executivo Responsável</label>
                <select class="form-control" id="responsavel" name="responsavel" required>
                    <option value="">Escolha um executivo</option>
                    <?php foreach ($executivos as $executivo) : ?>
                        <option value="<?php echo $executivo['nickname']; ?>"><?php echo $executivo['nickname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="nicknames">
                <div class="row" style="align-items:flex-end;">
                    <div class="form-group col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                        <label for="nickname" class="col-form-label">Nickname</label>
                        <input id="nickname" type="text" class="form-control" name="nicksnames[]" placeholder="Nickname do membro..." required />
                    </div>

                    <div class="form-group col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                        <button class="btn btn-outline-success btn-block" type="button" onclick="addInput('nicknames')"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        <?php elseif ($tipo == 5) : ?>
            <input type="hidden" name="tipo" value="5" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Nickname do ajudante</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do ajudante..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="ajudado" class="form-label">Membro ajudado</label>
                <input id="ajudado" type="text" class="form-control" name="ajudado" placeholder="Nickname do membro ajudado..." required />
            </div>

            <div class="form-group">
                <label for="como">Como ajudou?</label>
                <select class="form-control" id="como" name="como" required>
                    <option value="">Escolha um opção</option>
                    <option value="Dúvidas Frequentes (FAQ's)">Dúvidas Frequentes (FAQ's)</option>
                    <option value="Tour pelos Quartos do SIHB">Tour pelos Quartos do SIHB</option>
                    <option value="Entrar no Discord">Entrar no Discord</option>
                </select>
            </div>

            <div class="form-group">
                <label for="onde">Onde ajudou?</label>
                <select class="form-control" id="onde" name="onde" required>
                    <option value="">Escolha um opção</option>
                    <option value="HelpDesk">HelpDesk</option>
                    <option value="Discord">Discord</option>
                </select>
            </div>
        <?php elseif ($tipo == 6) : ?>
            <input type="hidden" name="tipo" value="6" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="nickname" class="form-label">Nickname</label>
                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="Digite seu nickname aqui..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="sugestao" class="form-label">Sugestão</label>
                <textarea name="sugestao" id="sugestao" class="form-control"></textarea>
            </div>
        <?php elseif ($tipo == 9) : ?>
            <input type="hidden" name="tipo" value="9" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Nickname do professor</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do professor..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="ajudado" class="form-label">Membro</label>
                <input id="ajudado" type="text" class="form-control" name="ajudado" placeholder="Nickname do(s) membro(s)..." required />
            </div>

            <div class="form-group">
                <label for="como">Curso tipo</label>
                <select class="form-control" id="como" name="como" required>
                    <option value="">Escolha um opção</option>
                    <option value="Curso de Habbo Etiqueta (CHE)">
                        Curso de Habbo Etiqueta (CHE)
                    </option>
                    <option value="Curso de Propedêutica Jurídica (CPJ)">
                        Curso de Propedêutica Jurídica (CPJ)
                    </option>
                    <option value="Curso de Gestão Operacional (CGP)">
                        Curso de Gestão Operacional (CGP)
                    </option>
                    <option value="Curso de Reforço Ortográfico (CRO)">
                        Curso de Reforço Ortográfico (CRO)
                    </option>
                    <option value="Curso de Segurança Digital (CSD)">
                        Curso de Segurança Digital (CSD)
                    </option>
                    <option value="Curso de Finanças e Remunerações (CFR)">
                        Curso de Finanças e Remunerações (CFR)
                    </option>
                    <option value="Curso de Progressão no SIHB (CP)">
                        Curso de Progressão no SIHB (CP)
                    </option>
                    <option value="Programa de Incentivo ao Colaborador (PIC)">
                        Programa de Incentivo ao Colaborador (PIC)
                    </option>
                    <option value="Programa de Gestão de Carreira (PGC)">
                        Programa de Gestão de Carreira (PGC)
                    </option>
                </select>
            </div>
        <?php elseif ($tipo == 10) : ?>
            <input type="hidden" name="tipo" value="10" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Nickname do promotor</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do promotor..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="nicknames">
                <div class="row" style="align-items:flex-end;">
                    <div class="form-group col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                        <label for="nickname" class="col-form-label">Nickname(s) dos(as) vencedor(es)</label>
                        <input id="nickname" type="text" class="form-control" name="nicksnames[]" placeholder="Nickname do membro..." required />
                    </div>

                    <div class="form-group col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                        <button class="btn btn-outline-success btn-block" type="button" onclick="addInput('nicknames')"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="como">Evento tipo</label>
                <input id="como" type="text" class="form-control" name="evento_tipo" placeholder="Digite o tipo do evento" required />
            </div>

            <div class="form-group">
                <label for="premio">Prêmio</label>
                <input id="premio" type="number" class="form-control" name="premio" placeholder="Prêmio (Em SIHBCOINS)" required />
            </div>
        <?php elseif ($tipo == 11) : ?>
            <input type="hidden" name="tipo" value="11" />

            <div class="form-group">
                <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
            </div>

            <div class="form-group">
                <label for="atendente" class="form-label">Nickname do redator</label>
                <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do promotor..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
            </div>

            <div class="form-group">
                <label for="feedback" class="form-label">Nickname de quem deu feedback</label>
                <input id="feedback" type="text" class="form-control" name="feedback" placeholder="Nickname de quem deu feedback..." required />
            </div>

            <div class="form-group">
                <label for="como">Categoria</label>
                <select class="form-control" id="como" name="como" required>
                    <option value="">Escolha um opção</option>
                    <option value="Críticas">
                        Críticas
                    </option>
                    <option value="Sugestões">
                        Sugestões
                    </option>
                </select>
            </div>
        <?php endif; ?>

        <input type="submit" value="Enviar" class="btn btn-success btn-block" />
    </form>
<?php elseif ($tipo == 3) : ?>
    <h5>Relatório de Início</h5>
    <form method="POST" action="<?php echo BASE; ?>relatorios/addRelatorio">
        <input type="hidden" name="tipo" value="3" />

        <div class="form-group">
            <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
            <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
        </div>

        <div class="form-group">
            <label for="atendente" class="form-label">Membro realizando a atividade</label>
            <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do membro realizando a atividae..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
        </div>

        <div class="form-group">
            <label for="contas" class="form-label">Nickname das contas utilizadas</label>
            <input id="contas" type="text" class="form-control" name="contas" placeholder="Nickname das contas..." required />
        </div>

        <input type="submit" value="Enviar" class="btn btn-success btn-block" />
    </form><br /><br />

    <h5>Relatório de Término</h5>
    <form method="POST" action="<?php echo BASE; ?>relatorios/addRelatorio">
        <input type="hidden" name="tipo" value="7" />

        <div class="form-group">
            <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
            <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
        </div>

        <div class="form-group">
            <label for="atendente" class="form-label">Membro realizando a atividade</label>
            <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do membro realizando a atividade..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
        </div>

        <div class="form-group">
            <label for="contas" class="form-label">Nickname das contas utilizadas</label>
            <input id="contas" type="text" class="form-control" name="contas" placeholder="Nickname das contas..." required />
        </div>

        <div class="form-group">
            <label for="tempo" class="form-label">Tempo que ficou em Auto-Lotação</label>
            <input id="tempo" type="text" class="form-control" name="tempo" placeholder="Tempo que ficou em Auto-Lotação..." required />
        </div>

        <div class="form-group">
            <label for="responsavel">Executivo Responsável por Comprovar o Ato</label>
            <select class="form-control" id="responsavel" name="responsavel" required>
                <option value="">Escolha um executivo</option>
                <?php foreach ($executivos as $executivo) : ?>
                    <option value="<?php echo $executivo['nickname']; ?>"><?php echo $executivo['nickname']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="submit" value="Enviar" class="btn btn-success btn-block" />
    </form>
<?php elseif ($tipo == 8) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Você está tentando acessar um relatório que não tem permissão, os Executivos foram avisados sobre seu ato.
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>
<?php endif; ?>