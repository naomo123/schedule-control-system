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

    //TODO: SHOULD change
    public function get()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
