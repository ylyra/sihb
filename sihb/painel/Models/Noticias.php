<?php

namespace Models;

use \Core\Model;
use \Models\Uteis;

class Noticias extends Model
{

    // 0 = Sem revisão
    // 1 = Revisada
    // 2 = Fixada
    // 3 = Destacada

    public function getNoticias()
    {
        $array = [];
        $sql = "SELECT *, (select count(*) from noticias_views where noticias_views.id_noticia = noticias.id) as views FROM noticias ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getNoticiaById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 
            (select count(*) from noticias_comentarios where noticias_comentarios.id_noticia = noticias.id) as total_comentarios, 
            (select noticias_categorias.nome from noticias_categorias where noticias_categorias.id = noticias.categoria) as categoria_nome, 
            (select count(*) from noticias_avaliacoes where noticias_avaliacoes.id_noticia = noticias.id) as total_votos
        FROM noticias 
        WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getComentariosNoticiaById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 

        (select count(*) from noticias_avaliacoes_comentarios where noticias_avaliacoes_comentarios.id_noticia_comentario = noticias_comentarios.id and tipo = 1) as likes, 

        (select count(*) from noticias_avaliacoes_comentarios where noticias_avaliacoes_comentarios.id_noticia_comentario = noticias_comentarios.id and tipo = 2) as deslikes

        FROM noticias_comentarios WHERE id_noticia = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getComentariosNoticias()
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 

        (select count(*) from noticias_avaliacoes_comentarios where noticias_avaliacoes_comentarios.id_noticia_comentario = noticias_comentarios.id and tipo = 1) as likes, 

        (select count(*) from noticias_avaliacoes_comentarios where noticias_avaliacoes_comentarios.id_noticia_comentario = noticias_comentarios.id and tipo = 2) as deslikes, 

        (select noticias.slug from noticias where noticias.id = noticias_comentarios.id_noticia) as slug

        FROM noticias_comentarios ORDER BY id DESC");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotalNoticias($status = 9)
    {
        $sql = "SELECT COUNT(*) as c FROM noticias";
        if ($status != 9) {
            if ($status == 1) {
                $sql .= " WHERE status >= $status";
            } else {
                $sql .= " WHERE status = $status";
            }
        }
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }

    public function getTotalNoticiasDe($autor_id)
    {
        $sql = "SELECT COUNT(*) as c FROM noticias WHERE autor_id = :autor_id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':autor_id', $autor_id);
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }

    public function getCategorias()
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM noticias_categorias");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addCategoria($nome, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO noticias_categorias (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $nome);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " criou uma nova categoria com o nome " . $nome . ".";
        $l->addLog('noticiascat_add', $msg);
    }

    public function updateCriacao($id, $titulo, $slug, $subtitulo, $banner, $categoria, $texto, $autor, $autor_id, $status = 0, $ofc_nickname = '')
    {
        $data = date('Y-m-d H:i:s');
        $sql = $this->db->prepare("UPDATE noticias SET slug = :slug, data = :data, titulo = :titulo, subtitulo = :subtitulo, banner = :banner, texto = :texto, autor = :autor, categoria = :categoria, status = :status WHERE id = :id AND autor_id = :autor_id");
        $sql->bindValue(':slug', $slug);
        $sql->bindValue(':data', $data);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':subtitulo', $subtitulo);
        $sql->bindValue(':banner', $banner);
        $sql->bindValue(':texto', $texto);
        $sql->bindValue(':autor', $autor);
        $sql->bindValue(':categoria', $categoria);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':autor_id', $autor_id);
        $sql->execute();

        if (!empty($ofc_nickname)) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou a notícia de #ID " . $id . " .";
            $l->addLog('noticias_edit', $msg);
        }
    }

    public function delComentario($id, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE noticias_comentarios SET status = 1 WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou o comentário de #ID " . $id . " .";
        $l->addLog('noticiascoment_del', $msg);
    }

    public function updateCatNoticias($id)
    {
        $sql = $this->db->prepare("UPDATE noticias SET categoria = 0 WHERE categoria = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function criarNoticia($id_registro)
    {
        $this->db->query("INSERT INTO noticias (titulo, autor_id) VALUES ('', $id_registro)");

        return $this->db->lastInsertId();
    }

    public function deleteNoticia($id, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM noticias WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou a notícia de #ID " . $id . " .";
        $l->addLog('noticias_del', $msg);
    }

    public function delCategoria($id, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM noticias_categorias WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $this->updateCatNoticias($id);

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou a categoria de #ID " . $id . " .";
        $l->addLog('noticiascat_del', $msg);
    }

    private function buildWhere($filters)
    {
        $where = array(
            'status >= 1'
        );

        if (!empty($filters['pesquise_por'])) {
            $where[] = "titulo LIKE :pesquise_por OR texto LIKE :pesquise_por_texto";
        }

        if ($filters['categoria'] != 'all') {
            $where[] = "categoria = :categoria";
        }

        if (!empty($filters['data_de'])) {
            $where[] = "data >= :data_de";
        }

        if (!empty($filters['data_ate'])) {
            $where[] = "data <= :data_ate";
        }

        return $where;
    }

    private function bindWhere($filters, &$sql)
    {
        if (!empty($filters['pesquise_por'])) {
            $sql->bindValue(":pesquise_por", '%' . $filters['pesquise_por'] . '%');
            $sql->bindValue(":pesquise_por_texto", '%' . $filters['pesquise_por'] . '%');
        }

        if (!empty($filters['categoria'])) {
            $sql->bindValue(":categoria", $filters['categoria']);
        }

        if (!empty($filters['data_de'])) {
            $de = explode('/', $filters['data_de']);
            $data_de = $de[2] . '-' . $de[1] . '-' . $de[0];
            $sql->bindValue(":data_de", $filters['data_de']);
        }

        if (!empty($filters['data_ate'])) {
            $ate = explode('/', $filters['data_ate']);
            $data_ate = $ate[2] . '-' . $ate[1] . '-' . $ate[0];
            $sql->bindValue(":data_ate", $filters['data_ate']);
        }
    }
}
