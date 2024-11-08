<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <?php include "connection.php"; ?>
    <h1>Create a new record</h1>
    <form method="post" action="create.php" class="form-group">
        <input type="text" name="item" placeholder="Item..." class="form-control" required><br>
        <input type="text" name="class" placeholder="Class..." class="form-control" required><br>
        <textarea name="description" class="form-control" placeholder="Description..."></textarea><br>
        <input type="text" name="containment" placeholder="Containment..." class="form-control" required><br>
        <input type="text" name="image" placeholder="Image URL..." class="form-control"><br>
        <input type="submit" name="submit" value="Create" class="btn btn-primary">
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $insert = $connection->prepare("INSERT INTO Assig3 (item, class, description, containment, image) VALUES (?, ?, ?, ?, ?)");
            $insert->bind_param("sssss", $_POST['item'], $_POST['class'], $_POST['description'], $_POST['containment'], $_POST['image']);
            if ($insert->execute()) {
                echo "<p>Record successfully created</p>";
            } else {
                echo "<p>Error: " . $insert->error . "</p>";
            }
        }
    ?>
</body>
</html>
