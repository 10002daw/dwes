<?php

class Automovil {
    private $modelo;
    private $marca;
    private $cilindrada;
    private $numRuedas;

    public function __construct($modelo, $marca, $cilindrada) {
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->cilindrada = $cilindrada;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getCilindrada() {
        return $this->modelo;
    }

    public function getNumRuedas() {
        return $this->modelo;
    }

    public function __toString() {
        return "[".get_class($this).", $this->marca, $this->modelo, $this->cilindrada]";
    }
}

class Moto extends Automovil {
    public function __construct($modelo, $marca, $cilindrada) {
        parent::__construct($modelo, $marca, $cilindrada);
        $this->numRuedas = 2;
    }
}

class Coche extends Automovil {
    public function __construct($modelo, $marca, $cilindrada) {
        parent::__construct($modelo, $marca, $cilindrada);
        $this->numRuedas = 4;
    }
}

echo $automovil = new Automovil("Ténéré", "Yamaha", 1000);
echo $moto = new Moto("Ténéré", "Yamaha", 1000);
echo $coche = new Coche("Focus", "Ford", 1500);