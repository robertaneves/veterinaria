<?php 

class Tratamento{
    public $codigoTratamento;
    public $nomeTratamento;
    public $descricaoTratamento;

    public function __construct($codigoTratamento = null, $nomeTratamento = null, $descricaoTratamento = null){
        $this->codigoTratamento = $codigoTratamento;
        $this->nomeTratamento = $nomeTratamento;
        $this->descricaoTratamento = $descricaoTratamento;
    }

}
?>