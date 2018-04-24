<?php
$dbServername = "db686893124.db.1and1.com";
$dbUsername = "root";
$dbPassword = "";
$dbName = "db686893124";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die ("Error connecting to database.");

$sql = "'INSERT INTO users (username, password) VALUES ".$_POST["username"].", ".$POST_["password"].";'";

$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

//if successful goto index
if ($resultCheck > 0) {
    header('Location: https://www.bamboocalc.com/baboon-alert-system/index.html');
}
else {
    header('Location: https://www.bamboocalc.com/baboon-alert-system/newuser.html?error_create');
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



</body>


</html>