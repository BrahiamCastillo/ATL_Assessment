<?php


require_once '..\DatabaseHandler\databaseFunctions.php';
require_once '..\Models\contacts.php';
require_once '..\Models\phone_number.php';

$con = new DatabaseFunctions();

/* Este request retorna a todos los contactos con sus respectivos números telefónicos */
if(isset($_GET['all'])) {

    if($_GET['all'] == "yes") {

        $list = $con->getAllContacts();
        $listAllContacts = json_encode($list);
        echo $listAllContacts;
    }
}

/* Este request retorna un contacto en específico por vía de su clave primaria*/
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $contact = $con->getContactByID($id);
    $contactEncode = json_encode($contact);
    echo $contactEncode;
}

/* Un case con requests POST para añadir contactos nuevos con un número telefónico, la validación para evitar datos vacíos se hizo desde la base de datos y 
se manejó la misma desde el controlador*/

if(isset($_POST['action'])) {

    switch ($_POST['action']) {
        case 'addContact':
            $newContact = new Contacts();
            $newContact->mapAddData(
            $_POST['name'],
            $_POST['last_name'],
            $_POST['email']
            );
            $response = $con->addContact($newContact,$_POST['phone_number']);
            echo $response;
            break;
        case 'addPhone':
            $response = $con->addNumberPhoneForContactID($_POST['idcontact'],$_POST['phone_number']);
            echo $response;
            break;
        case 'deleteContact':
            $response = $con->deleteContact($_POST['idcontact']);
            echo $response;
            break;
        case 'deletePhone':
            $response = $con->deletePhone($_POST['phone_number']);
            echo $response;
            break;
        default:
            echo 'Unavaible action';
            break;
    }
    
}
 