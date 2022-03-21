<?php
require_once 'Dao.php';
class Pago extends Dao
{
    public function get($id = '')
    {
        $query = "CALL sp_getPayments(?)";
        $result = $this->get_query($query, 's', array($id));
        return $result;
    }

    //TODO: SHOULD change
    public function set($object = array())
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
