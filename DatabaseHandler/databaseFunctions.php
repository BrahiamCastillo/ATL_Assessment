<?php

require_once 'databaseConnection.php';
require_once '..\Models\phone_number.php';
require_once '..\Models\contacts.php';

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
                   $row
                );

                array_push($list, $phone_number);
            }

            $stm->close();
            return $list;
        }
    }

    public function getPhoneNumbersByNumber($phone_number)
    {
        $list = array();
        $stm = $this->connection->db->prepare('Select * FROM phone_number where phone_number = ?');
        $stm->bind_param('s', $phone_number);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $list;
        } else {

            while ($row = $result->fetch_object()) {
                $phone_number = new Phone_Numer();

                $phone_number->mapData(
                   $row
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
                    $row,
                    $this->getPhoneNumbersById($row->idcontact)
                );

                array_push($list, $contact);
            }

            $stm->close();
            return $list;
        }
    }


    public function getContactByID($id)
    {

        $stm = $this->connection->db->prepare('Select * FROM contacts where idcontact = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $contact = new Contacts();

            $contact->mapData(
                $row,
                $this->getPhoneNumbersById($row->idcontact)
            );

            $stm->close();
            return $contact;
        }
    }

    public function addContact($contact,$phone_number)
    {

        $stm = $this->connection->db->prepare('insert into contacts(name,last_name,email) VALUES(?,?,?)');
        $stm->bind_param('sss', $contact->name, $contact->last_name, $contact->email);
        $stm->execute();
        if($this->connection->db->insert_id != null) {
            $this->addNumberPhoneForContactID($this->connection->db->insert_id,$phone_number);
            return '¡Contact added!';
        } else {

            return "Complete all fields";
        }
        
    }

    public function addNumberPhoneForContactID($contactID,$number)
    {

        $stm = $this->connection->db->prepare('insert into phone_number(idcontact,phone_number) VALUES(?,?)');
        $stm->bind_param('is', $contactID, $number);
        $stm->execute();
        if($this->connection->db->insert_id != null) {

            return '¡Phone number added!';
        } else {

            return "Complete all fields";
        }
    }

    public function deleteContact($id)
    {

        $stm = $this->connection->db->prepare('delete from contacts where idcontact = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
        if($this->getContactByID($id)->idcontact == null) {

            return '¡Contact deleted!';
        } else {

            return "Id unavaible";
        }
    }

    public function deletePhone($phone_number)
    {

        $stm = $this->connection->db->prepare('delete from phone_number where phone_number = ?');
        $stm->bind_param('s', $phone_number);
        $stm->execute();
        if($this-> getPhoneNumbersByNumber($phone_number)->id_phoneNumber == null) {

            return '¡Phone number deleted!';
        } else {

            return "Phone number unavaible";
        }
    }
}
