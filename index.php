<?php
require_once 'database.php';

$pdo = Database::connect();
$sql = 'SELECT * FROM customers ORDER BY id DESC';
$q = $pdo->prepare($sql);
$q->execute();
$data = $q->fetchAll(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>PHP CRUD</h1>
        </div>
        <div class="row">
            <!-- ... (existing code) -->
        </div>
        <table class="table table-striped table-bordered" style="margin-top: 25px">
            <caption>List of Customers</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['mobile'] . '</td>';
                    echo '<td width=250>
                            <a class="btn btn-dark" href="read.php?id=' . $row['id'] . '">Read</a>
                            <a class="btn btn-success" href="update.php?id=' . $row['id'] . '">Update</a>
                            <a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>
                        </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- ... (existing code) -->
</body>

</html>
