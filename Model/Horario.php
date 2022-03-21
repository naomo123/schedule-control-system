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
    public function get_actual()
    {
        $d = strtotime("now");
        $dw = date("N", $d);
        $query = "CALL sp_getSchedule(?)";
        $result = $this->get_query($query, 's', array($dw));
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
