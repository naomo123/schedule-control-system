<?php
require_once 'Dao.php';
class Puesto extends Dao
{
    public function get($id = '')
    {
        $query = '';
        if ($id  == '') {
            $query = "CALL sp_getPositions";
            $result = $this->get_query($query);
        } else {
            $query = "SELECT * FROM puestos WHERE idPuesto = ?";
            $result = $this->get_query($query, 's', array($id));
        }
        return $result;
    }

    public function set($object = array())
    {
        extract($object);
        $query = "INSERT INTO puestos(nombre, descripcion) VALUES(?,?)";
        return $this->set_query($query, 'ss', array($nombre, $descripcion));
    }
    public function update($object = array())
    {
        extract($object);
        $query = "UPDATE puestos SET nombre = ?, descripcion = ? WHERE idPuesto = ?";
        return $this->set_query($query, 'ssi', array($nombre, $descripcion, $idPuesto));
    }
    public function delete($id = "")
    {
        $query = "DELETE FROM puestos WHERE idPuesto=?";
        return $this->set_query($query, 's', array($id));
    }
}
