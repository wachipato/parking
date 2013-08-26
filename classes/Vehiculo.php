<?php
class Vehiculo {
	private $_vehiculo_id;
	private $_clienteId;
	private $_tipoId;
	private $_lugarId;
	private $_matricula;
	private $_marca;
	private $_modelo;
	private $_color;
	private $_fAlta;
	private $_fBaja;
	private $_objetoBase;
	
	public function __construct($objBase)
	{
		$this->_objetoBase = $objBase;
	}
	
	public function getVehiculo($id)
	{
		$this->_objetoBase->query("SELECT * FROM `vehiculos` WHERE vehiculo_id = :vehiculo_id");
		$this->_objetoBase->bind(':vehiculo_id', $id);
		return $this->_objetoBase->single();
	}
	
	public function getVehiculos()
	{
		$this->_objetoBase->query("SELECT * FROM `vehiculos`");
		return $this->_objetoBase->resultset();
	}
	
	public function getVehiculosActivos()
	{
		$this->_objetoBase->query("SELECT * FROM `vehiculos` WHERE `fecha_baja` IS NULL");
		return $this->_objetoBase->resultset();
	}

	public function getNomClientePorVehiculo($cliente_id)
	{
		$this->_objetoBase->query("SELECT apellido, nombre FROM clientes c LEFT JOIN vehiculos v ON (v.cliente_id = c.cliente_id) WHERE c.cliente_id = ".$cliente_id." AND v.fecha_baja IS NULL");
		return $this->_objetoBase->single();
	}

	public function getTipoDeVehiculo($vehiculo_id)
	{
		$this->_objetoBase->query("SELECT t.nombre FROM tipos_de_vehiculo t LEFT JOIN vehiculos v ON (v.tipo_id = t.tipo_id) WHERE v.vehiculo_id = ".$vehiculo_id."");
		return $this->_objetoBase->single();
	}

	public function bajaVehiculo($id)
	{	
		$this->_objetoBase->query('UPDATE `vehiculos` SET fecha_baja = NOW() WHERE `vehiculo_id` = :id');
		$this->_objetoBase->bind(':id', $id);
		$this->_objetoBase->execute();
	}
	
	public function insertarVehiculo($tabla, $datos)
	{
		$this->_objetoBase->insertar($tabla, $datos);
	}

	public function actualizarVehiculo($tabla, $where, $datos)
	{
		$this->_objetoBase->actualizar($tabla, $where, $datos);
	}

	public function eliminarVehiculo($tabla, $where)
	{
		$this->_objetoBase->eliminar($tabla, $where);
	}
}
?>