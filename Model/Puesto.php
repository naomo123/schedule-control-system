<?php
require_once 'Dao.php';
class Puesto extends Dao
{
    public function get($id = '')
    {
        $query = "CALL sp_getPositions";
        $result = $this->get_query($query);
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
