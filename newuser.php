<?php
if (isset($_POST["register"])) {
    if (clean($_POST["password"]) !== clean($_POST["password2"])) {
        $confirmError = true;
    }
    else {
        $hostname = "db686893124.db.1and1.com";
        $database = "db686893124";
        $dbUsername = "dbo686893124";
        $dbPassword = "*****";

        $conn = mysqli_connect($hostname, $dbUsername, $dbPassword, $database) or die ("Error connecting to database.");

        $sql = "INSERT INTO users (username, password) VALUES ('" . clean($_POST["username"]) . "', '" . clean($_POST["password"]) . "')";

        $result = mysqli_query($conn, $sql);

        mysqli_close($conn);

        if ($result) {
            echo "<script type='text/javascript'>alert('New user created.');</script>";
        } else {
            $registerError = true;
        }
    }
}

function clean($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="login.css" rel="stylesheet">
</head>

<body class="text-center">

<form method="post" class="form-login">
    <?php
    if (isset($registerError)) {
        echo '<div class="alert alert-danger">Username already exists.</div>';
    }
    elseif (isset($confirmError)) {
        echo '<div class="alert alert-danger">Password and confirm password do not match.</div>';
    }
    ?>
  <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
  <input type="password" name="password" class="form-control" placeholder="Password" required>
  <input type="password" name="password2" class="form-control" placeholder="Confirm Password" required>
  <button name="register" class="btn btn-lg btn-outline-primary btn-block" type="submit">Create User</button>
  <p class="mt-5 mb-3 text-muted"><a href="index.php">Return to Login</a></p>
  <p class="text-muted">ducey@hawaii.edu</p>
</form>

</body>

</html>