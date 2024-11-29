<?php

session_start();
require 'db_connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //alloc
    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    //mail validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, fullname, pass FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    //password check
    if($user && password_verify($password, $user['pass'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];

        echo json_encode(['success' => true]);
        exit();
    } else{
        echo json_encode(['success' => false, 'message' => 'Invalid credentials.']);
        exit();
    }

}
?>