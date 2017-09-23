<?php


class DB 
{
    protected $db_name = 'data4';
    protected $db_user = 'root';
    protected $db_pass = '';
    protected $db_host = 'localhost';
    public static $mysqli; 
    
    public function __construct() 
    { 
        self::$mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        
    } 

    public function select($table,$where,$num) 
    {
        $sql = "SELECT * FROM $table WHERE $where";
        $result = self::$mysqli->query($sql);
        $num_rows = $result->num_rows;
        
            if($num==0)
                {
                if($num_rows == 1)
                return $result->fetch_assoc();
                
                } else {
                return $num_rows;
            }

    }

    public function ChoseCountry()
    {
        $sql = "SELECT * FROM country";
        $result = self::$mysqli->query($sql);
        while($data = $result->fetch_assoc())
                {
                echo "<option value={$data['id']}>{$data['country']}</option>"; 
                }    
    }

    public function insert($table, $column, $value)
    {
        $sql= "INSERT INTO $table ($column) VALUES ($value)";
        return self::$mysqli->query($sql);
                        
     }
     
     
    public function filter($data)
    {     
        return trim(self::$mysqli->real_escape_string($data));
               
    }
	
	 

}
?>