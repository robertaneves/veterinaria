<?php 

require_once(__DIR__ . '/../../config/Conexao.php');

class EspecieController{

    private $pdo;
    public function __construct(){
        $this->pdo = Conexao::conectar();
    }

    public function cadastrarEspecie($nomeEspecie){
        try {
            $sqlEspecie = 'INSERT INTO especie (nome_especie) VALUES (?)';
            $stmtEspecie = $this->pdo->prepare($sqlEspecie);
            $sucessoEspecie = $stmtEspecie->execute([$nomeEspecie]);
            return $sucessoEspecie;
        } catch (PDOException $e) {
            error_log('Erro: ' . $e->getMessage());
        }
    }
}
    
    ?>