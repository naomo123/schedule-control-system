<?php
require_once 'Dao.php';
class Pago extends Dao
{
    public function get($id = '')
    {
        $query = '';
        if ($id  == '') {
            $query = "CALL sp_getPaymentsAll()";
            $result = $this->get_query($query);
        } else {
            $query = "CALL sp_getPayments(?)";
            $result = $this->get_query($query, 's', array($id));
        }
        return $result;
    }
    public function set($object = array())
    {
        extract($object);
        $query = "CALL sp_setPayment(?,?,?,?,?,?,?)";
        return $this->set_query($query, 'sssdddd', array($idUsuario, $idTipoPago, $fechaPago, $monto, $isss, $renta, $montoFinal));
    }

    //TODO: SHOULD change
    public function update()
    {
    }
    public function delete()
    {
    }
}
