<?php
class Pago {
	private $_pagoId;
	private $_vehiculo_id;
	private $_cliente_id;
	private $_monto;
	private $_fecha_pago;
	private $_objetoBase;
	
	public function __construct($objBase)
	{
		$this->_objetoBase = $objBase;
	}
	
	public function getPago($id)
	{
		$this->_objetoBase->query("SELECT * FROM `pagos` WHERE pago_id = :pago_id");
		$this->_objetoBase->bind(':pago_id', $id);
		return $this->_objetoBase->single();
	}
	
	public function getPagos()
	{
		$this->_objetoBase->query("SELECT * FROM `pagos`");
		return $this->_objetoBase->resultset();
	}
	
	public function insertarPago($tabla, $datos)
	{
		$this->_objetoBase->insertar($tabla, $datos);
	}

	public function actualizarPago($tabla, $where, $datos)
	{
		$this->_objetoBase->actualizar($tabla, $where, $datos);
	}

	public function eliminarPago($tabla, $where)
	{
		$this->_objetoBase->eliminar($tabla, $where);
	}
}
?>