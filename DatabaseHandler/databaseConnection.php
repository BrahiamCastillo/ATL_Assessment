<?php

class databaseConnection {
    public $db;

    function __construct()
    {
        $this->db = new mysqli("localhost","id18937708_root","w%kJy{WIy81~$43L","id18937708_atl_assessment");

        if($this->db->connect_error) {

            exit('Connection Issues');
        }
    }
}