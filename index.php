<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCP CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <?php include "connection.php"; ?>
    <ul class="nav navbar-dark bg-dark">
        <?php foreach($result as $link): ?>
            <li class="nav-item">
                <a href="index.php?item=<?php echo $link['item']; ?>" class="nav-link text-light"><?php echo $link['item']; ?></a>
            </li>
        <?php endforeach; ?>
        <li class="nav-item">
            <a href="create.php" class="nav-link text-light">Create a new record</a>
        </li>
    </ul>

    <h1>SCP CRUD Application</h1>
    <?php
        if (isset($_GET['item'])) {
            $item = $_GET['item'];
            $stmt = $connection->prepare("SELECT * FROM Assig3 WHERE item = ?");
            $stmt->bind_param("s", $item);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $array = $result->fetch_assoc();
                    echo "<div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$array['item']}</h5>
                                <p class='card-text'>{$array['description']}</p>
                                <p><img src='{$array['image']}' alt='Image of {$array['item']}' class='img-fluid'></p>
                                <a href='update.php?update={$array['id']}' class='btn btn-primary'>Update</a>
                                <a href='index.php?delete={$array['id']}' class='btn btn-danger'>Delete</a>
                            </div>
                          </div>";
                } else {
                    echo "<p>No record found.</p>";
                }
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }
        }
    ?>
</body>
</html>
