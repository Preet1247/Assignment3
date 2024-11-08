<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <?php include "connection.php"; ?>
    <h1>Update record</h1>
    <?php
        $row = [];
        if (isset($_GET['update'])) {
            $id = $_GET['update'];
            $recordID = $connection->prepare("SELECT * FROM Assig3 WHERE id = ?");
            $recordID->bind_param("i", $id);
            if ($recordID->execute()) {
                $result = $recordID->get_result();
                $row = $result->fetch_assoc();
            } else {
                echo "<p>Error: " . $recordID->error . "</p>";
            }
        }

        if (isset($_POST['update'])) {
            $update = $connection->prepare("UPDATE Assig3 SET item=?, class=?, description=?, containment=?, image=? WHERE id=?");
            $update->bind_param("sssssi", $_POST['item'], $_POST['class'], $_POST['description'], $_POST['containment'], $_POST['image'], $_POST['id']);
            if ($update->execute()) {
                echo "<p>Record updated successfully</p>";
            } else {
                echo "<p>Error: " . $update->error . "</p>";
            }
        }
    ?>
    <form method="post" action="update.php" class="form-group">
        <input type of="hidden" name="id" value="<?php echo $row['id'] ?? ''; ?>">
        <input type="text" name="item" class="form-control" value="<?php echo $row['item'] ?? ''; ?>"><br>
        <input type="text" name="class" class="form-control" value="<?php echo $row['class'] ?? ''; ?>"><br>
        <textarea name="description" class="form-control"><?php echo $row['description'] ?? ''; ?></textarea><br>
        <input type="text" name="containment" class="form-control" value="<?php echo $row['containment'] ?? ''; ?>"><br>
        <input type="text" name="image" class="form-control" value="<?php echo $row['image'] ?? ''; ?>"><br>
        <input type="submit" name="update" value="Update Record" class="btn btn-primary">
    </form>
</body>
</html>
