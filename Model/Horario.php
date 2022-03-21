<?php
require_once 'Dao.php';
class Horario extends Dao
{
    public function get()
    {
        $query = "SELECT * FROM horarios";
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
