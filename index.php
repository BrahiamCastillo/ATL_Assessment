<?php

require_once 'DatabaseHandler\databaseFunctions.php';

$con = new DatabaseFunctions();

$list = $con->getAllContacts();

$listEncdeo = json_encode($list);

echo $listEncdeo;

