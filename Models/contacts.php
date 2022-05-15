<?php

require_once 'phone_number.php';

class Contacts {

    public $idcontact;
    public $name;
    public $last_name;
    public $email;
    public $contacts;

    public function mapData(

        $idcontact,
        $name,
        $last_name,
        $email = '0',
        $contacts = '0'
    ) {
        $this->idcontact = $idcontact;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->contacts = $contacts;
      
    }


}