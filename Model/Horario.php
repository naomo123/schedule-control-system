<?php
require_once 'Dao.php';
class Horario extends Dao
{
    public function get($id = '')
    {
        $query = '';
        if ($id  == '') {
            $query = "SELECT * FROM horarios";
            $result = $this->get_query($query);
        } else {
            $query = "SELECT * FROM horarios WHERE idHorario = ?";
            $result = $this->get_query($query, 's', array($id));
        }
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

    public function set($object = array())
    {
        extract($object);
        $query = "CALL sp_setSchedule(?,?,?,?)";
        return $this->set_query($query, 'ssss', array($nombre, $horaInicio, $horaFin, implode(',',$days)));
    }
    public function update($object = array())
    {
        extract($object);
        $query = "CALL sp_updateSchedule(?,?,?,?,?)";
        return $this->set_query($query, 'sssss', array($id, $nombre, $horaInicio, $horaFin, implode(',',$days)));
    }
    public function delete($id = "")
    {
        $query = "DELETE FROM horarios WHERE idHorario=?";
        return $this->set_query($query, 'i', array($id));
    }
}
