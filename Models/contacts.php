<?php

require_once 'phone_number.php';

class Contacts {

    public $idcontact;
    public $name;
    public $last_name;
    public $email;
    public $contacts;

    public function mapData(

       $object,
       $contacts
    ) {
        $this->idcontact = $object->idcontact;
        $this->name = $object->name;
        $this->last_name = $object->last_name;
        $this->email = $object->email;
        $this->contacts = $contacts;
      
    }


}