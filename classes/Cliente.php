<?php
class Cliente {
	private $_objetoBase;
	
	public function __construct($objBase)
	{
		$this->_objetoBase = $objBase;
	}
	
	public function getCliente($id)
	{
		$this->_objetoBase->query("SELECT * FROM `clientes` WHERE cliente_id = :cliente_id");
		$this->_objetoBase->bind(':cliente_id', $id);
		return $this->_objetoBase->single();
	}
	
	public function getClientes()
	{
		$this->_objetoBase->query("SELECT * FROM `clientes`");
		return $this->_objetoBase->resultset();
	}
	
	public function getClientesActivos()
	{
		$this->_objetoBase->query("SELECT * FROM `clientes` WHERE `fecha_baja` IS NULL");
		return $this->_objetoBase->resultset();
	}

	public function bajaCliente($id)
	{	
		$this->_objetoBase->query('UPDATE `clientes` SET fecha_baja = NOW() WHERE `cliente_id` = :id');
		$this->_objetoBase->bind(':id', $id);
		$this->_objetoBase->execute();
		return true;
	}

	public function insertarCliente($tabla, $datos)
	{
		$this->_objetoBase->insertar($tabla, $datos);
		return true;
	}

	public function actualizarCliente($tabla, $where, $datos)
	{
		$this->_objetoBase->actualizar($tabla, $where, $datos);
		return true;
	}

	public function eliminarCliente($tabla, $where)
	{
		$this->_objetoBase->eliminar($tabla, $where);
	}
}
?>