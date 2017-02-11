<?php
session_start();
 $servername = "mysql-vt2016.csc.kth.se";
 $username = "shamra_admin";
 $password = "rOVAeCpn";
 $database = "shamra";
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $_SESSION["lan"] = $_POST["lan"];
   $_SESSION["objekttyp"] = $_POST["objekttyp"];
   $_SESSION["minArea"] = $_POST["minArea"];
   $_SESSION["maxArea"] = $_POST["maxArea"];
   $_SESSION["minRum"] = $_POST["minRum"];
   $_SESSION["maxRum"] = $_POST["maxRum"];
   $_SESSION["minPris"] = $_POST["minPris"];
   $_SESSION["maxPris"] = $_POST["maxPris"];
   $_SESSION["minAvgift"] = $_POST["minAvgift"];
   $_SESSION["maxAvgift"] = $_POST["maxAvgift"];
   $orderColumn = 'pris';
   $order = "DESC";
 } else {
   $orderColumn = $_GET['sortit'];
   $order = $_GET['orderit'];
 }

 $query = "SELECT * FROM bostader WHERE lan = :lan AND objekttyp = :objekttyp AND area BETWEEN :minArea AND :maxArea AND rum BETWEEN :minRum AND :maxRum AND avgift BETWEEN :minAvgift AND :maxAvgift AND pris BETWEEN :minPris AND :maxPris ORDER BY $orderColumn $order";
 try {
   $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $preparedstmt = $conn->prepare($query);
   $preparedstmt->bindValue(':lan', $_SESSION["lan"], PDO::PARAM_STR);
   $preparedstmt->bindValue(':objekttyp', $_SESSION["objekttyp"], PDO::PARAM_STR);
   $preparedstmt->bindValue(':minArea', $_SESSION["minArea"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':maxArea', $_SESSION["maxArea"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':minRum', $_SESSION["minRum"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':maxRum', $_SESSION["maxRum"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':minPris', $_SESSION["minPris"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':maxPris', $_SESSION["maxPris"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':minAvgift', $_SESSION["minAvgift"], PDO::PARAM_INT);
   $preparedstmt->bindValue(':maxAvgift', $_SESSION["maxAvgift"], PDO::PARAM_INT);
   $preparedstmt->execute();
   $result = $preparedstmt->fetchAll();
  /*
   $cookies = array("lan", "objekttyp", "minArea", "maxArea", "minRum", "maxRum", "minPris", "maxPris", "minAvgift", "maxAvgift");
   foreach($cookies as $cookie) {
     setcookie($cookie, $_SESSION[$cookie], time()+ (60*15),"/");
   }
   */
   setcookie('lan', $_SESSION['lan'], time()+ (60*15),"/");
   setcookie('objekttyp', $_SESSION['objekttyp'], time()+ (60*15),"/");
   setcookie('minArea', $_SESSION['minArea'], time()+ (60*15),"/");
   setcookie('maxArea', $_SESSION['maxArea'], time()+ (60*15),"/");
   setcookie('minRum', $_SESSION['minRum'], time()+ (60*15),"/");
   setcookie('maxRum', $_SESSION['maxRum'], time()+ (60*15),"/");
   setcookie('minPris', $_SESSION['minPris'], time()+ (60*15),"/");
   setcookie('maxPris', $_SESSION['maxPris'], time()+ (60*15),"/");
   setcookie('minAvgift', $_SESSION['minAvgift'], time()+ (60*15),"/");
   setcookie('maxAvgift', $_SESSION['maxAvgift'], time()+ (60*15),"/");

   $headers = array("lan" => "Län", "objekttyp"=>"Objekttyp", "adress" => "Adress", "area" => "Area", "rum" => "Rum", "pris" => "Pris", "avgift" => "Avgift");

 } catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
 }
 ?>

<html>
 <head>
   <link href="index.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PHP Test</title>
 </head>
 <body>
   <div class="table-responsive">
   <table style="border: 0;"class="table table-bordered">
     <thead>
    <tr id="headers">
      <?php
      foreach ($headers as $header => $header_value) {
        if($orderColumn==$header) {
          if($order=="ASC") {
            echo "<th id=" . $header . ">" . $header_value . '<span class="glyphicon glyphicon-triangle-top"></span></th>';
          } else {
            echo "<th id=" . $header . ">" . $header_value . '<span class="glyphicon glyphicon-triangle-bottom"></span></th>';
          }
        } else {
          echo "<th id=" . $header . ">" . $header_value . "</th>";
        }
      }
      ?>
    </tr>
  </thead>
  <?php

  foreach ($result as $row) {
    echo "<tr><th>" . $row["lan"] . "</th><th>" . $row["objekttyp"] .
     "</th>
      <th>" . $row["adress"] . "</th>
      <th>" . $row["area"] . "</th>
      <th>" . $row["rum"] . "</th>
      <th>" . $row["pris"] . "</th>
      <th>" . $row["avgift"] . "</th>
      </tr>";
  }

  ?>
  </table>
</div>
 </body>
 <script type="text/javascript" src="index.js"></script>
</html>
