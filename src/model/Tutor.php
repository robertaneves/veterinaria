<?php 
class Tutor{
    public $codigoTutor;
    public $nomeTutor;
    public $telefoneTutor;
    public $cpfTutor;
    public $enderecoTutor;

    public function __construct($codigoTutor = null, $nomeTutor = null, $telefoneTutor = null, $cpfTutor = null, $enderecoTutor = null){
        $this->codigoTutor = $codigoTutor;
        $this->nomeTutor = $nomeTutor;
        $this->telefoneTutor = $telefoneTutor;
        $this->cpfTutor = $cpfTutor;
        $this->enderecoTutor = $enderecoTutor;
    }
}
?>