<?php

/**
 * @author Chathura Widanage <chathurawidanage@gmail.com>
 *
 */
class DB {

    private $dsn = 'mysql:host=localhost;dbname=asl';
    private $username = 'root';
    private $password = 'davekuru1';
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    private $PDO;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->PDO = new PDO($this->dsn, $this->username, $this->password, $this->options);
    }

    public function query($qry) {
        //echo $qry;
        return $this->PDO->query($qry); //->fetchAll(PDO::FETCH_ASSOC);
        //return $this->PDO->lastInsertId();
    }

    public function queryIns($qry) {
        $this->PDO->query($qry);
        return $this->PDO->lastInsertId();
    }

}
