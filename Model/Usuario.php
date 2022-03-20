<?php
require_once 'Dao.php';
class Usuario extends Dao
{
    public function login($object = array())
    {
        extract($object);
        $query = 'CALL sp_login(?,?,?)';
        $result = $this->get_query($query, 'sss', array($username, $username, $password));
        if (count($result) == 1) {
            $_SESSION["user"] = $result[0];
            return true;
        } else {
            session_unset();
            return false;
        }
    }

    public function existsCode($id = "")
    {
        $query = 'SELECT * FROM usuarios WHERE codigoUsuario = ?';
        $result = $this->get_query($query, 's', array($id));
        if (count($result) == 1)
            return $result[0];
        else
            return null;
    }

    //TODO: SHOULD change
    public function get($id = '')
    {
        $query = '';
        if ($id  == '') {
            $query = 'SELECT * FROM autores';
            $result = $this->get_query($query);
        } else {
            $query = "SELECT * FROM autores WHERE codigo_autor = ?";
            $result = $this->get_query($query, 's', array($id));
        }
        array_pop($result);
        return $result;
    }
    public function set($object = array())
    {
        extract($object);
        $query = "INSERT INTO autores(codigo_autor, nombre_autor, nacionalidad)
            VALUES(?,?,?)";
        return $this->set_query($query, 'sss', array($codigo_autor, $nombre_autor, $nacionalidad));
    }
    public function update($object = array())
    {
        extract($object);
        $query = "UPDATE autores SET nombre_autor=?, nacionalidad=?
         WHERE codigo_autor=?";
        return $this->set_query($query, 'sss', array($nombre_autor, $nacionalidad, $codigo_autor));
    }
    public function delete($id = '')
    {
        $query = "DELETE FROM autores WHERE codigo_autor=?";
        return $this->set_query($query, 's', array($id));
    }
}
