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

    public function existsEmail($email = "")
    {
        $query = 'SELECT * FROM usuarios WHERE email = ?';
        $result = $this->get_query($query, 's', array($email));
        if (count($result) == 1)
            return $result[0];
        else
            return null;
    }

    public function get($id = '')
    {
        $query = '';
        if ($id  == '') {
            $query = "CALL sp_getUsers()";
            $result = $this->get_query($query);
        } else {
            $query = "CALL sp_getUser(?)";
            $result = $this->get_query($query, 's', array($id));
        }
        return $result;
    }

    public function signin($object = array())
    {
        extract($object);
        $query = 'CALL sp_signIn(?,?)';
        return $this->set_query($query, 'ss', array($code, $password));
    }

    public function set($object = array())
    {
        extract($object);
        $query = "CALL sp_setUser(?,?,?,?,?,?,?,?,?)";
        return $this->set_query($query, 'sssssssss', array($id, $positionId, $name, $lastName, $birthdate, $email, $telephone, $dui, $extraHours));
    }

    public function update($object = array())
    {
        extract($object);
        $query = "CALL sp_updateUser(?,?,?,?,?,?,?,?)";
        return $this->set_query($query, 'ssssssss', array($id, $positionId, $name, $lastName, $birthdate, $telephone, $dui, $extraHours));
    }

    public function delete($id = '')
    {
        $query = "DELETE FROM usuarios WHERE codigoUsuario=?";
        return $this->set_query($query, 's', array($id));
    }
}
