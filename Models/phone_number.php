<?php

class Phone_Numer {

    public $id_phoneNumber;
    public $id_contact;
    public $phone_number;

    public function mapData(

        $object
    ) {

        $this->id_phoneNumber = $object->idphone_number;
        $this->id_contact = $object->idcontact;
        $this->phone_number = $object->phone_number;

       
    }
}