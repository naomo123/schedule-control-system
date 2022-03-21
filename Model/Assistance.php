<?php
require_once 'Dao.php';
class Assistance extends Dao
{
    public function set($object = array())
    {
        extract($object);
        $query = "INSERT INTO asistencias(idUsuario, imagen) VALUES(?,?)";
        return $this->set_query($query, 'ss', array($id, $image));
    }

    public function get($id = '')
    {
        $query = "SELECT * FROM asistencias WHERE idAsistencia = ?";
        $result = $this->get_query($query, 's', array($id));
        return $result;
    }

    //TODO: SHOULD change
    public function update()
    {
    }
    public function delete()
    {
    }
}
