<?php
namespace Models;

use \Core\Model;

class Cursos extends Model {

    public function getCursos()
    {       
        $array = [];

        $sql = $this->db->query("SELECT *, 
            (select count(*) from cursos_alunos where cursos_alunos.id_curso = cursos.id) as total_alunos, 
            (select count(*) from cursos_aulas where cursos_aulas.id_curso = cursos.id) as total_aulas
        FROM 
            cursos 
        ORDER BY id DESC");

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getCurso($id_curso)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *
        FROM 
            cursos 
        WHERE 
            id = :id");
        $sql->bindValue(':id', $id_curso);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();

            $array['aulas'] = $this->getAulas($id_curso);
        }

        return $array;
    }

    public function getAreas()
    {
        $array = [];

        $sql = $this->db->query("SELECT * 
        FROM 
            cursos_area 
        ORDER BY id DESC");

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getArea($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM cursos_area WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function addCurso($nome, $descricao, $id_area, $imagem, $cor, $valor, $vip)
    {
        $sql = $this->db->prepare("INSERT INTO cursos (id_area, nome, imagem, descricao, cor, modulo_nome, valor, vip) VALUES (:id_area, :nome, :imagem, :descricao, :cor, 'Modulo Único', :valor, :vip)");
        $sql->bindValue(':id_area', $id_area);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':imagem', $imagem);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':cor', $cor);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':vip', $vip);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function addArea($nome, $imagem, $cor)
    {
        $sql = $this->db->prepare("INSERT INTO cursos_area (nome, cor, imagem) VALUES (:nome, :cor, :imagem)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':cor', $cor);
        $sql->bindValue(':imagem', $imagem);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function adicionarAula($nome, $ordem, $video_url, $id_curso)
    {

        $this->updateOrdem($id_curso, $ordem);

        $sql = $this->db->prepare("INSERT INTO cursos_aulas (nome, id_modulo, id_curso, ordem) VALUES (:nome, 1, :id_curso, :ordem)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':id_curso', $id_curso);
        $sql->bindValue(':ordem', $ordem);
        $sql->execute();

        $id_aula = $this->db->lastInsertId();
        $this->addVideoAula($id_aula, $video_url);
    }

    public function darCurso($id_registro, $id_curso)
    {
        if (!$this->temCurso($id_registro, $id_curso)) {
            $sql = $this->db->prepare("INSERT INTO cursos_alunos (id_curso, id_registro, completo) VALUES (:id_curso, :id_registro, 0)");
            $sql->bindValue(':id_curso', $id_curso);
            $sql->bindValue(':id_registro', $id_registro);
            $sql->execute();
        }
    }

    public function editCurso($nome, $descricao, $id_area, $imagem, $cor, $valor, $vip, $id)
    {
        $sql = $this->db->prepare("UPDATE cursos SET id_area = :id_area, nome = :nome, imagem = :imagem, descricao = :descricao, cor = :cor, modulo_nome = 'Modulo Único', valor = :valor, vip = :vip WHERE id = :id");
        $sql->bindValue(':id_area', $id_area);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':imagem', $imagem);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':cor', $cor);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':vip', $vip);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function editArea($nome, $cor, $imagem, $id)
    {
        $sql = $this->db->prepare("UPDATE cursos_area SET nome = :nome, cor = :cor, imagem = :imagem WHERE id = :id");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':cor', $cor);
        $sql->bindValue(':imagem', $imagem);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function deletarCurso($id_curso)
    {
        $sql = $this->db->prepare("DELETE FROM cursos WHERE id = :id");
        $sql->bindValue(':id', $id_curso);
        $sql->execute();

        $this->deletarAlunos($id_curso);
        $this->deletarAulas($id_curso);
    }

    public function deletarAula($id_curso, $id_aula)
    {
        $sql = $this->db->prepare("DELETE FROM cursos_aulas WHERE id = :id AND id_curso = :id_curso");
        $sql->bindValue(':id', $id_aula);
        $sql->bindValue(':id_curso', $id_curso);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM cursos_historico WHERE id_aula = :id_aula AND id_curso = :id_curso");
        $sql->bindValue(':id_aula', $id_aula);
        $sql->bindValue(':id_curso', $id_curso);
        $sql->execute();
    }

    public function deletarArea($id_area)
    {
        $this->atualizarArea($id_area);

        $sql = $this->db->prepare("DELETE FROM cursos_area WHERE id = :id");
        $sql->bindValue(':id', $id_area);
        $sql->execute();
    }

    public function temCurso($id_registro, $id_curso)
    {
        $sql = $this->db->prepare("SELECT *
        FROM 
        cursos_alunos 
        WHERE 
            id_curso = :id_curso AND id_registro = :id_registro");
        $sql->bindValue(':id_curso', $id_curso);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    private function getAulas($id_curso)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select cursos_videos.url from cursos_videos where cursos_videos.id_aula = cursos_aulas.id) as videoUrl,
        (select count(*) from cursos_historico where cursos_historico.id_aula = cursos_aulas.id and cursos_historico.id_curso = cursos_aulas.id_curso) as views
        FROM 
        cursos_aulas 
        WHERE 
            id_curso = :id ORDER BY ordem");
        $sql->bindValue(':id', $id_curso);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    private function temVideoPosicao($id_curso, $ordem)
    {
        $sql = $this->db->prepare("SELECT *
        FROM 
        cursos_aulas 
        WHERE 
            id_curso = :id AND ordem = :ordem");
        $sql->bindValue(':id', $id_curso);
        $sql->bindValue(':ordem', $ordem);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    private function addVideoAula($id_aula, $url)
    {
        $sql = $this->db->prepare("INSERT INTO cursos_videos (id_aula, url) VALUES (:id_aula, :url)");
        $sql->bindValue(':id_aula', $id_aula);
        $sql->bindValue(':url', $url);
        $sql->execute();
    }

    private function updateOrdem($id_curso, $ordem)
    {
        if ($this->temVideoPosicao($id_curso, $ordem)) {
            $sql = $this->db->prepare("UPDATE cursos_aulas SET ordem = ordem + 1 WHERE id_curso = :id_curso AND  ordem >= :ordem1");
            $sql->bindValue(':id_curso', $id_curso);
            $sql->bindValue(':ordem1', $ordem);
            $sql->execute();
        }
    }

    public function atualizarArea($id_area)
    {
        $sql = $this->db->prepare("UPDATE cursos SET id_area = 0 WHERE id_area = :id_area");
        $sql->bindValue(':id_area', $id_area);
        $sql->execute();
    }

    private function deletarAlunos($id_curso)
    {
        $sql = $this->db->prepare("DELETE FROM cursos_alunos WHERE id_curso = :id");
        $sql->bindValue(':id', $id_curso);
        $sql->execute();
    }

    private function deletarAulas($id_curso)
    {
        $aulas = $this->getAulas($id_curso);

        foreach ($aulas as $aula) {
            $this->deletarAula($id_curso, $aula['id']);
            $this->deletarVideo($aula['id']);
        }
    }

    private function deletarVideo($id_aula)
    {
        $sql = $this->db->prepare("DELETE FROM cursos_videos WHERE id_aula = :id");
        $sql->bindValue(':id', $id_aula);
        $sql->execute();
    }
	
}
