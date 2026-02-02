<?php 
$servername = 'localhost';
$user =  'root';
$password = '';
$db_name = 'alumni_db';

$conn = new mysqli($servername, $user, $password, $db_name) {
    if ($conn->connect_error) {
        die('Connection falied' : ($conn->connect_error));
    }
}
?>