<?php 

require_once(__DIR__ . '/../../config/Conexao.php');


class TutorController{
    private $pdo;
    public function __construct(){
        $this->pdo = Conexao::conectar();
    }
    public function cadastrarTutor($nomeTutor, $telefoneTutor, $cpf, $endereco){
        try {
            $sqlTutor = 'INSERT INTO tutor (nome_tutor, telefone_tutor, cpf, endereco) VALUES (?, ?, ?, ?)';
            $stmtTutor = $this->pdo->prepare($sqlTutor);
            $sucessoTutor = $stmtTutor->execute([$nomeTutor, $telefoneTutor, $cpf, $endereco]);
            return $sucessoTutor;
        } catch (PDOException $e) {
            error_log('Erro: '. $e->getMessage());
        }
    }
}
?>