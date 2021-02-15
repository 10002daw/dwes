<?php
class Ordenador {
	protected $cod;
	protected $procesador;
	protected $ram;
	protected $disco;
	protected $grafica;
	protected $unidadoptica;
	protected $so;
	protected $otros;
	protected $nombre_corto;
	protected $pvp;
	protected $descripcion;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo,$valor) {
        $this->$atributo=$valor;
    }

	public function __construct($row) {
		$this->cod = $row['cod'];
		$this->procesador = $row['procesador'];
		$this->ram = $row['RAM'];
		$this->disco = $row['disco'];
		$this->grafica = $row['grafica'];
		$this->unidadoptica = $row['unidadoptica'];
		$this->so = $row['SO'];
		$this->otros = $row['otros'];
		$this->nombre_corto = $row['nombre_corto'];
		$this->pvp = $row['PVP'];
		$this->descripcion = $row['descripcion'];
	}
}