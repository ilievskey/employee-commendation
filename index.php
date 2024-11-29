<?php
require 'db_connection.php';

session_start();
//require 'auth_check.php';

$categories = ['Makes Work Fun' => 'mwf', 'Team Player' => 'tp', 'Culture Champion' => 'cc', 'Difference Maker' => 'dm'];
$leaders = [];

foreach ($categories as $name => $column) {
    $stmt = $conn->prepare("SELECT fullname, $column AS count FROM users WHERE $column > 0 ORDER BY $column DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $leaders[$name] = $result->fetch_assoc();
}

$stmt = $conn->prepare("SELECT fullname, votes_given FROM users WHERE votes_given > 0 ORDER BY votes_given DESC LIMIT 5");
$stmt->execute();
$active_users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
                    <a class="nav-link" href="vote.php">Vote!</a>
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
    <div class="container">
        <div class="row gap-1 justify-content-center">
            <?php foreach ($leaders as $category => $leader): ?>
            <div class="card col-md-6">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($category); ?></h2>
                    <?php if ($leader): ?>
                    <p class="card-text">
                        <?= htmlspecialchars($leader['fullname']); ?><br>
                        <small><?= $leader['count']; ?> commendations</small>
                    </p>
                    <?php else: ?>
                    <p class="card-text text-muted">No commendations yet</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-5">
            <h3>Most commendations given away:</h3>
            <?php if (!empty($active_users)): ?>
                <ul class="list-group">
                    <?php foreach ($active_users as $user): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($user['fullname']); ?>
                            <span class="badge bg-primary rounded"><?= $user['votes_given']; ?> votes given</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No commendations given away yet.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>