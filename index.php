<?php
session_start();

if (isset($_POST["login"])) {
    $hostname = "db686893124.db.1and1.com";
    $database = "db686893124";
    $dbUsername = "dbo686893124";
    $dbPassword = "*****";

    $conn = mysqli_connect($hostname, $dbUsername, $dbPassword, $database) or die ("Error connecting to database.");

    $sql = "SELECT * FROM users WHERE username='" . clean($_POST["username"]) . "' AND password='" . clean($_POST["password"]) . "'";

    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    mysqli_close($conn);

    if ($resultCheck === 1) {
        $_SESSION["username"] = clean($_POST["username"]);
        header('location: menu.html');
    } else {
        $loginError = true;
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
    if (isset($loginError)) {
        echo '<div class="alert alert-danger">Invalid username or password.</div>';
    }
    ?>
  <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
  <input type="password" name="password" class="form-control" placeholder="Password" required>
  <button name="login" class="btn btn-lg btn-outline-primary btn-block" type="submit">Log in</button>
  <p class="mt-5 mb-3 text-muted"><a href="newuser.php">Create New User</a></p>
  <p class="text-muted">ducey@hawaii.edu</p>
</form>

</body>

</html>