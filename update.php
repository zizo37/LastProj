<?php
require_once 'database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE customers SET name = ?, email = ?, mobile = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $email, $mobile, $id));
        Database::disconnect();
        header("Location: index.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Create Data!</title>
</head>

<body>
    <!--<h1>Hello, world!</h1>-->
    <!--<button type="button" class="btn btn-primary">Primary</button>-->
    <br><br>
    <div class="container">
        <div class="row">
            <h1>Update a Customer</h1>
        </div>
        <br>
        <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

            <div class="form-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
                <label class="control-label">Name</label>
                <div class="form-group">
                    <input class="form-control" name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : ''; ?>" style="width: 500px">
                    <?php if (!empty($nameError)) : ?>
                        <span class="help-inline text-danger"><?php echo $nameError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group <?php echo !empty($emailError) ? 'error' : ''; ?>">
                <label class="control-label">Email Address</label>
                <div class="form-group">
                    <input class="form-control" name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>" style="width: 500px">
                    <?php if (!empty($emailError)) : ?>
                        <span class="help-inline text-danger"><?php echo $emailError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group <?php echo !empty($mobileError) ? 'error' : ''; ?>">
                <label class="control-label">Mobile Number</label>
                <div class="form-group">
                    <input class="form-control" name="mobile" type="text" placeholder="Mobile Number" value="<?php echo !empty($mobile) ? $mobile : ''; ?>" style="width: 500px">
                    <?php if (!empty($mobileError)) : ?>
                        <span class="help-inline text-danger"><?php echo $mobileError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-dark" href="index.php">Back</a>
            </div>
        </form>
    </div> <!-- /container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>