<!--db conn-->

<?php
$host = 'localhost';
$db_name = 'employee_commendation';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $db_name);

if($conn->connect_error){
    die('connection terminated: '. $conn->connect_error);
}

?>