<?php


require_once '..\DatabaseHandler\databaseFunctions.php';

$con = new DatabaseFunctions();

if(isset($_GET['all'])) {

    if($_GET['all'] == "yes") {

        $list = $con->getAllContacts();
        $listAllContacts = json_encode($list);
        echo $listAllContacts;
    }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $contact = $con->getContactByID($id);
    $contactEncode = json_encode($contact);
    echo $contactEncode;
}
 