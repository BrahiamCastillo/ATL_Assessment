<?php

require_once 'databaseConnection.php';
require_once 'Models\phone_number.php';
require_once 'Models\contacts.php';

class DatabaseFunctions {

    private $connection;

    function __construct()
    {
        $this->connection = new databaseConnection();
    }


    public function getPhoneNumbersById($id)
    {
        $list = array();
        $stm = $this->connection->db->prepare('Select * FROM phone_number where idcontact = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $list;
        } else {

            while ($row = $result->fetch_object()) {
                $phone_number = new Phone_Numer();

                $phone_number->mapData(
                    $row->idphone_number,
                    $row->idcontact,
                    $row->phone_number,
                );

                array_push($list, $phone_number);
            }

            $stm->close();
            return $list;
        }
    }

    public function getAllContacts()
    {
        $list = array();
        $stm = $this->connection->db->prepare('Select * FROM contacts');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $list;
        } else {

            while ($row = $result->fetch_object()) {
                $contact = new Contacts();

                $contact->mapData(
                    $row->idcontact,
                    $row->name,
                    $row->last_name,
                    $row->email,
                    $this->getPhoneNumbersById($row->idcontact)
                );

                array_push($list, $contact);
            }

            $stm->close();
            return $list;
        }
    }
}