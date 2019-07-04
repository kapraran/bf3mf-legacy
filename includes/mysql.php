<?php

class Mysql
{
    private $username = 'root';
    private $password = 'root';
    private $host = 'localhost';
    private $db = 'bf3mf';
    private $link;

    public $queries = 0;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->link = mysqli_connect($this->host, $this->username, $this->password) or die('Error #1');
        mysqli_select_db($this->link, $this->db) or die('Error #2');
    }

    public function query($query, $escape = false, $error_die = false, $return_array = false)
    {
        $query = ($escape) ? addslashes($query) : $query;

        $result = mysqli_query($this->link, $query);
        if (!$result && $error_die) {
            die("Error #3");
        } elseif (!$result) {
            $return = array('error' => true, 'error_desc' => mysqli_error($this->link));
        } else {
            $return = array('error' => false, 'resource' => $result);
        }

        if ($return_array) {
            $this->queries = $this->queries + 1;
            return $return;
        } elseif ($return['error']) {
            return false;
        } else {
            $this->queries = $this->queries + 1;
            return $result;
        }
    }

    public function unique($input, $type)
    {
        if (!isset($input) || !isset($type)) {
            return false;
        }

        global $MYSQL;
        $query = "SELECT * FROM clans WHERE $type = '$input'";
        $res = $MYSQL->query($query);

        if (!$res) {
            redirectHTML('error/1');
        }
        if (mysql_num_rows($res) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function close()
    {
        mysqli_close($this->link);
    }
}
