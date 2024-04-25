<?php

// Connect to your MySQL database (change the database credentials)
$db = new mysqli('localhost', 'root', '', 'uovinfohubdb');

// Check the connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

?>