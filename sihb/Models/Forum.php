<?php

namespace Models;

use \Core\Model;
use \Models\Uteis;

class Forum extends Model
{

    // 0 = Sem revisão
    // 1 = Revisada
    // 2 = Fixada
    // 3 = Fechada
    // 4 = Deletada

    public function getTopicoById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *,
        (select count(*) from forum_comentarios where forum_comentarios.id_registro = forum.autor_id) as total_msgsT,
        (select count(*) from forum where forum.autor_id = forum.autor_id) as total_msgsF,
        (select patente_id from registros where registros.id = forum.autor_id) as cargo_id,
        (select nome from patentes where patentes.id = cargo_id) as cargo,
        (select avatar_forum from registros where registros.id = forum.autor_id) as avatar_forum,
        (select descricao_forum from registros where registros.id = forum.autor_id) as descricao_forum
        FROM forum 
        WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getRecentes()
    {
        $array = [
            'destaques' => $this->byStatus([2], 2),
            'outras' => $this->byStatus([0 => 0, 1 => 1, 2 => 2, 3 => 3], 4)
        ];
        return $array;
    }

    public function getSimilar($titulo)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 
            (select count(*) from forum_comentarios where forum_comentarios.id_topico = forum.id) as respostas 
            FROM forum 
            WHERE titulo LIKE :titulo AND status != 0 
            ORDER BY data DESC LIMIT 4");
        $sql->bindValue(':titulo', '%' . $titulo . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getByCat($tipo, $offset = 0, $limit = 4)
    {
        $array = [];
        $u = new Uteis();

        $sql = "SELECT *, (select count(*) from forum_comentarios where forum_comentarios.id_topico = forum.id) as respostas FROM forum";

        if ($tipo != 'all') {
            $sql .= " WHERE categoria = '$tipo'";
        }

        $sql .= " ORDER BY data DESC LIMIT $offset, $limit";

        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $a = $sql->fetchAll();

            foreach ($a as $b) {
                $array[] = [
                    'id' => $b['id'],
                    'slug' => $b['slug'],
                    'data' => $b['data'],
                    'titulo' => $b['titulo'],
                    'texto' => $b['texto'],
                    'autor' => $b['autor'],
                    'autor_id' => $b['autor_id'],
                    'categoria' => $b['categoria'],
                    'status' => $b['status'],
                    'respostas' => $b['respostas'],
                    'postado_a' => $u->diferenca($b['data'])
                ];
            }
        }

        return $array;
    }

    public function getTotalTopicos()
    {
        $array = [
            'total' => $this->countTopicos(),
            'regras' => $this->countTopicos('regras'),
            'boletins' => $this->countTopicos('boletins'),
            'duvidas' => $this->countTopicos('duvidas'),
            'sugestoes' => $this->countTopicos('sugestoes'),
            'outras' => $this->countTopicos('outras')
        ];
        return $array;
    }

    public function getComentariosForumById($offset, $limit, $id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 

        (select count(*) from forum_comentarios where forum_comentarios.id_registro = forum_comentarios.id_registro) as total_msgsT,
        (select count(*) from forum where forum.autor_id = forum_comentarios.id_registro) as total_msgsF,
        (select patente_id from registros where registros.id = forum_comentarios.id_registro) as cargo_id,
        (select nome from patentes where patentes.id = cargo_id) as cargo,
        (select avatar_forum from registros where registros.id = forum_comentarios.id_registro) as avatar_forum,
        (select descricao_forum from registros where registros.id = forum_comentarios.id_registro) as descricao_forum
        
        FROM forum_comentarios WHERE id_topico = :id LIMIT $offset, $limit");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotalComentariosForumById($id)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM forum_comentarios WHERE id_topico = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $row = $sql->fetch();

        return $row['c'];
    }

    public function totalMeusTopicos($id_registro)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM forum WHERE autor_id = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
        $sql = $sql->fetch();
        return ($sql['c'] >= 10) ? $sql['c'] : '0' . $sql['c'];
    }

    public function totalMinhasRespostas($id_registro)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM forum_comentarios WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
        $sql = $sql->fetch();
        return ($sql['c'] >= 10) ? $sql['c'] : '0' . $sql['c'];
    }

    public function totalMeusExcluidos($id_registro)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM forum WHERE autor_id = :id_registro AND 'status' = 4");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
        $sql = $sql->fetch();
        return ($sql['c'] >= 10) ? $sql['c'] : '0' . $sql['c'];
    }

    public function getTopicosByAutorId($id_registro)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM forum WHERE autor_id = :id_registro AND 'status' != 4 ORDER BY data DESC");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function meuTopico($id_topico, $id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM forum WHERE id = :id_topico AND autor_id = :id_registro AND 'status' != 4 ORDER BY data DESC");
        $sql->bindValue(':id_topico', $id_topico);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function addComentario($comentario, $id_topico, $id_registro, $nickname, $data, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO forum_comentarios (id_topico, id_registro, nickname, comentario, data) VALUES (:id_topico, :id_registro, :nickname, :comentario, :data)");
        $sql->bindValue(':id_topico', $id_topico);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':nickname', $nickname);
        $sql->bindValue(':comentario', $comentario);
        $sql->bindValue(':data', $data);
        $sql->execute();

        $id = $this->db->lastInsertId();
        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um novo comentário de #ID " . $id . ".";
        $l->addLog('forum_add', $msg);
    }

    public function addTopico($titulo, $slug, $categoria, $texto, $autor, $autor_id, $data, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO forum (slug, data, titulo, texto, autor, autor_id, categoria, status) VALUES (:slug, :data, :titulo, :texto, :autor, :autor_id, :categoria, 0)");
        $sql->bindValue(':slug', $slug);
        $sql->bindValue(':data', $data);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':texto', $texto);
        $sql->bindValue(':autor', $autor);
        $sql->bindValue(':autor_id', $autor_id);
        $sql->bindValue(':categoria', $categoria);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um novo tópico no fórum.";
        $l->addLog('forum_add', $msg);

        return $this->db->lastInsertId();
    }

    public function deleteTopico($id_topico, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE forum SET status = 4 WHERE id = :id");
        $sql->bindValue(':id', $id_topico);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou um tópico no fórum.";
        $l->addLog('forum_add', $msg);
    }

    private function byStatus($tipo, $limit)
    {
        $array = [];

        $sql = $this->db->query("SELECT *, (select count(*) from forum_comentarios where forum_comentarios.id_topico = forum.id) as respostas FROM forum WHERE status IN (" . implode(',', $tipo) . ") ORDER BY data DESC LIMIT $limit");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    private function countTopicos($tipo = '')
    {
        $array = [];

        $sql = "SELECT COUNT(*) as c FROM forum";

        if (!empty($tipo)) {
            $sql .= " WHERE categoria = '$tipo'";
        }

        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array['c'];
    }
}
