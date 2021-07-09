<?php


namespace framework\database;


class Database
{
    protected $link = false;
    protected $sql;

    /**
     * Constructor, to connect to database, select database and set charset
     * @param $config string configuration array
     */
    public function __construct($config = array()){
        $host = isset($config['host'])? $config['host'] : 'localhost';
        $user = isset($config['user'])? $config['user'] : 'root';
        $password = isset($config['password'])? $config['password'] : '';
        $dbname = isset($config['dbname'])? $config['dbname'] : '';
        $port = isset($config['port'])? $config['port'] : '3306';
        $charset = isset($config['charset'])? $config['charset'] : 'utf8mb4';
        $this->link = mysqli_connect($host,$user,$password,$dbname,$port) or die('Database
    connection error');
        mysqli_set_charset($this->link, $charset) or die('Ошибка при загрузке набора символов utf8mb4');
    }

    public function query($sql){
        $this->sql = $sql;
        $str = $sql . "[". date("Y-m-d H:i:s") ."]" . PHP_EOL;
        file_put_contents("log.txt", $str,FILE_APPEND);
        $result = mysqli_query($this->sql,$this->link);
        if (! $result) {
            die(mysqli_error($this->link).'<br />Error SQL statement is'.$this->sql.'<br />');
        }
        return $result;
    }
}