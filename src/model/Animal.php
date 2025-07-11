<?php 
    class Animal{
        public $codigoAnimal;
        public $nomeAnimal;
        public $dataAnimal;
        public $sexoAnimal;
        public $observacao;
        public $Especie;
        public $Tutor;

        function __construct($codigoAnimal = null, $nomeAnimal = null, $dataAnimal = null, $sexoAnimal = null, $observacao = null, Especie $especie = null, Tutor $tutor = null){
            $this->codigoAnimal = $codigoAnimal;
            $this->nomeAnimal = $nomeAnimal;
            $this->dataAnimal = $dataAnimal;
            $this->sexoAnimal = $sexoAnimal;
            $this->observacao = $observacao;
            $this->Especie = $especie; 
            $this->Tutor = $tutor;
     
        }
    }

?>