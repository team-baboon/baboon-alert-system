<?php
session_start();

$radio = 0;
$tv = 0;
$mobile = 0;
$email = 0;

if (isset($_GET['radio'])) {
    $radio = 1;
}

if (isset($_GET['television'])) {
    $tv = 1;
}

if (isset($_GET['mobile'])) {
    $header = 'FALSE ALARM';
    $msg = null;
    $e_type = $_GET["e_type"];

    if ($e_type === 'amber_alert') {
        $msg = "There is no AMBER Alert.";
    } elseif ($e_type === 'high_surf') {
        $msg = "There is no high surf advisory.";
    } elseif ($e_type === 'missile') {
        $msg = "There is no missile threat.";
    } elseif ($e_type === 'tsunami') {
        $msg = "There is no tsunami inbound to Hawai'i.";
    }

    mail("8083139154@tmomail.net, 8089276781@vtext.com, 7578135980@tmomail.net", $header, $msg, "From: admin@bamboocalc.com");
    $mobile = 1;
}

if (isset($_GET['email'])) {
    $header = null;
    $msg = null;
    $e_type = $_GET["e_type"];

    if ($e_type === 'amber_alert') {
        $msg = "False alarm. There is no AMBER Alert.";
        $header = "False alarm. There is no AMBER Alert.";
    } elseif ($e_type === 'high_surf') {
        $msg = "False alarm. There is no high surf advisory.";
        $header = "False alarm. There is no high surf advisory.";
    } elseif ($e_type === 'missile') {
        $msg = "False alarm. There is no missile threat.";
        $header = "False alarm. There is no missile threat.";
    } elseif ($e_type === 'tsunami') {
        $msg = "False alarm. There is no tsunami inbound to Hawai'i.";
        $header = "False alarm. There is no tsunami inbound to Hawai'i.";
    }

    $msg .= " The previous warning was a false alarm.";
    mail("jeremy21@hawaii.edu, isio@hawaii.edu, ducey@hawaii.edu", $header, $msg);
    $email = 1;
}

$hostname = "db686893124.db.1and1.com";
$database = "db686893124";
$dbUsername = "dbo686893124";
$dbPassword = "*****";

$conn = mysqli_connect($hostname, $dbUsername, $dbPassword, $database) or die ("Error connecting to database.");

$sql = "INSERT INTO emergency_log (username, emergency, alert_type, radio, tv, mobile, email) VALUES ('" . $_SESSION["username"] . "', '" . $_GET["e_type"] . "', 'false', " . $radio . ", " . $tv . ", " . $mobile . ", " . $email . ")";

mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheet.css">
  <title>State of Hawai'i Emergency Alert System</title>
</head>

<body class="false-alarm" onload="findGetParameter('e_type')">

<div class="row">
  <div class="col-md-6 col-md-offset-3 header-box">
    <h1 class="text-center" style="font-weight: bold">FALSE ALARM EXECUTED</h1>
  </div>
</div>

<br/>

<div class="text-center text-uppercase container" id="e_icon"></div>

<br/>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row" id="m_icons"></div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<br/>

<div class="row form-group">
  <div class="col-md-4">
    <a href="menu.html"><img src="icons/back_arrow.png" style="height:72px"></a>
    <label>BACK TO MAIN MENU</label>
  </div>
</div>

<script type="text/javascript">
    function findGetParameter(e_type) {
        var result = null,
            tmp = [];
        var counter = 0;
        var medium =[];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === e_type) {
                    result = decodeURIComponent(tmp[1]);
                }

                if (tmp[0] === 'radio' || tmp[0] === 'television' || tmp[0] === 'mobile' || tmp[0] === 'email') {
                    medium[counter] = tmp[0];
                    counter++;
                }

            });
        var path = "icons/"+result+".png";
        var img = new Image();
        img.src = path;
        img.height = 250;
        document.getElementById('e_icon').appendChild(img);
        var h2 = document.createElement("h2");
        if (result.includes('_')) {
            h2.innerHTML = result.replace('_', ' ');
        }
        else {
            h2.innerHTML = result;
        }
        document.getElementById('e_icon').appendChild(h2);
        console.log(counter);

        for (var i = 0; i < counter; i++) {
            var col = document.createElement("div");
            col.classList.add("col-md-"+12/counter);
            col.classList.add('text-center');
            col.classList.add('text-capitalize');
            var img = new Image();
            img.height = 100;
            img.src = "icons/"+medium[i]+"_icon.png";
            col.appendChild(img);
            var h4 = document.createElement("h4");
            h4.innerHTML = medium[i];
            col.appendChild(h4);
            document.getElementById('m_icons').appendChild(col);
        }
        return result;
    }
</script>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</html>