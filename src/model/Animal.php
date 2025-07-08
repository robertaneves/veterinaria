<?php 
    class Animal{
        public $codigoAnimal;
        public $nomeAnimal;
        public $dataNascimento;
        public $sexoAnimal;
        public $Especie;
        public $Tutor;

        function __construct($codigoAnimal = null, $nomeAnimal = null, $dataNascimento = null, $sexoAnimal = null, Especie $especie = null, Tutor $tutor = null){
            $this->codigoAnimal = $codigoAnimal;
            $this->nomeAnimal = $nomeAnimal;
            $this->dataNascimento = $dataNascimento;
            $this->sexoAnimal = $sexoAnimal;
            $this->Especie = $especie; 
            $this->Tutor = $tutor;
     
        }
    }

?>