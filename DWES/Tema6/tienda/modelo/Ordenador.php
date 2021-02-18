<?php
require_once("Producto.php");

class Ordenador extends Producto {
	protected $procesador;
	protected $ram;
	protected $disco;
	protected $grafica;
	protected $unidadoptica;
	protected $so;
	protected $otros;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo,$valor) {
        $this->$atributo=$valor;
    }

	public function __construct($row) {
		parent::__construct($row);
		$this->procesador = $row['procesador'];
		$this->ram = $row['RAM'];
		$this->disco = $row['disco'];
		$this->grafica = $row['grafica'];
		$this->unidadoptica = $row['unidadoptica'];
		$this->so = $row['SO'];
		$this->otros = $row['otros'];
	}
}