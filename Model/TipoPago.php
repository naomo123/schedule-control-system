<?php
require_once 'Dao.php';
class TipoPago extends Dao
{
    public function get($id = '')
    {
        $query = "SELECT * FROM tipopagos";
        $result = $this->get_query($query);
        return $result;
    }
    public function set($object = array())
    {
    }

    //TODO: SHOULD change
    public function update()
    {
    }
    public function delete()
    {
    }
}
