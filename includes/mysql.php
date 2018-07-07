<?php

class Mysql
{
    private $username = 'global_admin';
    private $password = 'tGn3KPDeScB8NABb';
    private $host = 'localhost';
    private $db = 'bf3mf';

    public $queries = 0;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        mysql_connect($this->host, $this->username, $this->password) or die('Error #1');
        mysql_select_db($this->db) or die('Error #2');
    }

    public function query($query, $escape = false, $error_die = false, $return_array = false)
    {
        $query = ($escape) ? addslashes($query) : $query;

        $result = mysql_query($query);
        if (!$result && $error_die) {
            die("Error #3");
        } elseif (!$result) {
            $return = array('error' => true, 'error_desc' => mysql_error());
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
        mysql_close();
    }

}
