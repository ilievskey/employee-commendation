<?php

require 'auth_check.php';
require 'db_connection.php';

$stmt = $conn->prepare("SELECT id, fullname FROM users WHERE id != ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

$category_stmt = $conn->prepare("SELECT id, category_name FROM categories");
$category_stmt->execute();
$category_result = $category_stmt->get_result();
$categories = $category_result->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee commendation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Commends</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                if(isset($_SESSION['user_id'])):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="vote.php">Vote!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</a>
                    </li>
                <?php
                else:
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log in</a>
                    </li>
                <?php
                endif;
                ?>
            </ul>
        </div>
    </div>
</nav>
<main>
    <div class="p-4 m-4 d-flex flex-column">
        <form id="commendationForm" class="row g-3 d-flex flex-column align-items-center">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="col-md-6">
                <label for="nominee" class="form-label">Send commendation to:</label>
                <select class="form-select" id="nominee" name="nominee">
                    <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>">
                        <?php echo htmlspecialchars($user['fullname']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" id="category" name="category">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['category_name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="comment" class="form-label">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="6" placeholder="This employee absolutely deserved this award!"></textarea>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary">Commend</button>
            </div>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>