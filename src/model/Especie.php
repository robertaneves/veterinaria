<?php 
class Especie{
    public $codigoEspecie;
    public $nomeEspecie;

    function __construct($codigoEspecie = null, $nomeEspecie = null){
        $this->codigoEspecie = $codigoEspecie;
        $this->nomeEspecie = $nomeEspecie;
    }
}

?>