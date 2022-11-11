<?php
class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "quanlynguoidung";

    private $conn = NULL;
    private $result = NULL;

    public function connect()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbName);
        if (!$this->conn) {
            echo "Kết nối db thất bại";
            exit();
        } else {
            mysqli_set_charset($this->conn, 'utf8');
        }
        return $this->conn;
    }

    public function execute($sql)
    {
        $this->result = $this->conn->query($sql);
        return $this->result;
    }

    public function getData()
    {
        if ($this->result) {
            $data = mysqli_fetch_array($this->result);
        } else {
            $data = null;
        }
        return $data;
    }

    public function getAllData()
    {
        $data = array();
        if (!$this->result) {
            $data = array();
        } else {
            while ($datas = $this->getData()) {
                $data[] = $datas;
            }
        }
        return $data;
    }
    
    public function countRow()
    {
        if ($this->result) {
            $data = mysqli_num_rows($this->result);
        } else {
            $data = 0;
        }
        return $data;
    }
}
?>