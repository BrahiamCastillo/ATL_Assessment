<?php

class databaseConnection {
    public $db;

    function __construct()
    {
        $this->db = new mysqli("127.0.0.1","root","br4h14m123","atl_assessment");

        if($this->db->connect_error) {

            exit('Connection Issues');
        }
    }
}