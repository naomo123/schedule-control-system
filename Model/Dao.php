<?php
abstract class Dao{
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $db_conn;
    function __construct()
    {
        $this->db_host = "localhost";
        $this->db_user = "root";
        $this->db_pass = "";
        $this->db_name = "schedule_control_system";
    }

    private function db_open(){
        $this->db_conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }
    private function db_close(){
        $this->db_conn->close();
    }
    protected function set_query($query, $types = null, $params = null){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->db_open();
        $stmt = $this->db_conn->prepare($query);
        if ($types != null && $params != null)
            $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $rowsAffected = $this->db_conn->affected_rows;
        $stmt->close();
        $this->db_close();
        return $rowsAffected;
    }
    protected function get_query($query, $types = null, $params = null){  
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);      
        $this->db_open();
        $stmt = $this->db_conn->prepare($query);
        if ($types != null && $params != null)
            $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=[];
        while($rows[] = $result->fetch_assoc());
        $stmt->close();
        $result->close();
        $this->db_close();
        array_pop($rows);
        return $rows;
    }
    abstract function get();
    abstract function set();
    abstract function delete();
    abstract function update();

}