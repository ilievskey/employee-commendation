<?php

require 'auth_check.php';
require 'db_connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nominee_id = $_POST['nominee'];
    $voter_id = $_POST['user_id'];
    $category_id = $_POST['category'];
    $comment = trim($_POST['comment']);

    if(empty($nominee_id) || empty($category_id) || empty($comment)){
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    if($nominee_id == $voter_id){
        echo json_encode(['success' => false, 'message' => 'Nice try. You cannot commend yourself!']);
        exit();
    }

    $stmt = $conn->prepare(
        "INSERT INTO votes (nominee_id, voter_id, category_id, comment, timestamp) VALUES (?, ?, ?, ?, NOW())"
    );
    $stmt->bind_param("iiis", $nominee_id, $voter_id, $category_id, $comment);

    if($stmt->execute()){
        echo json_encode(['success' => true, 'message' => 'Commendation submitted!']);
    } else{
        echo json_encode(['success' => false, 'message' => 'Failed to send commendation. Try again later.']);
    }
    exit();
}
?>