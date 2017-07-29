<?php

class Core {

    protected $result, $db;
    private $rows;
    private static $dsn = "mysql:host=localhost;dbname=chat";
    private static $user = "root";
    private static $password = "root";
    public $username;

    public function __construct()
    {
        $this->db = new PDO(self::$dsn,self::$user,self::$password);
    }

    public function query($sql){
        $this->result = $this->db->query($sql);

    }

    public function rows(){
        $this->rows = $this->result->fetchAll(PDO::FETCH_ASSOC);

        return $this->rows;

    }


}