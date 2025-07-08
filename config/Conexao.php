<?php 
class Conexao{
    public static function conectar(){
        $server = 'mysql:host=localhost; dbname=veterinaria;';
        $user = 'root';
        $password = '';

        try {
            $pdo = new PDO($server, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
            
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            exit();
        }

    }
}
?>