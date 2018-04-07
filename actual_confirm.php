<?php
if (isset($_GET['email'])) {
    $header = null;
    $msg = null;
    $e_type = $_GET["e_type"];

    if ($e_type === 'amber_alert') {
        $msg = "There has been an amber alert issued for the state of Hawai'i. Keep an eye out for kidnapped kids.";
        $header = "There has been an amber alert issued for the state of Hawai'i.";
    } elseif ($e_type === 'high_surf') {
        $msg = "There is a high surf advisory for the state of Hawai'i. Please surf responsibly.";
        $header = "There is a high surf advisory for the state of Hawai'i";
    } elseif ($e_type === 'missile') {
        $msg = "Ballistic Missile Threat Inbound to Hawaii. Seek shelter immediately.";
        $header = "Ballistic Missile Threat Inbound to Hawaii.";
    } elseif ($e_type === 'tsunami') {
        $msg = "There is likely a tsunami on route to the state of Hawai'i. Move inland towards higher ground.";
        $header = "Tsunami Warning declared for the state of Hawai'i.";
    }

    $msg .= " This is not a test.";
    mail("jeremy21@hawaii.edu, isio@hawaii.edu, ducey@hawaii.edu", $header, $msg);
}
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
<body class="actual-alert" onload="findGetParameter('e_type')">
<div class="row">
  <div class="col-md-3">
    <img class="alert-sign" src="icons/alert_sign.png">
  </div>
  <div class="col-md-6 header-box">
    <h1 class="text-center" style="font-weight: bold">ALERT EXECUTED</h1>
  </div>
  <div class="col-md-3">
    <img class="alert-sign float-right" src="icons/alert_sign.png">
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
        //console.log("icons/"+result+".png");
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

        /*TODO have e_type handled with m_icons in one array so less repeating code*/
        var passed_parameters = document.createElement("input");
        passed_parameters.type = "hidden";
        passed_parameters.id = "passed_params";
        passed_parameters.name= "e_type";
        passed_parameters.value = result;
        document.getElementById('execute_form').appendChild(passed_parameters);


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

            var passed_parameters = document.createElement("input");
            passed_parameters.type = "hidden";
            passed_parameters.id = "passed_params"+i;
            passed_parameters.name=medium[i];
            document.getElementById('execute_form').appendChild(passed_parameters);
        }

        return result;
    }
</script>

<div class="row form-group">
  <div class="col-md-4">
    <a href="menu.html"><img src="icons/back_arrow.png" style="height:72px"></a>
    <label>BACK TO MAIN MENU</label>
  </div>
  <div class="col-md-4">
    <form method="GET" role="form" id="execute_form">
      <div class="text-center">
          <button type="submit" class="false-button" onclick='this.form.action="false.html";'></button>
      </div>
    </form>
  </div>
  <div class="col-md-4"></div>
</div>

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