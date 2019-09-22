<?php 
class CoreModel 
{
    protected $_server = "localhost";
    protected $_username = "root";
    protected $_password = "";
    protected $_connection = null;
    public function __construct()
    {
        $this->_connection = new mysqli($this->_server, $this->_username, $this->_password);
        $this->_connection->query("use test");
    }

    public function execute($query)
    {
        return $this->_connection->query($query);
    }

    public function GetArray(string $query){
        $result = $this->_connection->query($query);
        if(!$result)
        {
            return false;
        }
        $result_array = [];
        while($row = $result->fetch_assoc())
        {
            $result_array[] = $row;
        }
        return $result_array;
    }

    public function __destruct()
    {
        $this->_connection->close();
    }

}

?>