<?php

class Phone_Numer {

    public $id_phoneNumber;
    public $id_contact;
    public $phone_number;

    public function mapData(

        $id_phoneNumber,
        $id_contact,
        $phone_number
    ) {

        $this->id_phoneNumber = $id_phoneNumber;
        $this->id_contact = $id_contact;
        $this->phone_number = $phone_number;
    }
}